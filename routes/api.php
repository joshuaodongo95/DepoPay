<?php

use App\Http\Controllers\Api\V1\Admin\BusinessApiController;
use App\Http\Controllers\Api\V1\Admin\PaymentPlanApiController;
use App\Http\Controllers\Api\V1\Admin\ProductApiController;
use App\Http\Controllers\Api\V1\Admin\ProductCategoryApiController;
use App\Http\Controllers\Api\V1\Admin\ProductTagApiController;
use App\Http\Controllers\Api\V1\Admin\SubscriptionApiController;
use App\Http\Controllers\Api\V1\Admin\UserApiController;
use App\Http\Controllers\Api\V1\Admin\WalletApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', UserApiController::class);

    // Business
    Route::apiResource('businesses', BusinessApiController::class);

    // Wallet
    Route::apiResource('wallets', WalletApiController::class);

    // Payment Plans
    Route::apiResource('payment-plans', PaymentPlanApiController::class);

    // Subscriptions
    Route::apiResource('subscriptions', SubscriptionApiController::class);

    // Product Category
    Route::post('product-categories/media', [ProductCategoryApiController::class, 'storeMedia'])->name('product_categories.store_media');
    Route::apiResource('product-categories', ProductCategoryApiController::class);

    // Product Tag
    Route::apiResource('product-tags', ProductTagApiController::class);

    // Product
    Route::post('products/media', [ProductApiController::class, 'storeMedia'])->name('products.store_media');
    Route::apiResource('products', ProductApiController::class);
});
