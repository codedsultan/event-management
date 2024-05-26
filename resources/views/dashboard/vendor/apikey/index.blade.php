@extends('layouts.vendor')
@section('maincontent')
<!-- <div><h1>Stripe Integeration</h1></div> -->

<div class="d-flex justify-content-between">
  <div><h1>Stripe Integeration</h1></div>
  <div><a class="btn btn-primary position-relative" href="{{route('vendor.stripe.key.create')}}">Create Secret Key</a></div>
</div>
<div class="card">
  <div class="card-body">
    <!-- <h5 class="card-title">Card title</h5> -->
    <!-- <div class="d-flex justify-content-between"> -->
    <div><strong>Secret Key :</strong></div>

    <!-- </div> -->
    <p class="card-text mt-2">
     {{$key->stripe ?? 'N/A'}}
     <!-- {{ route('vendor.stripe.key.delete',['key' =>1]) }} -->
    </p>
    @if (isset($key->id))


    <form action="{{ route('vendor.stripe.key.delete',['key' => $key->id]) }}" method="post"  enctype="multipart/form-data" id="create-apikey">
    @method('DELETE')
    @csrf


    <div><button type="submit" class="btn btn-primary position-relative">Delete</button></div>
    </form>
    @endif
    <!-- <button type="button" class="btn btn-primary">Learn More</button> -->
    <!-- 'stripe.key.delete' -->
  </div>
</div>

@endsection
