<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PaymentPlanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTagController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');


// Route::redirect('/', '/login');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('user', [HomeController::class, 'user'])->name('user');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Business
    Route::post('businesses/csv', [BusinessController::class, 'csvStore'])->name('businesses.csv.store');
    Route::put('businesses/csv', [BusinessController::class, 'csvUpdate'])->name('businesses.csv.update');
    Route::resource('businesses', BusinessController::class, ['except' => ['store', 'update', 'destroy']]);

    // Wallet
    Route::post('wallets/csv', [WalletController::class, 'csvStore'])->name('wallets.csv.store');
    Route::put('wallets/csv', [WalletController::class, 'csvUpdate'])->name('wallets.csv.update');
    Route::resource('wallets', WalletController::class, ['except' => ['store', 'update', 'destroy']]);

    // Payment Plans
    Route::resource('payment-plans', PaymentPlanController::class, ['except' => ['store', 'update', 'destroy']]);

    // Subscriptions
    Route::post('subscriptions/csv', [SubscriptionController::class, 'csvStore'])->name('subscriptions.csv.store');
    Route::put('subscriptions/csv', [SubscriptionController::class, 'csvUpdate'])->name('subscriptions.csv.update');
    Route::resource('subscriptions', SubscriptionController::class, ['except' => ['update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Product Category
    Route::post('product-categories/media', [ProductCategoryController::class, 'storeMedia'])->name('product-categories.storeMedia');
    Route::post('product-categories/csv', [ProductCategoryController::class, 'csvStore'])->name('product-categories.csv.store');
    Route::put('product-categories/csv', [ProductCategoryController::class, 'csvUpdate'])->name('product-categories.csv.update');
    Route::resource('product-categories', ProductCategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Product Tag
    Route::resource('product-tags', ProductTagController::class, ['except' => ['store', 'update', 'destroy']]);

    // Product
    Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::post('products/csv', [ProductController::class, 'csvStore'])->name('products.csv.store');
    Route::put('products/csv', [ProductController::class, 'csvUpdate'])->name('products.csv.update');
    Route::resource('products', ProductController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
