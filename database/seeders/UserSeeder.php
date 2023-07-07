<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'          => 'Admin',
            'username'      => 'admin',
            'email'         => 'admin@mail.com',
            'password'      => bcrypt('password'),
        ]);
        $user->syncRoles('Admin');

        $logistik = User::create([
            'name'          => 'Admin Logistik',
            'username'      => 'admin-logistik',
            'email'         => 'logistik@mail.om',
            'department_id' => Department::where('name', 'Logistik')->first()->id ?? NULL,
            'password'      => bcrypt('password'),
        ]);
        $logistik->syncRoles('Admin Logistik');

        $gudang = User::create([
            'name'          => 'Admin Gudang',
            'username'      => 'admin-gudang',
            'email'         => 'gudang@mail.om',
            'department_id' => Department::where('name', 'Gudang')->first()->id ?? NULL,
            'password'      => bcrypt('password'),
        ]);
        $gudang->syncRoles('Admin Gudang');

        $customer = User::create([
            'name'          => 'PT. EPPCONINDO PILAR ABADI',
            'username'      => 'pt_epa',
            'email'         => 'epa@mail.om',
            'password'      => bcrypt('password'),
            'address'       => 'Jl. Wibawa Mukti II No. 81, Jatiasih, Bekasi - 17425',
            'phone'         => '(021) 8242 0228'
        ]);
        $customer->syncRoles('Customer');
    }
}
