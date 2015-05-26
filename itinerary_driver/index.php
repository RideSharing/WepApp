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

if (! isset ( $_SESSION ["api_key"] )|| $_SESSION['driver'] == 'customer') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title><?php echo $lang['REGISTER_ITINERARY']?></title>

<!-- Section -->
<section class="full-content">
	<div class="row">
		<h4 style="text-align: center;"><?php echo $lang['LIST_REGISTER_ITINERARY']?></h1>
	</div>
	<div class="row">
		<div class="col-lg-4 no-padding">
			<div id="list-itinerary">
				<div class="list-group">
					<!-- Start: list_row -->
						<?php
						$api_key = $_SESSION ["api_key"];
						$ch = curl_init ();
						
						curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/itineraries/driver/itinerary_status" );
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
						
						foreach ( $res as $value ) {
							if ($value->{'status'} == 1) {
								?>
								<a href="cancel_itinerary.php?itinerary_id=<?php echo $value->{'itinerary_id'} ?>&driver=<?php echo $value->{'fullname'} ?>" class="list-group-item">
									<h6 class="list-group-item-heading">
										<label style="color: red;"><?php echo $lang['FROM']?></label>
										<?php echo $value->{'start_address'}==NULL?' ':$value->{'start_address'}?>
										<br> <label style="color: red;"><?php echo $lang['TO']?></label>
										<?php echo $value->{'end_address'}==NULL?' ':$value->{'end_address'}?>
									</h6> 
									<b><?php echo $lang['DRIVER']?>: </b> <?php echo $value->{'fullname'}==NULL?' ':$value->{'fullname'}?>
									<br> <b><?php echo $lang['EMAIL']?>: </b> <?php echo $value->{'email'}==NULL?' ':$value->{'email'} ?>	
									<br> <b><?php echo $lang['PHONE']?> </b> <?php echo $value->{'phone'}==NULL?' ':$value->{'phone'} ?>	
									<br> <b><?php echo $lang['DISTANCE']?>:</b> <?php echo $value->{'distance'}==NULL?' ':$value->{'distance'}?> km
									<br> <b><?php echo $lang['COST']?>:</b> <?php echo $value->{'cost'}==NULL?' ':$value->{'cost'}?>								
								</a> 
						<?php
							} 
						}
						?>
					<!-- End: list_row -->
				</div>
			</div>
		</div>
		<div class="col-lg-8 no-padding">
			<div id="map"></div>
		</div>
	</div>
</section>
<?php
require_once '../footer_master.php';
?>
<script>
var list_itinerary = <?php echo json_encode($res);?>;
var map;

var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);

function initialize() {

	geocoder = new google.maps.Geocoder();
	
	map = new google.maps.Map(document.getElementById('map'), {
	    center : danang,
	    zoom : 13
	});
	
	list_itinerary.forEach (function(value){
		
		if(value['status'] == 1){

			var latLng = new google.maps.LatLng(value['start_address_lat'], value['start_address_long']);

			var marker = new google.maps.Marker({
				position : latLng,	
				icon : '../icons/icon_motor.png',
			});

			var infocontent = '<b><?php echo $lang['FROM']?></b> ' + value['start_address'] + '<br><b><?php echo $lang['TO']?></b> ' + 
				value['end_address'] + '<br><b><?php echo $lang['DRIVER']?>: </b>' + value['fullname'] + 
				'<br><div><img src="data:image/jpeg;base64,' + value['link_avatar'] + 
				'" style="height: 50px; width: 6	0px;"/></div><b><?php echo $lang['PHONE']?> </b>' + 
				value['phone'] + '<br><b><?php echo $lang['DISTANCE']?>: </b>' + 
				value['distance'] + ' KM<br><b><?php echo $lang['COST']?>:</b> ' + value['cost'] + 
				'<br><a href="cancel_itinerary.php?itinerary_id=' + value['itinerary_id'] + 
				'&driver=' + value['fullname'] + '"><?php echo $lang['VIEW_INFOR'];?></a>';
				
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
