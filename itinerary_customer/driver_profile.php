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

$api_key = $_SESSION["api_key"];

if (! isset ( $_SESSION ["api_key"] )|| $_SESSION['driver'] == 'driver') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title><?php echo $lang['DRIVER_PROFILE']?></title>
<!-- Header -->
<header>
	<div class="container" style="padding-top: 100px">
		<div class="row">
			<div class="col-lg-12">
				<div class="intro-text">
					<!-- form -->
					<form class="form-horizontal">
						<fieldset>
							<legend>
								<b><?php echo $lang['DRIVER_PROFILE']?></b>
							</legend>
							<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="driver_avatar"/>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3"><?php echo $lang['DRIVER_NAME']?>:</label>
										<label class="col-lg-4" id="driver_name"  style="text-align: left; color:#2C3E50; "><?php echo $_REQUEST{'driver'};?></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3"><?php echo $lang['EMAIL']?>:</label>
										<label class="col-lg-4" id="driver_email" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3"><?php echo $lang['PHONE']?></label>
										<label class="col-lg-4" id="driver_phone" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3"><?php echo $lang['PERSONAL_ID']?></label>
										<label class="col-lg-4" id="driver_id" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
									<?php 
										$user_id = $_REQUEST{'driver_id'};


										$ch = curl_init();
										
										curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/average_rating/$user_id");
										
										curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);
										
										curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));
										
										// Thiết lập sử dụng GET
										curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
										
										
										// execute the request
										$result = curl_exec($ch);
										
										// close curl resource to free up system resources
										curl_close($ch);
										
										$json = json_decode ( $result );
										
										$rating = $json->{'average_rating'};
									?>
										<label class="col-lg-3"><?php echo $lang['RATING']?>:</label>
										<div class="col-lg-4" id="rating"></div>
									</div>
									<div class="col-sm-7" style="text-align: left;">
										<div class="col-lg-2">
											<a class="btn btn-primary btn-block" href="../itinerary_customer/detail_itinerary.php?itinerary_id=<?php echo $_REQUEST{'itinerary_id'};?>&driver=<?php echo $_REQUEST{'driver'};?>&driver_id=<?php echo $_REQUEST{'driver_id'};?>">Back</a>
										</div>
									</div>
							</div>
							
						</fieldset>
					</form>
					<div class="no-padding"><h5><?php echo $lang['COMMENT'];?></h5></div>
					<div class="col-lg-offset-3 col-lg-6 id="list-comment"">
						<ul class="list-group" style="text-align: left;">
						  <?php
						  $ch = curl_init();
						  
						  curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/commentsofuser/".$_REQUEST{'driver_id'});
						  
						  curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);
						  
						  curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));
						  
						  // Thiết lập sử dụng GET
						  curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
						  
						  
						  // execute the request
						  $result = curl_exec($ch);
						  
						  // close curl resource to free up system resources
						  curl_close ( $ch );
						  
						  $json = json_decode ( $result );
						  
						  $res = $json->{'comments'};
						  
						  if(empty( $res ) ){
						  ?>
						  	<li class="list-group-item" style="font-style: italic; color: red; text-align: center;">No comment</li>
						  <?php 
						  } else{

							  foreach ( $res as $value ) {
							  ?>
							  	<li class="list-group-item list-group-item-info"><?php echo $value->{'content'};?></li>
							  <?php 
							  }
						  }
						  ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<?php
require_once '../footer_master.php';
?>
<script>
$("document").ready(function(){

	var form_data = new FormData(); 
	 
	form_data.append("user_id",<?php echo $_REQUEST{'driver_id'}?>);
	
	$.ajax({
		url: '../controller/view_OtherProfile.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,         	                
        type: 'post',
        success: function(string){
        	 
        	var getData = $.parseJSON(string);

        	if(!getData['error']){
        		
        		$("#driver_avatar").attr('src','data:image/jpeg;base64,'+getData['link_avatar']);
        		document.getElementById("driver_email").innerHTML = getData['email'];
        		document.getElementById("driver_phone").innerHTML = getData['phone'];
        		document.getElementById("driver_id").innerHTML = getData['personalID'];
        		
            }
        	
        }
    });

	$.fn.raty.defaults.path = '../images/rating';
	
	$('#rating').raty({

	  readOnly:true,
	  score: <?php echo $rating;?>
	  
	});
	
});
</script>
<!-- Plugin JavaScript -->
<script
	src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>
</body>
</html>
