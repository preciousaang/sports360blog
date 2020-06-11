<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){
            return response()->json(['message'=>'User Logged in'], 200);
        }else{
            return response()->json(['error'=>'Username/Password Combination Incorrect'], 401);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json(true, 200);
    }
}
