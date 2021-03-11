<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }

        Session::flash('error', 'Email - Password Anda Salah!!!');
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
