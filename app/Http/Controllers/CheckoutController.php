<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        if(Auth::guard('customer')->check())
        {
            if(empty(Cart::where('customer_id',auth()->guard('customer')->user()->id)->where('order_id',null)->where('vendor_id',$request->vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }

        }else{

            if(empty(Cart::where('session_id',Session::get('cart'))->where('order_id',null)->where('vendor_id',$request->vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }
        }
        $vendor = $request->vendor;
        return view('checkouts',compact('vendor'));
    }

}
