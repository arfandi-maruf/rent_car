<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function proses(Request $request)
    {
       $credential= $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ],
        [
            'email.required'=>'Email Tidak Boleh Kosong!',
            'email.email'=>'Format Email salah!',
            'password.required'=>'Password Tidak Boleh Kosong!'
        ]);
        if(auth::attempt($credential)){
            $request->session()->regenerate();

            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Autentifikasi Gagal!.',
        ])->onlyInput('email');
    }
    public function keluar(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect()->route('home');
    }
}
