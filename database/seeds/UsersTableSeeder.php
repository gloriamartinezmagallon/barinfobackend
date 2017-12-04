<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert(
            ['name'=>'Administrador', 'email'=>'info@navarradeveloper.com', 'password'=>bcrypt('78752170d')]
        );
    }
}
