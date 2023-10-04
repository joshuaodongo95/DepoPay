<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PaymentPlanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Business
    Route::resource('businesses', BusinessController::class, ['except' => ['store', 'update', 'destroy']]);

    // Wallet
    Route::resource('wallets', WalletController::class, ['except' => ['store', 'update', 'destroy']]);

    // Payment Plans
    Route::resource('payment-plans', PaymentPlanController::class, ['except' => ['store', 'update', 'destroy']]);

    // Products
    Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::resource('products', ProductController::class, ['except' => ['store', 'update', 'destroy']]);

    // Categories
    Route::resource('categories', CategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Subscriptions
    Route::resource('subscriptions', SubscriptionController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
