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
            $table->string('contactHeading')->default('Contact Us');
            $table->string('contactSubHeading')->default('Some text');
            $table->string('contactText')->default('Some text ...');
            $table->string('contactPhoneNumbers');
            $table->string('contactEmail');
            $table->string('contactAddress');
            $table->string('contactImage')->nullable();
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
