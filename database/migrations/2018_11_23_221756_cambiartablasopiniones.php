<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cambiartablasopiniones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DROP TABLE campo_opinion_marcas');
        DB::statement('DROP TABLE campo_opinion_tamanios');
        DB::statement('DROP TABLE campo_opinions');
        DB::statement('DROP TABLE campos');
        DB::statement('DROP TABLE servicios');
        DB::statement('DROP TABLE opinions');

        Schema::create('campos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',200);
            $table->timestamps();
        });

        Schema::create('subcampos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campo_id')->unsigned();
            $table->string('nombre',200);

            $table->boolean('indicarvaloracion')->default(1);
            $table->boolean('indicarnumero')->default(0);
            $table->boolean('indicarprecio')->default(0);
            $table->boolean('indicartamanio')->default(0);
            $table->boolean('indicarmarca')->default(0);
            $table->boolean('indicarubicacion')->default(0);

            $table->timestamps();

            $table->foreign('campo_id')->references('id')->on('campos')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('opinions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bar_id')->unsigned();
            $table->integer('device_id')->unsigned();

            $table->integer('precio')->default(0);
            $table->integer('calidad')->default(0);
            $table->integer('tipo_id')->default(0)->unsigned();

            $table->string('texto',400);

            $table->timestamps();

            $table->foreign('bar_id')->references('id')->on('bars')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('subcampo_opinions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('opinion_id')->unsigned();
            $table->integer('subcampo_id')->unsigned();

            $table->integer('indicarvaloracion')->default(0);
            $table->integer('indicarnumero')->default(0);
            $table->integer('indicarprecio')->default(0);
            $table->integer('indicartamanio')->default(0);
            $table->integer('indicarmarca')->default(0);
            $table->integer('indicarubicacion')->default(0);


            $table->string('texto',400);

            $table->foreign('opinion_id')->references('id')->on('opinions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subcampo_id')->references('id')->on('subcampos')->onDelete('cascade')->onUpdate('cascade');


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
        DB::statement('DROP TABLE campos');
        DB::statement('DROP TABLE subcampos');
        DB::statement('DROP TABLE opinions');
        DB::statement('DROP TABLE subcampo_opinions');
    }
}
