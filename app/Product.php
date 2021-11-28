<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id','brand_id', 'product_code','product_name','product_slug', 'short_description',
        'long_description','product_quantity', 'price','image_one','image_two', 'image_three','image_three','status'
    ];
}
