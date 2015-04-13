<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Schedule</title>

<!-- Section -->
<section class="full-content">
	<div class="row">
		<div class="col-lg-4 no-padding">
			<div id="list-itinerary">
				<div class="list-group">
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
							?>
							<a href="#" class="list-group-item">
								<h6 class="list-group-item-heading">
								<label style="color: red;">FROM:</label>
									<?php echo $value->{'start_address'}==NULL?' ':$value->{'start_address'}?>
								<br>
								<label style="color: red;">TO:</label>
									<?php echo $value->{'end_address'}==NULL?' ':$value->{'end_address'}?>
								</h6>
								<b>Driver: </b> <?php echo $value->{'fullname'}==NULL?' ':$value->{'fullname'}?>
								<br>
								<b>Email: </b> <?php echo $value->{'email'}==NULL?' ':$value->{'email'} ?>	
								<br>
								<b>Phone: </b> <?php echo $value->{'phone'}==NULL?' ':$value->{'phone'} ?>									
							</a> 
						<?php
						}
						?>
					<!-- End: list_row -->
				</div>
			</div>
		</div>
	</div>
</section>
<?php
require_once '../footer_master.php';
?>