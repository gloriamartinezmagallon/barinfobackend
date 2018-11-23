<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleinfoBar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bars', function (Blueprint $table) {            
            $table->string('google_phonenumber',255)->nullable();          
            $table->string('google_website',255)->nullable();      
            $table->double('google_rating', 4, 2)->nullable();
            $table->integer('google_pricelevel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bars', function (Blueprint $table) {
            //
        });
    }
}
