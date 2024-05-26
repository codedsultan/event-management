@extends('layouts.user')

@section('maincontent')

<div class="d-flex justify-content-between">
  <div><h3>Order details</h3></div>

</div>

<div class=" mt-4 mb-4 "><h4>Tickets</h4></div>
<div class="border">

<table class="table table-hover table-striped table-borderless">
  <thead>
    <tr>
      <th >Ticket</th>
      <!-- <th >Description</th> -->
      <th >Quantity</th>
      <!-- <th >Total</th> -->
      <!-- <th >Email</th> -->
      <!-- <th >Status</th> -->
      <!-- <th ></th> -->
    </tr>
  </thead>
  <tbody class="table-group-divider">
  @foreach($order->cart as $item)
    <tr>
      <td>
        {{$item->ticket->event->title}} <span><strong> ({{ucfirst($item->ticket->type)}})</strong></span> x {{$item->quantity}}
      </td>
      <!-- <td>{{$item->quantity}}</td> -->
      <td>${{number_format($item->quantity * $item->price,2)}}</td>
    </tr>
    @endforeach
    <tr>
        <td ><h6>Order #</h6></td>

        <td >{{$order->order_number}}</td>


    </tr>
    <tr>
        <td ><h6>Payment Status</h6></td>

        <td>
            @if($order->payment_status === 'unpaid')
                <span class="badge rounded-pill text-bg-warning p-2 text-capitalize">{{$order->payment_status}}</span>
            @else
                <span class="badge rounded-pill text-bg-info p-2 text-capitalize">{{$order->payment_status}}</span>
            @endif
        </td>


    </tr>
    <tr>
        <td ><h6>Subtotal</h6></td>

        <td ><strong>${{number_format($order->total_amount,2)}}</strong></td>


    </tr>
    @if($order->payment_status === 'unpaid')
    <tr>
        <td ></td>
        <td >
             <a class="btn btn-primary position-relative" href="{{route('stripe.checkout', ['customer_email' => auth()->guard('customer')->user()->email,'price' => $order->total_amount, 'order' => $order->order_number, 'order_id' => $order->id, 'vendor_id' => $order->vendor_id])}}">Make Payment</a>
        </td>
    </tr>
    @endif


  </tbody>
</table>
</div>



@endsection
