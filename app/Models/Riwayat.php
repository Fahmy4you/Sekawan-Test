<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category_Riwayat;

class Riwayat extends Model
{
    protected $guarded = [
        'id',
    ];

    public function category() {
        return $this->belongsTo(Category_Riwayat::class, 'category_riwayat_id');
    }
}
