<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a super admin
        User::create([
            'fname' => 'Super',
            'lname' => 'User',
            'email' => 'super.user@gmail.com',
            'password' => Hash::make('123456789'),
            'mobile' => '7894567896',
            'role' => 'superAdmin'
        ]);
        
        // Create a TL
        User::create([
            'fname' => 'Team',
            'lname' => 'Leader',
            'email' => 'team.leader@gmail.com',
            'password' => Hash::make('123456789'),
            'mobile' => '7894567894',
            'role' => 'teamLeader'
        ]);

        // Create a Employee
        User::create([
            'fname' => 'Normal',
            'lname' => 'Employee',
            'email' => 'normal.employee@gmail.com',
            'password' => Hash::make('123456789'),
            'mobile' => '7894567892',
            'role' => 'normalEmployee'
        ]);
    }
}
