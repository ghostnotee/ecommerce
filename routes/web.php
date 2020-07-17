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

Route::group(['prefix' => '/shoppingcart'], function () {
    Route::get('/', 'ShoppingCartController@index')->name('shoppingcart');
    Route::post('/addtocart', 'ShoppingCartController@addtocart')->name('shoppingcart.addtocart');
    Route::delete('/removefromcart/{rowId}', 'ShoppingCartController@removefromcart')->name('shoppingcart.removefromcart');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/payment', 'PaymentController@index')->name('payment');
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/orderdetails/{id}', 'OrderController@orderDetails')->name('orderdateils');
});

Route::group(['prefix' => '/user'], function () {
    Route::get('/signin', 'UserController@signInForm')->name('user.signin');
    Route::post('/signin', 'UserController@signin');
    Route::get('/register', 'UserController@registerForm')->name('user.register');
    Route::post('/register', 'UserController@register');
    Route::get('/activate/{activation_key}', 'UserController@activate')->name('useractivate');
    Route::post('/signout', 'UserController@signout')->name('user.signout');
});

//For test
Route::get('/test/mail', function () {
    $user = \App\Models\User::find(1);
    return new App\Mail\UserRegisterMail($user);
});
