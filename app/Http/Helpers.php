<?php

use App\Models\Order;
use App\Models\Cart;
use App\Models\InvoiceItem;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

// use Auth;
class Helper {





    // Cart Count
    public static function cartCount($user_id=''){
        // dd(Auth::guard('customer')->check());
        if(Auth::guard('customer')->check()){
            if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return Cart::where('customer_id',$user_id)->where('order_id',null)->sum('quantity');
        }
        else{
            return 0;
        }
    }
    // relationship cart with product
    // public function product(){
    //     return $this->hasOne('App\Models\Product','id','product_id');
    // }

    public static function getAllProductFromCart($user_id=''){
        if(Auth::guard('customer')->check()){
            if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return Cart::with('ticket')->where('customer_id',$user_id)->where('order_id',null)->get();
        }
        else{
            return [];
        }
    }

    public static function getAllVendorProductFromCart($user_id=''){
        if(Auth::guard('customer')->check()){
            if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return Cart::with('ticket')->where('customer_id',$user_id)->where('order_id',null)->get()->groupBy('vendor_id');
            // ->groupBy(function($data) {
            //     return $data->timezone;
            // });

        }
        else{
            return [];
        }
    }
    // Total amount cart
    public static function totalCartPrice($user_id=''){
        if(Auth::guard('customer')->check()){
            if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return Cart::where('customer_id',$user_id)->where('order_id',null)->sum('amount');
        }
        else{
            return 0;
        }
    }

    // public static function totalVendorCartPrice($user_id='',$vendor_id){
    //     if(Auth::guard('customer')->check()){
    //         if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
    //         return Cart::where('customer_id',$user_id)->where('order_id',null)->where('vendor_id')->sum('amount');
    //     }
    //     else{
    //         return 0;
    //     }
    // }

    public static function totalVendorCartPrice($user_id='',$vendor_id=""){
        if(Auth::guard('customer')->check()){
            if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return Cart::where('customer_id',$user_id)->where('order_id',null)->where('vendor_id',$vendor_id)->sum('amount');
        }
        else{
            return 0;
        }
    }

    public static function totalInvoicePrice($id){
        // if(Auth::guard('customer')->check()){
            // if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
            return InvoiceItem::where('invoice_id',$id)->sum('price');
        // }
        // else{
        //     return 0;
        // }
    }


    public static function getVendorId($user_id=""){
        if($user_id=="") $user_id=auth()->guard('customer')->user()->id;
        $cart= Cart::where('customer_id',$user_id)->where('order_id',null)->first();
        // dd()
        return $cart->vendor_id;

    }

    public static function getVendorAPiKey($vendor_id){
        $vendor = Vendor::whereId($vendor_id)->with('api_key')->first();
        // dd($vendor);
        return $vendor->api_key->stripe;

    }
    // Vendor::whereId($request->vendor_id)->with('api_key')->first();
    // Total price with shipping and coupon
    // public static function grandPrice($id,$user_id){
    //     $order=Order::find($id);
    //     // dd($id);
    //     if($order){
    //         $shipping_price=(float)$order->shipping->price;
    //         $order_price=self::orderPrice($id,$user_id);
    //         return number_format((float)($order_price+$shipping_price),2,'.','');
    //     }else{
    //         return 0;
    //     }
    // }



}

?>
