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
            $table->json('hero_carousel')->default(json_encode(["https://images.pexels.com/photos/5325632/pexels-photo-5325632.jpeg?auto=compress", "https://images.pexels.com/photos/5325589/pexels-photo-5325589.jpeg?auto=compress","https://images.pexels.com/photos/5325582/pexels-photo-5325582.jpeg?auto=compress","https://images.pexels.com/photos/5325701/pexels-photo-5325701.jpeg?auto=compress"]));
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
