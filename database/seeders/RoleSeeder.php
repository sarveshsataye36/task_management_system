<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles data
        $roles = [
            ['role_name' => 'superAdmin','role_title' => 'Super Admin'],
            ['role_name' => 'teamLeader','role_title' => 'Team Leader'],
            ['role_name' => 'normalEmployee','role_title' => 'Normal Employee'],
        ];

        // Loop through roles data and insert into database
        foreach ($roles as $roleData) {
            Role::create($roleData);
        }
    }
}
