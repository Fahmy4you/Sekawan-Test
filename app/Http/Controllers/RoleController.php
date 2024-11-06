<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return view('role.index', [
            "active" => "role",
            "path" => ["Role", "Home"],
            "title" => "Role | Home",
            "role" => Role::whereNotIn('role', ['Driver', 'Super'])->get(),
            "aAtas" => [
                'url' => route('role.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }
    
    public function create() {
        return view('role.create', [
            "active" => "role",
            "path" => ["Role", "Create"],
            "title" => "Role | Create",
            "aAtas" => [
                'url' => route('role.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
          ]);
    }

    public function createPost(Request $request) {
        $validatedData = $request->validate([
            'role' => 'required|max:50|unique:roles',
          ]);
          
          Role::create($validatedData);
          
          return redirect()->route('role.home')->with('success', 'Role Baru Ditambahkan');
    }
    
    public function edit(Role $role) {
        return view('role.edit', [
            "active" => "role",
            "path" => ["Role", "Edit"],
            "title" => "Role | Edit",
            "role" => $role,
            "aAtas" => [
                'url' => route('role.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
        ]);
    }

    public function editPost(Request $request, Role $role) {
        $validatedData = $request->validate([
            'role' => 'required|unique:roles,role,' . $role->id,
        ]);

        Role::where('id', $role->id)
            ->update($validatedData);
      
        return redirect()->route('role.home')->with('success', 'Role Berhasil Dirubah');
    }
    
}
