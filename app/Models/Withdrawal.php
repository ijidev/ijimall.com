<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    public function trans_log()
    {
        return $this->hasMany(Transaction::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
