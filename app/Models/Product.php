<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'subcategory_id',
        'category_id',   
    ];
    
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class. 'vendor_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id', );
    }

    public function subcat()
    {
        return $this->belongsToMany(Category::class, 'product_category')->where('parent_id' != null);
    }

    
}
