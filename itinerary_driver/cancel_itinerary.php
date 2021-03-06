<?php
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
<title><?php echo $lang['DETAILS_ITINERARY']?></title>
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
								<b><?php echo $lang['DETAILS_ITINERARY']?></b>
							</legend>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DRIVER_NAME']?>:</label>
								<div class="col-sm-4 control-label" style="text-align: left;">
									<a href="#" style="color: blue; text-decoration: underline;" data-toggle="tooltip" data-original-title="Click to see Driver Information"><?php echo $_REQUEST{'driver'}?></a>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DEPARTURE']?>:</label>
								<label class="col-sm-4 control-label" id="start_address" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DESTINATION']?>:</label>
								<label class="col-sm-4 control-label" id="end_address" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['STARTING_TIME']?>:</label>
								<label class="col-sm-4 control-label" id="time" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DURATION']?>:</label>
								<label class="col-sm-4 control-label" id="duration" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DISTANCE']?>:</label>
								<label class="col-sm-4 control-label" id="distance" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['COST']?>:</label>
								<label class="col-sm-4 control-label" id="cost" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['DESCRIPTION']?>:</label>
								<label class="col-sm-4 control-label" id="description" style="text-align: left; color:#2C3E50; "></label>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-3">
									<input class="btn btn-primary btn-block" id="cancel_itinerary" type="button" value="<?php echo $lang['CANCEL_ITINERARY'];?>">
								</div>
								<div class="col-sm-2">
									<a class="btn btn-primary btn-block" href="update_itinerary.php?itinerary_id=<?php echo $_REQUEST{'itinerary_id'}?>"><?php echo $lang['EDIT']?></a>
								</div>
								<div class="col-sm-2">
									<a class="btn btn-primary btn-block" href="../itinerary_driver"><?php echo $lang['BACK']?></a>
								</div>
							</div>
						</fieldset>
					</form>
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
	 
	form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'}?>);
	
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

        	if(!getData['error']){

        		document.getElementById("start_address").innerHTML = getData['start_address'];
        		document.getElementById("end_address").innerHTML = getData['end_address'];
        		document.getElementById("time").innerHTML = getData['leave_date'];
        		document.getElementById("duration").innerHTML = getData['duration']==null?"":getData['duration'];
        		document.getElementById("distance").innerHTML = getData['distance']==null?"":getData['distance']+" km";
        		document.getElementById("cost").innerHTML = getData['cost']==null?"":getData['cost'];
        		document.getElementById("description").innerHTML = getData['description'];
        		document.getElementById("view_customer").href = "customer_profile.php?customer_id="+getData['customer_id']+"&itinerary_id="+getData['itinerary_id'];
        		
            }
        	
        }
    });

	$("#cancel_itinerary").click(function(){

		var form_data = new FormData();   
		
		form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'}?>);
		
		$.ajax({
			url: '../controller/cancel_itinerary.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,         	                
            type: 'post',
            success: function(string){

            	var getData = $.parseJSON(string);

            	if(getData['error']){

            		showError(getData['message']);
            		
                }
            		
            	else {

            		showSuccess(getData['message']);
            		
            		setTimeout(function(){

               			location.assign( 'index.php' );
	    				
		    		},500);

                }      	
            }
        });

	});

	// Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip({
        placement : 'top'
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
