<?php
session_start ();

require_once '../header_master.php';
?>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Update Driver</title>

<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/toastr.css">

<!-- Custom CSS -->
<link href="../css/freelancer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/BeatPicker.min.css">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700"
	rel="stylesheet" type="text/css">
<link
	href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic"
	rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
</head>
<body bgcolor="18BC9C">
	<!-- Header -->
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div>
						<form class="form-inline">
						
							<input class="form-control" id="start_place" type="text"
								placeholder="Start Place" style="width: 350px;"> 
							<input class="form-control"	id="end_place" type="text" 
								placeholder="End Place" style="width: 350px;">
					
						</form>
						<div id="directions-panel"></div>
						<div id="googleMap" style="height: 450px; width: 700px;"></div>
						
					</div>
				</div>
			</div>
		</div>

	<!-- Bootstrap JavaScript -->
	<script src="../js/bootstrap.min.js"></script>

	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script>
$("document").ready(function(){
	$.ajax({
		url: '../controller/get_avatar.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		$("#mini_avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);
        		
        		
            }
        	
        }
    
    });
})	
</script>
<script>
var map;
var start_marker;
var end_marker;
var start_infowindow;
var end_infowindow;
var stepDisplay = new google.maps.InfoWindow();
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var rendererOptions = {
		  draggable: true,
		  suppressMarkers : true
		  
		};
var start;
var end;
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
	      start = document.getElementById('start_place').value;
	      end = document.getElementById('end_place').value;
	      calcRoute();
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
	      start = document.getElementById('start_place').value;
	  	  end = document.getElementById('end_place').value;
	      calcRoute();

	      bounds.content(place.geometry.location);
	    }

	    map.fitBounds(bounds);
    
	  });
	  
	  
	  // Bias the SearchBox results towards places that are within the bounds of the
	  // current map's viewport.
	  
	// Center map
	start_marker = new google.maps.Marker({
		position : danang,	
		draggable : true,
		icon : '../icons/iconstart.png',
		title : "Start"
	});

	end_marker = new google.maps.Marker({
		position : danang,
		draggable : true,
		icon : '../icons/iconstop.png',
		title : "End"
	});

	start_marker.setMap(map);
	end_marker.setMap(map);

	google.maps.event.addListener(end_marker, "dragend", function() {
	      var position = end_marker.getPosition();
	      end = position;
	      calcRoute();
	      
	    });

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

function calcRoute() {

	// First, remove any existing markers from the map.
    for (i = 1; i < markerArray.length - 1; i++) {
      markerArray[i].setMap(null);
    }

    // Now, clear the array itself.
    markerArray = [];
	  
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
    
    for (var i = 0; i < myRoute.steps.length-1; i++) {
      var icon = "https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=" + i + "|FF0000|000000";
      if (i == 0) {

    	  start_marker.setPosition(myRoute.steps[0].start_point);
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

    end_marker.setPosition(myRoute.steps[i].end_point);
    
    markerArray.push(end_marker);
    
    google.maps.event.trigger(markerArray[0], "click");
  }

  function attachInstructionText(marker, text) {
    google.maps.event.addListener(marker, 'click', function() {
      // Open an info window when the marker is clicked on,
      // containing the text of the step.	
      stepDisplay.setContent(text);
      stepDisplay.open(map, marker);
    });
  }

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
