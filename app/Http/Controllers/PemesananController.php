<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pemesanan, User, Kendaraan, Riwayat};

class PemesananController extends Controller
{
    public function index() {
        return view('pesanan.index', [
            "active" => "pesanan",
            "path" => ["Pesanan", "Home"],
            "title" => "Pesanan | Home",
            "pesanan" => Pemesanan::where('status_id', '!=', 6)->get(),
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
                            $query->where('id', [1,6]);
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

          $nama = auth()->user()->name;
          $kendaraan = Kendaraan::where('id', $validatedData['kendaraan_id'])->first()->nama;
          $user = User::where('id', $validatedData['user_id'])->first()->name;
          $this->riwayat->create([
            'category_riwayat_id' => 2,
            'keterangan' => "User {$nama} Membooking Kendaraan {$kendaraan} Untuk User {$user} "
        ]);
          
          return redirect()->route('pesanan.home')->with('success', 'Pesanan Baru Ditambahkan');
    }

    public function setuju(Pemesanan $pemesanan) {
        Pemesanan::where("id", $pemesanan->id)->update(["status_id" => 2]);
        
        $nama = auth()->user()->name;
        $kendaraan = $pemesanan->kendaraan->nama;
        $user = $pemesanan->user->name;
        $roleName = auth()->user()->role->role;
        $this->riwayat->create([
            'category_riwayat_id' => 6,
            'keterangan' => "{$roleName} {$nama} Menyetujui Tahap 1 {$user} Menggunakan Kendaraan {$kendaraan}"
        ]);
        return redirect()->route('pesanan.home')->with('success', "Pesanan {$pemesanan->user->name} Untuk Mengendarai {$pemesanan->kendaraan->nama} Disetujui Tahap 1 ");
    }
    
    public function setuju2(Pemesanan $pemesanan) {
        Pemesanan::where("id", $pemesanan->id)->update(["status_id" => 6]);

        $nama = auth()->user()->name;
        $kendaraan = $pemesanan->kendaraan->nama;
        $user = $pemesanan->user->name;
        $roleName = auth()->user()->role->role;
        $this->riwayat->create([
            'category_riwayat_id' => 7,
            'keterangan' => "{$roleName} {$nama} Menyetujui {$user} Menggunakan Kendaraan {$kendaraan}"
        ]);
        return redirect()->route('pesanan.home')->with('success', "Pesanan {$pemesanan->user->name} Untuk Mengendarai {$pemesanan->kendaraan->nama} Disetujui");
    }

    public function tolak(Pemesanan $pemesanan) {
        if($pemesanan->status_id == 6) {
            return abort(403);
        } else if($pemesanan->status_id == 1 && auth()->user()->role->id == 3) {
            return abort(403, "This action is unauthorized.");
        } else if($pemesanan->status_id == 2 && auth()->user()->role->id == 2) {
            return abort(403, "This action is unauthorized.");
        }

        Pemesanan::where("id", $pemesanan->id)->delete();

        $nama = auth()->user()->name;
        $kendaraan = $pemesanan->kendaraan->nama;
        $user = $pemesanan->user->name;
        $roleName = auth()->user()->role->role;
        $this->riwayat->create([
            'category_riwayat_id' => 8,
            'keterangan' => "{$roleName} {$nama} Menolak {$user} Menggunakan Kendaraan {$kendaraan}"
        ]);
        $this->notification->create([
            'user_id' => $pemesanan->user->id,
            'judul' => "Penolakan Booking",
            'keterangan' => "{$roleName} {$nama} Menolak {$user} Menggunakan Kendaraan {$kendaraan}"
        ]);

        return redirect()->route('pesanan.home')->with('success', "Pesanan {$pemesanan->user->name} Untuk Mengendarai {$pemesanan->kendaraan->nama} Ditolak");
    }
}
