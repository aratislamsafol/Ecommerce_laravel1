<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_item;
use App\Shipping;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Index(){
        $orders=Order::latest()->get();
        return view('admin.orders.index',compact('orders'));
    }

    public function ViewOrder($id){
        $order=Order::findOrFail($id);
        $order_item=Order_item::where('order_id',$id)->get();
        $shipping=Shipping::where('order_id',$id)->first();

        return view('admin.orders.view',compact('order','order_item','shipping'));
    }
}
