<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Pass the user data to the view
        return view('dashboard', compact('user'));
    }

    public function index(Request $request)
    {
        if (!$request->user()->hasRole('mentor')) {
            abort(403, 'You are not authorized to access this page.');
        }

        return view('dashboard');
    }
}
