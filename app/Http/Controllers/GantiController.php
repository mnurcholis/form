<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class GantiController extends Controller
{
    public function index()
    {
        return view('auth.ganti-password');
    }
    public function updatePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)], // You can adjust password rules here
        ]);

        // Update the user's password
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->save();

        return redirect()->route('login')->with('success', 'Password Berhasil diubah, silahkan login dengan password terbaru.');
    }
}
