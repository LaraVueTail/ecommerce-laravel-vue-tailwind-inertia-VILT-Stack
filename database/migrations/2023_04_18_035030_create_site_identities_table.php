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
            $table->string('siteName');
            $table->string('siteDomain');
            $table->string('siteEmail');
            $table->string('siteOwnerName');
            $table->string('siteOwnerEmail');
            $table->string('logoImage');
            $table->string('stripe_secret_key')->default(config('ecommerce.stripe_secret_key'));
            $table->boolean('enable_stripe')->default(config('ecommerce.enable_stripe'));
            $table->string('currency')->default(config('ecommerce.currency'));
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
