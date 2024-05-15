@extends('layouts.user')

@section('maincontent')

<div class="d-flex justify-content-between">
  <div><h1>Orders</h1></div>
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
      <th >Number</th>
      <!-- <th >Description</th> -->
      <th >Quantity</th>
      <th >Total</th>
      <!-- <th >Email</th> -->
      <th >Status</th>
      <th ></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  @foreach($orders as $order)
    <tr>
      <td>
        <a href="#">{{$order->order_number}}</a>
      </td>
      <td>{{$order->quantity}}</td>
      <td>{{$order->total_amount}}</td>
      <td>
        @if($order->payment_status === 'unpaid')
            <span class="badge rounded-pill text-bg-warning p-2 text-capitalize">{{$order->payment_status}}</span>
        @else
            <span class="badge rounded-pill text-bg-info p-2 text-capitalize">{{$order->payment_status}}</span>
        @endif
      </td>
      <td>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button"
           data-bs-toggle="dropdown" aria-expanded="false">More</button>
          <ul class="dropdown-menu">
          @if($order->payment_status === 'unpaid')
            <li>
              <a class="dropdown-item" href="{{route('stripe.checkout', ['price' => $order->total_amount, 'order' => $order->order_number, 'order_id' => $order->id])}}">Make Payment</a>
            </li>
        @endif
            <li>
              <a class="dropdown-item" href="#">Preview</a>
            </li>
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
