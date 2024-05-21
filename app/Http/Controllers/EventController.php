<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(){
        $events = Event::orderBy('id','desc')->paginate(10);

        return view('index',compact('events'));
    }

    public function show($id){
        $event = Event::where('id',$id)->with('tickets')->first();
        return view('event.show',compact('event'));
    }

    public function iframe(){
        $events = Event::orderBy('id','desc')->paginate(3);
        return view('iframeevents',compact('events'));
    }
}
