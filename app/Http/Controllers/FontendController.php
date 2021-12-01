<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;


class FontendController extends Controller
{
    public function Index(){
        $categories=Category::where('status',1)->latest()->get();
        $products=Product::where('status',1)->latest()->get();
        $lts=Product::where('status',1)->latest()->limit(3)->get();
        $lts2=Product::where('status',1)->latest()->skip(3)->limit(3)->get();

        return view('pages.index',compact('categories','products','lts','lts2'));
    }
}
