@extends('layouts.admin')
@section('content')

    <div class="container d-flex align-self-center">
        <div class="container report_container row align-self-center">
            <div class="shadow report_id col-7 col-md-3 p-2 d-flex justify-content-center mx-4">
                <h3>Id prijave: {{$report_data->id}}</h3>
                <br>
            </div>
            <div class="shadow col-11 row report_wraper m-4 align-self-center p-0">
                <div class="report_left col-lg-6 my-2">

                    <div class="opis_problema mt-2 mx-3">
                        <h4 class="p-3">Opis problema:</h4>
                        <p class="pl-3">{{$report_data->description}}</p>
                        <hr>
                        <h4 class="pl-3 pb-3 mb-0">Adresa: </h4>
                        <p class="pl-3 pb-3">{{$report_data->address}}</p>
                        <hr>
                        <h4 class="pl-3 pb-3 mb-0">Id korisnika: </h4>
                        @foreach($user_data as $user)
                            <p class="pl-3">{{$user->id}}</p>
                        @endforeach

                    </div>

                </div>
                <div class="col-lg-6 report_right row justify-content-center align-items-center m-0 my-2">

                    <div class="slika_problema mt-2 col-12 mx-3 row ">
                        @if ($report_data->image_user !== NULL)
                            <div class="col-12 px-0">
                                <img class="img-fluid" src="{{ asset('storage/images/' . $report_data->image_user) }}" alt="">
                            </div>
                        @else
                            <div  id="map" style="width: 300px; height: 300px" class="col-12"></div>
                        @endif
                    </div>


                </div>
                <!--                ----------------------- form ---------------------------                -->

                <div class="col-12 p-3 row justify-content-center">
                    <a class="btn btn-green col-8 m-2" role="button" data-toggle="collapse" href="#completed_form" data-target="#completed_form" aria-expanded="false" aria-controls="completed_form">Dodaj opis rješenja <br> <i class="fas fa-chevron-down"></i></a>
                </div>
                <div class=" container-fluid p-0 m-0 row panel-collapse collapse" id="completed_form">
                    <!--start -->
                    <form method="POST" action="{{ url('/admin/report/finish/'.$report_data->id) }}" enctype="multipart/form-data" class="col-12 row m-0 p-3">
                        @csrf
                        <div class="form-group row col-lg-6 p-2 m-0 justify-content-center">
                            <!--<label class="col-md-4 col-form-label text-md-right" for="image_solved">Fotografija</label> -->
                            <!-- photo       -->
                            <div class="form-group row col-8 d-flex justify-content-center">
                                <div id="takePhoto" class="col-12 px-0" style="background-color: #d1cabe;" >

                                    <input type="file" name="image_solved" id="image_solved" hidden="" onchange="loadFile(event)" />
                                    <label for="image_solved" class="">
                                        <img src="{{ asset('storage/img/photo.png') }}" id="img" class="img-fluid" alt="">
                                    </label>
                                </div>
                                <br/>
                            </div>
                        </div>
                        <div class="form-group row col-lg-6 p-2 m-0 justify-content-center">
                            <label for="solved_description" class="col-md-4 col-form-label text-md-right d-none">{{ __('Opis rjesenja') }}</label>

                            <div class="col-md-12">
                                <textarea id="solved_description" type="text" placeholder="Opis rješenja..." rows="5" cols="5" class="form-control py-2 @error('solved_description') is-invalid @enderror" name="solved_description" required autocomplete="solved_description"></textarea>

                                @error('solved_description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group py-2">
                                    <label for="exampleFormControlSelect1"></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                                        @foreach($categories as $category)

                                            <option class="odabir_kategorije" value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group py-2">
                                    <button type="submit" class="btn btn-green">
                                        <span><i class="fas fa-check-circle "></i>&nbsp{{ __('Potvrdi') }}</span>
                                    </button>
                                </div>



                            </div>
                        </div>

                    </form>
                </div>
                <!-- kraj -->

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
            var styledMapType = new google.maps.StyledMapType(
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
                ], {name: 'Retro'})


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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKgLk6pYKfaL8H7UcKP7lfKoGeqyWgPzM&callback=initMap"></script>

    <script>
        var loadFile = function(event) {
            var img = document.getElementById('img');
            img.src = URL.createObjectURL(event.target.files[0]);
        };

        /*
        function collapseF() {
            if (document.getElementById('completed_form')) {

                if (document.getElementById('completed_form').class == 'container-fluid p-0 m-0 row collapse show') {
                    console.log('aaa');
                    document.getElementById('completed_form').class = 'container-fluid p-0 m-0 row collapse hide';

                }
                else {
                    console.log('bbb');
                    document.getElementById('completed_form').class = 'container-fluid p-0 m-0 row collapse show';

                }
            }
        }*/



    </script>

@endsection