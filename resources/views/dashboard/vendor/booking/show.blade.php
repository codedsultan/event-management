@extends('layouts.vendor')
@section('maincontent')
<!-- <h1>Application</h1> -->
<div class="row">
<div class="col-md-6 ">
            <div class="">
                <h1>{{ucfirst($booking->name)}}<h1>
            </div>
            <div class="mb-8">
                <h5>Description</h5>
                <p class="mb-0">{{$booking->description}}</p>
            </div><!-- / project-info-box -->

            <div class="">

                <p><b>Start Date:</b> {{$booking->start_date}}</p>
                <p><b>End Date:</b> {{$booking->end_time}}</p>
                <p><b>Start Time:</b> {{$booking->starts_at}}</p>
                <p><b>End Time:</b> {{$booking->ends_at}}</p>
                <p><b>Location:</b> {{$booking->location->name}}</p>

            </div>

            <h4 class="mt-4">Additional Requirements</h4>
            <ul>
            @foreach ( $booking->items_required as $item )
            <li><p>{{ ucfirst($item)}}</p></li>
            @endforeach
            </ul>


        </div>

  <div class="col">

  <img class="border " src="/retina.webp"  width="100%" height="300" alt="project-image" class="rounded" />
  <div class="card-body">
    <h1>{{$booking->location->name}}</h1>
    <p class="card-text text-justify">{{$booking->location->description}}</p>
  </div>


  </div>
</div>

@endsection


@push('styles')
    <link rel="stylesheet" href="{{asset('css/event.css')}}">
@endpush
