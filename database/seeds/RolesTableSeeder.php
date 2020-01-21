<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Admin;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create([
            'name' => 'superAdmin',
            'guard_name' => 'admin'
        ]);
        $role = Role::create([
            'name' => 'store',
            'guard_name' => 'admin'
        ]);


    }
}
