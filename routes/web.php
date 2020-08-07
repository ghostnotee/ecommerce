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

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/signin');
    Route::match(['get', 'post'], '/signin', 'UserController@signInForm')->name('admin.signin');
    Route::get('/logout', 'UserController@logout')->name('admin.logout');
    Route::middleware('admin')->get('/homepage', 'HomepageController@index')->name('admin.homepage');

    // /admin/user

    Route::prefix('/user')->group(function () {
        Route::match(['get', 'post'], '/', 'UserController@index')->name('admin.user');
        Route::get('/create', 'UserController@form')->name('admin.user.create');
        Route::get('/edit/{id}', 'UserController@form')->name('admin.user.edit');
        Route::post('/save/{id?}', 'UserController@save')->name('admin.user.save');
        Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
    });
});

Route::get('/', 'HomePageController@index')->name('homepage');
Route::get('/category/{slug_categoryname}', 'CategoryController@index')->name('category');
Route::get('/product/{slug_productname}', 'ProductController@index')->name('product');
Route::post('/search', 'ProductController@search')->name('product_search');
Route::get('/search', 'ProductController@search')->name('product_search');

Route::group(['prefix' => '/shoppingcart'], function () {
    Route::get('/', 'ShoppingCartController@index')->name('shoppingcart');
    Route::post('/addtocart', 'ShoppingCartController@addtocart')->name('shoppingcart.addtocart');
    Route::delete('/removefromcart/{rowId}', 'ShoppingCartController@removefromcart')->name('shoppingcart.removefromcart');
    Route::delete('/emptythecart', 'ShoppingCartController@emptythecart')->name('shoppingcart.emptythecart');
    Route::patch('/updatethecart/{rowId}', 'ShoppingCartController@updatethecart')->name('shoppingcart.updatethecart');
});

Route::get('/payment', 'PaymentController@index')->name('payment');
Route::post('/payment', 'PaymentController@paying')->name('paying');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/orderdetails/{id}', 'OrderController@orderDetails')->name('orderdetails');
});

Route::group(['prefix' => '/user'], function () {
    Route::get('/signin', 'UserController@signInForm')->name('user.signin');
    Route::post('/signin', 'UserController@signin');
    Route::get('/register', 'UserController@registerForm')->name('user.register');
    Route::post('/register', 'UserController@register');
    Route::get('/activate/{activation_key}', 'UserController@activate')->name('user.activate');
    Route::post('/signout', 'UserController@signout')->name('user.signout');
});

//For test
Route::get('/test/mail', function () {
    $user = \App\Models\User::find(1);
    return new App\Mail\UserRegisterMail($user);
});
