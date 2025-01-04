<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentor = User::where('email', 'mentor@gmail.com')->first();

        Course::create([
            'title' => 'Introduction to Laravel',
            'description' => 'Basic introduction to Laravel framework',
            'mentor_id' => $mentor->id,
        ]);
    }
}
