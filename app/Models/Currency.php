<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function currencies()
    {
        return $this->belongsTo(Currency::class,'user_currencies');
    }
}
