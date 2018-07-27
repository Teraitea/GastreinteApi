<?php

use Illuminate\Database\Seeder;

class AstreintesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Astreinte', 10)->create();
    }
}
