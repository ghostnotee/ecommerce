<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomePageController@index')->name('homepage');
Route::get('/category/{slug_categoryname}', 'CategoryController@index')->name('category');
Route::get('/product/{slug_productname}', 'ProductController@index')->name('product');
Route::post('/search', 'ProductController@search')->name('product_search');
Route::get('/search', 'ProductController@search')->name('product_search');
Route::get('/shoppingcart', 'ShoppingCartController@index')->name('shoppingcart');
Route::get('/payment', 'PaymentController@index')->name('payment');
Route::get('/orders', 'OrderController@index')->name('orders');
Route::get('/orderdetails/{id}', 'OrderController@orderDetails')->name('orderdateils');

Route::group(['prefix' => '/user'], function () {
    Route::get('/signin', 'UserController@signInForm')->name('user.signin');
    Route::get('/register', 'UserController@registerForm')->name('user.register');
    Route::post('/register', 'UserController@register');
});

//For test
Route::get('/test/mail', function () {
    $user = \App\Models\User::find(1);
    return new App\Mail\UserRegisterMail($user);
});
