@extends('layouts.user')
@section('maincontent')
<div class="w-50 mx-auto">

<div>
    <h4>Transfer Ticket</h4>
   </div>
<form action="{{ route('user.ticket.update',$customerTicket->id) }}" method="post"  enctype="multipart/form-data" id="transfer-ticket">
@csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Email</span>
        <input class="form-control" type="text" id="type" name="email" />
    </div>
    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
    <!-- <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Price</span>
        <input class="form-control" type="text" name="price" id="price" />
    </div>
    <span class="text-danger">@error('price') {{ $message }} @enderror</span>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Quantity</span>
        <input class="form-control" type="number" name="quantity" id="quantity" />
    </div>
    <span class="text-danger">@error('quantity') {{ $message }} @enderror</span> -->


    <button type="submit" class="btn btn-primary w-100">Transfer</button>

</form>
</div>
@endsection
