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
        Schema::create('about_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('about_heading')->default('About Us');
            $table->string('about_sub_heading')->default('Some text');
            $table->text('about_text')->nullable();
            $table->string('about_image')->default("https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg")->nullable();
            $table->json('about_statuses')->nullable();
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
        Schema::dropIfExists('about_page_contents');
    }
};
