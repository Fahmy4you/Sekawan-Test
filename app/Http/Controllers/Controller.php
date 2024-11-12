<?php

namespace App\Http\Controllers;
use App\Models\{Riwayat, Notification};

abstract class Controller
{
    protected $riwayat, $notification;
    public function __construct() {
      $this->riwayat = new Riwayat();
      $this->notification = new Notification();
    }
}
