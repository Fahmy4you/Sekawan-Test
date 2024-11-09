<?php

namespace App\Http\Controllers;
use App\Models\Riwayat;

abstract class Controller
{
    protected $riwayat;
    public function __construct() {
      $this->riwayat = new Riwayat();
    }
}
