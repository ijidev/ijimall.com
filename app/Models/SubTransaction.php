<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTransaction extends Model
{
   protected $guarded = [];
    use HasFactory;

    public function suborder()
    {
       return $this->belongsTo(SubOrder::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function wallet()
    {
       return $this->belongsTo(Wallet::class);
    }
}
