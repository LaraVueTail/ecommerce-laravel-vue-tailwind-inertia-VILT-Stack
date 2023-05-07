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
        Schema::create('footer_contents', function (Blueprint $table) {
            $table->id();
            // $table->json('pageLinks')->nullable()->default(json_encode([
            //     [
            //         'pageName'=>'About',
            //         'pageLink'=>asset('about')
            //     ],
            //     [
            //         'pageName'=>'Contact',
            //         'pageLink'=>asset('contact')
            //     ]
            // ]));
            $table->json('pageLinks')->nullable();
            $table->json('socialLinks')->nullable();
            // ->default(json_encode([
            //     [
            //         'socialName'=>'facebook',
            //         'socialLink'=>'#'
            //     ],
            //     [
            //         'socialName'=>'instagram',
            //         'socialLink'=>'#'
            //     ],
            //     [
            //         'socialName'=>'youtube',
            //         'socialLink'=>'#'
            //     ],
            //     [
            //         'socialName'=>'whatsapp',
            //         'socialLink'=>'#'
            //     ]
            // ]));
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
        Schema::dropIfExists('footer_contents');
    }
};
