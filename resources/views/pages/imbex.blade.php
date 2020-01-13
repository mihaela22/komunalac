@extends('layouts.app')
@section('content')


    <span class="moje-prijave"><h1>Prijave</h1></span>
    <div class="cotainer" style="width: 100%; ">
        <div style="position: relative">
        <div id="map" style="display: block; min-height: 636px">
        </div>
            <div style="position: absolute; top: 15px; left: 180px; z-index: 99;"><img src="/storage/img/red_marker.svg" class="toggle1"  style="height: 40px;" id="unsolved" alt="" title="U procesu">
                <img src="/storage/img/green_marker.svg" class="toggle" style="height: 40px;"  id="solved" alt="" title="Riješeni">
        </div>
        <script>

            var unsolved = {!! json_encode($reportsProcessed) !!};
            var solved = {!! json_encode($reportsSolved) !!};
            var markersSolved = [];
            var markersUnsolved = [];
            var map;
            var prevIW = null;

            function initMap() {
                // Map options
                var options = {
                    zoom: 10,
                    center: {lat: 45.3271, lng: 14.4422},
                    fullscreenControl: false,
                    streetViewControl: false
                }

                // New map
                map = new google.maps.Map(document.getElementById('map'), options);

                addAll(unsolved, markersUnsolved);
                addAll(solved, markersSolved);


                document.getElementById('unsolved').addEventListener('click', function() {
                    setMarkersVisible(markersUnsolved);
                });
                document.getElementById('solved').addEventListener('click', function() {
                    setMarkersVisible(markersSolved);
                });

            }

            function setMarkersVisible(markers) {
                if(prevIW){
                    prevIW.close();
                }
                for (var i = 0; i < markers.length; i++) {
                    if  (markers[i].getVisible(true)) {
                        markers[i].setVisible(false);
                    }else{
                        markers[i].setVisible(true);
                    }
                }
            }

            function addAll(markers, array) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i] = addMarkerAll(markers[i], array);
                }
            }

            function addMarkerAll(marker, array){

                var id = marker.id;
                var address = marker.address;
                var description = marker.description;
                var reported_at =  marker.reported_at;
                var image = marker.image_user;
                var solved = marker.solved_at;

                if(solved == null){
                    var color = "/storage/img/red_marker.svg";
                } else {
                    var color = "/storage/img/green_marker.svg";

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

                array.push(mark);
                return mark;

            }

            $(document).ready(function() {
                $( "#solved" ).click( function() {
                    $("#solved").toggleClass('flip');
                });
            });

            $(document).ready(function() {
                $( "#unsolved" ).click( function() {
                    $("#unsolved").toggleClass('flip1');
                });
            });

        </script>
    </div>







@endsection
