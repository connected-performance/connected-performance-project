<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function logout()
    {
        session()->pull('admin');
        return redirect()->route('index');
    }
}
