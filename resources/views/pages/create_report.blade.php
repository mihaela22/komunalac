@extends('layouts.app')
@section('content')

<script>

         var geocoder;
         var map;
         var marker;



                                function initMap() {


                                    var options = {
                                        zoom: 11,
                                        center: {lat: 45.3271, lng: 14.4422},
                                        fullscreenControl: false,
                                        streetViewControl: false,
                                        zoomControl: true,
                                        zoomControlOptions: {
                                            style: google.maps.ZoomControlStyle.SMALL,
                                            position: google.maps.ControlPosition.LEFT_CENTER
                                        },
                                        styles: [{
                                            featureType: "poi",
                                            elementType: "labels",
                                            stylers: [{
                                                visibility: "off"
                                            }]
                                        }]

                                    }
                                    map = new google.maps.Map(document.getElementById('map'), options);

                                    // Try HTML5 geolocation.
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function(position) {
                                            var pos = {
                                                lat: position.coords.latitude,
                                                lng: position.coords.longitude
                                            };

                                            placeMarker(pos);
                                            map.setCenter(pos);
                                        }, function() {
                                            handleLocationError(true, infoWindow, map.getCenter());
                                        });
                                    } else {
                                        // Browser doesn't support Geolocation
                                        handleLocationError(false, infoWindow, map.getCenter());
                                    }


                                    document.getElementById('submit').addEventListener('click', function() {
                                        codeAddress(geocoder, map);
                                    });

                                    google.maps.event.addDomListener(window, 'load', initAutocomplete);


                                    map.addListener('click', function(event) {
                                        setMarker(event.latLng);
                                });
                                }

                                function codeAddress(geocoder){
                                    var address = document.getElementById('address').value;
                                    geocoder = new google.maps.Geocoder();


                                    geocoder.geocode( {'address':address}, function(results, status) {
                                        if (status == 'OK') {
                                            map.setCenter(results[0].geometry.location);
                                            placeMarker(results[0].geometry.location);

                                            $("#latitude").val(results[0].geometry.location.lat());
                                            $("#longitude").val(results[0].geometry.location.lng());

                                        }else {
                                            alert('Nije uspijelo zbog:' + status);
                                        }
                                    });

                                }

                                function placeMarker(location) {
                                    if (marker && marker.setPosition) {
                                        marker.setPosition(location);
                                    } else {
                                        marker = new google.maps.Marker({
                                            position: location,
                                            map: map,
                                            icon: "/storage/img/red_marker.svg"
                                        });
                                    }
                                }


                                function setMarker(location) {
                                    placeMarker(location);
                                    geocoder = new google.maps.Geocoder();
                                    geocoder.geocode({'location': location}, function(results, status) {
                                        if (status === 'OK') {

                                            $("#address").val(results[0].formatted_address);

                                        } else {
                                            window.alert('Geocoder failed due to: ' + status);
                                        }
                                    });



                                    $("#latitude").val(location.lat());
                                    $("#longitude").val(location.lng());

                                }

                                function initAutocomplete() {
                                    var input = document.getElementById('address');
                                    var options = {
                                        componentRestrictions: {country: 'hr'},

                                    };

                                    new google.maps.places.Autocomplete(input, options);

                                }

</script>

    <form id="regForm"  action="{{url('store_report')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Prijavi problem</h1>
        
            <div class="tab input-group">
                
                <input placeholder="Opis problema" oninput="this.className = ''" type="text" class="text_field @error('description') is-invalid @enderror" id="description" name="description" autocomplete="name" required autofocus>
                    <span class="bar"></span>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <div style="float:right; ">
                        <button type="button"  class="stvori-racun-2" onclick="nextPrev(1)">Dalje</button>
                        </div> 
                            
            </div>
        
            <div class="tab input-group">
            
                <div id="map" style="display: block; width:100%;"></div>
                
                   <i><button id="submit" type="button" name="geokd" class="stvori-racun-3"><i class="fas fa-map-marker-alt"></i></button></i>
                    <input placeholder="Adresa" oninput="this.className = ''" type="text" class="text_field @error('address') is-invalid @enderror" id="address" name="address" autocomplete="off" required>
                     
                        <span class="bar"></span>

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                            <div style="float:right;">
                              <button type="button"  class="stvori-racun-2" onclick="nextPrev(-1)">Natrag</button>
                              <button type="button"  class="stvori-racun-2" onclick="nextPrev(1)">Dalje</button>
                            </div>
                            
                                   
                                   
            </div>
             <input placeholder="Latitude" oninput="this.className = ''" type="hidden" class="text_field @error('latitude') is-invalid @enderror" id="latitude" name="latitude"  autocomplete="latitude" >

             <input placeholder="Longitude" oninput="this.className = ''" type="hidden" class="text_field @error('longitude') is-invalid @enderror" id="longitude" name="longitude"  autocomplete="longitude"  >
           

          
                                   
            
            <div class="tab input-group">
              <input placeholder="Fotografija" oninput="this.className = ''" type="file" name="image_user" id="image_user" class="text_field" required>
                <span class="bar"></span> 
                  
                  <div style="float:right;">
                    <button type="button"  class="stvori-racun-2" onclick="nextPrev(-1)">Natrag</button>
                    <button type="submit"  class="stvori-racun-2" >Pošalji</button>
                  </div>                       
                  
            </div>            
            <!--<div style="overflow:auto;">-->
            
                                <!-- Circles which indicates the steps of the form: -->
                              
            <div style="text-align:center;margin-top:100px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
            
    </form>



<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n);
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>


@endsection
