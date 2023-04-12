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
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();
            $table->json('hero_carousel')->default(json_encode(["https://images.pexels.com/photos/1549200/pexels-photo-1549200.jpeg", "https://images.pexels.com/photos/354972/pexels-photo-354972.jpeg", "https://images.pexels.com/photos/6311237/pexels-photo-6311237.jpeg"]));
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
        Schema::dropIfExists('home_page_contents');
    }
};
