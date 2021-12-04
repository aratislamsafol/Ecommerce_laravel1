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

    public function ShowCart(){
        $carts=Cart::where('user_ip',request()->ip())->latest()->get();
        $sub_total=Cart::all()->where('user_ip',request()->ip())->sum(function($res){
            return $res->product_qty * $res->price;
        });

        return view('pages.cart',compact('carts','sub_total'));
    }

    public function Remove($id){
        Cart::where('user_ip',request()->ip())->find($id)->delete();
        return Redirect()->back();
    }

    public function UpdateCart(Request $request,$cart_id){
        Cart::where('id',$cart_id)->where('user_ip',request()->ip())->Update([
            'product_qty'=> $request->product_qty
        ]);
        return Redirect()->back();
    }
}
