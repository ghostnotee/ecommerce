<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $this->validate(request(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5|max:15'
        ]);

        $user = User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'user_name' => request('user_name'),
            'password' => Hash::make(request('password')),
            'email' => request('email'),
            'activation_key' => Str::random(60),
            'is_active' => 0
        ]);

        Mail::to(request('email'))->send(new UserRegisterMail($user));

        auth()->login($user);

        return redirect()->route('homepage');
    }
}
