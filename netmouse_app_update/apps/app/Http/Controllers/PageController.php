<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function student_index()
    {
        return view('user.index');
    }
    public function mentor_index(Request $request)
    {
        // Validasi role
        if (!$request->user()->hasRole('mentor')) {
            abort(403, 'You are not authorized to access this page.');
        }

        // Render view jika user adalah mentor
        return view('mentor.index');
    }
}
