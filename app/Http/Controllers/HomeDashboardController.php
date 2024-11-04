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
}
