@extends('layouts.user')
@section('maincontent')



    <div><h1>Dashboard</h1></div>
    <!-- <h4>vendor Dashboard</h4> -->
    <p>Welcome,{{ Auth::guard('customer')->user()->name }}.<p>

@endsection
