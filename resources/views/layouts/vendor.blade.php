

@extends('layouts.base')
@section('content')

<h1>@yield('page_title')</h1>

<div class="layout">
  <main class="layout-main px-4">
    @yield('maincontent')

  </main>
  <aside class="layout-sidebar border-end">
    <ul class="list-group border-0 vendor-nav">
      <li class="list-group-item list-group-item-action border-bottom w-auto me-2">
        <a href="{{route('vendor.bookings')}}">Applications</a>
      </li>
      <li class="list-group-item list-group-item-action border-bottom w-auto me-2">
        <a href="{{route('vendor.events')}}">Events</a>
      </li>

      <li class="list-group-item list-group-item-action border-bottom w-auto me-2">
        <a href="{{route('vendor.stripe.key.index')}}">Stripe</a>
      </li>


      <!-- <li class="list-group-item list-group-item-action border-bottom w-auto me-2 ">
        <a href="#">Tickets</a>
      </li> -->
      <!-- <li class="list-group-item list-group-item-action">
        <a href="#">Menu 2</a>
      </li>
      <li class="list-group-item list-group-item-action">
        <a href="#">Menu 3</a>
      </li>
      <li class="list-group-item list-group-item-action">
        <a href="#">Menu 4</a>
      </li> -->
    </ul>
  </aside>
</div>


@endsection

@push('styles')
<style>
    .vendor-nav{
        width: 200px;
    }

    @media only screen and (max-width: 400px) {
        .vendor-nav{
        width: 50px;
    }
    }
</style>

@endpush
