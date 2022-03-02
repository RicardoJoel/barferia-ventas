<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateUserSeeder::class);
        $this->call(CreateBusinessSeeder::class);
        $this->call(CreateCustomerSeeder::class);
        $this->call(CreateProjectTypeSeeder::class);
        $this->call(CreateProjectSeeder::class);
    }
}
