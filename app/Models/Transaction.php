<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $guarded = [];
    use HasFactory;

    public function order()
    {
       return $this->belongsTo(Order::class);
    }

    public function wallet()
    {
       return $this->belongsTo(Wallet::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
