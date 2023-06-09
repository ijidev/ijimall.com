<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubOrder extends Model
{
    protected $fillable = [
        'order_id',
        'vendor_id',
        'grand_total',
         'item_count',
        
    ];
    use HasFactory;

    public function items(){
        
        return $this->belongsToMany(Product::class, 'sub_order_items', 'sub_order_id', 'product_id',)->withpivot('quantity','price');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,);
    }
}
