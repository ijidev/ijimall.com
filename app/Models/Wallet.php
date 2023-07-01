<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
   protected $guarded = [];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
       return $this->belongsTo(Shop::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'user_currency', 'user_id', 'currency_id');
    }
}
