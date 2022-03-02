/* This example adds a search box to a map, using the Google Place Autocomplete
 * feature. People can enter geographical searches. The search box will return a
 * pick list containing a mix of places and predicted search terms.
 * This example requires the Places library. Include the libraries=places
 * parameter when you first load the API. For example:
 * <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
 */
let map;
let marker;
let geocoder;
let infoWind;
let inputAdd;
let inputUbi;
let inputLat;
let inputLng;

$('#ubigeo').editableSelect();
var other = $('#other_ubigeo').val();
if (other) $('#ubigeo').val(other);

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -11.9917, lng: -77.0706 },
    zoom: 16,
    mapTypeId: "roadmap",
    mapTypeControl: false,
  });
  marker = new google.maps.Marker({map});
  geocoder = new google.maps.Geocoder();
  infoWind = new google.maps.InfoWindow();
  inputAdd = document.getElementById("address");
  inputUbi = document.getElementById("ubigeo");
  inputLat = document.getElementById("lat");
  inputLng = document.getElementById("lng");

  const searchBox = new google.maps.places.SearchBox(inputAdd);

  map.addListener("click", (e) => {
    geocode({location: e.latLng}, true);
    drawCircle(e.latLng);
  });

  clearMap();
  if (inputAdd.value) 
    setMarket(inputLat.value, inputLng.value, inputAdd.value);
  else
    geolocalizacion();

  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  let markers = [];

  // Listen for the event fired when the user selects a prediction and retrieve more details for that place.
  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();

    if (places.length == 0) return;

    // Clear out the old markers.
    markers.forEach((marker) => {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();

    places.forEach((place) => {
      if (!place.geometry || !place.geometry.location) {
        console.log("El resultado encontrado no tiene geometría.");
        return;
      }
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    geocode({address: inputAdd.value}, false)
    map.fitBounds(bounds);
  });
}

function geolocalizacion() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWind, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWind, map.getCenter());
  }
}

function clearMap() {
  marker.setMap(null);
}

function geocode(request, click) {
  clearMap();
  geocoder
    .geocode(request)
    .then((result) => {
      const { results } = result;
      map.setCenter(results[0].geometry.location);
      marker.setPosition(results[0].geometry.location);
      marker.setMap(map);
      infoWind.setContent(results[0].formatted_address);
      infoWind.open(map, marker);
      if (click) inputAdd.value = results[0].formatted_address;
      var dist = getName(results[0].address_components,'locality');
      var prov = getName(results[0].address_components,'administrative_area_level_2');
      var depa = getName(results[0].address_components,'administrative_area_level_1');
      inputUbi.value = depa + ' / ' + prov + ' / ' + dist;
      var coord = results[0].geometry.location.toJSON();
      inputLat.value = coord.lat;
      inputLng.value = coord.lng;
      return results;
    })
    .catch((e) => {
      inputUbi.value = inputLat.value = inputLng.value = '';
      alert("El servicio de geocodificación no pudo realizarse debido a la siguiente razón: " + e);
    });
}

function getName(comp, type) {
  var filtered_array = comp.filter(function(address_component){
    return address_component.types.includes(type);
  });
  return filtered_array.length ? 
    filtered_array[0].long_name.replace('Distrito de ', '').replace('Provincia de ', '').replace('Provincia de ', '')
    : '';
}

function handleLocationError(browserHasGeolocation, infoWind, pos) {
  infoWind.setPosition(pos);
  infoWind.setContent(
    browserHasGeolocation
      ? "Error: Lo sentimos, el servicio de geolocalización ha fallado."
      : "Error: Tu buscador web no soporta la geolocalización."
  );
  infoWind.open(map);
}

function setMarket(lat, lng, address) {
  const pos = {lat:intVal(lat), lng:intVal(lng)};
  map.setCenter(pos);
  marker.setPosition(pos);
  marker.setMap(map);
  infoWind.setContent(address);
  infoWind.open(map, marker);
  drawCircle(pos);
}

function drawCircle(pos) {
  const cityCircle = new google.maps.Circle({
    strokeColor: "#FF0000",
    strokeOpacity: 0.5,
    strokeWeight: 1,
    fillColor: "#FF0000",
    fillOpacity: 0.05,
    map,
    center: pos,
    radius: 6000,
  });

  const cityCircleN = new google.maps.Circle({
    strokeColor: "#FF0000",
    strokeOpacity: 0.5,
    strokeWeight: 1,
    fillColor: "#FF0000",
    fillOpacity: 0,
    map,
    center: pos,
    radius: 4000,
  });
}