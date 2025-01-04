<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function showCertificate($mentorName, Request $request)
    {
        if (!$request->user()->hasRole('mentor')) {
            abort(403, 'You are not authorized to access this page.');
        }

        return view('mentor.certificate', ['mentorName' => $mentorName]);
    }
}

