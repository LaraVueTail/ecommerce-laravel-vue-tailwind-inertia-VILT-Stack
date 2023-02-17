<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [PublicPagesController::class,'homePage']);
Route::get('shop', [PublicPagesController::class,'shopPage']);
Route::get('products/{product}', [PublicPagesController::class,'singleProductPage']);

Route::get('cart/',[CartController::class,'index']);
Route::post('cart/add',[CartController::class,'add']);
Route::post('cart/update',[CartController::class,'update']);
Route::post('cart/remove',[CartController::class,'remove']);

Route::get('dashboard',[CustomerDashboardController::class,'index'])->name('customer_dashboard');
Route::get('dashboard/manage-address',[CustomerDashboardController::class,'address']);
Route::post('dashboard/{user}',[CustomerDashboardController::class,'update']);

Route::get('login',[UserController::class,'login']);
Route::post('login',[UserController::class,'auth']);
Route::post('logout',[UserController::class,'logout']);