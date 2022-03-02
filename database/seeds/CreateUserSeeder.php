<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [[
            'is_admin' => true,
            'name' => 'Administrador',
            'email' => 'admin@preciso.pe',
            'email_verified_at' => now(),
            'password' => Hash::make('RvMl2IG#'),
        ],[
            'name' => 'Ricardo',
            'lastname' => 'Béjar',
            'document' => '70689935',
            'telephone' => '991267284',
            'email' => 'rbejar@preciso.pe',
            'email_verified_at' => now(),
            'password' => Hash::make('ToP%$YGy'),
        ]];

        foreach ($array as $item)
            User::create($item);
    }
}
