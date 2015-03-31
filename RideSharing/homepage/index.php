<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ride Sharing</title>

<!-- Bootstrap CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- jQuery -->

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-1">
				<div id="carousel-example-generic" class="carousel slide"
					data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0"
							class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="#" alt="Photo 1">
							<div class="carousel-caption">Photo 1</div>
						</div>
						<div class="item">
							<img src="#" alt="Photo 2">
							<div class="carousel-caption">Photo 2</div>
						</div>
						<div class="item">
							<img src="#" alt="Photo 3">
							<div class="carousel-caption">Photo 3</div>
						</div>
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic"
						role="button" data-slide="prev"> <span
						class="glyphicon glyphicon-chevron-left"></span>
					</a> <a class="right carousel-control"
						href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#">Home</a></li>
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">Mode <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="">Driver</a></li>
					<li><a href="">Rider</a></li>
				</ul></li>
			<li><a href="../manageaccount">Manage Account</a></li>
			<li><a href="#">Manage Itineraries</a></li>
			<li><a href="#">Manage Schedule</a></li>
			<li><a href="#">Analyze Statistically</a></li>
			<li><form>
				<div>
					<input type="button" class="btn btn-primary" name="logout"
						id="logout" value="Sign out">
				</div>
			</li>
		</ul>

		<div class="row">
			<br>
			<div id="googleMap" style="width: 590px; height: 380px;"
				class="col-md-offset-1">
			</div>
		</div>
	</div>
	
<script src="http://code.jquery.com/jquery-1.11.2.js"></script>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- GoogleMap JavaScript -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="../js/googlemap.js"></script>
<script>
$("document").ready(function(){
	
	$("#logout").click(function(){

		window.location.assign("../controller/logout.php");
		
		});
	
});
</script>
</body>
</html>
</html>