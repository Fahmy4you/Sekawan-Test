<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{
    public function index() {
        return view('index', [
            "active" => "dashboard",
            "path" => ["Dashboard", "Home"],
            "title" => "Dashboard | Home",
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