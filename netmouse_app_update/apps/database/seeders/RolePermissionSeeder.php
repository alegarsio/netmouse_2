<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        Permission::create(['name' => 'buat-kursus']);
        Permission::create(['name' => 'ikut-kursus']);
        Permission::create(['name' => 'ctf']);
        Permission::create(['name' => 'lihat-data-student']);
        Permission::create(['name' => 'lihat-data-mentor']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'mentor']);
        Role::create(['name' => 'student']);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo('lihat-data-mentor');
        $admin->givePermissionTo('lihat-data-student');
        $admin->givePermissionTo('buat-kursus');

        $student = Role::findByName('student');
        $student->givePermissionTo('ikut-kursus');
        $student->givePermissionTo('ctf');

        $mentor = Role::findByName('mentor');
        $mentor->givePermissionTo('buat-kursus');
        $mentor->givePermissionTo('lihat-data-student');
        

    }
}
