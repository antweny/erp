<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = [
            ['name' => 'itemUnit-read', 'guard_name' => 'admin'],
            ['name' => 'itemUnit-create', 'guard_name' => 'admin'],
            ['name' => 'itemUnit-update', 'guard_name' => 'admin'],
            ['name' => 'itemUnit-delete', 'guard_name' => 'admin'],
            ['name' => 'itemReceived-read', 'guard_name' => 'admin'],
            ['name' => 'itemReceived-create', 'guard_name' => 'admin'],
            ['name' => 'itemReceived-update', 'guard_name' => 'admin'],
            ['name' => 'itemReceived-delete', 'guard_name' => 'admin'],
            ['name' => 'itemCategories-read', 'guard_name' => 'admin'],
            ['name' => 'itemCategories-create', 'guard_name' => 'admin'],
            ['name' => 'itemCategories-update', 'guard_name' => 'admin'],
            ['name' => 'itemCategories-delete', 'guard_name' => 'admin'],
            ['name' => 'itemIssued-read', 'guard_name' => 'admin'],
            ['name' => 'itemIssued-create', 'guard_name' => 'admin'],
            ['name' => 'itemIssued-update', 'guard_name' => 'admin'],
            ['name' => 'itemIssued-delete', 'guard_name' => 'admin'],
            ['name' => 'item-read', 'guard_name' => 'admin'],
            ['name' => 'item-create', 'guard_name' => 'admin'],
            ['name' => 'item-update', 'guard_name' => 'admin'],
            ['name' => 'item-delete', 'guard_name' => 'admin'],
            ['name' => 'department-read', 'guard_name' => 'admin'],
            ['name' => 'department-create', 'guard_name' => 'admin'],
            ['name' => 'department-update', 'guard_name' => 'admin'],
            ['name' => 'department-delete', 'guard_name' => 'admin'],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }



    }
}
