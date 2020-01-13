@extends('layouts.app')
@section('content')


<span class="moje-prijave"><h1>Moje prijave</h1></span>
<div class="section-3">
<div id="map" style="display: block; min-height: 380px; border-radius: 5px;"  class="map_reports">
</div>
<script>

    var markers = {!! json_encode($reports) !!};
    var map;
    var prevIW = null;
    function initMap() {
        // Map options
        var options = {
            zoom: 10,
            center: {lat: 45.3271, lng: 14.4422},
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

        // New map
        map = new google.maps.Map(document.getElementById('map'), options);


        for (var i = 0; i < markers.length; i++) {
            markers[i] = addMarker(markers[i]);
        }


    }

    function addMarker(marker){

        var id = marker.id;
        var address = marker.address;
        var description = marker.description;
        var reported_at =  marker.reported_at;
        var image = marker.image_user;
        var solved = marker.solved_at;

        if(solved == null){
            var color = "/storage/img/red_marker.svg"
        } else {
            var color = "/storage/img/green_marker.svg"

        }




        var html =  "<b>" + id + "</b></br> Prijavljeno: " + reported_at + "</br><img src='storage/images/" + image + "' alt='image in infowindow'>" ;


        var web= "<div class='card-5' ><h2>Prijava br. " + id
           + "</h2></div><div class='card-4'><div class='table-2'><div class='table-cell-3'><h3 class='h3-mini'>Slika prijavljenog problema</h3><img class='prijavljena-slika-1' src='storage/images/" +
           image + "' alt=''></div><div class='table-cell-3'><div class='bottom-line-2'><h3 class='h3-mini'>Opis problema </h3><p class='opis-2'>" +
           description + "</p></div><div class='bottom-line-2'><h3 class='h3-mini'>Adresa </h3><p class='opis-2'>" +
           address + "</p></div><div class='bottom-line-2'><h3 class='h3-mini'>Datum prijave problema </h3><p class='opis-2'>" +
           reported_at + "</p></div></div>";








        var markerLatlng = new google.maps.LatLng(parseFloat(marker.latitude),parseFloat(marker.longitude));

        var mark = new google.maps.Marker({
            map: map,
            position: markerLatlng,
            icon: color


        });



        var infoWindow = new google.maps.InfoWindow({ maxHeight: 320 });

        google.maps.event.addListener(mark, 'click', function(){

            if(prevIW){
                prevIW.close();
                infoWindow.setContent(web);
                infoWindow.open(map, mark);
                prevIW = infoWindow;
            }
            infoWindow.setContent(web);
            infoWindow.open(map, mark);
            prevIW = infoWindow;
        });
        google.maps.event.addListener(map, "click", function() {
            infoWindow.close();
        });


        return mark;

    }

</script>
</div>
@foreach($reports as $report)

<div class="section">
    <div class="card" >
        <h2>Prijava br. {{ $report->id }} </h2>
    </div>
<div class="card-1">
    <div class="table-2">
        <div class="table-cell-2">
            <h3>Slika prijavljenog problema</h3>
            <img class="prijavljena-slika" src="{{ asset('storage/images/' . $report->image_user) }}" alt="">
        </div>
        <div class="table-cell-2 druga">
            <div class="bottom-line">
                <h3>Opis problema:</h3>
                    <p class="opis"> {{ $report->description }} </p>
            </div>
            <div class="bottom-line">
                <h3>Adresa: </h3>
                    <p class="opis"> {{ $report->address }} </p>
            </div>
            <div class="bottom-line">
                <h3>Datum prijave problema: </h3>
                    <p class="opis">{{ $report->reported_at->format('d.m.Y') }}</p>
            </div>
            <div class="bottom-line"> 
                <h3>Status prijave </h3>
                
                    <p class="opis">@if ($report->solved_at != null)
                                        Riješeno
                                    @else
                                        U procesu rješavanja
                                    @endif
                    </p> 
            </div>
        </div>
    </div>
        
        <div class="opširnije">
            <a href="/reports/{{$report->id}}"><button class="stvori-racun button-opsirnije" type="button">Saznaj više</button></a>
        </div>
        
   
</div>
</div>

@endforeach

  




@endsection
