<?php

use Illuminate\Database\Seeder;

class UsersTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = \App\User::create([
            'name' => 'Super Admin',
            'user_name'=>'super_admin_111111111',
            'email' => 'superAdmin@superAdmin.com',
            'admin' => '1',
            'password' => bcrypt('password'),
            'admin_id' =>'1',
        ]);
        $superAdmin->attachRole('super_admin');

        $admin = \App\User::create([
            'name' => 'Admin Admin',
            'user_name'=>'admin_222222222',
            'email' => 'admin@admin.com',
            'admin' => '1',
            'password' => bcrypt('password'),
            'admin_id' =>'1',
        ]);
        $admin->attachRole('admin');

        $user = \App\User::create([
            'name' => 'User User',
            'user_name'=>'user_333333333',
            'email' => 'user@user.com',
            'admin' => '0',
            'password' => bcrypt('password'),
            'admin_id' =>'1',
        ]);
        $user->attachRole('user');
    }
}
