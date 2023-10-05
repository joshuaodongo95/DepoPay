<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('bisiness_id')->nullable();
            $table->foreign('bisiness_id', 'bisiness_fk_9077966')->references('id')->on('businesses');
        });
    }
}
