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

    // =============== Product Details ====================
     public function ProductDetails($product_id){
        $product_details=Product::findOrfail($product_id);
        $categories_id=$product_details->category_id;
        $related_pro=Product::where('category_id',$categories_id)->where('id','!=',$product_id)->latest()->get();
        return view('pages.product_details',compact('product_details','related_pro'));
     }

// ================================Shop Page========================================
     public function ShopShow(){
         $category=Category::where('status',1)->get();
         $products=Product::where('status',1)->latest()->get();
         $lts2=Product::where('status',1)->latest()->skip(3)->limit(3)->get();
         $productrtl=Product::where('status',1)->paginate(9);
         return view('pages.shop',compact('category','products','productrtl','lts2'));
     }

     public function CategoryWiseShow($id){
         $category=Category::where('status',1)->latest()->get();
        $products=Product::where('category_id',$id)->latest()->paginate(9);
        $lts2=Product::where('status',1)->latest()->skip(3)->limit(3)->get();
         return view('pages.categoryshow',compact('category','products','lts2'));
     }
}
