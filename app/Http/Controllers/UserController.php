<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisterMail;
use App\Models\ShoppingCart;
use App\Models\ShoppingcartProduct;
use App\Models\User;
use App\Models\UserDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
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
            $request->session()->regenerate();

            $activeCartId = ShoppingCart::activeCartId();
            if (is_null($activeCartId)) {
                $activeCart = ShoppingCart::create(['user_id' => Auth::id()]);
                $activeCartId = $activeCart->id;
            }
            session()->put('activeCartId', $activeCartId);

            if (Cart::count() > 0) {
                foreach (Cart::content() as $cartItem) {
                    ShoppingcartProduct::updateOrCreate(
                        ['shoppingcart_id' => $activeCartId, 'product_id' => $cartItem->id],
                        ['quantity' => $cartItem->qty, 'price' => $cartItem->price, 'status' => 'Beklemede']
                    );
                }
            }

            Cart::destroy();

            $cartProducts = ShoppingcartProduct::with('product')
                ->where('shoppingcart_id', $activeCartId)->get();

            foreach ($cartProducts as $cartProduct) {
                Cart::add(
                    $cartProduct->product->id,
                    $cartProduct->product->product_name,
                    $cartProduct->quantity,
                    $cartProduct->price,
                    0,
                    ['slug' => $cartProduct->product->slug]
                );
            }

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

        $user->userdetail()->save(new UserDetail());

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
