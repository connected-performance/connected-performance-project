<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class YouTubeController extends Controller
{

    public function redirectToYouTube()
    {
        // return Socialite::driver('youtube')->redirect();

        $client_id = env('YOUTUBE_CLIENT_ID');
        $redirect_uri = env('YOUTUBE_REDIRECT_URI');
        
        return redirect("https://accounts.google.com/o/oauth2/auth?client_id=$client_id&redirect_uri=$redirect_uri&scope=https://www.googleapis.com/auth/youtube&response_type=code");
    }

    public function handleYouTubeCallback()
    {
        $user = Socialite::driver('youtube')->user();

        // $user contains user data from YouTube

        // Store the user data in your database or do any other necessary processing

        return redirect('/dashboard'); // Redirect the user to the dashboard
    }
}
