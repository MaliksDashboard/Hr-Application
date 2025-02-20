<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Admin',
            'Back Office Manager',
            'Back Office Member',
            'Branch Manager',
            'Branch Employee',
            'Viewer',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert(['name' => $role, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
