<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            "active" => "users",
            "path" => ["Users", "Home"],
            "title" => "Users | Home",
            "users" => User::all(),
            "aAtas" => [
                'url' => route('user.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
        ]);
    }
    
    public function create() {
        return view('users.create', [
            "active" => "users",
            "path" => ["Users", "Create"],
            "title" => "Users | Create",
            "roles" => Role::all(),
            "aAtas" => [
                'url' => route('user.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
          ]);
    }

    public function createPost(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
          ]);
          
          $validatedData['password'] = bcrypt($validatedData['password']);

          dd($validatedData);
          
          User::create($validatedData);
          
          return redirect()->route('user.home')->with('success', 'User Baru Ditambahkan');
    }
}
