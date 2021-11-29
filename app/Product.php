<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id','brand_id', 'product_code','product_name','product_slug', 'short_description',
        'long_description','product_quantity', 'price','image_one','image_two', 'image_three','image_three','status'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function Brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
