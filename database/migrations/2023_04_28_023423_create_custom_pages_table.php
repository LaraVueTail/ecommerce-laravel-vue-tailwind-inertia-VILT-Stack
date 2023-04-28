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
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('New Page');
            $table->string('title')->default('New Page Title');
            $table->string('sub_title')->default('Some text');
            $table->string('image')->default("https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg")->nullable();
            $table->string('slug')->unique();
            $table->text('content')->nullable();
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
        Schema::dropIfExists('custom_pages');
    }
};
