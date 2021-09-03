<?php

use Illuminate\Database\Seeder;

class RolesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = \App\Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Can Control And Do Any Thing In The Project',
        ]);

        $admin = \App\Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Can Control Almost All The Project',
        ]);

        $user = \App\Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'Can Do Specific Tasks In The Project',
        ]);
    }
}
