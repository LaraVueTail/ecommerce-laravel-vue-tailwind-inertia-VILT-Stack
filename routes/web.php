<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerDashboardController;

// use App\Http\Controllers\AdminControllers\AdminThemeOptionsController;
use App\Http\Controllers\AdminControllers\AdminWebsiteContentController;
use App\Http\Controllers\AdminControllers\AdminHomePageContentController;
use App\Http\Controllers\AdminControllers\AdminAboutPageContentController;
use App\Http\Controllers\AdminControllers\AdminContactPageContentController;
use App\Http\Controllers\AdminControllers\AdminOrderController;
use App\Http\Controllers\AdminControllers\AdminProductController;
use App\Http\Controllers\AdminControllers\AdminCategoryController;
use App\Http\Controllers\AdminControllers\AdminUserController;

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
Route::name('public.')->group(function () {
    Route::get('/', [PublicPagesController::class, 'homePage'])->name('home');
    Route::get('/about', [PublicPagesController::class, 'aboutPage'])->name('about');
    Route::get('/contact', [PublicPagesController::class, 'contactPage'])->name('contact');

    Route::name('account.')->group(function(){
        Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');
        Route::post('login', [UserController::class, 'auth'])->middleware('guest');
        Route::post('logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
        
        Route::get('register', [UserController::class, 'create'])->middleware('guest')->name('register');
        Route::post('register', [UserController::class, 'store'])->middleware('guest');
    });

    Route::name('products.')->group(function(){
        Route::get('shop', [ProductController::class, 'index'])->name('index');
        Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('show');
    });

    Route::name('cart.')->group(function(){
        Route::get('cart/', [CartController::class, 'index'])->name('index');
        Route::post('cart/add', [CartController::class, 'add'])->name('add');
        Route::post('cart/update', [CartController::class, 'update'])->name('update');
        Route::post('cart/remove', [CartController::class, 'remove'])->name('remove');
    });

    Route::middleware('auth')->group(function () {
        Route::name('dashboard.')->group(function(){
            Route::prefix('dashboard')->group(function(){
                Route::get('/', [CustomerDashboardController::class, 'index'])->name('home');
                Route::get('/manage-address', [CustomerDashboardController::class, 'address'])->name('addresses');
                Route::get('/orders', [CustomerDashboardController::class, 'orders'])->name('orders');
                Route::post('/{user}', [CustomerDashboardController::class, 'update']);
            });
        });
        Route::name('checkout.')->group(function(){
            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('checkout', [CheckoutController::class, 'checkout']);
            Route::get('/success', [CheckoutController::class, 'success'])->name('success');
            Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
        });
    });
});

Route::name('admin.')->group(function(){
    Route::middleware('can:admin')->group(function () {
        Route::prefix('admin-dashboard')->group(function () {
            Route::get('', [AdminDashboardController::class, 'index'])->name('home');
            Route::get('/website-contents', [AdminWebsiteContentController::class, 'edit'])->name('website_contents');
            Route::put('/home-page-contents/{homePageContent}', [AdminHomePageContentController::class, 'update']);
            Route::put('/home-page-contents/{homePageContent}/deleteImage', [AdminHomePageContentController::class, 'deleteImage']);
            Route::put('/about-page-contents/{aboutPageContent}', [AdminAboutPageContentController::class, 'update']);
            Route::put('/contact-page-contents/{contactPageContent}', [AdminContactPageContentController::class, 'update']);
            Route::resource('/orders', AdminOrderController::class);
            Route::resource('/products', AdminProductController::class)->except('show');
            Route::resource('/categories', AdminCategoryController::class)->except('show');
            Route::resource('/users', AdminUserController::class);
            Route::put('/products/{product}/deleteImage', [AdminProductController::class, 'deleteImage']);
            Route::put('/orders/{order}/edit-status', [AdminOrderController::class, 'updateOrderStatus']); 
        });
    
    });
});




