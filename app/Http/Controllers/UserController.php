<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('signout');
    }

    public function signInForm()
    {
        return view('user.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
            request()->session()->regenerate();
            return redirect()->intended('/');
        } else {
            $errors = ['email' => 'Hata Oluştu'];
            return back()->withErrors($errors);
        }
    }

    public function signout()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('homepage');
    }

    public function registerForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
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

    public function activate($activationKey)
    {
        $user = User::where('activation_key', $activationKey)->first();
        if (!is_null($user)) {
            $user->activation_key = null;
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/')
                ->with('message', 'Mail adresi doğrulandı.')
                ->with('message_type', 'success');
        } else {
            return redirect()->to('/')
                ->with('message', 'Mail adresi doğrulanmış')
                ->with('message_type', 'warning');
        }
    }
}
