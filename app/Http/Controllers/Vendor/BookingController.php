<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $bookings = Booking::where('vendor_id',$request->user()->id)->with('invoice')->orderBy('id','desc')->paginate(20);
        return view('dashboard.vendor.booking.index', compact('bookings'));
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create(Request $request,Location $location)
    {
        return view('dashboard.vendor.booking.create', compact('location'));
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        // dd()
        $data =  $request->validate([
            'name' => ['required','string'],
            'description' => ['required','string'],
            // 'start_date' => ['required','string','after:yesterday'],
            // 'end_date' => ['nullable','string','after:start_date'],
            // 'starts_at' => ['required','string'],
            // 'ends_at' => ['nullable','string','after:starts_at'],
            'start_date' => ['required','string'],
            'end_date' => ['nullable','string'],
            'starts_at' => ['required','string'],
            'ends_at' => ['nullable','string'],
            'items_required' => ['nullable', 'array']
        ]);

        $booking = new Booking();
        $booking->name = $data['name'];
        $booking->description = $data['description'];
        $booking->start_date = $data['start_date'];
        $booking->end_date = $data['end_date'];
        $booking->starts_at = $data['starts_at'];
        $booking->ends_at = $data['ends_at'];
        $booking->items_required = $data['items_required'];
        $booking->vendor_id = $request->user()->id;
        $booking->save();

        return redirect()->route('vendor.bookings')->with('success', 'Application successfull');
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(Booking $booking)
    {
        $booking->load('location');
        return view('dashboard.vendor.booking.show', compact('booking'));
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
