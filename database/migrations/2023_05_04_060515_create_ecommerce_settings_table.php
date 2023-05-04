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
        Schema::create('ecommerce_settings', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_secret_key')->default(config('ecommerce.stripe_secret_key'));
            $table->boolean('enable_stripe')->default(config('ecommerce.enable_stripe'));
            $table->string('whatsapp_number')->default(config('ecommerce.whatsapp_number'));
            $table->boolean('enable_whatsapp')->default(config('ecommerce.enable_whatsapp'));
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
        Schema::dropIfExists('ecommerce_settings');
    }
};
