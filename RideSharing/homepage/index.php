<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ride Sharing</title>

<!-- Bootstrap CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- jQuery -->
<script src="http://code.jquery.com/jquery-1.11.2.js"></script>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- GoogleMap JavaScript -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div id="carousel-example-generic" class="carousel slide"
					data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0"
							class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="#" alt="Photo 1">
							<div class="carousel-caption">Photo 1</div>
						</div>
						<div class="item">
							<img src="#" alt="Photo 2">
							<div class="carousel-caption">Photo 2</div>
						</div>
						<div class="item">
							<img src="#" alt="Photo 3">
							<div class="carousel-caption">Photo 3</div>
						</div>
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic"
						role="button" data-slide="prev"> <span
						class="glyphicon glyphicon-chevron-left"></span>
					</a> <a class="right carousel-control"
						href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#">Home</a></li>
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Mode <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="">Driver</a></li>
					<li><a href="">Rider</a></li>
				</ul></li>
			<li><a href="../manageaccount">Manage Account</a></li>
			<li><a href="#">Manage Itineraries</a></li>
			<li><a href="#">Manage Schedule</a></li>
			<li><a href="#">Analyze Statistically</a></li>
			<div>
				<input type="button" class="btn btn-primary" name="logout"
					id="logout" value="Sign out">
			</div>
		</ul>

		<div class="row">
			<br> <input class="col-md-5" id="start_place" class="controls"
				type="text" placeholder="Start Place" onchange="calcRoute();"> <br>
			<input class="col-md-5" id="end_place" class="controls" type="text"
				placeholder="End Place" onchange="calcRoute();">
			<div id="googleMap" style="width: 590px; height: 380px;"
				class="col-md-offset-1"></div>
			<div id="directions-panel"></div>
		</div>
	</div>
	<script>
$("document").ready(function(){
	
	$("#logout").click(function(){

		window.location.assign("../controller/logout.php");
		
		});
	
});
</script>
	<script>
var map;
var start_marker;
var end_marker;
var start_infowindow;
var end_infowindow;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var rendererOptions = {
		  draggable: true,
		  suppressMarkers : true
		  
		};
var  markerArray = [];
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);

function initialize() {

	var markers = [];

	directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

	directionsService = new google.maps.DirectionsService();
	
	map = new google.maps.Map(document.getElementById('googleMap'), {
	    mapTypeId : google.maps.MapTypeId.ROADMAP,
	    center : danang,
	    zoom : 13
	});

	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById('directions-panel'));

	  // Create the search box and link it to the UI element.
	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('start_place'));
	  map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('end_place'));
	  
	  var startsearchBox = new google.maps.places.SearchBox(
	    /** @type {HTMLInputElement} */(document.getElementById('start_place')));
	  var endsearchBox = new google.maps.places.SearchBox(
			    /** @type {HTMLInputElement} */(document.getElementById('end_place')));

	  // [START region_getplaces]
	  // Listen for the event fired when the user selects an item from the
	  // pick list. Retrieve the matching places for that item.
	  google.maps.event.addListener(startsearchBox, 'places_changed', function() {
	    var places = startsearchBox.getPlaces();

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
	        size: new google.maps.Size(51, 51),
	        origin: new google.maps.Point(0, 0),
	        anchor: new google.maps.Point(17, 34),
	        scaledSize: new google.maps.Size(25, 25)
	      };

	      // Create a marker for each place.
	      start_marker.setPosition(place.geometry.location);

	      bounds.content(place.geometry.location);
	    }

	    map.fitBounds(bounds);
	  });
	  // [END region_getplaces]

	  google.maps.event.addListener(endsearchBox, 'places_changed', function() {
	    var places = endsearchBox.getPlaces();

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
	        size: new google.maps.Size(51, 51),
	        origin: new google.maps.Point(0, 0),
	        anchor: new google.maps.Point(17, 34),
	        scaledSize: new google.maps.Size(25, 25)
	      };

	      // Create a marker for each place.
	      end_marker.setPosition(place.geometry.location);

	      bounds.content(place.geometry.location);
	    }

	    map.fitBounds(bounds);
	  });
	  
	  
	  // Bias the SearchBox results towards places that are within the bounds of the
	  // current map's viewport.
	  
	
	// infowindow
	start_infowindow = new google.maps.InfoWindow({
		content : "Start"
	});

	end_infowindow = new google.maps.InfoWindow({
		content : "End"
	});

	// Center map
	start_marker = new google.maps.Marker({
		position : danang,
		draggable : true,
		icon : '../icons/icon-start-marker.png',
		title : "Start"
	});

	end_marker = new google.maps.Marker({
		position : danang,
		draggable : true,
		icon : '../icons/icon-end-marker.png',
		title : "End"
	});

	start_infowindow.open(map, start_marker);
	end_infowindow.open(map, end_marker);

	// The placeMarker() function places a marker where the user has clicked,
	// and shows an infowindow with the latitudes and longitudes of the marker:
// 	google.maps.event.addListener(map, 'click', function(event) {

// 		placeMarker(event.latLng);

// 	});

	start_marker.setMap(map);
	end_marker.setMap(map);

	google.maps.event.addListener(start_marker, "position_changed", function() {
		calcRoute();
	});

	google.maps.event.addListener(end_marker, "position_changed", function() {
		calcRoute();
	});

// 	google.maps.event.addListener(start_marker, 'click', function() {
// 	// infowindow.open(map, marker);
// 	// Zoom to 9 when clicking on marker

// 	});

	/*
	 * google.maps.event.addListener(map,'center_changed',function() { // 3
	 * seconds after the center of the map has changed, pan back to the marker
	 * window.setTimeout(function() { map.panTo(marker.getPosition()); },3000);
	 * });
	 */
}

function placeMarker(location) {
	
	start_marker.setPosition(location);
	
	var infowindow = new google.maps.InfoWindow({
		content : 'Latitude: ' + location.lat() + '<br>Longitude: '
				+ location.lng()
	});

}

// Add a Home control that returns the user to London
function HomeControl(controlDiv, map) {
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.backgroundColor = 'yellow';
	controlUI.style.border = '1px solid';
	controlUI.style.cursor = 'pointer';
	controlUI.style.textAlign = 'center';
	controlUI.title = 'Set map to London';
	controlDiv.appendChild(controlUI);
	var controlText = document.createElement('div');
	controlText.style.fontFamily = 'Arial,sans-serif';
	controlText.style.fontSize = '12px';
	controlText.style.paddingLeft = '4px';
	controlText.style.paddingRight = '4px';
	controlText.innerHTML = '<b>Home<b>'
	controlUI.appendChild(controlText);

	// Setup click-event listener: simply set the map to London
	google.maps.event.addDomListener(controlUI, 'click', function() {
		map.setCenter(danang)
	});
}

function calcRoute() {

	// First, remove any existing markers from the map.
    for (i = 0; i < markerArray.length; i++) {
      markerArray[i].setMap(null);
    }

    // Now, clear the array itself.
    markerArray = [];
    
	  var start = document.getElementById('start_place').value;
	  var end = document.getElementById('end_place').value;
	  var request = {
	    origin: start,
	    destination: end,
	    travelMode: google.maps.TravelMode.DRIVING
	  };
	  
	  directionsService.route(request, function(response, status) {
	    if (status == google.maps.DirectionsStatus.OK) {
	      directionsDisplay.setDirections(response);
	      showSteps(response);
	    }
	  });
}

function showSteps(directionResult) {
    // For each step, place a marker, and add the text to the marker's
    // info window. Also attach the marker to an array so we
    // can keep track of it and remove it when calculating new
    // routes.
    var myRoute = directionResult.routes[0].legs[0];
    
    for (var i = 0; i < myRoute.steps.length; i++) {
      var icon = "https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=" + i + "|FF0000|000000";
      if (i == 0) {

    	  attachInstructionText(start_marker, myRoute.steps[i].instructions);
    	  markerArray.push(start_marker);
          
      }else {

    	  var marker = new google.maps.Marker({
    	        position: myRoute.steps[i].start_point, 
    	        map: map,
    	        icon: icon
    	  });
    	  
    	  attachInstructionText(marker, myRoute.steps[i].instructions);

    	  markerArray.push(marker);

      }
      
    }
    
    markerArray.push(end_marker);
    
    google.maps.event.trigger(markerArray[0], "click");
  }

  function attachInstructionText(marker, text) {
    google.maps.event.addListener(marker, 'click', function() {
      // Open an info window when the marker is clicked on,
      // containing the text of the step.
      stepDisplay.setContent(text);
      stepDisplay.open(mapCanvas, marker);
    });
  }

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
</html>