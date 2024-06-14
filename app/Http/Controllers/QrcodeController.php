<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class QrcodeController extends Controller
{
    public function index($id)
    {
        $decrypted = Crypt::decryptString($id);

        return view('welcome', compact('decrypted'));
    }
}
