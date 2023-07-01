<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function withdrawal()
    {
        $this->hasMany(Withdrawal::class);
    }
}
