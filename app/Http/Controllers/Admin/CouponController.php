<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Index(){
        $coupon_show=Coupon::latest()->paginate(5);

        return view('admin.coupon.index',compact('coupon_show'));
    }

    public function AddCoupon(Request $request){
        $request->validate([
            'coupon_name' => 'required|max:255',
        ],
        [
            'coupon_name.required'=>'please Valid Input coupon Name',
            'coupon_name.max'=>'Maximum 255 Chars category Name',
        ]
    );

    Coupon::insert([
        'coupon_name'=>$request->coupon_name,
        'created_at'=>Carbon::now()
    ]);
    return Redirect()->back()->with('success','Coupon Inserted Successfully');
    }

    public function Edit($id){
        $coupon_id=Coupon::find($id);

        return view('admin.coupon.edit',compact('coupon_id'));
    }

    public function Update(Request $request,$id){
        $coupon_id=Coupon::find($id)->Update([
            'coupon_name'=>$request->coupon_name,

            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->route('admin.coupon')->with('success','Coupon Updated Successfully');
    }

    public function Delete($id){
        $coupon_id_del=Coupon::find($id)->delete();

        return Redirect()->back()->with('delete','Coupon Item Deleted Successfully');
    }

    public function Inactive($id){
        Coupon::find($id)->Update([
            'status'=>0
        ]);
        return Redirect()->back()->with('status-Active','Coupon Item Inactived');
    }

    public function Active($id){
        Coupon::find($id)->Update([
            'status'=>1
        ]);
        return Redirect()->back()->with('status-Inactive','Coupon Item Actived');
    }
}
