<?php
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
						
						curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/itineraries" );
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
					style="color: #FFF; background-color: #F39C12">Nhập điểm
					đi&nbsp&nbsp&nbsp&nbsp</span> <input id="start-place" type="text"
					class="form-control" placeholder="Điểm đi..."
					aria-describedby="sizing-addon3">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12">Nhập điểm đến</span>
				<input id="end-place" type="text" class="form-control"
					placeholder="Điểm đến..." aria-describedby="sizing-addon3">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"
					style="color: #FFF; background-color: #F39C12">Ngày đi</span> <input
					type="text" data-beatpicker="true"
					data-beatpicker-position="['*','*']"
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

$('document').ready(function(){
	
	var list_content = "";
	var content = "";
	
	list_itinerary.forEach (function(value){

		if( value['status'] == 1 ){

			content = '<a href="detail_itinerary.php?itinerary_id='+
			value["itinerary_id"]+'&driver='+value["fullname"]+'&driver_id='+
			value["driver_id"]+'" class="list-group-item"><h6 class="list-group-item-heading">'+
			'<label style="color: red;">FROM:</label>'+
			value["start_address"]+'<br> <label style="color: red;">TO:</label>'+
			value["end_address"]+'</h6><b>Driver: </b>'+value["fullname"]+
			'<br> <b>Email: </b>'+value["email"]+
			'<br> <b>Phone: </b>'+value["phone"]+									
			'</a>  ';
			
		}

		list_content = list_content.concat(content);

	});
	$('#list-group').html(list_content);
});

</script>
<script>
var map;
var autocomplete;
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);

function initialize() {
	
	autocomplete = new google.maps.places.Autocomplete((document.getElementById('start-point')), { types: ['geocode'] });
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('end-point')), { types: ['geocode'] });
	
	map = new google.maps.Map(document.getElementById('map'), {
	    center : danang,
	    zoom : 13
	});

	var control = document.getElementById('control');
    var curPosBtn = document.getElementById('curPos');
    var loadingBtn = document.getElementById('map-control-loading');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(curPosBtn);
    map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(loadingBtn);
    
	
	list_itinerary.forEach (function(value){
		
		if(value['status'] == 1){

			var latLng = new google.maps.LatLng(value['start_address_lat'], value['start_address_long']);

			var marker = new google.maps.Marker({
				position : latLng,	
				icon : '../icons/icon_motor.png',
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

			marker.setMap(map);
		
			google.maps.event.addListener(marker,'click',function() {

				marker.info.open(map, marker);
			  
			});
		}

	});


}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>
</html>
