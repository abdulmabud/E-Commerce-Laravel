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

Route::get('/', 'FrontendController@index')->name('homepage');

Route::get('/cart/{id}', 'FrontendController@cartAdd')->name('cart.add');
Route::get('/cart', 'FrontendController@showCart')->name('cart.show');
Route::get('/checkout', 'FrontendController@checkout')->name('checkout');

Route::post('/order','FrontendController@store')->name('order.store');
