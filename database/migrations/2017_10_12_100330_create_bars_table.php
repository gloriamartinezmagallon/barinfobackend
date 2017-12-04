<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codrecursoGN')->nullable();
            $table->string('nombre', 200);
            $table->string('nombreLocalidad', 500);
            $table->string('tipo', 500)->nullable();
            $table->string('especialidad', 500)->nullable();
            $table->string('imgFicheroGN', 500)->nullable();
            $table->string('descripZona', 500)->nullable();
            $table->double('latitud', 10, 7)->nullable();
            $table->double('longitud', 10, 7)->nullable();
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
        Schema::dropIfExists('bars');
    }
}
