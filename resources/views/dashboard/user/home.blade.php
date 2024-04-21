

@extends('layouts.base')
@section('content')

<div class="layout">
  <main class="layout-main px-4">
    <div><h1>Dashboard</h1></div>
    <p>{{ Auth::guard('customer')->user()->name }}<p>
    <p>{{ Auth::guard('customer')->user()->email }}<p>

  </main>
  <aside class="layout-sidebar border-end">
    <ul class="list-group border-0" style="width:200px;">
      <li class="list-group-item list-group-item-action">
        <a href="#">My Tickets</a>
      </li>
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

