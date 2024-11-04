<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $guarded = [
        'id',
    ];

    public function user() {
        return $this->hasMany(Users::class);
    }
}
