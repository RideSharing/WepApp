<!DOCTYPE html>
<html lang="en">

<head>
<style>
.dropdown-submenu {
	position: relative;
}

.dropdown-submenu>.dropdown-menu {
	top: 0;
	left: 100%;
	margin-top: -6px;
	margin-left: -1px;
	-webkit-border-radius: 0 6px 6px 6px;
	-moz-border-radius: 0 6px 6px;
	border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
	display: block;
}

.dropdown-submenu>a:after {
	display: block;
	content: " ";
	float: right;
	width: 0;
	height: 0;
	border-color: transparent;
	border-style: solid;
	border-width: 5px 0 5px 5px;
	border-left-color: #ccc;
	margin-top: 5px;
	margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
	border-left-color: #fff;
}

.dropdown-submenu.pull-left {
	float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
	left: -100%;
	margin-left: 10px;
	-webkit-border-radius: 6px 0 6px 6px;
	-moz-border-radius: 6px 0 6px 6px;
	border-radius: 6px 0 6px 6px;
}
</style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/toastr.css">
    
    <!-- Custom CSS -->
    <link href="../css/freelancer.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/BeatPicker.min.css">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script
	src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../">Ride Sharing</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="../#about">Giới thiệu</a>
                    </li>
                    <li class="page-scroll">
                        <a href="../#contact">Liên hệ</a>
                    </li>
                    <?php
                    if (isset($_SESSION['api_key'])) {
                    ?>
                    <li>
                        <div class="dropdown">
                            <a id="menu1" class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding:0px;">
                                <img src="" class="circle-profile" id="mini_avatar">
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="../manageaccount">Personal</a></li>
                              <li class="dropdown-submenu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Itinerary</a>
								<ul class="dropdown-menu">
									<?php 
									if($_SESSION['mode'] == 'customer'){?>
										<li role="presentation">
											<a role="menuitem" tabindex="-1" href="#" id="search_itinerary">Search Itinerary</a>
										</li>
									<?php
                    				} else {
									?>
										<li role="presentation">
											<a role="menuitem" tabindex="-1" href="#" id="posted_itinerary">Itinerary's posted</a>
										</li>
										<li role="presentation">
											<a role="menuitem" tabindex="-1" href="#" id="accepted_itinerary">Itinerary's accepted</a>
										</li>
									<?php 
									}
									?>	
										<li role="presentation">
											<a role="menuitem" tabindex="-1" href="#">Schedule</a>
										</li>
									</ul>
								</li>
                              <li class="dropdown-submenu"><a href="#" class="dropdown-toggle"
									data-toggle="dropdown">User Mode</a>
									<ul class="dropdown-menu">
										<div class="radio">
											<label style="color: #336EAA;"><input type="radio" name="mode" id="customer" <?php echo $_SESSION['mode']=='customer'?'checked':'' ?> >Customer</label>
										</div>
										<div class="radio">
											<label style="color: #336EAA;"><input type="radio" name="mode" id="driver">Driver</label>
										</div>
									</ul>
							</li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="../controller/logout.php">Logout</a></li>
                            </ul>
                      </div>
                    </li>
                    <?php 
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>