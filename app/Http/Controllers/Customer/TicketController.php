<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {

        $orders = Order::where('customer_id',$request->user()->id)->orderBy('id','desc')->paginate(20);
        return view('dashboard.user.orders.index', compact('orders'));
    }

}
