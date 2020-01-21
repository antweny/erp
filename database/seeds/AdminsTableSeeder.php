<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Illuminate\Support\Facades\Hash;



class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Antweny Sawe',
            'email' => 'antweny@gmail.com',
            'password' => Hash::make('Password1'),
        ]);

        $admin->assignRole('superAdmin');
    }
}
