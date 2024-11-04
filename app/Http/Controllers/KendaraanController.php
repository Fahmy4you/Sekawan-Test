<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index() {
        return view('kendaraan.index', [
            "active" => "kendaraan",
            "path" => ["Kendaraan", "Home"],
            "title" => "Kendaraan | Home",
            "kendaraan" => Kendaraan::all(),
            "aAtas" => [
                'url' => route('user.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }
}
