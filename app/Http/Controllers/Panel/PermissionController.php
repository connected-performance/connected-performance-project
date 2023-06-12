<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //

    public function permission_index($id){
        return$user = User::where('id',$id)->with('roles')->first();
        return view('content.permission.admin',compact('user'));
    }
}
