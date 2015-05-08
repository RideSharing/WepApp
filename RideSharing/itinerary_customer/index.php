<?php
include '../controller/Constant.php';
session_start ();

if (! isset ( $_SESSION ["api_key"] ) || $_SESSION ['driver'] == 'driver') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Search Itinerary</title>

<!-- Section -->
<section class="full-content">
	<div class="row" class="input-group-addon">
		<h4 style="text-align: center;">Search Itinerary</h4>
	</div>
	<div class="row">
		<div class="col-lg-4 no-padding">
			<div id="list-itinerary">
						<?php
						$api_key = $_SESSION ["api_key"];
						$ch = curl_init ();
						
						curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/itineraries" );
						curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
						curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
								'Authorization: ' . $api_key 
						) );
						
						// execute the request
						$result = curl_exec ( $ch );
						
						// close curl resource to free up system resources
						curl_close ( $ch );
						
						$json = json_decode ( $result );
						
						$res = $json->{'itineraries'};
						
						?>
				<div class="list-group" id="list-group">
					<!-- Start: list_row -->
					<!-- End: list_row -->
				</div>
			</div>
		</div>
		<div class="col-lg-8 no-padding" style="padding-right: 10px;">
			<div id="map"></div>
		</div>
	</div>
</section>
<div id="control">
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12">Start Place</span> 
				<input id="start-place" type="text"
					class="form-control" placeholder="Enter the Start Place ..."
					aria-describedby="sizing-addon3">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12">End Place&nbsp&nbsp</span>
				<input id="end-place" type="text" class="form-control"
					placeholder="Enter the End Place ..." aria-describedby="sizing-addon3">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12">Date Departure</span> 
				<input type="text" id="date_departure" data-beatpicker="true" data-beatpicker-position="['*','*']"
					data-beatpicker-disable="{from:[2014,1,1],to:'<'}" />
			</div>
		</div>
	</div>
</div>
<?php
require_once '../footer_master.php';
?>
<script>
var list_itinerary = <?php echo json_encode($res);?>;
var list_content = "";
var content = "";
var map;
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);
var geocoder;
var markers = [];
var locationPos;

function initialize() {
	if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            locationPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        }, function() {
          handleNoGeolocation(true);
        });
    } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }
	
	var start_place = new google.maps.places.Autocomplete((document.getElementById('start-place')), { types: ['geocode'] });
	var end_place = new google.maps.places.Autocomplete((document.getElementById('end-place')), { types: ['geocode'] });

    geocoder = new google.maps.Geocoder();
	
	map = new google.maps.Map(document.getElementById('map'), {
	    center : danang,
	    zoom : 13
	});

	var control = document.getElementById('control');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);

	list_itinerary.forEach (function(value){
		
		if(value['status'] == 1){

			//list icon on map
			var latLng = new google.maps.LatLng(value['start_address_lat'], value['start_address_long']);

			var marker = new google.maps.Marker({
				position : latLng,	
				icon : '../icons/icon_motor.png'
			});

			var infocontent = '<b>FROM:</b> ' + value['start_address'] + '<br><b>TO:</b> ' + 
				value['end_address'] + '<br><b>DRIVER: </b>' + value['fullname'] + 
				'<br><div><img src="data:image/jpeg;base64,' + value['link_avatar'] + 
				'" style="height: 50px; width: 6	0px;"/></div><b>DISTANCE: </b>' + 
				value['distance'] + ' KM<br><b>COST:</b> VND ' + value['cost'] + 
				'<br><a href="detail_itinerary.php?itinerary_id=' + value['itinerary_id'] + 
				'&driver=' + value['fullname'] + '">View Detail Information	........</a>';

			marker.info = new google.maps.InfoWindow({
				  content: infocontent,
				  maxWidth: 200
			});
			
			markers.push(marker);
		
			google.maps.event.addListener(marker,'click',function() {

				marker.info.open(map, marker);
			  
			});

			//list with list group
			content = '<a href="detail_itinerary.php?itinerary_id='+
			value["itinerary_id"]+'&driver='+value["fullname"]+'&driver_id='+
			value["driver_id"]+'" class="list-group-item"><h6 class="list-group-item-heading">'+
			'<label style="color: red;">FROM:</label>'+
			value["start_address"]+'<br> <label style="color: red;">TO:</label>'+
			value["end_address"]+'</h6><b>Driver: </b>'+value["fullname"]+
			'<br> <b>Email: </b>'+value["email"]+
			'<br> <b>Phone: </b>'+value["phone"]+									
			'</a>  ';
			
			list_content = list_content.concat(content);
		}

	});

	$('#list-group').html(list_content);
	
	//Set marker on MAP
	setAllMap(map);
	  
	google.maps.event.addListener(start_place, 'place_changed', function() {	

		var form_data = new FormData();
		var start = "123";
		
		start = codeAddress($('#start-place').val());
		alert(start);
		
		
		form_data.append('start_place',$('#start-place').val());
		form_data.append('end_place',$('#end-place').val());
		
		$.ajax({
			url: "../controller/getListItinerary.php", // point to server-side PHP script 
	        dataType: 'text',  // what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,         	                
	        type: 'post',
	        success: function(string){
	        	
                var getData = $.parseJSON(string);

                if(!getData['error']){

                	setAllMap(null);
                	list_content = "";
                	markers = [];
                	
                	var list = getData['itineraries'];
      
                	list.forEach (function(value){
                    	//list icon on map
                		if(value['status'] == 1){
							
                			var latLng = new google.maps.LatLng(value['start_address_lat'], value['start_address_long']);

                			var marker = new google.maps.Marker({
                				position : latLng,	
                				icon : '../icons/icon_motor.png'
                			});

                			var infocontent = '<b>FROM:</b> ' + value['start_address'] + '<br><b>TO:</b> ' + 
                				value['end_address'] + '<br><b>DRIVER: </b>' + value['fullname'] + 
                				'<br><div><img src="data:image/jpeg;base64,' + value['link_avatar'] + 
                				'" style="height: 50px; width: 6	0px;"/></div><b>DISTANCE: </b>' + 
                				value['distance'] + ' KM<br><b>COST:</b> VND ' + value['cost'] + 
                				'<br><a href="detail_itinerary.php?itinerary_id=' + value['itinerary_id'] + 
                				'&driver=' + value['fullname'] + '">View Detail Information	........</a>';

                			marker.info = new google.maps.InfoWindow({
                				  content: infocontent,
                				  maxWidth: 200
                			});

                			markers.push(marker);
                		
                			google.maps.event.addListener(marker,'click',function() {

                				marker.info.open(map, marker);
                			  
                			});

                			//list with list group
                			content = '<a href="detail_itinerary.php?itinerary_id='+
                			value["itinerary_id"]+'&driver='+value["fullname"]+'&driver_id='+
                			value["driver_id"]+'" class="list-group-item"><h6 class="list-group-item-heading">'+
                			'<label style="color: red;">FROM:</label>'+
                			value["start_address"]+'<br> <label style="color: red;">TO:</label>'+
                			value["end_address"]+'</h6><b>Driver: </b>'+value["fullname"]+
                			'<br> <b>Email: </b>'+value["email"]+
                			'<br> <b>Phone: </b>'+value["phone"]+									
                			'</a>  ';
                			
                			list_content = list_content.concat(content);
                			
                		}

                	});

                	
                	$('#list-group').html(list_content);
 
                	setAllMap(map);
                	
                } else {

                	showError(getData['message']);

                }
	            	
	        }
        });

	});

	google.maps.event.addListener(end_place, 'place_changed', function() {

		var form_data = new FormData();
		

		form_data.append('start_place',$('#start-place').val());
		form_data.append('end_place',$('#end-place').val());
		
		$.ajax({
			url: "../controller/getListItinerary.php", // point to server-side PHP script 
	        dataType: 'text',  // what to expect back from the PHP script, if anything
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,         	                
	        type: 'post',
			success: function(string){
	        	
                var getData = $.parseJSON(string);

                if(!getData['error']){

                	setAllMap(null);
                	list_content = "";
                	markers = [];
                	
                	var list = getData['itineraries'];
      
                	list.forEach (function(value){
                    	//list icon on map
                		if(value['status'] == 1){
							
                			var latLng = new google.maps.LatLng(value['start_address_lat'], value['start_address_long']);

                			var marker = new google.maps.Marker({
                				position : latLng,	
                				icon : '../icons/icon_motor.png'
                			});

                			var infocontent = '<b>FROM:</b> ' + value['start_address'] + '<br><b>TO:</b> ' + 
                				value['end_address'] + '<br><b>DRIVER: </b>' + value['fullname'] + 
                				'<br><div><img src="data:image/jpeg;base64,' + value['link_avatar'] + 
                				'" style="height: 50px; width: 6	0px;"/></div><b>DISTANCE: </b>' + 
                				value['distance'] + ' KM<br><b>COST:</b> VND ' + value['cost'] + 
                				'<br><a href="detail_itinerary.php?itinerary_id=' + value['itinerary_id'] + 
                				'&driver=' + value['fullname'] + '">View Detail Information	........</a>';

                			marker.info = new google.maps.InfoWindow({
                				  content: infocontent,
                				  maxWidth: 200
                			});

                			markers.push(marker);
                		
                			google.maps.event.addListener(marker,'click',function() {

                				marker.info.open(map, marker);
                			  
                			});

                			//list with list group
                			content = '<a href="detail_itinerary.php?itinerary_id='+
                			value["itinerary_id"]+'&driver='+value["fullname"]+'&driver_id='+
                			value["driver_id"]+'" class="list-group-item"><h6 class="list-group-item-heading">'+
                			'<label style="color: red;">FROM:</label>'+
                			value["start_address"]+'<br> <label style="color: red;">TO:</label>'+
                			value["end_address"]+'</h6><b>Driver: </b>'+value["fullname"]+
                			'<br> <b>Email: </b>'+value["email"]+
                			'<br> <b>Phone: </b>'+value["phone"]+									
                			'</a>  ';
                			
                			list_content = list_content.concat(content);
                			
                		}

                	});

                	
                	$('#list-group').html(list_content);
 
                	setAllMap(map);
                	
                } else {

                	showError(getData['message']);

                }
	            	
	        }	
        });

	});

}

google.maps.event.addDomListener(window, 'load', initialize);

function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	  }
}

function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
      var content = 'Error: The Geolocation service failed.';
    } else {
      var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
      map: map,
      position: new google.maps.LatLng(16.053578, 108.217543),
      content: content
    };

    var infowindow = new google.maps.InfoWindow(options);
    map.setCenter(options.position);
  }

function codeAddress(address) {
	  
	  geocoder.geocode( {'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
		    
	    	return results[0].geometry.location+"";
	      
	    } else {
		    
	      showError('Geocode was not successful for the following reason: ' + status);
	      
	    }
	  });
	}

</script>
</body>
</html>
