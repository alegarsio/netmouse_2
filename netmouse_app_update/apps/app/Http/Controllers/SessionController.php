<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        return view('index');
    }
    public function about(){
        return view('about');
    }
    public function team(){
        return view('team');
    }
    public function netsim(){
        return view('netsim');
    }
    public function about_ctf(){
        return view('about_ctf');
    }
}
