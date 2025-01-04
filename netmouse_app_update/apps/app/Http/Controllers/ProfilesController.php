<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
 
    public function show()
    {
        $user = Auth::user();  // Mengambil data pengguna yang sedang login
        return view('custom_profile.show', compact('user'));  // Merender halaman custom_profile.show
    }
}
