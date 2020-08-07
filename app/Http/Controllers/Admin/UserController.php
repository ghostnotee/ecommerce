<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signInForm(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'is_active' => 1,
                'is_admin' => 1
            ];

            if (Auth::guard('admin')->attempt($credentials, true)) {

                return redirect()->route('admin.homepage');
            } else {
                return back()->withInput()->withErrors(['email' => 'Giriş Hatalı !']);
            }
        }

        return view('admin.signin');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.signin');
    }

    public function index()
    {
        $usersList = User::orderByDesc('created_at')->paginate(8);
        return view('admin.user.index', compact('usersList'));
    }
}
