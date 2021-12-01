<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddCart(Request $request){
        $check=Cart::where('product_id',$request->product_id)->first();
        if($check){
            Cart::where('product_id',$request->product_id)->increment('product_qty');
            return Redirect()->back()->with('success','Product Added');

        }else{
            Cart::insert([
                'product_id'=>$request->product_id,
                'product_qty'=>1,
                'price'=>$request->price,
                'user_ip'=>request()->ip(),
            ]);
            return Redirect()->back()->with('success','Product Added');
        }

    }
}
