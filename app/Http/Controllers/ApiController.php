<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Event $event)
    {
        $events = Event::orderBy('id','desc')->paginate(3);

        return EventResource::collection($events);
    }
}
