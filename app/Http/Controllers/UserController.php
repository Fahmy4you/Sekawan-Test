<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Pemesanan;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            "active" => "users",
            "path" => ["Users", "Home"],
            "title" => "Users | Home",
            "users" => User::join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('roles.role', '!=', 'Super')
                        ->orderBy("roles.id")
                        ->select('users.*')
                        ->get(),
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
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:8',
            'role_id' => 'required',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        User::create($validatedData);

        $nama = auth()->user()->name;
        $this->riwayat->create([
            'category_riwayat_id' => 12,
            'keterangan' => "User {$nama} Menambahkan User {$validatedData['name']}"
        ]);
        
        return redirect()->route('user.home')->with('success', 'User Baru Ditambahkan');
    }

    public function edit(User $user) {
        return view('users.edit', [
            "active" => "users",
            "path" => ["Users", "Edit"],
            "title" => "Users | Edit",
            "user" => $user,
            "roles" => Role::all(),
            "aAtas" => [
                'url' => route('user.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
        ]);
    }

    public function editPost(Request $request, User $user) {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'password' => 'nullable|min:8',
        ]);

        if (empty($validatedData['password'])) {
            $validatedData['password'] = $user->password;
        } else {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        if($validatedData['role_id'] != $user->role->id) {
            Pemesanan::where("user_id" , $user->id)->delete();
            
        }

        User::where('id', $user->id)
            ->update($validatedData);

        $nama = auth()->user()->name;
        $this->riwayat->create([
            'category_riwayat_id' => 13,
            'keterangan' => "User {$nama} Mengedit User {$validatedData['name']}"
        ]);
      
        return redirect()->route('user.home')->with('success', 'User Berhasil Dirubah');
        
    }
    
    public function hapus(User $user) {
        $pemesanan = Pemesanan::where("user_id", $user->id);
        if($user->role->role == "Driver") {
            if($pemesanan->exists()) {
                $pemesanan->delete();
            }
        }

        User::where("id", $user->id)->delete();
        $nama = auth()->user()->name;
        $this->riwayat->create([
            'category_riwayat_id' => 14,
            'keterangan' => "User {$nama} Menghapus User {$user->name}"
        ]);
        return redirect()->route('user.home')->with('success', 'User Berhasil Dihapus');
    }

}
