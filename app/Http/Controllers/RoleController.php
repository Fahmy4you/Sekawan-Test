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
            "role" => Role::all(),
            "aAtas" => [
                'url' => route('user.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }
}
