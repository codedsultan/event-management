@extends('layouts.vendor')
@section('maincontent')

<div class="d-flex justify-content-between">
  <div><h1>{{$event->title}} tickets</h1></div>
  <div>
    <a
        href="{{ route('vendor.create.tickets',$event->id) }}"
        class="btn btn-primary"
    >
        Create Ticket
    </a>

</div>

</div>

<div class=" mt-10 border">
<table class="table table-hover table-striped table-borderless">
  <thead>
    <tr>
      <th >Type</th>
      <th >Price</th>
      <th >Remaining</th>
      <th >Sold</th>
      <th >Total</th>
      <!-- <th ></th> -->
    </tr>
  </thead>
  <tbody class="table-group-divider">
  @foreach($tickets as $ticket)
    <tr>
      <td>
        {{$ticket->type}}
      </td>
      <td >{{$ticket->price}}</td>
      <td>N/A</td>
      <td>N/A</td>
      <td>{{$ticket->quantity_available}}</td>
      <!-- <td>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button"
           data-bs-toggle="dropdown" aria-expanded="false">More</button>
          <ul class="dropdown-menu">

            <li>
              <a class="dropdown-item" href="#">Preview</a>
            </li>
          </ul>
        </div>
      </td> -->
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
