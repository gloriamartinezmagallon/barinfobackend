<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnOpinionIdCampoopinionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campo_opinions', function (Blueprint $table) {
            $table->integer('opinion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campo_opinions', function (Blueprint $table) {
            $table->dropColumn('opinion_id');
        });
    }
}
