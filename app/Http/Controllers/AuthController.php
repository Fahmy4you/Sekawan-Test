<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login', [
            "title" => "LOGIN",
        ]);
    }
    public function loginPost() {
        $validatedData = $request->validate([
            'email' => 'required|email|email:rfc,dns',
            'password' => 'required',
        ]);

        
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
}
