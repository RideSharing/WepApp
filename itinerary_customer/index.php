<?php
include '../controller/Constant.php';
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

if (! isset ( $_SESSION ["api_key"] ) || $_SESSION ['driver'] == 'driver') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title><?php echo $lang['SEARCH_ITINERARY']?></title>

<!-- Section -->
<section class="full-content">
	<div class="row" class="input-group-addon">
		<h4 style="text-align: center;"><?php echo $lang['SEARCH_ITINERARY']?></h4>
	</div>
	<div class="row">
		<div class="col-lg-4 no-padding">
			<div id="list-itinerary">
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
					style="color: #FFF; background-color: #F39C12"><?php echo $lang['DEPARTURE']?>&nbsp;&nbsp;&nbsp;</span>
				<input id="start-place" type="text" class="form-control" aria-describedby="sizing-addon3">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12"><?php echo $lang['DESTINATION']?></span>
				<input id="end-place" type="text" class="form-control" aria-describedby="sizing-addon3">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div id="datetimepicker" class="input-group input-group-sm date">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12"><?php echo $lang['STARTING_DAY']?></span> 
				<input id="date_departure" class="form-control" type="text" placeholder="<?php echo $lang['STARTING_TIME'];?> - <?php echo $lang['TIME_FORMAT']?>" ></input> 
				<span class="input-group-addon add-on"> 
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
</div>
<?php
require_once '../footer_master.php';
?>
<script>
var list_content = "";
var content = "";
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);
var rendererOptions = {
		
		  suppressMarkers : true
		  
};
var map = new google.maps.Map(document.getElementById('map'), {
    center : danang,
    map : map,
    zoom : 13
});
var end_marker = new google.maps.Marker({
    icon: '../icons/end_marker.png',
    map : map
		});
var geocoder;
var markers = [];
var locationPos;
var start, end = "";

function initialize() {
	if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            
        directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
        directionsDisplay.setMap(map);
        locationPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude) + "";
        start = locationPos;
        $('#end-place').val("<?php if(isset($_REQUEST{'End_Address'})) echo $_REQUEST{'End_Address'};?>");
        
		var start_place = new google.maps.places.Autocomplete((document.getElementById('start-place')), { types: ['geocode'] });
		var end_place = new google.maps.places.Autocomplete((document.getElementById('end-place')), { types: ['geocode'] });
	
	    geocoder = new google.maps.Geocoder();
	
		var control = document.getElementById('control');
	
	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);
	    
	    get_change();
		 
		google.maps.event.addListener(start_place, 'place_changed', function() {	

			get_change();
			  
		});
	
		google.maps.event.addListener(end_place, 'place_changed', function() {

			get_change();
			
		});
   }, function() {
            handleNoGeolocation(true);
          });
   } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
   }
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

function search() {

	var start_Lat, start_Lng, end_Lat, end_Lng;
	var tmp = start.split(", ");
	
	start_Lat = tmp[0];
	start_Lng = tmp[1];

	tmp = end.split(", ");
	end_Lat = tmp[0];
	end_Lng = tmp[1];

	var form_data = new FormData();

	form_data.append('start_place_Lat',start_Lat);
	form_data.append('start_place_Lng',start_Lng);
	form_data.append('end_place_Lat',end_Lat);
	form_data.append('end_place_Lng',end_Lng);
	form_data.append('leave_date',$('#date_departure').val());

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

            			var infocontent = '<b><?php echo $lang['FROM']?></b> ' + value['start_address'] + 
            				'<br><b><?php echo $lang['TO']?></b> ' + value['end_address'] + 
            				'<br><b><?php echo $lang['STARTING_TIME']?>: </b>' + value['leave_date'] + 
            				'<br><b><?php echo $lang['DRIVER']?>: </b>' + value['fullname'] + 
            				'<br><div><img src="data:image/jpeg;base64,' + value['link_avatar'] + 
            				'" style="height: 50px; width: 6	0px;"/></div><b><?php echo $lang['DISTANCE']?>: </b>' + 
            				value['distance'] + ' KM<br><b><?php echo $lang['COST']?>:</b> ' + value['cost'] + 
            				'<br><a href="detail_itinerary.php?itinerary_id=' + value['itinerary_id'] + 
            				'&driver=' + value['fullname'] + '&driver_id='+value['driver_id']+'"><?php echo $lang['VIEW_INFOR'];?></a>';

            			marker.info = new google.maps.InfoWindow({
            				  content: infocontent,
            				  maxWidth: 200
            			});

            			markers.push(marker);
            		
            			google.maps.event.addListener(marker,'click',function() {

            				marker.info.open(map, marker);
            				var end_address = "("+value['end_address_lat']+", "+value['end_address_long']+")";
            				calcRoute(marker.getPosition(),end_address);
            			  
            			});

            			//list with list group
            			content = '<a href="detail_itinerary.php?itinerary_id='+
            			value["itinerary_id"]+'&driver='+value["fullname"]+'&driver_id='+
            			value["driver_id"]+'" class="list-group-item"><h6 class="list-group-item-heading">'+
            			'<label style="color: red;"><?php echo $lang['FROM']?></label> '+
            			value["start_address"]+'<br> <label style="color: red;"><?php echo $lang['TO']?></label> '+
            			value["end_address"]+'</h6><b><?php echo $lang['STARTING_TIME']?>: </b>' + value['leave_date'] + 
            			'<br><b><?php echo $lang['DRIVER']?>: </b>'+value["fullname"]+
            			'<br> <b><?php echo $lang['PHONE']?> </b>'+value["phone"]+	
            			'<br> <b><?php echo $lang['DISTANCE']?>: </b>'+value["distance"]+	
            			' km<br> <b><?php echo $lang['COST']?>: </b>'+value["cost"]+								
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
	  
}

function get_change(){

	directionsDisplay.setMap(null);
	end_marker.setMap(null);
	geocoder.geocode( {'address': $('#start-place').val()}, function(results, status) {

		start = locationPos;
		start = start.replace("(","");
    	start = start.replace(")","");

	    if($('#start-place').val() != ""){

	    	var tmp = results[0].geometry.location+"";
	    	start = tmp.replace("(","");
	    	start = start.replace(")","");

		}

    	geocoder.geocode( {'address': $('#end-place').val()}, function(results, status) {

	    	if($('#end-place').val() != ""){

	    		var tmp = results[0].geometry.location+"";
    		    end = tmp.replace("(","");
    	    	end = end.replace(")","");
	    		
		    }    

	    	search();	    	

    	});

	});
	
}

function calcRoute(start_address, end_address) {

	var request = {
	    origin: start_address,
	    destination: end_address,
	    travelMode: google.maps.TravelMode.DRIVING
	};
	  
	directionsService.route(request, function(response, status) {
	    if (status == google.maps.DirectionsStatus.OK) {
	      directionsDisplay.setDirections(response);
	      directionsDisplay.setMap(map);
	     var myRoute = response.routes[0].legs[0];
	      
	     end_marker.setPosition(myRoute.steps[myRoute.steps.length-1].end_point);
	     end_marker.setMap(map); 
	    }
	  });
}

$('#datetimepicker').datetimepicker({
	format: 'yyyy/MM/dd'
}).on('changeDate', function(){get_change();});

</script>
</body>
</html>
