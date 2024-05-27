@extends('layouts.vendor')
@section('maincontent')
<div><h4>Save Stripe Key</h4></div>

<!-- <div class="card"> -->
<div class="row">
  <div class="col">
  <form action="{{ route('vendor.stripe.key.store') }}" method="post"  enctype="multipart/form-data" id="create-apikey">
    @csrf
    <span class="text-danger">@error('stripe_secret') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">Stripe Secret</span>
        <input class="form-control" type="text" id="stripe_secret" name="stripe_secret" value="{{  old('stripe_secret') }}" />
    </div>
    <button type="submit" class="btn btn-primary mt-3 w-25">Save</button>
  </form>
  </div>
</div>
<!-- </div> -->
@endsection
