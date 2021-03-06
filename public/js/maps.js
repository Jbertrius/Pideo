/*
 * Learning Google Maps Geocoding by example
 * Miguel Marnoto
 * 2015 - en.marnoto.com
 *
 */

var map;
var marker;


function initialize() {

    var mapOptions = {
        center: new google.maps.LatLng(28.890554,-10.023368),
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

       // This event detects a click on the map.
    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.trigger(map, 'resize');
   google.maps.event.addListener(map, "click", function(event) {

      // Get lat lng coordinates.
      // This method returns the position of the click on the map.
      var lat = event.latLng.lat().toFixed(6);
      var lng = event.latLng.lng().toFixed(6);
      // Call createMarker() function to create a marker on the map.
      createMarker(lat, lng);
      // getCoords() function inserts lat and lng values into text boxes.
      getCoords(lat, lng);
   });

}

google.maps.event.addDomListener(window, 'load', initialize);

function searchAddress() {

    var addressInput = document.getElementById('city').value;

    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({address: addressInput}, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {

      var myResult = results[0].geometry.location;

      createMarker(myResult.lat(), myResult.lng());

          getCoords(myResult.lat(), myResult.lng());

      map.setCenter(myResult);

      map.setZoom(13);
        }
    });

}

// Function that creates the marker.
function createMarker(lat, lng) {

   // The purpose is to create a single marker, so
   // check if there is already a marker on the map.
   // With a new click on the map the previous
   // marker is removed and a new one is created.

   // If the marker variable contains a value
   if (marker) {
      // remove that marker from the map
      marker.setMap(null);
      // empty marker variable
      marker = "";
   }

   // Set marker variable with new location
   marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat, lng),
      draggable: true, // Set draggable option as true
      map: map
   });


   // This event detects the drag movement of the marker.
   // The event is fired when left button is released.
   google.maps.event.addListener(marker, 'dragend', function() {
      
      // Updates lat and lng position of the marker.
      marker.position = marker.getPosition();

      // Get lat and lng coordinates.
      var lat = marker.position.lat().toFixed(6);
      var lng = marker.position.lng().toFixed(6);

      // Update lat and lng values into text boxes.
      getCoords(lat, lng);

   });
}


// This function updates text boxes values.
function getCoords(lat, lng) {

   // Reference input html element with id="lat".
   var coords_lat = document.getElementById('lat');

   // Update latitude text box.
   coords_lat.value = lat;

   // Reference input html element with id="lng".
   var coords_lng = document.getElementById('lng');

   // Update longitude text box.
   coords_lng.value = lng;
}


 
