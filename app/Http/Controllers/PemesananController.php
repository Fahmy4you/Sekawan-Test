<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Kendaraan;

class PemesananController extends Controller
{
    public function index() {
        return view('pesanan.index', [
            "active" => "pesanan",
            "path" => ["Pesanan", "Home"],
            "title" => "Pesanan | Home",
            "pesanan" => Pemesanan::all(),
            "aAtas" => [
                'url' => route('pesanan.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }

    public function create() {
        return view('pesanan.create', [
            "active" => "pesanan",
            "path" => ["Pesanan", "Create"],
            "title" => "Pesanan | Create",
            "users" => User::leftJoin('pemesanans', 'users.id', '=', 'pemesanans.user_id')
                        ->whereNull('pemesanans.id')
                        ->select('users.*')
                        ->whereHas('role', function ($query) {
                            $query->where('role', 'Driver');
                        })
                        ->get(),
            "kendaraan" => Kendaraan::leftJoin('pemesanans', 'kendaraans.id', '=', 'pemesanans.kendaraan_id')
                        ->whereNull('pemesanans.id')
                        ->select('kendaraans.*')
                        ->get(),
            "aAtas" => [
                'url' => route('pesanan.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
          ]);
    }

    public function createPost(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'kendaraan_id' => 'required',
          ]);

          $validatedData["status_id"] = 1;
          
          Pemesanan::create($validatedData);
          
          return redirect()->route('pesanan.home')->with('success', 'Pesanan Baru Ditambahkan');
    }
}
