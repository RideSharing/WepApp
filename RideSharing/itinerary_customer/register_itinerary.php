<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>

<title>Register Itinerary</title>

<body>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-13">
					<form>
						<fieldset>
							<legend style="text-align: center;">
								<b>Register Itinerary</b>
							</legend>
							<div class="col-lg-5">
								<div class="form-group">
									<input class="form-control" id="start_place" type="text"
										placeholder="Start Place"> <input id="start_place_lat"
										type="text" style="display: none;"> <input
										id="start_place_lng" type="text" style="display: none;">
								</div>
								<div class="form-group">
									<input class="form-control" id="end_place" type="text"
										placeholder="End Place"> <input id="end_place_lat" type="text"
										style="display: none;"> <input id="end_place_lng" type="text"
										style="display: none;">
								</div>
								<div class="form-group">
									<input class="form-control" id="leave_date" type="text"
										placeholder="Date Begin">
								</div>
								<div class="form-group">
									<textarea class="form-control" id="description"
										placeholder="Description" style="resize: none;"></textarea>
								</div>
								<div class="form-group">
									<input class="form-control" id="distance" type="text"
										placeholder="Distance">
								</div>
								<div class="form-group">
									<input class="form-control" id="duration" type="text"
										placeholder="Duration">
								</div>
								<div class="form-group">
									<input class="form-control" id="cost" type="text"
										placeholder="Cost">
								</div>
								<div class="form-group">
									<input class="btn btn-primary btn-block" type="button"
										name="register_itinerary" id="register_iti" value="Register">
								</div>
							</div>
							<div id="googleMap" style="height: 485px; width: 680px;"></div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</header>	
	<?php
	require_once '../footer_master.php';
	?>
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

	$("#register_iti").click(function(){

		var form_data = new FormData();
		
		form_data.append("start_address",$("#start_place").val());
		form_data.append("start_address_lat",$("#start_place_lat").val());
		form_data.append("start_address_long",$("#start_place_lng").val());
		form_data.append("end_address",$("#end_place").val());
		form_data.append("end_address_lat",$("#end_place_lat").val());
		form_data.append("end_address_long",$("#end_place_lng").val());
		form_data.append("leave_date",$("#leave_date").val());
		form_data.append("duration",$("#duration").val());
		form_data.append("distance",$("#distance").val());
		form_data.append("cost",$("#cost").val());
		form_data.append("description",$("#description").val());

		$.ajax({
			url: '../controller/register_itinerary.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,         	                
	        type: 'post',
	        success: function(string){
	                
	           var getData = $.parseJSON(string);

	        	alert(getData['message']);       	
	        	
	        }
	    
	    });

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
	//directionsDisplay.setPanel(document.getElementById('directions-panel'));

	  // Create the search box and link it to the UI element.
	  
	  var startsearchBox = new google.maps.places.SearchBox(
	    /** @type {HTMLInputElement} */(document.getElementById('start_place')));
	  var endsearchBox = new google.maps.places.SearchBox(
			    /** @type {HTMLInputElement} */(document.getElementById('end_place')));

	  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('start_place'));
	 // map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('end_place'));
	  
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
		icon : '../icons/iconstart.png',
		title : "Start"
	});

	end_marker = new google.maps.Marker({
		position : danang,
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
	      $("#start_place_lat").val(start_marker.getPosition().lat());
	      $("#start_place_lng").val(start_marker.getPosition().lng());
	      $("#end_place_lng").val(end_marker.getPosition().lat());
	      $("#end_place_lat").val(end_marker.getPosition().lng());
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
