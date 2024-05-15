<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        // dd($request->user()->load('api_key')->api_key->stripe);
        return view('dashboard.vendor.home');
    }
}
