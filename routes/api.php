<?php

use App\Http\Controllers\Api\V1\Admin\CategoryApiController;
use App\Http\Controllers\Api\V1\Admin\PaymentPlanApiController;
use App\Http\Controllers\Api\V1\Admin\ProductApiController;
use App\Http\Controllers\Api\V1\Admin\SubscriptionApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Payment Plans
    Route::apiResource('payment-plans', PaymentPlanApiController::class);

    // Products
    Route::post('products/media', [ProductApiController::class, 'storeMedia'])->name('products.store_media');
    Route::apiResource('products', ProductApiController::class);

    // Categories
    Route::apiResource('categories', CategoryApiController::class);

    // Subscriptions
    Route::apiResource('subscriptions', SubscriptionApiController::class);
});
