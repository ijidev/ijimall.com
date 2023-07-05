<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Product::class, 'cart_items', 'cart_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
