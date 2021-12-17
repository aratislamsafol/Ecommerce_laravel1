<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function StoreData(Request $request){
        $request->validate([
            'shipping_first_name' => 'required|max:30',
            'shipping_last_name' => 'required|max:30',
            'shipping_phone' => 'required|min:10|numeric',
            'shipping_email' => 'required|email',
            'shipping_state' => 'required|max:255',
            'shipping_address' => 'required|max:255',
            'post_code' => 'required|max:255',
        ],
        [
            'shipping_first_name.required'=>'First Name is not valid(max 30 chars)',
            'shipping_last_name.required'=>'Last Name is not valid(max 30 chars)',
            'shipping_phone.required'=>'Phone Number Must be upper to 10 Digit',
            'shipping_email.required'=>'Email is Not Required',
        ]
    );

    $order_id=Order::insert([
        'user_id' =>Auth::id(),
        'invoice_no' => mt_rand(10000000,99999999),
        'total'=>$request->total,
        'subtotal'=>$request->subtotal,
        'coupon_discount'=>$request->coupon_discount,
        'payment_type' =>$request->payment_type,
        'created_at'=>Carbon::now(),
    ]);

    $carts=Cart::where('user_ip',request()->ip())->latest()->get();

    foreach($carts as $cart){
        Order_item::insert([
            'order_id'=>$order_id,
            'product_id'=>$cart->product_id,
            // 'product_name'=>$cart->product->product_name,
            'product_qty' =>$cart->product_qty,
            'created_at'=>Carbon::now(),
        ]);
    }

    Shipping::insert([
        'order_id'=>$order_id,
        'shipping_first_name'=>$request->shipping_first_name,
        'shipping_last_name'=>$request->shipping_last_name,
        'shipping_email'=>$request->shipping_email,
        'shipping_phone'=>$request->shipping_phone,
        'shipping_address'=>$request->shipping_address,
        'shipping_state'=>$request->shipping_state,
        'post_code'=>$request->post_code,
        'created_at'=>Carbon::now(),
    ]);

    if(Session::has('coupon')){
        Session::forget('coupon');
    }
    Cart::where('user_ip',request()->ip())->delete();

    return Redirect()->to('order/success')->with('success','Store Order Data Successfully');
    }

    public function SuccessPages(){
        return view('pages.complete_checkout');
    }

    public function OrderCart(){
        $orders=Order::where('user_id',Auth::id())->latest()->get();

        return view('pages.profile.order',compact('orders'));
    }

    public function OrderFontendShow($id){
        $order=Order::findOrFail($id);
        $order_item=Order_item::with('Product')->where('order_id',$id)->get();
        $shipping=Shipping::where('order_id',$id)->first();

        return view('pages.profile.view',compact('order','order_item','shipping'));
    }


}
