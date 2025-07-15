<?php

namespace Database\Seeders;

use App\Models\Roles;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create(
            [
            'rolesName' => 'IT Developer',
            'developer' => 1,
            'superAdmin' => 1,
            'generalManager' => 1,
            'administrator' => 1,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'Super Admin',
            'developer' => 0,
            'superAdmin' => 1,
            'generalManager' => 1,
            'administrator' => 1,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'General Manager',
            'developer' => 0,
            'superAdmin' => 0,
            'generalManager' => 1,
            'administrator' => 1,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'Admin Sales',
            'developer' => 0,
            'superAdmin' => 0,
            'generalManager' => 0,
            'administrator' => 1,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'Sales Manager',
            'developer' => 0,
            'superAdmin' => 0,
            'generalManager' => 0,
            'administrator' => 0,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'Sales Assisten Manager',
            'developer' => 0,
            'superAdmin' => 0,
            'generalManager' => 0,
            'administrator' => 0,
            'salesManager' => 1,
            'salesSupervisor' => 1,
            'salesEngineer' => 1
            ],
            [
            'rolesName' => 'Sales Engineer',
            'developer' => 0,
            'superAdmin' => 0,
            'generalManager' => 0,
            'administrator' => 0,
            'salesManager' => 0,
            'salesSupervisor' => 0,
            'salesEngineer' => 1
            ],
        );
    }
}
