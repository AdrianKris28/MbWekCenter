<?php

use App\Http\Controllers\Auth\LoginController as login;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;

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
    return view('auth.login');
});

Route::get('cart', function () {
    return view('cart');
})->name('cart');

Route::get('transaction', function () {
    return view('transaction');
})->name('transaction');

Route::get('/home', [PageController::class, 'home'])->name('home');

Route::get('/manageUser', [PageController::class, 'viewUser'])->name('manageUser');
Route::get('/manageUser/delete/{id}', [PageController::class, 'deleteUser']);

Route::get('/updateProduct/{id}', [PageController::class, 'updateProduct']);
// Route::get('/updateProduct/{id}', [PageController::class, 'updateProduct']);
Route::post('/updateProd', [PageController::class, 'updateProd']);

Route::get('/insertProduct', [PageController::class, 'insertProduct'])->name('insertProduct');
Route::post('/insertProd', [PageController::class, 'insertProd'])->name('insertProd');

Route::get('/updateprofile', [PageController::class, 'profileUpdate'])->name('updateprofile');
Route::post('/updateprof', [PageController::class, 'updateprof'])->name('updateprof');

Route::get('/productDetail/{id}', [PageController::class, 'detailProduct']);
Route::post('/addToCart', [PageController::class, 'addCartProduct']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
