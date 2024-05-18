<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        // dd($request->vendor);
        $vendor = $request->vendor;
        return view('checkouts',compact('vendor'));
    }

}
