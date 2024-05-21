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
        // dd($request->vendor);
        if(Auth::guard('customer')->check())
        {
            if(empty(Cart::where('customer_id',auth()->guard('customer')->user()->id)->where('order_id',null)->where('vendor_id',$request->vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }
            // $user = auth()->guard('customer')->user();
            // dd($user);
        }else{
            // $data = $request->validate([
            //     'email' => ['required','string','email']
            // ]);
            if(empty(Cart::where('session_id',Session::get('cart'))->where('order_id',null)->where('vendor_id',$request->vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }
            // $user = Customer::firstOrCreate(['email' =>  $data['email']]);
            // Cart::where('session_id', Session::get('cart'))->where('order_id', null)->where('vendor_id',$vendor)->update(['customer_id' => $user->id]);
        }
        $vendor = $request->vendor;
        return view('checkouts',compact('vendor'));
    }

}
