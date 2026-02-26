<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller {

    public function login() {
        return view('Auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns', 
            'password' => 'required|max:20'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/dashboard')->with('success', 'Berhasil login sebagai admin');
        }

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('/')->with('success', 'Berhasil login sebagai customer');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak salah.',
        ])->onlyInput('email');
    }

    public function logout() {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('customer')->logout();
        }

        // lalu redirect ke login : 
        return redirect('login');
    }
}
