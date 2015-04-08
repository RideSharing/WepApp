<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ride Sharing - Trang chủ</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/toastr.css">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/BeatPicker.min.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index" onload="initialize()">
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
                <a class="navbar-brand" href="">Ride Sharing</a>
                <div>
                    <span id="map-marker"><i class="fa fa-map-marker"></i></span>
                    <input id="nav-search" type="text" placeholder="Nhập địa chỉ muốn tìm..."></input>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php
                    if (!isset($_SESSION['api_key'])) {
                    ?>
                    <li class="page-scroll">
                        <a href="#register">Đăng kí</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#" class="btn btn-md btn-success"  data-toggle="modal" data-target="#loginModal">Đăng nhập</a>
                    </li>
                    <?php 
                    }
                    ?>
                    <li class="page-scroll">
                        <a href="#about">Giới thiệu</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Liên hệ</a>
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
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="manageaccount">Thông tin cá nhân</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="itinerary">Quản lý hành trình</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="controller/logout.php">Đăng xuất</a></li>
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