<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            ['nombre' => 'Hamburguesería',],
            ['nombre' => 'De todo',],
            ['nombre' => 'Italiano',],
            ['nombre' => 'Japones/Chino',],
            ['nombre' => 'Sidrería',],
            ['nombre' => 'Restaurante',],
            ['nombre' => 'Cervecería',],
            ['nombre' => 'Chill-out',],
            ['nombre' => 'Picotear',],
        ]);
    }
}
