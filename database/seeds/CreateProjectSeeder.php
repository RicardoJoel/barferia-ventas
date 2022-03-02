<?php

use Illuminate\Database\Seeder;
use App\Project;
   
class CreateProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'project_type_id' => 4, 'customer_id' => 28, 'manager_id' => 1, 'code' => 'OTR000000PRETEM', 'name' => 'Otros temas', 'approved_at' => NULL,],[
            'project_type_id' => 4, 'customer_id' => 28, 'manager_id' => 1, 'code' => 'OTR000000PREVAC', 'name' => 'Vacaciones', 'approved_at' => NULL,],[
            'project_type_id' => 4, 'customer_id' => 28, 'manager_id' => 1, 'code' => 'OTR000000PREPER', 'name' => 'Permiso', 'approved_at' => NULL,],[
            'project_type_id' => 4, 'customer_id' => 28, 'manager_id' => 1, 'code' => 'OTR000000PREALM', 'name' => 'Almuerzo', 'approved_at' => NULL,],[
            'project_type_id' => 2, 'customer_id' => 1, 'manager_id' => 1, 'code' => 'PUB300419ALDNTS', 'name' => 'Notas', 'approved_at' => '2019-04-30',],[
            'project_type_id' => 2, 'customer_id' => 3, 'manager_id' => 1, 'code' => 'PUB051219AFPVFN', 'name' => 'Video de funcionalidad (adicional)', 'approved_at' => '2019-12-05',],[
            'project_type_id' => 2, 'customer_id' => 6, 'manager_id' => 1, 'code' => 'PUB010519APSFEE', 'name' => 'Contrato APESEG - FEE', 'approved_at' => '2019-05-01',],[
            'project_type_id' => 2, 'customer_id' => 13, 'manager_id' => 1, 'code' => 'PUB021219EFFPGW', 'name' => 'Página web de Effie', 'approved_at' => '2019-12-02',],[
            'project_type_id' => 2, 'customer_id' => 13, 'manager_id' => 1, 'code' => 'PUB080419EFFRDS', 'name' => 'Redes sociales', 'approved_at' => '2019-04-08',],[
            'project_type_id' => 2, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'PUB170619GIZGTC', 'name' => 'Guía de transporte y cambio climático', 'approved_at' => '2019-06-17',],[
            'project_type_id' => 2, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'PUB080819GIZAGT', 'name' => 'Agendas territoriales', 'approved_at' => '2019-08-08',],[
            'project_type_id' => 2, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'PUB051219GIZMDG', 'name' => 'Memoria digital', 'approved_at' => '2019-12-05',],[
            'project_type_id' => 2, 'customer_id' => 17, 'manager_id' => 1, 'code' => 'PUB040919LIMINS', 'name' => 'Memoria Institucional', 'approved_at' => '2019-09-04',],[
            'project_type_id' => 2, 'customer_id' => 19, 'manager_id' => 1, 'code' => 'PUB260419MBCCFI', 'name' => 'Consultorio Financiero', 'approved_at' => '2019-04-26',],[
            'project_type_id' => 2, 'customer_id' => 24, 'manager_id' => 1, 'code' => 'PUB051219CKLLBR', 'name' => 'Libro de Coaching', 'approved_at' => '2019-12-05',],[
            'project_type_id' => 2, 'customer_id' => 26, 'manager_id' => 1, 'code' => 'PUB251119PCMSUT', 'name' => 'Manual SUT', 'approved_at' => '2019-11-25',],[
            'project_type_id' => 2, 'customer_id' => 26, 'manager_id' => 1, 'code' => 'PUB271219PCMPSC', 'name' => 'PROMSACE', 'approved_at' => '2019-12-27',],[
            'project_type_id' => 2, 'customer_id' => 29, 'manager_id' => 1, 'code' => 'PUB250619SNMPHE', 'name' => 'Piezas de hidrocarburos y energía', 'approved_at' => '2019-06-25',],[
            'project_type_id' => 2, 'customer_id' => 12, 'manager_id' => 1, 'code' => 'PUB051219SURVTT', 'name' => 'Videos Tutoriales', 'approved_at' => '2019-12-05',],[
            'project_type_id' => 2, 'customer_id' => 12, 'manager_id' => 1, 'code' => 'PUB010120SURFEE', 'name' => 'Contrato SURA - FEE', 'approved_at' => '2020-01-01',],[
            'project_type_id' => 1, 'customer_id' => 4, 'manager_id' => 1, 'code' => 'CON080120CCPBRC', 'name' => 'Brochure Accep', 'approved_at' => '2020-01-08',],[
            'project_type_id' => 2, 'customer_id' => 10, 'manager_id' => 1, 'code' => 'PUB080120DASPGW', 'name' => 'Página web Defensoría del Asegurado', 'approved_at' => '2020-01-08',],[
            'project_type_id' => 2, 'customer_id' => 28, 'manager_id' => 1, 'code' => 'PUB010120PREL25', 'name' => 'Libro Effie 25 Años', 'approved_at' => '2020-01-01',],[
            'project_type_id' => 2, 'customer_id' => 31, 'manager_id' => 1, 'code' => 'PUB061219WTPCIM', 'name' => 'Lima 2019 - Comunicaciones: Impresión', 'approved_at' => '2019-12-06',],[
            'project_type_id' => 2, 'customer_id' => 31, 'manager_id' => 1, 'code' => 'PUB101019WTPCCO', 'name' => 'Lima 2019 - Comunicaciones: Contenido', 'approved_at' => '2019-10-10',],[
            'project_type_id' => 3, 'customer_id' => 32, 'manager_id' => 1, 'code' => 'FFP100120FGLRPP', 'name' => 'Fruglobe - Reporte de palta 2020', 'approved_at' => '2020-01-10',],[
            'project_type_id' => 3, 'customer_id' => 33, 'manager_id' => 1, 'code' => 'FFP010120FFPFSN', 'name' => 'FreshNews', 'approved_at' => '2020-01-01',],[
            'project_type_id' => 3, 'customer_id' => 33, 'manager_id' => 1, 'code' => 'FFP010120FFPFSD', 'name' => 'FreshData', 'approved_at' => '2020-01-01',],[
            'project_type_id' => 3, 'customer_id' => 33, 'manager_id' => 1, 'code' => 'FFP010120FFPFSR', 'name' => 'FreshReport', 'approved_at' => '2020-01-01',],[
            'project_type_id' => 2, 'customer_id' => 25, 'manager_id' => 1, 'code' => 'PUB170120OSPMEC', 'name' => 'Memoria Institucional - Edición y Corrección de Estilo', 'approved_at' => '2020-01-17',],[
            'project_type_id' => 2, 'customer_id' => 12, 'manager_id' => 1, 'code' => 'PUB200120SURVFC', 'name' => 'Videos Factoring', 'approved_at' => '2020-01-20',],[
            'project_type_id' => 2, 'customer_id' => 25, 'manager_id' => 1, 'code' => 'PUB220120OSPMDG', 'name' => 'Memoria Institucional - Diseño y Diagramación', 'approved_at' => '2020-01-22',],[
            'project_type_id' => 2, 'customer_id' => 19, 'manager_id' => 1, 'code' => 'PUB290120MBCRPC', 'name' => 'Redes Personales Corporativas', 'approved_at' => '2020-01-29',],[
            'project_type_id' => 2, 'customer_id' => 1, 'manager_id' => 1, 'code' => 'PUB310120ALDCMJ', 'name' => 'Contenidos Mi Junta', 'approved_at' => '2020-01-31',],[
            'project_type_id' => 2, 'customer_id' => 11, 'manager_id' => 1, 'code' => 'PUB050220DRCCEC', 'name' => 'Caso Effie - Citroën', 'approved_at' => '2020-02-05',],[
            'project_type_id' => 2, 'customer_id' => 11, 'manager_id' => 1, 'code' => 'PUB050220DRCCER', 'name' => 'Caso Effie - Renault', 'approved_at' => '2020-02-05',],[
            'project_type_id' => 2, 'customer_id' => 23, 'manager_id' => 1, 'code' => 'PUB090220MLICML', 'name' => 'Casos CAD', 'approved_at' => '2020-02-09',],[
            'project_type_id' => 2, 'customer_id' => 15, 'manager_id' => 1, 'code' => 'PUB060220IBKSTB', 'name' => 'Reporte de Sostenibilidad', 'approved_at' => '2020-02-06',],[
            'project_type_id' => 2, 'customer_id' => 35, 'manager_id' => 1, 'code' => 'PUB030220CCLLTE', 'name' => 'Estudio de Lote', 'approved_at' => '2020-02-03',],[
            'project_type_id' => 2, 'customer_id' => 34, 'manager_id' => 1, 'code' => 'PUB200220QVCCTN', 'name' => 'Contenidos Digitales', 'approved_at' => '2020-02-20',],[
            'project_type_id' => 1, 'customer_id' => 36, 'manager_id' => 1, 'code' => 'CON260220MEMMIN', 'name' => 'Consultoría Planificación Minera', 'approved_at' => '2020-02-26',],[
            'project_type_id' => 2, 'customer_id' => 15, 'manager_id' => 1, 'code' => 'PUB030320IBKCEI', 'name' => 'Casos Effie - Interbank', 'approved_at' => '2020-03-03',],[
            'project_type_id' => 2, 'customer_id' => 14, 'manager_id' => 1, 'code' => 'PUB050320IABEVN', 'name' => 'Eventos iab 2020', 'approved_at' => '2020-03-05',],[
            'project_type_id' => 2, 'customer_id' => 14, 'manager_id' => 1, 'code' => 'PUB030320IABEBK', 'name' => 'eBook iabMixx 2020', 'approved_at' => '2020-03-03',],[
            'project_type_id' => 2, 'customer_id' => 13, 'manager_id' => 1, 'code' => 'PUB180320EFFLFI', 'name' => 'Effie Awards Perú - Libro de Finalistas', 'approved_at' => '2020-03-18',],[
            'project_type_id' => 2, 'customer_id' => 13, 'manager_id' => 1, 'code' => 'PUB200320EFFCJF', 'name' => 'Effie Awards Perú - Curso de Jurados + Feedback', 'approved_at' => '2020-03-20',],[
            'project_type_id' => 2, 'customer_id' => 37, 'manager_id' => 1, 'code' => 'PUB230320ASBCDI', 'name' => 'Contenidos Digitales', 'approved_at' => '2020-03-23',],[
            'project_type_id' => 2, 'customer_id' => 12, 'manager_id' => 1, 'code' => 'PUB070420SURVRD', 'name' => 'Videos Retiro 2,000', 'approved_at' => '2020-04-07',],[
            'project_type_id' => 2, 'customer_id' => 13, 'manager_id' => 1, 'code' => 'PUB270420EFFECL', 'name' => 'Effie College - Piezas Varias', 'approved_at' => '2020-04-27',],[
            'project_type_id' => 2, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'PUB140520GIZCOV', 'name' => 'Productos comunicacionales digitales COVID-19', 'approved_at' => '2020-05-14',],[
            'project_type_id' => 2, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'PUB010620GIZCPM', 'name' => 'Asesoría Capacita+', 'approved_at' => '2020-06-01',],[
            'project_type_id' => 1, 'customer_id' => 9, 'manager_id' => 1, 'code' => 'CON010620GIZSAL', 'name' => 'Sistematización Avances y logros del proyecto PCM-UE/GIZ/AECID', 'approved_at' => '2020-06-01',],[
            'project_type_id' => 2, 'customer_id' => 34, 'manager_id' => 1, 'code' => 'PUB230620QVCVTE', 'name' => 'Videos Tu Empresa', 'approved_at' => '2020-06-23',],[
            'project_type_id' => 2, 'customer_id' => 19, 'manager_id' => 1, 'code' => 'PUB100620MBCCRM', 'name' => 'Columna Relevancia Microempresa COVID-19', 'approved_at' => '2020-06-10',],[
            'project_type_id' => 2, 'customer_id' => 34, 'manager_id' => 1, 'code' => 'PUB010720QVCDEM', 'name' => 'Desayunos Empresariales', 'approved_at' => '2020-07-01',],[
            'project_type_id' => 2, 'customer_id' => 38, 'manager_id' => 1, 'code' => 'PUB140820PCFCAN', 'name' => 'Desarrollo de Casos ANDA', 'approved_at' => '2020-08-14',],[
            'project_type_id' => 2, 'customer_id' => 39, 'manager_id' => 1, 'code' => 'PUB010920RPZCEF', 'name' => 'Desarrollo de Casos Effie', 'approved_at' => '2020-09-01',],[
            'project_type_id' => 2, 'customer_id' => 40, 'manager_id' => 1, 'code' => 'PUB280820ICPCOC', 'name' => 'Estructura Contenidos COVID-19', 'approved_at' => '2020-08-28',],[
            'project_type_id' => 2, 'customer_id' => 41, 'manager_id' => 1, 'code' => 'PUB010920BIFDCE', 'name' => 'Desarrollo Casos Effie', 'approved_at' => '2020-09-01',],[
            'project_type_id' => 2, 'customer_id' => 16, 'manager_id' => 1, 'code' => 'PUB040920IZPDCE', 'name' => 'Desarrollo Casos Effie', 'approved_at' => '2020-09-04',],[
            'project_type_id' => 2, 'customer_id' => 42, 'manager_id' => 1, 'code' => 'PUB080920SPMDCE', 'name' => 'Desarrollo Casos Effie', 'approved_at' => '2020-09-08',],[
            'project_type_id' => 2, 'customer_id' => 43, 'manager_id' => 1, 'code' => 'PUB100929CPEDCE', 'name' => 'Desarrollo Casos Effie', 'approved_at' => '2029-09-10',
        ]];

        foreach ($array as $item)
            Project::create($item);
    }
}
