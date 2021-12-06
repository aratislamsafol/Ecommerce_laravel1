<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    public function AddWishlist($product_id){
        $checks=Wishlist::where('product_id',$product_id)->first();
        if(Auth::check()){
            if($checks){
                return Redirect()->back()->with('success','Added to Wishlist Before');
            }else{
                    Wishlist::insert([
                    'user_id'=>Auth::id(),
                    'product_id'=>$product_id,
                ]);
                return Redirect()->back()->with('success','Added to Wishlist');
                }

        }else{
            return Redirect()->route('login')->with('fail','Could not Added to Wishlist');
        }
    }
    public function ShowWishlist(){
        $wishlist=Wishlist::where('user_id',Auth::id())->latest()->get();

        return view('pages.wishlist',compact('wishlist'));
    }
    public function Remove($id){
        Wishlist::where('user_id',Auth::id())->find($id)->delete();

        return Redirect()->back();
    }
}
