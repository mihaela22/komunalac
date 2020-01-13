@extends('layouts.admin')
@section('content')
<!-- --------------------------------------------------------------- B A N    U S E R ----------------------------------------->
    <div id="banUser" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <form method="post" action="" id="editForm">
                @csrf
                @method('GET')
                    <div class="modal-header">
                        <h4 class="modal-title">Blokiranje korisnika &nbsp;<i class="fas fa-exclamation-circle fa-1x"></i></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Jeste li sigurni da želite blokirati korisnika?</p>
                        <p>Id: <span id="userId_show"></span>&nbsp;&nbsp;&nbsp;&nbsp;Email: <span id="userEmail_show"></span></p>
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" value="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-delete" value="Ban">
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- --------------------------------------------------------------- B A N    U S E R ----------------------------------------->



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
<div class="container d-flex align-self-center">
    <div class="container report_container row align-self-center">
        <div class="shadow report_id col-7 col-md-3 p-2 d-flex justify-content-center mx-4">
            <h3>Id prijave: {{$report_data->id}}</h3>
            <br>
        </div>
        <div class="shadow col-11 row report_wraper m-4 align-self-center p-0">
        <div class="report_left col-lg-6 my-2">

            <div id="divOpisProblema" class="opis_problema mt-2 mx-3">
                <h4 class="p-3">Opis problema:</h4>
                <p class="pl-3">{{$report_data->description}}</p>
                <hr>
                <h4 class="pl-3 pb-3 mb-0">Adresa: </h4>
                <p class="pl-3 pb-3">{{$report_data->address}}</p>
                <hr>
                <div class="actions p-3 row justify-content-center">
                    @if ($report_data->user->ban === 2)
                        <P>Prijava blokiranog korisnika</P>
                    @else
                    @if ($report_data->solved_at === NULL)

                        <a class="btn btn-green col-sm-8 col-md-4 m-2" href="{{url('/admin/report/processed/'. $report_data->id)}}">Proslijedi</a>
                        <a href="#banUser" class="btn btn-red col-sm-8 col-md-4 m-2" data-email="{{$report_data->user->email}}" data-userid="{{$report_data->user->id}}" data-toggle="modal">Blokiraj korisnika</a>

                        @else

                        <a class="btn btn-green col-sm-8 col-md-6 m-2" style="color: white" onclick="switchVisible()">Rješenje problema</a>
                    @endif
                        @endif
                </div>
            </div>

            <div id="divRjesenjeProblema" class="opis_problema mt-2 mx-3">
                <h4 class="p-3">Opis rješenja:</h4>
                <p class="pl-3">{{$report_data->solved_description}}</p>
                <hr>
                @if(!empty($report_data->category))
                <h4 class="pl-3 pb-3 mb-0">Kategorija problema: </h4>
                <p class="pl-3 pb-3">{{$report_data->category->name}}</p>
                <hr>
                @endif
                <h4 class="pl-3 pb-3 mb-0">Datum rješenja: </h4>
                <p class="pl-3 pb-3">{{$report_data->solved_at}}</p>
                <hr>
                <div class="actions p-3 row justify-content-center">
                    <a class="btn btn-green col-sm-8 col-md-6 m-2" style="color: white" onclick="switchVisible()">Natrag</a>
                </div>
            </div>

        </div>
        <div class="col-lg-6 report_right row justify-content-center align-items-center m-0 my-2">

                <div class="slika_problema mt-2 col-12 mx-3 row ">
                    @if ($report_data->image_user !== NULL)
                        <div class="col-12 px-0">
                            <img class="img-fluid" id="slikaProblema" src="{{ asset('storage/images/' . $report_data->image_user) }}" alt="">
                        </div>
                    @else
                        <div  id="map" style="width: 300px; height: 300px" class="col-12"></div>
                    @endif
                </div>


        </div>
            @if ($report_data->image_user !== NULL)
            <div  id="map" style="width: 300px; height: 300px" class="col-12"></div>
            @endif
        </div>




    </div>



    </div>
        <script>

            function initMap() {
                var lat = {{$report_data->latitude}};
                var lng = {{$report_data->longitude}};
                var myLatLng = {lat, lng};


                var styledMapType  = new google.maps.StyledMapType (
                    [
                        {
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ebe3cd"
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#523735"
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "color": "#f5f1e6"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#c9b2a6"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#dcd2be"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#ae9e90"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dfd2ae"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dfd2ae"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#93817c"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#a5b076"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#447530"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f1e6"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#fdfcf8"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f8c967"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#e9bc62"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e98d58"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#db8555"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#806b63"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dfd2ae"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#8f7d77"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "color": "#ebe3cd"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dfd2ae"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#b9d3c2"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#92998d"
                                }
                            ]
                        }
                    ],{name: 'Retro'})



                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13,
                    center: myLatLng,
                    streetViewControl: false,
                    mapTypeControlOptions: {
                        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                            'styled_map']
                    }
                });
                map.mapTypes.set('styled_map', styledMapType);
                map.setMapTypeId('styled_map');
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: '{{$report_data->address}}'
                });
            }
        </script>
        <script src="{{ asset('js/google_maps.js') }}" defer></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKgLk6pYKfaL8H7UcKP7lfKoGeqyWgPzM&callback=initMap">
        </script>
<script>
$(function(){
$(document).on('show.bs.modal', '#banUser', function (event) {
var button = $(event.relatedTarget);
var userId = button.data('userid');
var userEmail = button.data('email');
var modal = $(this);

modal.find('.modal-body #user_id').val(userId);
    modal.find('.modal-body #userId_show').text(userId);
    modal.find('.modal-body #userEmail_show').text(userEmail);
    modal.find('.modal-content #editForm').attr('action',"http://127.0.0.1/admin/ban_user/"+ userId+"/");
})
});


function switchVisible() {
    if (document.getElementById('divRjesenjeProblema')) {

        if (document.getElementById('divRjesenjeProblema').style.display == 'none') {
            document.getElementById('divOpisProblema').style.display = 'none';
            document.getElementById('divRjesenjeProblema').style.display = 'block';
            document.getElementById('slikaProblema').src="{{ asset('storage/images/' . $report_data->image_solved) }}";

        }
        else {
            document.getElementById('divRjesenjeProblema').style.display = 'none';
            document.getElementById('divOpisProblema').style.display = 'block';
            document.getElementById('slikaProblema').src="{{ asset('storage/images/' . $report_data->image_user) }}";

        }
    }
}
</script>

        

</body>
@endsection