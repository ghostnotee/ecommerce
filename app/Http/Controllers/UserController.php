<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signInForm()
    {
        return view('user.signin');
    }

    public function registerForm()
    {
        return view('user.register');
    }
}
