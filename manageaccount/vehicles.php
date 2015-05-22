<?php
include_once '../controller/Constant.php';
session_start ();

if(isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "en") {
        include '../includes/lang_en.php';
    } else {
        include '../includes/lang_vi.php';
    }
} else {
    setcookie('lang', 'en', time() + (86400 * 365), "/");
}

if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
include '../header_master.php';
?>
<title><?php echo $lang['VEHICLE_MANAGEMENT'] ?></title>
<!-- Header -->
<header>
	<div class="container" style="padding-top: 100px">
		<div class="row">
		<!-- form -->
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-5 control-label"><?php echo $lang['VEHICLE_SELECT'] ?></label>
					<div class="col-sm-4">
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
							<option value = "n"></option>
							<?php for($i = 0; $i < sizeof($res); $i++){
								$value = $res[$i];
							?>
								<option value = "<?php echo $i;?>"><?php echo $value->{'type'}; echo " - "; echo $value->{'license_plate'};?></option>
							<?php }?>
							<option value = "e" style="font-style: italic;"><?php echo $lang['ADD_VEHICLE'] ?></option>	
						</select>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="intro-text">
					<!-- form -->
					<form id="form_vehicle" class="form-horizontal" style="display: none;">
						<fieldset>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['TYPE'] ?></label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="Vehicle Type"
										id="type_vehicle" placeholder="Vehicle Type:">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['REGISTER_CERTIFICATE'] ?></label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="Register Certification"
										id="Register_Certification" placeholder="Register_Certification:">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['LICENSE_PLATE'] ?></label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="License Plate"
										id="License_Plate" placeholder="License_Plate">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['LICENSE_PLATE_PHOTO'] ?></label>
								<input type="file" class="col-sm-4" name="License_Plate_Image" id="up_LP_Image">
								<div class="col-sm-4">
									<img src="" class="img-thumbnail"
										style="height: 200px; width: 400px;" id="License_Plate_Image" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['VEHICLE_PHOTO'] ?></label>
								<input type="file" class="file col-sm-4" name="Vehicle_Image" id="up_V_Image">
								<div class="col-sm-4">
									<img src="" class="img-thumbnail"
										style="height: 200px; width: 400px;" id="Vehicle_Image" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label"><?php echo $lang['VEHICLE_INSURANCE_PHOTO'] ?> </label>
								<input type="file" class="col-sm-4" name="Vehicle_Insurrance_Image" id="up_VI_Image">
								<div class="col-sm-4">
									<img src="" class="img-thumbnail"
										style="height: 200px; width: 400px;" id="Vehicle_Insurrance_Image" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-5 col-sm-1">
									<input class="btn btn-primary btn-block" type="button"
										name="update" id="update" value="Update">
								</div>
								<div class="col-sm-1">
									<input class="btn btn-primary btn-block" type="button"
										name="delete" id="delete" value="Delete">
								</div>
								<div class="col-sm-1">
									<a class="btn btn-primary btn-block" href="updatedriver.php"><?php echo $lang['BACK'] ?></a>
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
var list_Vehicle;
var vehicle_ID = "", link = "";
$('document').ready(function(){

	var list = <?php echo json_encode($res); ?>;
	
	$('#list_vehicle').change(function(){

		for(var i = 0; i < list.length; i++){

			if ($(this).val() === i.toString()) {
				link = "../controller/update_Vehicle.php";
				
				document.getElementById('form_vehicle').style.display = 'block';
				document.getElementById('delete').disabled = false;
				document.getElementById('update').value = 'Update';
		    	
				vehicle_ID = list[i]['vehicle_id'];
				$('#type_vehicle').val(list[i]['type']);
				$('#Register_Certification').val(list[i]['reg_certificate']);
				$('#License_Plate').val(list[i]['license_plate']);
				$('#License_Plate_Image').attr('src',"data:image/jpeg;base64,"+list[i]['license_plate_img']);
				$('#Vehicle_Image').attr('src',"data:image/jpeg;base64,"+list[i]['vehicle_img']);
				$('#Vehicle_Insurrance_Image').attr('src',"data:image/jpeg;base64,"+list[i]['motor_insurance_img']);
				
		    }

		}
		if($(this).val() === "e"){
			 
			link = "../controller/add_Vehicle.php";
	    	document.getElementById('form_vehicle').style.display = 'block';
	    	document.getElementById('delete').disabled = true;
			document.getElementById('update').value = 'Add';
 	
	    	$('#type_vehicle').val("");
			$('#Register_Certification').val("");
			$('#License_Plate').val("");
			$('#License_Plate_Image').attr('src',"");
			$('#Vehicle_Image').attr('src',"");
			$('#Vehicle_Insurrance_Image').attr('src',"");

		}
		if($(this).val() === "n"){
			 
	    	document.getElementById('form_vehicle').style.display = 'none';

		}
		

	});

// 	$.ajax({
// 		url: '../controller/getVehicle.php', // point to server-side PHP script 
// 	    dataType: 'text',  // what to expect back from the PHP script, if anything
// 	    cache: false,
// 	    data: "nothing",         	                
// 	    type: 'post',
// 	    success: function(string){
	        
// 	    	var getData = $.parseJSON(string);
	    	
// 	    	if(!getData['error']){

// 		    	var vehicle = "";

//     			list_Vehicle = getData['vehicles'];
//     			select = document.getElementById('list_vehicle');
//     			list_Vehicle.forEach (function(value){

//     				 var opt = document.createElement('option');
//     				 opt.value = value['license_plate'];
//     				 opt.innerHTML = value['license_plate'];
//     				 select.appendChild(opt);
//     			});

	    		
// 	        }else {

// 	        	showError("Error cannot get the vehicles!");

// 	            }
	    	
// 	    },
// 	    error: function(){

// 	    	showError("Error unknow!");

// 	        }
// 	});

	$('#up_LP_Image').change(function(){

		readURL(this,"#License_Plate_Image");

	});

	$('#up_V_Image').change(function(){

		readURL(this,"#Vehicle_Image");

	});

	$('#up_VI_Image').change(function(){

		readURL(this,"#Vehicle_Insurrance_Image");

	});

	$('#update').click(function(){

		var form_data = new FormData();
		
		form_data.append("vehicle_ID",vehicle_ID);
		form_data.append("type",$('#type_vehicle').val());
		form_data.append("license_plate",$('#License_Plate').val());
		form_data.append("reg_certificate",$('#Register_Certification').val());
		form_data.append("license_plate_img",$('#License_Plate_Image').attr('src').replace("data:image/jpeg;base64,",""));
		form_data.append("vehicle_img",$('#Vehicle_Image').attr('src').replace("data:image/jpeg;base64,",""));
		form_data.append("motor_insurance_img",$('#Vehicle_Image').attr('src').replace("data:image/jpeg;base64,",""));

		$.ajax({
			url: link, // point to server-side PHP script 
		    dataType: 'text',  // what to expect back from the PHP script, if anything
		    cache: false,
		    contentType: false,
            processData: false,
		    data: form_data,         	                
		    type: 'post',
		    success: function(string){
		        
		    	var getData = $.parseJSON(string);
		    	
		    	if(!getData['error']){

		    			showSuccess(getData['message']);
		    			setTimeout(function(){

		    				location.reload();
		    				
			    		},500);
		    		
		        }else {

		        	showError(getData['message']);

		            }
		    	
		    },
		    error: function(){

		    	showError("Error unknow!");

		        }
		});

	});

	$('#delete').click(function(){

		var form_data = new FormData();
		
		form_data.append("vehicle_ID",vehicle_ID);

		$.ajax({
			url: '../controller/delete_Vehicle.php', // point to server-side PHP script 
		    dataType: 'text',  // what to expect back from the PHP script, if anything
		    cache: false,
		    contentType: false,
            processData: false,
		    data: form_data,         	                
		    type: 'post',
		    success: function(string){
		        
		    	var getData = $.parseJSON(string);
		    	
		    	if(!getData['error']){

		    			showSuccess(getData['message']);

		    			setTimeout(function(){

		    				location.reload();
		    				
			    		},500);
		    		
		        }else {

		        	showError(getData['message']);

		            }
		    	
		    },
		    error: function(){

		    	showError("Error unknow!");

		        }
		});

	});
	
});

//Set image for field
function readURL(input,id) {
	
	var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var file = input.files[0];

    if(file.size > 358400){	

    	showError("File size is not big than 350KB!");

    }else {

    	if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else {

        	showError("Please add the image!");

            }	

    }
   
}
</script>
</body>
</html>