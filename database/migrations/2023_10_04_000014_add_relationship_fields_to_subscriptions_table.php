<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_9066658')->references('id')->on('users');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9066659')->references('id')->on('products');
            $table->unsignedBigInteger('payment_plan_id')->nullable();
            $table->foreign('payment_plan_id', 'payment_plan_fk_9066660')->references('id')->on('payment_plans');
        });
    }
}
