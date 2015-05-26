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

if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $lang['CHANGE_PASS']?></title>

<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/toastr.css">

<!-- Custom CSS -->
<link href="../css/freelancer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/BeatPicker.min.css">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700"
	rel="stylesheet" type="text/css">
<link
	href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic"
	rel="stylesheet" type="text/css">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


</head>
<body>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-text">
						<!-- form -->
						<form class="form-horizontal">
							<fieldset>
								<legend><?php echo $lang['CHANGE_PASS']?></legend>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['AVATAR']?></label>
									<div class="col-sm-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="avatar" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="font-style: italic;"><?php echo $lang['NEW_PASS']?></label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="newPassword" name="newPassword">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="font-style: italic;"><?php echo $lang['RETYPE_PASS']?></label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="retypePassword" id="retypePassword">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-1">
										<input class="btn btn-primary btn-block" type="button"
											name="oK" id="oK" value="<?php echo $lang['UPDATE']?>">
									</div>
									<div class="col-sm-1">
										<a class="btn btn-primary btn-block" href="../manageaccount"><?php echo $lang['BACK']?></a>
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

	<?php 
			if(isset($_SESSION['showMessage'])){
			?>
				showSuccess("You became to <?php echo $_SESSION['driver'];?>!");
			<?php	
				$_SESSION['showMessage'] = null;
			}
			?>

	$("#oK").click(function(){

		if($("#newPassword").val() != $("#retypePassword").val()){

			showError("Retyping your password is wrong!");

		}else {

			var form_data = new FormData();  

			form_data.append("newPassword",$("#newPassword").val());

			$.ajax({
				url: '../controller/change_password.php', // point to server-side PHP script 
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
		            	
		            }else {

		            	showError(getData['message']);
			            
			        }
	            	
	            },
	            error: function(){

	            	showError("Error unknow!");

	                }
	        });

		} 

	});
	
});
</script>
</body>
</html>
