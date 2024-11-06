<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login', [
            "title" => "LOGIN",
        ]);
    }
    public function loginPost(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|email:rfc,dns',
            'password' => 'required',
        ]);

        if(Auth::attempt($validatedData)){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.home'));
            
        }
          
        return back()->with('error', 'Login Gagal Coba Periksa Data Anda Kembali');
        
    }

    public function register() {
        return view('auth.register', [
            "title" => "REGISTER",
        ]);
    }
    public function registerPost(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role_id'] = 1;
        
        User::create($validatedData);
        
        return redirect()->route('auth.login')->with('success', 'Register Berhasil Silahkan Login');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('auth.login')->with('success', 'Anda Berhasil Log Out');
    }
}
