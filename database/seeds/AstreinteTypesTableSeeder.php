<?php

/**
 * import the model
 */
use App\AstreinteType;

use Illuminate\Database\Seeder;
class AstreinteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'Astreinte de solicitation',                
            'Astreinte de production'                
        ];

        for($i = 0; $i < sizeof($name); $i++):
            $data = [
                'name' => $name[$i]
            ];

            AstreinteType::create($data);
        endfor;
    }
}
