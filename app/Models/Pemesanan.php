<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Status;

class Pemesanan extends Model
{
    protected $guarded = [
        'id',
    ];

    public function kendaraan() {
        return $this->belongsTo(Kendaraan::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }
}
