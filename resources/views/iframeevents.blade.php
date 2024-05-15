<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">

</head>
<body class="container mx-auto">
    <div class="row flex">
        @foreach($events as $event)
        <div class="col-sm-3 mb-4">
            <div class="card h-100">
                <img src="{{$event->featured_image}}" class="card-img-top" alt="green iguana" />
                <div class="card-body">
                    <h4>{{$event->title}}</h4>
                        <!-- <p class="card-text text-wrap">
                            {{$event->description}}
                        </p> -->
                    <!-- <div>
                    <button class="btn btn-primary" type="button">Share</button>
                    <button class="btn btn-link" type="button">Learn More</button>
                    <button class="btn btn-link" type="button">Learn More</button>
                    </div> -->
                </div>
                <div class="card-footer">
                <!-- <button class="btn btn-link" type="button">
                    Learn More
                </button> -->

                <a
                    href="{{ route('event.show',$event->id) }}"
                    class="btn btn-primary"
                >
                    Learn More
                </a>
                    <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                </div>
            </div>

        </div>


        @endforeach

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>


