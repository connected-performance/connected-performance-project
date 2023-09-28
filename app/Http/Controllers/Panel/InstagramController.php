<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;

class InstagramController extends Controller
{


    public function exchangeAccessToken(Request $request)
    {
        // Your short-lived access token
        $shortLivedToken = $request->input('short_lived_token');

        // Your Facebook App ID and App Secret
        $appId = env('FACEBOOK_APP_ID');
        $appSecret = env('FACEBOOK_APP_SECRET');

        // URL for token exchange
        $exchangeUrl = "https://graph.instagram.com/access_token";

        // Parameters for the POST request
        $params = [
            'form_params' => [
                'grant_type' => 'ig_exchange_token',
                'client_id' => $appId,
                'client_secret' => $appSecret,
                'access_token' => $shortLivedToken,
            ],
        ];

        // Initialize Guzzle HTTP client
        $client = new Client();

        try {
            $response = $client->post($exchangeUrl, $params);

            $data = json_decode($response->getBody(), true);

            // The long-lived access token
            $longLivedToken = $data['access_token'];

            // storing to db
            $config = Config::firstOrNew(['key' => 'insta_access_token']);
            $config->value = encrypt($longLivedToken);
            $config->save();

            return response()->json(['long_lived_token' => $longLivedToken]);
        } catch (\Exception $e) {
            // Handle any errors that may occur during the exchange process
            return response()->json(['error' => 'Token exchange failed'], 500);
        }
    }

    public function refreshToken($oldToken)
    {
        // Your logic to refresh the token here
        // Make a request to Instagram's API to obtain a new long-lived token

        $appId = env('FACEBOOK_APP_ID');
        $appSecret = env('FACEBOOK_APP_SECRET');

        $client = new Client();

        try {
            $response = $client->post('https://graph.instagram.com/refresh_access_token', [
                'form_params' => [
                    'grant_type' => 'ig_refresh_token',
                    'access_token' => $oldToken,
                    'client_secret' => $appSecret,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['access_token'])) {
                // storing to db
                $config = Config::firstOrNew(['key' => 'insta_access_token']);
                $config->value = encrypt($data['access_token']);
                $config->expiry = $data['expires_in'];
                $config->save();
                return $config;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getAccessToken()
    {
        $tokenRecord = User::findOrFail(auth()->user()->id);

        if (!$tokenRecord) {
            // Handle the case where the token record is not found
            return null;
        }

        $currentTimestamp = now();
        $expirationTimestamp = $tokenRecord->insta_access_token;

        if ($currentTimestamp >= $expirationTimestamp) {
            // The token has expired or is about to expire, trigger a refresh
            $newToken = $this->refreshToken($tokenRecord->value);

            if (!$newToken) {
                // Handle the case where the token refresh fails
                return response()->json(['error' => 'Token refresh failed'], 500);
            }

            return decrypt($newToken->value);
        } else {
            return decrypt($tokenRecord->value);
        }

        // Proceed with the API request using the token
        // ...
    }

    public function connectAccount()
    {

        $CLIENT_ID = env('INSTAGRAM_CLIENT_ID');
        $instagramAuthUrl = 'https://api.instagram.com/oauth/authorize'
            . "?client_id={$CLIENT_ID}"
            . '&redirect_uri=' . urlencode(route('instagram.callback'))
            . '&scope=user_profile,user_media'
            . '&response_type=code';

        return redirect($instagramAuthUrl);

        // return Socialite::driver('instagram')->redirect();
    }

    public function connectCallback(Request $request)
    {
        $code = $request->input('code');

        // Exchange the code for an access token
        // Make a POST request to Instagram's token endpoint
        $client = new Client();
        $response = $client->post('https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'client_id' =>  env('FACEBOOK_APP_ID'),
                'client_secret' => env('FACEBOOK_APP_SECRET'),
                'grant_type' => 'authorization_code',
                'redirect_uri' => route('instagram.callback'),
                'code' => $code,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $user = auth()->user(); // Assuming you have authenticated users
        $instagramUser = User::findOrFail($user->id);
        if ($user) {
            $instagramUser->insta_access_token = $data['access_token'];
            $instagramUser->insta_user_id = $data['user_id'];
            $instagramUser->token_expires_at = Carbon::now()->addSeconds($data['expires_in']);
            $instagramUser->save();
        }

        return response()->json($data);
    }

    public function getAccountDetails()
    {

        // Replace these with your actual values
        $accessToken = 'EAAI6gIuhFNIBO62QUyu8GjidMEhaCc2IIoWakjHu0iW0KDZAOzkXNZCbTInyCiPopcZB8ycTCvVDTtZB3IOEai4oFyPA3JhWLyBPeMA9UCJZBmmg7JB2260LA4hakqTM6CyLZAfwDZA2KVKZAy0w3V7ZA1wZAnMDNq13ZBEhWMXKYy5e7vWJLSY3pfH4hwDaN9dbUUqnzq3w3F88IS4x4Ak2s6WJDYnf6U10gZDZD';
        $instagramAccountId = 'summayyakhalid';

        $client = new Client();
        // $response = $client->get("https://graph.instagram.com/v12.0/{$instagramAccountId}?fields=id,username,followers_count,follows_count,media_count&access_token={$accessToken}");
        $response = $client->get("https://graph.instagram.com/v12.0/me/insights?metric=impressions,reach,follower_count&access_token={$accessToken}");

        $data = json_decode($response->getBody(), true);
        // $response = Http::get("https://graph.instagram.com/v12.0/{$instagramAccountId}?fields=id,username,followers_count,follows_count,media_count&access_token={$accessToken}");

        // $data = $response->json();

        // Access the data
        $username = $data['username'];
        $followersCount = $data['followers_count'];
        $followsCount = $data['follows_count'];
        $mediaCount = $data['media_count'];
    }
}
