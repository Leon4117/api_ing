<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class);

Route::controller(UserController::class)->group(function(){
    Route::post('user/login', 'login')->name('user.login');
});

Route::get('admin', [UserController::class, 'check']);

Route::resource('product', ProductController::class);
Route::resource('orders', OrdersController::class);
Route::get('orders/validate/{id}', [OrdersController::class, 'marca']);
