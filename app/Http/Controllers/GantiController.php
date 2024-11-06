<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GantiController extends Controller
{
    public function index()
    {
        return view('auth.ganti-password');
    }
}
