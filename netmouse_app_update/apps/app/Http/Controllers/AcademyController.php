<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademyController extends Controller
{
    public function index()
    {
        // Contoh data kursus
        $courses = [
            [
                'title' => 'Introduction to Programming',
                'description' => 'Learn the basics of programming and algorithms.',
                'difficulty' => 'Easy',
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'description' => 'Master essential data structures and algorithms.',
                'difficulty' => 'Medium',
            ],
            [
                'title' => 'Software Engineering',
                'description' => 'Understand software development methodologies and practices.',
                'difficulty' => 'Hard',
            ],
        ];

       
        return view('aca', compact('courses')); // Tampilan aca.blade.php akan dicari di resources/views/aca.blade.php
    }
}
