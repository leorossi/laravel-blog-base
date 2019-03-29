<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new \App\User();
        $superAdmin->name = 'Super Admin';
        $superAdmin->email = 'superadmin@domain.com';
        $superAdmin->password = \Illuminate\Support\Facades\Hash::make('secret');
        $superAdmin->role()->associate(\App\Role::where('name', 'superadmin')->first());
        $superAdmin->save();
    
        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@domain.com';
        $admin->password = \Illuminate\Support\Facades\Hash::make('secret');
        $admin->role()->associate(\App\Role::where('name', 'admin')->first());
        $admin->save();
    
        $admin = new \App\User();
        $admin->name = 'Editor';
        $admin->email = 'editor@domain.com';
        $admin->password = \Illuminate\Support\Facades\Hash::make('secret');
        $admin->role()->associate(\App\Role::where('name', 'editor')->first());
        $admin->save();
    }
}
