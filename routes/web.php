<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\PublicPagesController;
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

Route::get('/', [PublicPagesController::class, 'homePage'])->name('home');
Route::get('shop', [PublicPagesController::class, 'shopPage']);
Route::get('products/{product}', [PublicPagesController::class, 'singleProductPage']);

Route::get('cart/', [CartController::class, 'index']);
Route::post('cart/add', [CartController::class, 'add']);
Route::post('cart/update', [CartController::class, 'update']);
Route::post('cart/remove', [CartController::class, 'remove']);

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('customer_dashboard');
    Route::get('dashboard/manage-address', [CustomerDashboardController::class, 'address']);
    Route::post('dashboard/{user}', [CustomerDashboardController::class, 'update']);

    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
}
);

Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('login', [UserController::class, 'auth'])->middleware('guest');
Route::post('logout', [UserController::class, 'logout'])->middleware('auth');
