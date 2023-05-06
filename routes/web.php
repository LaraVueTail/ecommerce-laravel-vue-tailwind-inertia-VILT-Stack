<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;

use App\Http\Controllers\AdminControllers\AdminUserController;
use App\Http\Controllers\AdminControllers\AdminOrderController;
use App\Http\Controllers\AdminControllers\AdminProductController;
use App\Http\Controllers\AdminControllers\AdminCategoryController;
use App\Http\Controllers\AdminControllers\AdminEcommerceSettingsController;
use App\Http\Controllers\AdminControllers\ThemeSettingsControllers\AdminSiteIdentityController;
use App\Http\Controllers\AdminControllers\ThemeSettingsControllers\AdminFooterController;


use App\Http\Controllers\AdminControllers\PagesControllers\AdminHomePageContentController;
use App\Http\Controllers\AdminControllers\PagesControllers\AdminAboutPageContentController;
use App\Http\Controllers\AdminControllers\PagesControllers\AdminContactPageContentController;
use App\Http\Controllers\AdminControllers\PagesControllers\AdminCustomPageController;



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
    Route::get('/pages/{customPage:slug}', [PublicPagesController::class, 'customPage'])->name('customPage');


    Route::name('account.')->group(function(){
        Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');
        Route::post('login', [UserController::class, 'auth'])->middleware('guest');
        Route::post('logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

        Route::get('register', [UserController::class, 'create'])->middleware('guest')->name('register');
        Route::post('register', [UserController::class, 'store'])->middleware('guest');
    });

    Route::name('products.')->group(function(){
        Route::get('/shop', [ProductController::class, 'index'])->name('index');
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
                Route::get('/address', [CustomerDashboardController::class, 'address'])->name('address');
                Route::get('/orders', [CustomerDashboardController::class, 'orders'])->name('orders');
                Route::post('/{user}', [CustomerDashboardController::class, 'update']);
            });
        });
        Route::name('checkout.')->group(function(){
            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('checkout', [CheckoutController::class, 'checkout']);
            Route::post('checkout/webhook', [CheckoutController::class, 'webhook']);
            Route::get('checkout/success', [CheckoutController::class, 'success'])->name('success');
            Route::get('checkout/cancel', [CheckoutController::class, 'cancel'])->name('cancel');
        });
    });
});

Route::name('admin.')->group(function(){
    Route::middleware('can:admin')->group(function () {
        Route::prefix('admin-dashboard')->group(function () {
            Route::get('', [AdminDashboardController::class, 'index'])->name('home');
            Route::resource('/orders', AdminOrderController::class);
            Route::resource('/products', AdminProductController::class)->except('show');
            Route::resource('/categories', AdminCategoryController::class)->except('show');
            Route::resource('/users', AdminUserController::class);
            Route::get('/ecommerce-settings', [AdminEcommerceSettingsController::class, 'edit'])->name('ecommerce-settings_edit');
            Route::put('/ecommerce-settings', [AdminEcommerceSettingsController::class, 'update'])->name('ecommerce-settings_update');
            Route::put('/products/{product}/deleteImage', [AdminProductController::class, 'deleteImage']);
            Route::put('/orders/{order}/edit-status', [AdminOrderController::class, 'updateOrderStatus']); 

            Route::name('pages.')->group(function(){
                Route::prefix('pages')->group(function () {
                Route::get('/home-page-content/edit', [AdminHomePageContentController::class, 'edit'])->name('home_page_edit');
                Route::get('/about-page-content/edit', [AdminAboutPageContentController::class, 'edit'])->name('about_page_edit');
                Route::get('/contact-page-content/edit', [AdminContactPageContentController::class, 'edit'])->name('contact_page_edit');
                Route::get('/more-pages/edit', [AdminCustomPageController::class, 'edit'])->name('more_pages_edit');
                Route::put('/home-page-contents/delete-image', [AdminHomePageContentController::class, 'deleteImage'])->name('home_page_deleteImage');
                Route::put('/home-page-content', [AdminHomePageContentController::class, 'update'])->name('home_page_update');
                Route::put('/about-page-content', [AdminAboutPageContentController::class, 'update'])->name('about_page_update');
                Route::put('/contact-page-content', [AdminContactPageContentController::class, 'update'])->name('contact_page_update');
                Route::post('/more-pages-store', [AdminCustomPageController::class, 'store'])->name('more_pages_store');
                Route::put('/custom-page-content/{customPage}', [AdminCustomPageController::class, 'update'])->name('more_pages_update');
                Route::delete('/custom-page-content/{customPage}', [AdminCustomPageController::class, 'destroy'])->name('more_pages_delete');
                });
            });

            Route::name('theme-settings.')->group(function(){
                Route::prefix('theme-settings')->group(function () {
                    Route::get('/site-identity/edit', [AdminSiteIdentityController::class, 'edit'])->name('site_identity_edit');
                    Route::get('/footer/edit', [AdminFooterController::class, 'edit'])->name('footer_edit');
                    Route::put('/site-identity', [AdminSiteIdentityController::class, 'update'])->name('site_identity_update');
                    Route::put('/footer', [AdminFooterController::class, 'update'])->name('footer_update');
                });
            });


        });
    
    });
});




