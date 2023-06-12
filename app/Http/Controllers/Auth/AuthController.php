<?php

namespace App\Http\Controllers\Auth;

use App\Events\ActivityLog;
use App\Events\Notificaion;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail as MailDemoMail;

class AuthController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('isLoginUser');
       // $this->middleware('auth');
    }
//
    public function index()
    {
        return view('content.auth-login');
    }

    public function login(Request $request)
    {


        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => 'required',

        ]);
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = User::where('email', $request->email)->first();
            $actor = "";
            if($user->is_admin == true){
                $actor = 1;
            }else{
                $actor = 2;
            }
            $data = [
                'user_id'=>$user->id,
                'name' => $user->first_name." Active",
                'event_name' => "Login",
                'email' => $user->email,
                'description' => "Login Successfully",
                'actor' => $actor,
                'url' => url()->current(),

            ];
             event(new ActivityLog($data));
            $data = [
                'user_id' => $user->id,
                'title' => $user->first_name . '  Login',
                'description' => $user->first_name .  ' Success Full Login'
            ];
            if($user->is_admin == false){
                event(new Notificaion($data));
            }
            $type = 'login';
            Mail::to($user->email)->send(new MailDemoMail($user,$type));
            session()->put('admin', $user);
            session()->put('permissions', $user->roles[0]->permissions);
            return redirect()->route('panel.index');
        } else {
            return back()->with('error', 'wrong email or password');
        }
    }
}
