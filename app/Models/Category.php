<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function subcat()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('parent_id', '!=', null);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
