<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert([
            ['code' => Role::DIRECTOR, 'name' => 'Directeur'],
            ['code' => Role::DOCTOR, 'name' => 'Docteur'],
            ['code' => Role::PATIENT, 'name' => 'Patient'],
        ],['code']);
    }
}
