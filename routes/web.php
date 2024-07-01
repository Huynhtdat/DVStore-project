<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\User\SocialController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

// Routes under maintenance middleware
Route::middleware(['maintenance'])->group(function () {
    Route::get('/', [App\Http\Controllers\User\HomeController::class, "index"])->name('user.home');
    Route::get('product-detail/{product}', [App\Http\Controllers\User\ProductDetailController::class, "show"])->name('user.products_detail');
    Route::get('products/{slug}', [App\Http\Controllers\User\ShowProductController::class, "index"])->name('user.products');
    Route::get('search', [App\Http\Controllers\User\SearchController::class, "search"])->name('user.search');
});

Route::middleware(['maintenance_active'])->group(function () {
    Route::get('maintenance', [App\Http\Controllers\User\HomeController::class, "maintenance"])->name('user.maintenance');
});

// Routes under auth.user middleware
Route::middleware(['auth.user'])->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, "destroy"])->name('user.logout');
    Route::group(['prefix' => 'order-history'], function () {
        Route::get('/', [App\Http\Controllers\User\OrderHistoryController::class, 'index'])->name('order_history.index');
        Route::get('/detail/{order}', [App\Http\Controllers\User\OrderHistoryController::class, 'show'])->name('order_history.show');
        Route::get('/update/{order}', [App\Http\Controllers\User\OrderHistoryController::class, 'update'])->name('order_history.update');
    });
    Route::post('product-review/{product}', [App\Http\Controllers\User\ProductReviewController::class, "store"])->name('product_review.store');
    #cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
        Route::post('add-to-cart', [App\Http\Controllers\User\CartController::class, 'store'])->name('cart.store');
        Route::post('update-cart', [App\Http\Controllers\User\CartController::class, 'update'])->name('cart.update');
        Route::get('delete/{id}', [App\Http\Controllers\User\CartController::class, 'delete'])->name('cart.delete');
        Route::get('clear', [App\Http\Controllers\User\CartController::class, 'clearAllCart'])->name('cart.clear');
    });

    #prodfile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/change-password', [App\Http\Controllers\User\ProfileController::class, 'changePassword'])->name('profile.change_password');
        Route::post('/change-profile', [App\Http\Controllers\User\ProfileController::class, 'changeProfile'])->name('profile.change_profile');
    });

    #check out
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', [App\Http\Controllers\User\CheckOutController::class, 'index'])->name('checkout.index');
        Route::post('/', [App\Http\Controllers\User\CheckOutController::class, 'store']);
        Route::get('/callback-momo', [App\Http\Controllers\User\CheckOutController::class, 'callbackMomo'])->name('checkout.callback_momo');
        Route::get('/callback-vnpay', [App\Http\Controllers\User\CheckOutController::class, 'callbackVNPay'])->name('checkout.callback_vnpay');
    });
});

// Routes for guest users
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, "create"])->name('user.login');
    Route::post('login', [AuthenticatedSessionController::class, "store"]);

    Route::get('register', [RegisterController::class, "create"])->name('user.register');
    Route::post('register', [RegisterController::class, "store"]);

    Route::get('/api/city', [RegisterController::class, 'getCityData']);
    Route::get('/api/districts', [RegisterController::class, 'getDistricts']);
    Route::get('/api/wards', [RegisterController::class, 'getWards']);

    Route::get('verify-email/{user}', [RegisterController::class, "verifyEmail"])->name('user.verification.notice');
    Route::get('account/verify/{id}', [VerifyEmailController::class, 'verifyAccount'])->name('user.verify');
    Route::post('resend-email', [RegisterController::class, "resendEmail"])->name('user.resend_email');
    Route::get('verify-success', [RegisterController::class, "success"])->name('user.verify.success');

    Route::get('forgot-password', [ForgotPasswordController::class, "create"])->name('user.forgot_password_create');
    Route::post('forgot-password', [ForgotPasswordController::class, "store"])->name('user.forgot_password_store');
    Route::get('account/change-new-password', [ForgotPasswordController::class, "changePassword"])->name('user.change_new_password');
    Route::post('account/change-new-password', [ForgotPasswordController::class, "updatePassword"]);

    Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
    Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
});
