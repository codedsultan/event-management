<?php

namespace App\Http\Controllers\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Event $event)
    {
        $event->load('tickets');
        $tickets = $event->tickets;

        return view('dashboard.vendor.tickets.index', compact('event','tickets'));
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create(Event $event)
    {
        return view('dashboard.vendor.tickets.create', compact('event'));
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Event $event,Request $request)
    {
        $data = $request->validate([
            'type' => ['string'],
            'price' => ['numeric'],
            'quantity' => ['integer'],
        ]);

        $ticket = new Ticket();
        $ticket->title = $data['type'];
        $ticket->type = $data['type'];
        $ticket->quantity_available = isset($data['quantity']) ? $data['quantity'] : null ;
        $ticket->price = $data['price'];
        $ticket->event_id = $event->id;
        $ticket->save();
        return redirect()->route('vendor.tickets',($event->id))->with('success','Ticket has been Created successfully');

    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit($id)
    {
        //
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update($id)
    {
        //
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        //
    }


}
