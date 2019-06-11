<?php

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController', ['except' => ['store', 'create', 'destroy']]);
Route::delete('/users/{user}/delete', 'UsersController@delete');

Route::get('/shoeimg/{id}/{size}', 'ImagesController@shoe_image');


Route::resource('/shoes', 'ShoesController');
Route::get('/shoes/{id}/increment', 'ShoesController@increment');
Route::get('/shoes/{id}/decrement', 'ShoesController@decrement');


Route::get('/cart', 'CartController@index');
Route::post('/cart/add', 'CartController@cart');
Route::get('/cart/{id}/increment/{qty}', 'CartController@increment');
Route::get('/cart/{id}/decrement/{qty}', 'CartController@decrement');
Route::get('/cart/edit', 'CartController@update');
Route::get('/cart/{id}/remove', 'CartController@remove');
Route::get('/cart/destroy', 'CartController@destroy');


Route::resource('/admin/dashboard', 'AdminController');



Route::get('paypal/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
Route::get('paypal/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
Route::post('paypal/notify', 'PaypalController@notify');

Route::resource('/status', 'StatusController');


Route::get('users/{user}/orders', 'OrdersController@index');
Route::get('/orders', 'OrdersController@administratorindex');
Route::patch('orders/{order}/delivered', 'OrdersController@update');



Route::get('/orders/{order}/rate/{rate}/create', 'RatesController@create');
Route::post('/rates/store', 'RatesController@store');
Route::delete('/rates/{rate}', 'RatesController@destroy');
Route::get('/users/{user}/rates', 'RatesController@user_rates_index');

