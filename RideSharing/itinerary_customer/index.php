<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )|| $_SESSION['driver'] == 'driver') {
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
				<div class="list-group" id="list-group">
					<!-- Start: list_row -->
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
						
						foreach ( $res as $value ) {
							if ($value->{'status'} == 1) {
								?>
								<a href="detail_itinerary.php?itinerary_id=<?php echo $value->{'itinerary_id'} ?>&driver=<?php echo $value->{'fullname'} ?>&driver_id=<?php echo $value->{'user_id'} ?>" class="list-group-item">
									<h6 class="list-group-item-heading">
										<label style="color: red;">FROM:</label>
										<?php echo $value->{'start_address'}==NULL?' ':$value->{'start_address'}?>
										<br> <label style="color: red;">TO:</label>
										<?php echo $value->{'end_address'}==NULL?' ':$value->{'end_address'}?>
									</h6> 
									<b>Driver: </b> <?php echo $value->{'fullname'}==NULL?' ':$value->{'fullname'}?>
									<br> <b>Email: </b> <?php echo $value->{'email'}==NULL?' ':$value->{'email'} ?>	
									<br> <b>Phone: </b> <?php echo $value->{'phone'}==NULL?' ':$value->{'phone'} ?>									
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
<div id="control">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3" style="color: #FFF; background-color: #F39C12">Nhập điểm đi&nbsp&nbsp&nbsp&nbsp</span>
                    <input id="start-point" type="text" class="form-control" placeholder="Điểm đi..." aria-describedby="sizing-addon3">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3" style="color: #FFF; background-color: #F39C12">Nhập điểm đến</span>
                    <input id="end-point" type="text" class="form-control" placeholder="Điểm đến..." aria-describedby="sizing-addon3">
                </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3" style="color: #FFF; background-color: #F39C12">Ngày đi</span>
                    <input type="text" data-beatpicker="true" data-beatpicker-position="['*','*']" data-beatpicker-disable="{from:[2014,1,1],to:'<'}"/>
                </div>
            </div>
        </div>
    </div>
<?php
require_once '../footer_master.php';
?>
<script>
var list_itinerary;
var map;
var autocomplete;
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);

	

function initialize() {
	$.ajax({
		url: '../controller/getListItinerary.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		list_itinerary = getData['itineraries'];
        		
        		
            }else {

            	showError(getData['message']);

                }
        	
        },
        error: function(){

        	showError("Error unknow!");

            }
    });
	alert(list_itinerary);
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
