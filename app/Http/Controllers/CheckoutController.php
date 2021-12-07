<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function Index(){
        if(Auth::check()){
            return view('pages.checkout');
        }else{
            return Redirect()->route('login');
        }
    }
}
