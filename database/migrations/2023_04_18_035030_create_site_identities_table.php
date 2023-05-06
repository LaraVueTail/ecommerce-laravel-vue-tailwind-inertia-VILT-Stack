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
        Schema::create('site_identities', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_domain');
            $table->string('site_email');
            $table->string('site_owner_name');
            $table->string('site_owner_email');
            $table->string('logo_image');
            $table->string('banner_text');
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
        Schema::dropIfExists('site_identities');
    }
};
