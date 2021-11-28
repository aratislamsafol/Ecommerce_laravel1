<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $fillable = [
        'brand_name','brand_img', 'status',
    ];

    use SoftDeletes;
}
