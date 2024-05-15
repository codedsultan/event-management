
@extends('layouts.vendor')
@section('maincontent')
<div><h1>Create Application</h1></div>
<div class="row">
  <div class="col">
  <form action="{{ route('vendor.store.bookings') }}" method="post"  enctype="multipart/form-data" id="create-event">
    @csrf
    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">Name</span>
        <input class="form-control" type="text" id="name" name="name" value="{{  old('name') }}" />
    </div>

    <span class="text-danger">@error('description') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">Description</span>
        <textarea class="form-control" type="text" id="description" name="description" >
        {{old('description')}}
        </textarea>
    </div>


    <span class="text-danger">@error('start_date') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">Start Date</span>
        <input class="form-control" type="date" id="start_date" name="start_date" value="{{  old('start_date') }}"/>
    </div>

    <span class="text-danger">@error('end_date') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">End Date</span>
        <input class="form-control" type="date" id="end_date" name="end_date" value="{{  old('end_date') }}"/>
    </div>

    <span class="text-danger">@error('starts_at') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">Start Time</span>
        <input class="form-control" type="time" id="starts_at"  name="starts_at" value="{{  old('starts_at') }}"/>
    </div>

    <span class="text-danger">@error('ends_at') {{ $message }} @enderror</span>
    <div class="input-group mb-3">
        <span class="input-group-text w-25" id="basic-addon1">End Time</span>
        <input class="form-control" type="time" id="ends_at" name="ends_at" value="{{  old('ends_at') }}" />
    </div>


    <p>Additional Requirements</p>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="band" name="items_required[]" {{ is_array(old('items_required')) ? (in_array('band',old('items_required')) ? 'checked' : '') : ''}} />
        <label class="form-check-label" for="items_required">
            Band
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox"  value="microphone" name="items_required[]" {{ is_array(old('items_required')) ? (in_array('microphone',old('items_required')) ? 'checked' : '') : ''}} />
        <label class="form-check-label" for="items_required">
        Microphone
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox"  value="speakers" name="items_required[]" {{ is_array(old('items_required')) ? (in_array('speakers',old('items_required')) ? 'checked' : '') : ''}} />
        <label class="form-check-label" for="items_required">
            Speakers
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="food" name="items_required[]" {{ is_array(old('items_required')) ? (in_array('food',old('items_required')) ? 'checked' : '') : ''}}/>
        <label class="form-check-label" for="items_required">
            Food
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="drinks" name="items_required[]" {{ is_array(old('items_required')) ? (in_array('drinks',old('items_required')) ? 'checked' : '') : ''}}/>
        <label class="form-check-label" for="items_required">
            Drinks
        </label>
    </div>

    <button type="submit" class="btn btn-primary mt-3 w-100">Create</button>

    </form>
  </div>
  <div class="col">

  <img class="border " src="/retina.webp"  width="100%" height="300" alt="project-image" class="rounded" />
  <div class="card-body">
    <h1>{{$location->name}}</h1>
    <p class="card-text text-justify">{{$location->description}}</p>
  </div>


  </div>
</div>






@endsection

