@extends('layouts.base')
@section('content')
<div class="container">
    <div class="row g-0">
        <div class="col-md-6 border">
            <img src="/retina.webp" width="100%" height="300" class="img-fluid rounded-start p-8">
        </div>
        <div class="col-md-6">
            <div class="card-body p-8">
                <h1 >Amazing Event Space</h1>
                <p class="card-text text-justify py-4">
                    We need to start advertising on social media quick-win we don't need to boil the ocean here optics deploy,
                yet but what's the real problem we're trying to solve here?.
                Let's circle back tomorrow it's a simple lift and shift job pig in a python
                let's pressure test this it's a simple lift and shift job we need to get all stakeholders
                up to speed and in the right place
                We need to start advertising on social media quick-win we don't need to boil the ocean here optics deploy,
                yet but what's the real problem we're trying to solve here?.
                Let's circle back tomorrow it's a simple lift and shift job pig in a python
                let's pressure test this it's a simple lift and shift job we need to get all stakeholders
                up to speed and in the right place
                </p>

                <a href="{{route('vendor.create.bookings',1)}}" class="btn btn-primary">Apply for space</a>

            </div>
        </div>
    </div>

    <h1 class="my-8">Upcoming Events</h1>
    <div class="row flex">
        @foreach($events as $event)
        <div class="col-sm-4 mb-4">
            <div class="card h-100">
                <img src="{{$event->featured_image}}" class="card-img-top" alt="green iguana" />
                <div class="card-body">
                    <h4>{{$event->title}}</h4>
                </div>
                <div class="card-footer">


                <a
                    href="{{route('event.show',$event->id)}}"
                    class="btn btn-primary"
                >
                    Learn More
                </a>

                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection


