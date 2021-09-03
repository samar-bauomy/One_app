<?php

use Illuminate\Database\Seeder;
// use Illuminate\Database\RolesTableSeeder;
// use Illuminate\Database\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(RolesTabelSeeder::class);
        $this->call(UsersTabelSeeder::class);

    }
}
