<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index() {
        return view('riwayat.index', [
            "active" => "riwayat",
            "path" => ["Riwayat", "Home"],
            "title" => "Riwayat | Home",
            "aAtas" => [
                'url' => route('user.create'),
                'icon' => 'bx bx-cloud',
                'text' => "Donwload Data",
            ],
          ]);
    }
}
