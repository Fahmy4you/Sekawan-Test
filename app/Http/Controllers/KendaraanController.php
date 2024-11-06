<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Kendaraan, Pemesanan};

class KendaraanController extends Controller
{
    public function index() {
        return view('kendaraan.index', [
            "active" => "kendaraan",
            "path" => ["Kendaraan", "Home"],
            "title" => "Kendaraan | Home",
            "kendaraan" => Kendaraan::all(),
            "aAtas" => [
                'url' => route('kendaraan.create'),
                'icon' => 'bx bx-plus',
                'text' => "Tambah Data",
            ],
          ]);
    }

    public function create() {
        return view('kendaraan.create', [
            "active" => "kendaraan",
            "path" => ["Kendaraan", "Create"],
            "title" => "Kendaraan | Create",
            "aAtas" => [
                'url' => route('kendaraan.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
          ]);
    }

    public function createPost(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|max:100|unique:kendaraans',
            'plat' => 'required|max:50|unique:kendaraans',
          ]);
          
          Kendaraan::create($validatedData);
          
          return redirect()->route('kendaraan.home')->with('success', 'Kendaraan Baru Ditambahkan');
    }
    
    public function edit(Kendaraan $kendaraan) {
        return view('kendaraan.edit', [
            "active" => "kendaraan",
            "path" => ["Kendaraan", "Edit"],
            "title" => "Kendaraan | Edit",
            "kendaraan" => $kendaraan,
            "aAtas" => [
                'url' => route('kendaraan.home'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Back To Table",
            ],
        ]);
    }

    public function editPost(Request $request, Kendaraan $kendaraan) {
        $validatedData = $request->validate([
            'nama' => 'required|max:100',
            'plat' => 'required|unique:kendaraans,plat,' . $kendaraan->id,
        ]);

        Kendaraan::where('id', $kendaraan->id)
            ->update($validatedData);
      
        return redirect()->route('kendaraan.home')->with('success', 'Kendaraan Berhasil Dirubah');
        
    }
    
    public function hapus(Kendaraan $kendaraan) {
        $pemesanan = Pemesanan::where("kendaraan_id", $kendaraan->id);
        
        if($pemesanan->exists()) {
            $pemesanan->delete();
        }

        Kendaraan::where("id", $kendaraan->id)->delete();
        return redirect()->route('kendaraan.home')->with('success', 'Kendaraan Berhasil Dihapus');
    }
}
