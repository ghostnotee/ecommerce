<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function form($id = 0)
    {
        $user = new User;
        if ($id > 0) {
            $user = User::find($id);
        }
        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->only('first_name', 'last_name', 'email', 'user_name', 'is_active', 'is_admin');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        /*$data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;*/

        if ($request->id > 0) {
            // update
            $user = User::where('id', $request->id)->firstOrFail();
            $user->update($data);
        } else {
            // new create
            $user = User::create($data);
        }

        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->address,
                'phone' => $request->phone,
                'other_phone' => $request->other_phone
            ]
        );

        return redirect()->route('admin.user.edit', $user->id)
            ->with('message', ($request->id > 0 ? 'Güncellendi' : 'Kaydedildi'))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        User::destroy($id);

        return redirect()
            ->route('admin.user')
            ->with('message_type', 'success')
            ->with('message', 'Kullanıcı Silindi');
    }
}
