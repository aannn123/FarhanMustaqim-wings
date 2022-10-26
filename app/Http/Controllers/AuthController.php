<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'user' => $request->user,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
           Session::flash('error', 'Username dan password tidak sesuai');
           return redirect()->back();
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
