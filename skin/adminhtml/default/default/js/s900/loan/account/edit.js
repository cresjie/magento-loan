function initialize() {
  var markers = [];
  var map = new google.maps.Map(document.getElementById('google_map'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
  });

  /*
  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
	*/
  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('address'));
 // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.

  function setMapLocation(places){
  	if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),

      };

      // Create a marker for each place.

      
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        //position: place.geometry.location,
        position: new google.maps.LatLng(place.geometry.location.A,place.geometry.location.F)
      });

      markers.push(marker);
		
      bounds.extend(new google.maps.LatLng(place.geometry.location.A,place.geometry.location.F));
      
      
    }

    map.fitBounds(bounds);
    map.setZoom(15);
  }


  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    setMapLocation(places);
    
    document.getElementById('address_info').value = JSON.stringify(places);

  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });


  //if address_info has already a value
  var addressInfo = document.getElementById('address_info').value;

  //if(addressInfo)
  	setMapLocation( JSON.parse(addressInfo) );
  //console.log(JSON.parse(addressInfo));
}

if(google)
	google.maps.event.addDomListener(window, 'load', initialize);
else
	alert('Failed to load Google Map API');


var editForm = new varienForm('edit_form');

function formSubmit(){
	if(editForm.submit())
		$('loading-mask').show()
}

	