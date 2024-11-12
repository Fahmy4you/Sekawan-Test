<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pemesanan, Riwayat, Kendaraan};
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;

class HomeDashboardController extends Controller
{
    public function index() {
        $riwayat = Riwayat::where('category_riwayat_id', 2)
                    ->get()
                    ->groupBy(function($item) {
                        return Carbon::parse($item->created_at)->format('m'); // Kelompokkan berdasarkan bulan
                    });

        $yValues = array_fill(0, 12, 0);
        $currentMonth = Carbon::now()->month;

        foreach ($riwayat as $month => $items) {
            $monthIndex = (int)$month - 1;
            if ($monthIndex < $currentMonth) {
                $yValues[$monthIndex] = count($items);
            }
        }
        $yValues = array_slice($yValues, 0, $currentMonth);


        $pesananPerBulan = [];
        foreach ($riwayat as $month => $items) {
            $pesananPerBulan[$month] = count($items); // Jumlahkan pesanan untuk setiap bulan
        }
        $jumlahPesananTerbanyak = max($pesananPerBulan);

        return view('index', [
            "active" => "dashboard",
            "path" => ["Dashboard", "Home"],
            "title" => "Dashboard | Home",
            "dataGrafikTahun" => $yValues,
            "pesananTerbanyak" => $jumlahPesananTerbanyak,
            "aAtas" => [
                'url' => route('dashboard.download'),
                'icon' => 'bx bx-cloud',
                'text' => "Download Data",
            ],
          ]);
    }

  public function download() {
    $fileName = 'pesanan_per_bulan.xlsx';
    $riwayat = Riwayat::where('category_riwayat_id', 2)
        ->get()
        ->groupBy(function($item) {
            return Carbon::parse($item->created_at)->format('m'); 
        });

    $yValues = array_fill(0, 12, 0);
    $currentMonth = Carbon::now()->month;

    foreach ($riwayat as $month => $items) {
        $monthIndex = (int)$month - 1;
        if ($monthIndex < $currentMonth) {
            $yValues[$monthIndex] = count($items);
        }
    }

    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToFile($fileName);

    $headerRow = WriterEntityFactory::createRowFromArray(['Bulan', 'Pesanan']);
    $writer->addRow($headerRow);

    $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    for ($i = 0; $i < $currentMonth; $i++) {
        $row = WriterEntityFactory::createRowFromArray([
            $months[$i],    
            $yValues[$i]   
        ]);
        $writer->addRow($row);
    }
    
    $writer->close();
    return response()->download($fileName)->deleteFileAfterSend(true);
}

    
    public function booking() {
        return view('booking.index', [
            "active" => "booking",
            "path" => ["Booking", "Home"],
            "title" => "Booking | Home",
            "bookings" => Pemesanan::where("user_id", auth()->user()->id)->get(),
            "aAtas" => [
                'url' => route('dashboard.bookingCreate'),
                'icon' => 'bx bx-plus',
                'text' => "Booking Kendaraan",
            ],
          ]);
    }

    public function bookingCreate() {
        $cekPesanan = Pemesanan::where("user_id", auth()->user()->id);

        if($cekPesanan->exists()) {
            $kendaraan = false;
        } else {
            $kendaraan = Kendaraan::leftJoin('pemesanans', 'kendaraans.id', '=', 'pemesanans.kendaraan_id')
                        ->whereNull('pemesanans.id')
                        ->select('kendaraans.*')
                        ->get();
        }            

        return view('booking.create', [
            "active" => "booking",
            "path" => ["Booking", "Create"],
            "title" => "Booking | Create",
            "kendaraan" => $kendaraan,
            "aAtas" => [
                'url' => route('dashboard.booking'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Kembali",
            ],
          ]);
    }

    public function bookingCreatePost(Request $request) {
      
      $cekPesanan = Pemesanan::where("user_id", auth()->user()->id);

        if($cekPesanan->exists()) {
          return abort(403, "You already have a booking");
        }

        $validatedData = $request->validate([
            'kendaraan_id' => 'required',
          ]);

          $validatedData["user_id"] = auth()->user()->id;
           $validatedData["status_id"] = 1;

           $nama = auth()->user()->name;
           $kendaraan = Kendaraan::where('id', $validatedData["kendaraan_id"])->first()->nama;
           
          Pemesanan::create($validatedData);

          $this->riwayat->create([
            'category_riwayat_id' => 2,
            'keterangan' => "User {$nama} Membooking Kendaraan {$kendaraan}"
          ]);
          
          return redirect()->route('dashboard.booking')->with('success', 'Bookingan Anda Ditambahkan Tunggu Disetujui');
    }
    
    public function bookingDelete(Pemesanan $pemesanan, $categoryId) {
      if($pemesanan->user_id != auth()->user()->id) {
        return abort(403, "This Booking Is Not Yours");
      }
      
      $pesan = ($categoryId == 1 ? "Bookingan Anda Telah Dibatalkan" : "Bookingan Anda Telah Disudahi Pemakaiannya");
      
      Pemesanan::where("id", $pemesanan->id)->delete();

      $nama = auth()->user()->name;
      $kendaraan = $pemesanan->kendaraan->nama;
      $riwayatData = [];
      if($categoryId == 1) {
        $riwayatData = ['category_riwayat_id' => 16, 'keterangan' => "User {$nama} Membatalkan Bookingan Kendaraan {$kendaraan}"];
    } else {
          $riwayatData = ['category_riwayat_id' => 15, 'keterangan' => "User {$nama} Mengsudahi Bookingan Kendaraan {$kendaraan}"];

      }
      
      $this->riwayat->create($riwayatData);

        return redirect()->route('dashboard.booking')->with('success', $pesan);
    }
}