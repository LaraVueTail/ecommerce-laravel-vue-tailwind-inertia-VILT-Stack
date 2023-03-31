<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('availability')->nullable();
            $table->string('brand')->nullable();
            $table->string('tag')->nullable();
            $table->integer('inventory')->nullable();
            $table->foreignId('category_id');
            $table->string('slug')->unique();
            $table->string('link')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('more_images')->nullable();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->json('product_details')->nullable();
            $table->float('price_sale')->nullable();
            $table->float('price');
            $table->string('offer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
