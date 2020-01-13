@extends('layouts.app')
@section('content')
<div class="section-1">
    <div class="card" >
        <h2>Prijava br. {{ $report->id }}</h2>
    </div>
<div class="card-1-2">
    <div class="column">
        <div class="description">
            <div class="bottom-line-1-2">
                <h3 class="h3-position">Opis problema</h3>
                    <p class="opis-1">{{ $report->description }}</p>
            </div class="h3-position">
            <div class="bottom-line-2">
                <h3 class="h3-position">Adresa </h3>
                    <p class="opis-1">{{ $report->address }}</p>
            </div>
            <div class="section">
                <div id="map" style="display: block; width:100%; border-radius: 5px;" class="map_show"></div>
               <script>


            var report = @json($report);
            //morao dodat da bi mi čitalo solved_at, uz castanje u modelu

            var lat = report.latitude;
            var lon = report.longitude;
            var solved = report.solved_at;
            var map;


            if(solved == null){
                var color = "/storage/img/red_marker.svg"
            } else {
                var color = "/storage/img/green_marker.svg"
            }





            function initMap(report) {


                var options = {
                    zoom: 11,
                    center: {lat: lat, lng: lon},
                    fullscreenControl: false,
                    streetViewControl: false,
                    styles: [{
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    }]
                }


                map = new google.maps.Map(document.getElementById('map'), options);
                $(window).resize(function() {
                    // (the 'map' here is the result of the created 'var map = ...' above)
                    google.maps.event.trigger(map, "resize");
                });

                addMarker();


            }

            function addMarker(){





                var markerLatlng = new google.maps.LatLng(parseFloat(report.latitude),parseFloat(report.longitude));

                var mark = new google.maps.Marker({
                    map: map,
                    position: markerLatlng,
                    icon: color
                });


                return mark;

            }

        </script>

            </div>
        </div>
        <div class="description">
            <h3 class="h3-position">Slika prijavljenog problema</h3>
                <img class="prijavljena-slika" src="{{ asset('storage/images/' . $report->image_user) }}" alt="">
        </div>
        <div class="description">
            <div class="bottom-line-2">
                <h3 class="h3-position">Datum prijave problema </h3>
                    <p class="opis-1">
                       
                            {{ $report->reported_at->format('d.m.Y') }}
                                               
                    </p>
            </div> 
        </div>
        </div>
    </div>
</div>

    @if($report->solved_at == null)
<!--<h1> Nije riješeno</h1>-->
    @else
<div class="section">
    <div class="card" >
        <h2>Rješenje</h2>
    </div>
<div class="card-1-2">
    <div class="column">
        <div class="description">
            <div class="bottom-line-1-2">
                <h3 class="h3-position">Opis riješenja</h3>
                    <p class="opis-1">{{ $report->solved_description }}</p>
            </div>
            <div class="bottom-line-2">
                <h3 class="h3-position">Kategorija problema </h3>
                @if($report->category_id != NULL)
                    <p class="opis-1">{{ $report->category->name }}</p>
                    @else 
                    <p class="opis-1">Nekategorizirano</p>
               @endif
            </div>
            
        </div>
        <div class="description">
            <h3 class="h3-position">Slika riješenog problema</h3>
                <img class="prijavljena-slika" src="{{ asset('storage/images/' . $report->image_solved) }}" alt="">
        </div>
        <div class="description">
            <div class="bottom-line-2">
                <h3 class="h3-position">Datum riješenog problema </h3>
                    <p class="opis-1">{{ $report->solved_at->format('d.m.Y') }}</p>
            </div> 
        </div>
        </div>
    </div>
</div>

@endif


@endsection
