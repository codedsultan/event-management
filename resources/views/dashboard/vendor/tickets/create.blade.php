@extends('layouts.vendor')
@section('maincontent')

<div class="w-50 mx-auto">
   <div>
    <h4>Create Event</h4>
   </div>
<form action="{{ route('vendor.store.tickets',$event->id) }}" method="post"  enctype="multipart/form-data" id="create-event">
@csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Type</span>
        <input class="form-control" type="text" id="type" name="type" />
    </div>
    <span class="text-danger">@error('type') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Price</span>
        <input class="form-control" type="text" name="price" id="price" />
    </div>
    <span class="text-danger">@error('price') {{ $message }} @enderror</span>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Quantity</span>
        <input class="form-control" type="number" name="quantity" id="quantity" />
    </div>
    <span class="text-danger">@error('quantity') {{ $message }} @enderror</span>


    <button type="submit" class="btn btn-primary w-100">Create</button>

</form>
</div>
@endsection
