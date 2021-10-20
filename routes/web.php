<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/product/{id}', [FrontendController::class, 'productDetail'])->name('product.details');
Route::get('category/{slug}', [FrontendController::class, 'categoryProduct'])->name('category.product');

Route::post('/cart', [FrontendController::class, 'cartAdd'])->name('cart.add');
Route::post('/cartupdate', [FrontendController::class, 'cartUpdate'])->name('cart.update');
Route::get('/cart', [FrontendController::class, 'showCart'])->name('cart.show');
Route::post('/showcartlist', [FrontendController::class, 'showCartList'])->name('cart.showlist');
Route::post('/cartitemremove', [FrontendController::class, 'removeItem'])->name('cart.removeitem');
Route::post('/cartitemcount', [FrontendController::class, 'cartitemcount'])->name('cart.count');
Route::post('/singlecartitemcount', [FrontendController::class, 'singleCartItemCount'])->name('cart.scount');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'storeContact'])->name('contact.store');

Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');

Route::post('/order',[FrontendController::class, 'store'])->name('order.store');


//UserController
Route::get('/my-account', [UserController::class, 'account'])->name('myaccount');
Route::get('/my-account/order/{id}', [UserController::class, 'orderdetails'])->name('myaccount.orderdetails');


// Admin Group Route

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    //AdminController

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('order', [AdminController::class, 'order'])->name('admin.order');
    Route::post('orderfilter', [AdminController::class, 'orderFilter'])->name('admin.orderfilter');
    Route::get('order/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
    Route::post('status-change', [AdminController::class, 'changeStatus'])->name('order.status.change');
    Route::get('contact', [AdminController::class, 'contact'])->name('contact.index');
    Route::get('contact/{id}', [AdminController::class, 'contactDetails'])->name('contact.details');


    //ProductController 

    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);

    Route::get('featuredproduct', [ProductController::class, 'featuredproduct'])->name('featuredproduct.index');
    Route::post('add-featured-product', [ProductController::class, 'addfproduct'])->name('addfproduct');
    Route::get('add-featured-product/{id}', [ProductController::class, 'savefproduct'])->name('savefproduct');
    Route::delete('fproductdelete/{id}', [ProductController::class, 'fproductdelete'])->name('fproduct.delete');


    //FaqController
    Route::resource('faq', FaqController::class);

    //SettingController

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/deliverycharge', [SettingController::class, 'dCharge'])->name('setting.delivery.charge');
    Route::get('/setting/update-slider', [SettingController::class, 'updateSlider'])->name('slider.update');
    Route::post('/setting/update-slider/add', [SettingController::class, 'storeSlider'])->name('slider.store');
    Route::delete('/setting/update-slider/delete/{id}', [SettingController::class, 'destroySlider'])->name('slider.remove');

});

// User Authentication

Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// test code
Route::get('profile', function () {
    // Only authenticated users may enter...
})->middleware('auth.basic');
// Auth::routes();
