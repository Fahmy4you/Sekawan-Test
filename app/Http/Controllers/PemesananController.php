<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index() {
        return view('pesanan.index', [
            "active" => "pesanan",
            "path" => ["Pesanan", "Home"],
            "title" => "Pesanan | Home",
            "pesanan" => Pemesanan::all(),
            "aAtas" => [
                'url' => route('user.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }
}
