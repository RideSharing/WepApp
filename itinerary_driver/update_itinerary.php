<?php
include_once '../controller/Constant.php';
session_start ();

if(isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "en") {
        require_once '../includes/lang_en.php';
    } else {
        require_once '../includes/lang_vi.php';
    }
} else {
    setcookie('lang', 'en', time() + (86400 * 365), "/");
}

if (! isset ( $_SESSION ["api_key"] ) || $_SESSION ['driver'] == 'customer') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>

<title><?php echo $lang['EDIT_ITINERARY']?></title>

<body>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-13">
					<form>
						<fieldset>
							<legend style="text-align: center;">
								<b><?php echo $lang['EDIT_ITINERARY']?></b>
							</legend>
							<div class="col-lg-5">
								<div class="form-group">
									<input class="form-control" id="start_place" type="text"
										placeholder="<?php echo $lang['DEPARTURE'];?>"> 
									<input id="start_place_lat" type="text" style="display: none;"> 
									<input id="start_place_lng" type="text" style="display: none;">
								</div>
								<div class="form-group">
									<input class="form-control" id="end_place" type="text"
										placeholder="<?php echo $lang['DESTINATION'];?>"> <input id="end_place_lat" type="text"
										style="display: none;"> <input id="end_place_lng" type="text"
										style="display: none;">
								</div>
								<div class="form-group">
									<div id="datetimepicker" class="input-group date">
										<input id="leave_date" class="form-control" type="text" placeholder="<?php echo $lang['STARTING_TIME'];?> - <?php echo $lang['TIME_FORMAT']?>" ></input> 
										<span class="input-group-addon add-on"> 
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<textarea class="form-control" id="description"
										placeholder="<?php echo $lang['DESCRIPTION'];?>" style="resize: none;"></textarea>
								</div>
								<div class="form-group">
									<input class="form-control" id="distance" type="text"
										placeholder="<?php echo $lang['DISTANCE'];?> (km)">
								</div>
								<div class="form-group">
									<input class="form-control" id="duration" type="text"
										placeholder="<?php echo $lang['DURATION'];?>">
								</div>
								<div class="form-group">
									<input class="form-control" id="cost" type="text"
										placeholder="<?php echo $lang['COST'];?>">
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['VEHICLE_SELECT']?> </label>
									<div>
									<?php
									$api_key = $_SESSION ["api_key"];
									$ch = curl_init ();
									
									curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/vehicles" );
									curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
									curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
											'Authorization: ' . $api_key 
									) );
									curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
									
									// execute the request
									$result = curl_exec ( $ch );
									
									// close curl resource to free up system resources
									curl_close ( $ch );
									
									$json = json_decode ( $result );
									
									$res = $json->{'vehicles'};
									
									?>
									<select id=list_vehicle class="selectpicker">
										<?php for($i = 0; $i < sizeof($res); $i++){
											$value = $res[$i];
										?>
											<option value = "<?php echo $value->{'vehicle_id'};?>"><?php echo $value->{'type'}; echo " - "; echo $value->{'license_plate'};?></option>
										<?php }?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<input class="btn btn-primary btn-block" type="button"
										name="update_itinerary" id="update_itinerary" value="<?php echo $lang['UPDATE'];?>">
								</div>
							</div>
							<div id="map" style="height: 545px; width: 680px;"></div>
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
$('document').ready(function(){

	var form_data = new FormData();
	
	form_data.append("itinerary_id","<?php echo $_REQUEST{'itinerary_id'}?>");
	
	$.ajax({
		url: '../controller/detail_itinerary.php', // point to server-side PHP script 
		dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,         	                
        type: 'post',
        success: function(string){
                
           var getData = $.parseJSON(string);

        	if(!getData['error']) {

        		$("#start_place").val(getData['start_address']);
        		$("#start_place_lat").val(getData['start_address_lat']);
        		$("#start_place_lng").val(getData['start_address_long']);
        		$("#end_place").val(getData['end_address']);
        		$("#end_place_lat").val(getData['end_address_lat']);
        		$("#end_place_lng").val(getData['end_address_long']);
        		$("#leave_date").val(getData['leave_date']);
        		$("#description").val(getData['description']);
        		$("#distance").val(getData['distance']);
        		$("#duration").val(getData['duration']);
        		$("#cost").val(getData['cost']);
        		

			}else {

				showError(getData['message']);
				
			}       	
        	
        }
    
    });
    
	$("#update_itinerary").click(function(){
		
		var currentDay = new Date();
		var pickedDay = Date.parse($("#leave_date").val());

		if(pickedDay <= currentDay){
			
			showError("<?php echo $lang['DAY_ERROR'];?>");
			
		 } else{

			var e = document.getElementById("list_vehicle");
			var form_data = new FormData();
			form_data.append("itinerary_id","<?php echo $_REQUEST{'itinerary_id'}?>");
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
			form_data.append("vehicle_id",e.options[e.selectedIndex].value);
	
			$.ajax({
				url: '../controller/update_itinerary.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,         	                
		        type: 'post',
		        success: function(string){
			        
		           var getData = $.parseJSON(string);
	
		        	if(!getData['error']) {
	
		        		showSuccess(getData['message']);
	
					}else {
	
						showError(getData['message']);
						
					}       	
		        	
		        }
		    
		    });
		}

	});


    $('#datetimepicker').datetimepicker({
    	format: 'yyyy/MM/dd hh:mm:ss'
    });


});

</script>
<script>
var map;
var geocoder;
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

var  markerArray = [];
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);
var tmp = new google.maps.LatLng(16.054144447313266, 108.20707118988037);
var start = danang;
var end = tmp;

function initialize() {

	geocoder = new google.maps.Geocoder();

	var markers = [];

	directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

	directionsService = new google.maps.DirectionsService();
	
	map = new google.maps.Map(document.getElementById('map'), {
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
		title : "Start",
		draggable: true
	});

	end_marker = new google.maps.Marker({
		position : tmp,
		icon : '../icons/iconstop.png',
		title : "End",
		draggable: true
	});

	start_marker.setMap(map);
	end_marker.setMap(map);

	google.maps.event.addListener(start_marker, "dragend", function() {
	    start = start_marker.getPosition();
	    calcRoute();
	      
	    });

	google.maps.event.addListener(end_marker, "dragend", function() {
		end = end_marker.getPosition();
	    calcRoute();
	      
	    });

	google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
	    computeTotalDistance(directionsDisplay.getDirections());
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
	      
	      var myRoute = response.routes[0].legs[0];

	      start_marker.setPosition(myRoute.steps[0].start_point);

	      end_marker.setPosition(myRoute.steps[myRoute.steps.length-1].end_point);
	      
	      $("#start_place_lat").val(start_marker.getPosition().lat());
	      $("#start_place_lng").val(start_marker.getPosition().lng());
	      $("#end_place_lat").val(end_marker.getPosition().lat());
	      $("#end_place_lng").val(end_marker.getPosition().lng());
	      computeTotalDistance(response);
	    }
	  });
	// Get start address by latlng
	geocoder.geocode({'latLng': start}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      if (results[0]) {
		        $('#start_place').val(results[0].formatted_address);
		      } else {
		        showError('No results found');
		      }
		    } else {
		      showError('Geocoder failed due to: ' + status);
		    }
		});

	// Get stop address by latlng
	geocoder.geocode({'latLng': end}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      if (results[0]) {
	        $('#end_place').val(results[0].formatted_address);
	      } else {
	        showError('No results found');
	      }
	    } else {
	      showError('Geocoder failed due to: ' + status);
	    }
	});
		
}

  function computeTotalDistance(result) {

	  var myroute = result.routes[0];
	  $('#distance').val(myroute.legs[0].distance.value/1000.0);
	  $('#duration').val(Math.ceil(myroute.legs[0].duration.value/60.0));
	  
	}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>
