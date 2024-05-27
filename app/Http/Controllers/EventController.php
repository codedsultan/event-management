<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(){
        $events = Event::orderBy('id','desc')->paginate(6);

        return view('index',compact('events'));
    }

    public function all(){
        $events = Event::orderBy('id','desc')->paginate(12);

        return view('event.index',compact('events'));
    }

    public function show($slug){
        $event = Event::where('slug',$slug)->with('tickets')->first();
        return view('event.show',compact('event'));
    }

    public function iframe(){
        $events = Event::orderBy('id','desc')->paginate(3);
        return view('iframeevents',compact('events'));
    }
}
