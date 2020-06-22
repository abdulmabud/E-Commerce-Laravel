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
Route::get('/product/{id}', 'FrontendController@productDetail')->name('product.details');
Route::get('category/{slug}', 'FrontendController@categoryProduct')->name('category.product');

Route::post('/cart', 'FrontendController@cartAdd')->name('cart.add');
Route::post('/cartupdate', 'FrontendController@cartUpdate')->name('cart.update');
Route::get('/cart', 'FrontendController@showCart')->name('cart.show');
Route::get('/checkout', 'FrontendController@checkout')->name('checkout');

Route::post('/order','FrontendController@store')->name('order.store');


// admin area

Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/order', 'AdminController@order')->name('admin.order');
Route::get('/admin/order/{id}', 'AdminController@orderDetails')->name('admin.order.details');


//ProductController 

Route::resource('admin/product', 'ProductController');
Route::resource('admin/category', 'CategoryController');

Route::get('admin/featuredproduct', 'ProductController@featuredproduct')->name('featuredproduct.index');
Route::post('admin/add-featured-product', 'ProductController@addfproduct')->name('addfproduct');
Route::get('admin/add-featured-product/{id}', 'ProductController@savefproduct')->name('savefproduct');
Route::delete('admin/fproductdelete/{id}', 'ProductController@fproductdelete')->name('fproduct.delete');