<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function items(){
        
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id',)->withpivot('quantity','price');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subOrder(){
        return $this->hasMany(SubOrder::class);
    }

    public function generateSubOrder()
    {
        $orderItems = $this->items;
        foreach($orderItems->groupBy('vendor_id') as $vendorId => $products)
        {
            $shop = Shop::find($vendorId);
            // dd($shop->vendor_id);
           $suborder = $this->subOrder()->create([
                'order_id' => $this->id,
                'vendor_id' => $shop->vendor_id,
                'grand_total' => $products->sum('pivot.price'),
                'item_count' => $products->count()
            ]);
            foreach($products as $product)
            {
                $suborder->items()->attach($product->id, ['price' => $product->pivot->price, 'quantity' => $product->pivot->quantity]);
            }
        }
    }



}
