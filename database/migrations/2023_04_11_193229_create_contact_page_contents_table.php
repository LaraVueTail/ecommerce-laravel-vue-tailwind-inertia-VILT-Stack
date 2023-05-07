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
        Schema::create('contact_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('contact_heading')->default('Contact Us');
            $table->string('contact_sub_heading')->default('Some text');
            $table->text('contact_text')->default('Some text ...');
            $table->string('contact_phone_numbers');
            $table->string('contact_email');
            $table->string('contact_address');
            $table->string('contact_image')->default("https://images.pexels.com/photos/8204325/pexels-photo-8204325.jpeg")->nullable();
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
        Schema::dropIfExists('contact_page_contents');
    }
};
