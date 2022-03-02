<?php

use Illuminate\Database\Seeder;
use App\Customer;
   
class CreateCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'code' => 'ALD',
            'name' => 'alDía',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'ALC',
            'name' => 'Alicorp',
            'ruc' => '',
            'business_id' => 2,
        ],[
            'code' => 'AFP',
            'name' => 'Asociación de AFP',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'CCP',
            'name' => 'Asociación de Centros Comerciales del Perú (ACCEP)',
            'ruc' => '',
            'business_id' => 3,
        ],[
            'code' => 'AGP',
            'name' => 'Asociación de Gremios Productores Agrarios del Perú (AGAP)',
            'ruc' => '',
            'business_id' => 11,
        ],[
            'code' => 'APS',
            'name' => 'Asociación Peruana de Empresas de Seguros (APESEG)',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'BRK',
            'name' => 'Barrick',
            'ruc' => '',
            'business_id' => 4,
        ],[
            'code' => 'CLD',
            'name' => 'Cálidda',
            'ruc' => '',
            'business_id' => 4,
        ],[
            'code' => 'GIZ',
            'name' => 'Cooperación Alemana (GIZ)',
            'ruc' => '',
            'business_id' => 5,
        ],[
            'code' => 'DAS',
            'name' => 'Defensoría del Asegurado (DEFASEG)',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'DRC',
            'name' => 'DERCO',
            'ruc' => '',
            'business_id' => 6,
        ],[
            'code' => 'SUR',
            'name' => 'Grupo SURA',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'EFF',
            'name' => 'Grupo Valora (Effie Perú)',
            'ruc' => '',
            'business_id' => 7,
        ],[
            'code' => 'IAB',
            'name' => 'Interactive Advertising Bureau Perú (iab Perú)',
            'ruc' => '',
            'business_id' => 7,
        ],[
            'code' => 'IBK',
            'name' => 'Interbank',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'IZP',
            'name' => 'Izipay',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'LIM',
            'name' => 'Lima 2019',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'MCC',
            'name' => 'McCann Lima',
            'ruc' => '',
            'business_id' => 7,
        ],[
            'code' => 'MBC',
            'name' => 'Mibanco',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'MEF',
            'name' => 'Ministerio de Economía y Finanzas',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'MRE',
            'name' => 'Ministerio de Relaciones Exteriores',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'MTC',
            'name' => 'Ministerio de Transportes y Comunicaciones',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'MLI',
            'name' => 'Municipalidad de Lima',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'CKL',
            'name' => 'Nancy Cooklin',
            'ruc' => '',
            'business_id' => 9,
        ],[
            'code' => 'OSP',
            'name' => 'Osiptel',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'PCM',
            'name' => 'Presidencia del Consejo de Ministros',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'PMP',
            'name' => 'PromPerú',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'PRE',
            'name' => 'Preciso - Agencia de Contenidos',
            'ruc' => '',
            'business_id' => 10,
        ],[
            'code' => 'SNM',
            'name' => 'Sociedad Nacional de Minería, Petróleo y Energía (SNMPE)',
            'ruc' => '',
            'business_id' => 4,
        ],[
            'code' => 'SRB',
            'name' => 'SrBurns',
            'ruc' => '',
            'business_id' => 7,
        ],[
            'code' => 'WTP',
            'name' => 'Wunderman Thompson',
            'ruc' => '',
            'business_id' => 7,
        ],[
            'code' => 'FGL',
            'name' => 'Fruglobe',
            'ruc' => '',
            'business_id' => 11,
        ],[
            'code' => 'FFP',
            'name' => 'FreshFruit Perú',
            'ruc' => '',
            'business_id' => 10,
        ],[
            'code' => 'QVC',
            'name' => 'AngloAmerican',
            'ruc' => '',
            'business_id' => 4,
        ],[
            'code' => 'CCL',
            'name' => 'Casas de Chile',
            'ruc' => '',
            'business_id' => 13,
        ],[
            'code' => 'MEM',
            'name' => 'Ministerio de Energía y Minas',
            'ruc' => '',
            'business_id' => 8,
        ],[
            'code' => 'ASB',
            'name' => 'Asbanc',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'PCF',
            'name' => 'Pacífico Seguros',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'RPZ',
            'name' => 'Real Plaza',
            'ruc' => '',
            'business_id' => 3,
        ],[
            'code' => 'ICP',
            'name' => 'Intercorp',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'BIF',
            'name' => 'Banbif',
            'ruc' => '',
            'business_id' => 1,
        ],[
            'code' => 'SPM',
            'name' => 'Supermercados Peruanos',
            'ruc' => '',
            'business_id' => 3,
        ],[
            'code' => 'CPE',
            'name' => 'Colegios Peruanos',
            'ruc' => '',
            'business_id' => 14,
        ]];

        foreach ($array as $item)
            Customer::create($item);
    }
}
