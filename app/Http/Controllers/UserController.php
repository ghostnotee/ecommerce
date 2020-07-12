<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function register()
    {
        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'user_name' => request('user_name'),
            'password' => Hash::make(request('password')),
            'email' => request('email'),
            'activation_key' => Str::random(60),
            'is_active' => 0
        ]);

        auth()->login($user);

        return redirect()->route('homepage');
    }
}
