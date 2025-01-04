<?php

namespace Database\Seeders;

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
        // $admin = User::create([
        //     'name' => 'siena',
        //     'email' => 'siena@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $admin->assignRole('admin');

        $mentor = User::create([
            'name' => 'Indra',
            'email' => 'Indra@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $mentor->assignRole('mentor');

        // $student = User::create([
        //     'name' => 'student',
        //     'email' => 'student@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // $student->assignRole('student');
    }
}
