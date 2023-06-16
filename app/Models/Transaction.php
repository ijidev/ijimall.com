<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function order()
    {
        $this->belongsToMany(Order::class);
    }

    public function wallet()
    {
        $this->belongsToMany(Wallet::class);
    }

    public function user()
    {
        $this->belongsToMany(User::class);
    }
}
