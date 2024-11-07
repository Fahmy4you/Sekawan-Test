<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Riwayat;
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
                'url' => route('user.create'),
                'icon' => 'bx bx-cloud',
                'text' => "Download Data",
            ],
          ]);
    }
    
    public function booking() {
        return view('booking', [
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
        return view('booking', [
            "active" => "booking",
            "path" => ["Booking", "Create"],
            "title" => "Booking | Create",
            "aAtas" => [
                'url' => route('dashboard.booking'),
                'icon' => 'bx bx-left-arrow-alt',
                'text' => "Kembali",
            ],
          ]);
    }
}