<?php

namespace App\Http\Controllers;

use App\Models\logs;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();
            $name = Auth::user()->name;

            logs::create([
                'nama_akun' => $name,
                'aktivitas' => "Login",
            ]);
            
            if (auth()->user()->role_id === 1) {
                // jika user admin
                return redirect()->intended('/admin');
            } else if (auth()->user()->role_id === 2) {
                // jika user kasir
                return redirect()->intended('/kasir');
            } else if (auth()->user()->role_id === 3) {
                // jika user meja
                return redirect()->intended('/meja');
            } else if (auth()->user()->role_id === 4) {
                // jika user manajer
                return redirect()->intended('/manajer');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request)
    {
        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Logout",
        ]);
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
