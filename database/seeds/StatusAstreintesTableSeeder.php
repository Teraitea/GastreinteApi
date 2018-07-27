<?php
/**
 * Import the model
 */
use App\StatusAstreinte;
use Illuminate\Database\Seeder;

class StatusAstreintesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'A valider',                
            'Validé',                
            'Refusé'                
        ];

        for($i = 0; $i < sizeof($name); $i++):
            $data = [
                'name' => $name[$i]
            ];

            StatusAstreinte::create($data);
        endfor;
    }
}
