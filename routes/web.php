<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerDashboardController;

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
    Route::get('dashboard/orders', [CustomerDashboardController::class, 'orders']);
    Route::post('dashboard/{user}', [CustomerDashboardController::class, 'update']);

    Route::get('checkout', [CheckoutController::class, 'index']);
    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
}
);

Route::middleware('can:admin')->group(function () {
    Route::get('admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin_dashboard');
    Route::resource('admin-dashboard/orders', OrderController::class);
    Route::put('admin-dashboard/orders/{order}/edit-status', [OrderController::class, 'updateOrderStatus']); 
});

Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::post('login', [UserController::class, 'auth'])->middleware('guest');
Route::post('logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('register', [UserController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [UserController::class, 'store'])->middleware('guest');

