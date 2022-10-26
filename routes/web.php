<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home')->middleware('auth');
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
Route::post('/lougut', [AuthController::class, 'logout'])->name('logout');

Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout');
Route::get('/cart', [UserController::class, 'cart'])->name('cart');
