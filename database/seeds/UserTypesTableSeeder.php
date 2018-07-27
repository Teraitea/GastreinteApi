<?php

/**
 * import the model
 */
use App\UserType;

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'developper',
            'admin',
            'manager',
            'agent'
        ];

        for($i = 0; $i < sizeof($name); $i++):
            $data = [
                'name' => $name[$i]
            ];

            UserType::create($data);
        endfor;
    }
}
