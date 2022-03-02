<?php
  
use Illuminate\Database\Seeder;
use App\Business;
   
class CreateBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'name' => 'Banca, finanzas y aseguradoras',
        ],[
            'name' => 'Consumo masivo',
        ],[
            'name' => 'Retail',
        ],[
            'name' => 'Energía y minas',
        ],[
            'name' => 'Consultoría',
        ],[
            'name' => 'Automóviles',
        ],[
            'name' => 'Publicidad y marketing',
        ],[
            'name' => 'Sector público',
        ],[
            'name' => 'Coaching',
        ],[
            'name' => 'Proyectos propios',
        ],[
            'name' => 'Agroexportación',
        ],[
            'name' => 'Contenidos',
        ],[
            'name' => 'Immobiliaria',
        ],[
            'name' => 'Educación',
        ]];

        foreach ($array as $item)
            Business::create($item);
    }
}
