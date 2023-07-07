<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'          => 'Admin', 
            'guard_name'    => 'web'
        ]);

        Role::create([
            'name'          => 'Customer', 
            'guard_name'    => 'web'
        ]);

        Role::create([
            'name'          => 'Admin Logistik', 
            'guard_name'    => 'web'
        ]);

        Role::create([
            'name'          => 'Admin Gudang', 
            'guard_name'    => 'web'
        ]);
    }
}
