<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['superadmin', 'admin', 'editor'];
        foreach($roles as $role) {
            $model = new \App\Role();
            $model->name = $role;
            $model->save();
        }
        $this->command->info('Roles created.');
    }
}
