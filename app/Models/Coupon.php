<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Product::class, 'coupon_items', 'coupon_id', 'product_id');
    }
}
