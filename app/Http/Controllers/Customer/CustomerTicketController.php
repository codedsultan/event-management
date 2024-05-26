<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerTicket;
use Illuminate\Http\Request;

class CustomerTicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = CustomerTicket::where('customer_id',$request->user()->id)->with('ticket.event')->orderBy('id','desc')->paginate(20);
        // dd($tickets);
        return view('dashboard.user.ticket.index',compact('tickets'));
    }

    public function show()
    {

    }

    public function edit(CustomerTicket $customerTicket,Request $request)
    {
        // refactor autorization
        if($customerTicket->customer_id !== $request->user()->id){
            return abort(403);
        }
        return view('dashboard.user.ticket.edit',compact('customerTicket'));
    }
    public function update(CustomerTicket $customerTicket,Request $request)
    {
        if($customerTicket->customer_id !== $request->user()->id){
            return abort(403);
        }
        $data = $request->validate([
            'email' => ['string','required','email']
        ]);

        if($data['email'] == $request->user()->email){
            return redirect()->back()->with('success','You own the ticket already');
        }

        if($customerTicket->is_transferred){
            return redirect()->back()->with('success','Ticket is already transferred onse');
        }

        $customerTicket->email = $data['email'];
        $customerTicket->is_transferred = true;
        $customerTicket->save();

        return redirect()->route('user.tickets')->with('success','Ticket transferred successfuly');
    }
}
