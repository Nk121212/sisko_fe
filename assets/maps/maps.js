let map;
let markers = [];
var geocoder;

function initMap() {
  geocoder = new google.maps.Geocoder();
  const haightAshbury = { lat: 37.769, lng: -122.446 };
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: haightAshbury,
    mapTypeId: "roadmap",
  });

  codeAddress( $('#kota').val());
  // grabMyPosition();
  
  // This event listener will call addMarker() when the map is clicked.
  map.addListener("click", (event) => {
    deleteMarkers();
    addMarker(event.latLng);
    setInput(event.latLng.toJSON());
  });

  // Adds a marker at the center of the map.
  // addMarker(haightAshbury);
}

function grabMyPosition() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(centerMe);
  } else {
      alert("You don't support this");
  }
}
function centerMe(position) {
  var coords = new google.maps.LatLng(
      position.coords.latitude,
      position.coords.longitude
  );

  map.setCenter(coords);
  // or
  map.panTo(coords);
}
function codeAddress(address) {
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == 'OK') {
      map.setCenter(results[0].geometry.location);
      // var marker = new google.maps.Marker({
      //     map: map,
      //     position: results[0].geometry.location
      // });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
function setInput(longLat) {
  console.log(longLat);
  // alert(longLat.lat);
  $('#long').val(longLat.lng);
  $('#lat').val(longLat.lat);
}
// Adds a marker to the map and push to the array.
function addMarker(location) {
  const marker = new google.maps.Marker({
    position: location,
    map: map,
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}