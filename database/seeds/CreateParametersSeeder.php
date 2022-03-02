<?php
  
use Illuminate\Database\Seeder;
use App\Parameter;
   
class CreateParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'name' => 'DIAS',
            'value' => 31
        ]];

        foreach ($array as $item)
            Parameter::create($item);
    }
}
