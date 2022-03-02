<?php
  
use Illuminate\Database\Seeder;
use App\ProjectType;
   
class CreateProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'code' => 'CON',
            'name' => 'Consultoría',
            'description' => 'Proyectos de consultoría en general.',
        ],[
            'code' => 'PUB',
            'name' => 'Contenidos',
            'description' => 'Proyectos de contenidos impresos, digitales, audiovisuales o vivenciales.',
        ],[
            'code' => 'FFP',
            'name' => 'FreshFruit',
            'description' => 'Proyectos relacionados a FreshFruit Perú.',
        ],[
            'code' => 'OTR',
            'name' => 'Otros',
            'description' => 'Otro tipos de proyecto.',
        ]];

        foreach ($array as $item)
            ProjectType::create($item);
    }
}
