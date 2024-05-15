@extends('layouts.vendor')

@section('maincontent')

<div class="d-flex justify-content-between">
  <div><h1>Events</h1></div>
  <div>
    <!-- <a
    href="{{ route('organiser.create.events') }}"
    class="btn btn-primary"
    >
        Create Event
    </a> -->
</div>

</div>

<div class="mt-10 border" >
<table class="table table-hover table-striped table-borderless" >
  <thead>
    <tr>
      <th >Title</th>
      <th >Description</th>
      <th >Start Date</th>
      <th >End Date</th>
      <th >Tickets</th>
      <th ></th>
      <th ></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  @foreach($events as $event)
    <tr>
      <td>
        <a href="#">{{$event->title}}</a>
      </td>
      <td class="text-break">{{substr($event->description, 0, 35) . '...'}}</td>
      <td>{{now()->parse($event->start_date)->format('M d Y')}}</td>
      <td>{{now()->parse($event->end_date)->format('M d Y')}}</td>
      <td>{{$event->tickets->count()}}</td>
      <td>
        <article id="content-copy" style="display: none;">
            {{ route('event.show',$event->id) }}
        </article>
        <button id="btn-copy" class="btn btn-default">Share link</button>

        <!-- <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button"
           data-bs-toggle="dropdown" aria-expanded="false">Share</button>
          <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ route('event.show',$event->id) }}" rel="me" title="Facebook" target="_blank"><i class="fa facebook"></i> Facebook</a>
            </li>
            <li>
            <a href="https://twitter.com/intent/tweet?text={{ $event->title }}&amp;url={{route('event.show',$event->id)}}" target="_blank" class="dropdown-item social-button" id=""><span class="fa fa-twitter"></span>Twitter</a>
            </li>
          </ul>
        </div> -->
      </td>

      <td>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button"
           data-bs-toggle="dropdown" aria-expanded="false">More</button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{route('vendor.tickets',$event->id)}}">Manage Tickets</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{route('vendor.show.events',$event->id)}}">Preview</a>
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

@push('scripts')
<script>
    const copyButton = document.getElementById('btn-copy');
    copyButton.addEventListener('click', (event) => {
        // getting the text content that we want to copy
        const content = document.getElementById('content-copy').textContent;
        // loading the content into our clipboard
        navigator.clipboard.writeText(content);
})
</script>

@endpush
