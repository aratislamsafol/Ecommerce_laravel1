<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    // ===============Cart Coupon===============

    public function ApplyCoupon(Request $request){
        $check=Coupon::where('coupon_name',$request->coupon_name)->first();

        if($check){

        Session::put('coupon',[
            'coupon_name'=>$check->coupon_name,
            'discount_rate'=>$check->discount
        ]);
           return Redirect()->back()->with('success','Coupon Added Successfully');
        }else{
            return Redirect()->back()->with('Fail','Wrong Coupon');
        }
    }
}
