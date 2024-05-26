@extends('layouts.user')

@section('maincontent')

<div class="d-flex justify-content-between">
  <div><h1>Tickets</h1></div>
  <div>
    <!-- <a
    href="{{ route('organiser.create.events') }}"
    class="btn btn-primary"
    >
        Create Event
    </a> -->
</div>

</div>

<div class="table-responsive mt-10 border">
<table class="table table-hover table-striped table-borderless">
  <thead>
    <tr>
      <th >Code</th>
      <th >Event</th>
      <th >Start Date</th>
      <th >End Date</th>
      <!-- <th >Email</th> -->
      <th >Ownership</th>
      <th ></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  @foreach($tickets as $ticket)
    <tr>
      <td>
        <a href="#">{{$ticket->number}}</a>
      </td>

      <td>
        {{$ticket->ticket->event->title}}
      </td>
      <td>{{now()->parse($ticket->ticket->event->start_date)->format('M d Y')}}</td>
      <td>{{now()->parse($ticket->ticket->event->end_date)->format('M d Y')}}</td>
      <td>
        @if($ticket->is_transferred)
            <span class="badge rounded-pill text-bg-warning p-2 text-capitalize">Transferred</span>
        @else
            <span class="badge rounded-pill text-bg-info p-2 text-capitalize">Self</span>
        @endif
      </td>
      <td>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button"
           data-bs-toggle="dropdown" aria-expanded="false">More</button>
          <ul class="dropdown-menu">
          @if(!$ticket->is_transferred)
            <li>
              <a class="dropdown-item" href="{{route('user.ticket.edit',$ticket->id)}}">Transfer Ticket</a>
            </li>
        @endif
            <!-- <li>
              <a class="dropdown-item" href="#">Preview</a>
            </li> -->
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<ul>


</ul>



@endsection
