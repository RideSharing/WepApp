<?php
session_start();
require_once 'header.php';
?>

    <!-- Portfolio Grid Section -->
    <section id="maps" class="full-content">
        <div class="row">
            <div class="col-lg-4 no-padding">
                <div id="list-itinerary">
                    <div id="directions-panel"></div>
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <img src="img/thanh.png" class="circle-list-driver">
                        </a>
                        <a href="#" class="list-group-item">Second item</a>
                        <a href="#" class="list-group-item">Third item</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 no-padding">
                <div id="map"></div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Liên hệ với chúng tôi</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên" id="contact_name" required data-validation-required-message="Vui lòng nhập họ tên của bạn.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Địa chỉ email</label>
                                <input type="email" class="form-control" placeholder="Địa chỉ email" id="contact_email" required data-validation-required-message="Vui lòng nhập địa chỉ email.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nội dung liên hệ</label>
                                <textarea rows="5" class="form-control" placeholder="Nội dung" id="contact_message" required data-validation-required-message="Vui lòng nhập nội dung liên hệ."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="contact_success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button onclick="contact_func()" type="submit" class="btn btn-success btn-lg">Gửi liên hệ</button>
                            </div>
                        </div>
                    </form>
                </div>
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
        <div class="btn-group">
            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tỉnh 
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
        <button id="curPos" class="btn btn-warning btn-circle"><i class="fa fa-location-arrow"></i></button>
    </div>

    <div id="map-control-loading" style="display: none;">
        <button class="btn btn-info">Đang tải dữ liệu...</button>
    </div>

    <?php
    require_once 'footer.php';
    ?>
    <script>
        var autocomplete;
        var map;
        var _content;
        var curPos;
        var locationPos;
        var geocoder;
        var startMarker;
        var endMarker;
        var markers = [];

        function initialize() {

            autocomplete = new google.maps.places.Autocomplete((document.getElementById('nav-search')), { types: ['geocode'] });
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('start-point')), { types: ['geocode'] });
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('end-point')), { types: ['geocode'] });

            geocoder = new google.maps.Geocoder();

            var mapOptions = {
                zoom: 15, 
                zoomControl: false,
                streetViewControl: false,
                panControl: false,
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Try HTML5 geolocation
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    locationPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    startMarker = new google.maps.Marker({
                        position: locationPos,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        draggable: true
                    });
                    endMarker = new google.maps.Marker();

                    var infowindow = new google.maps.InfoWindow({
                        content: "Bạn đang ở đây!"
                    });

                    var control = document.getElementById('control');
                    var curPosBtn = document.getElementById('curPos');
                    var loadingBtn = document.getElementById('map-control-loading');

                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);
                    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(curPosBtn);
                    map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(loadingBtn);

                    google.maps.event.addListener(startMarker, 'click', function() {
                        infowindow.open(map,startMarker);
                    });

                    google.maps.event.addListener(map, 'dragend', function() {
                       getListItinerary(map.getCenter());
                    });

                    map.setCenter(locationPos);
                }, function() {
                  handleNoGeolocation(true);
                });
            } else {
                // Browser doesn't support Geolocation
                handleNoGeolocation(false);
            }
        }

        function handleNoGeolocation(errorFlag) {
          if (errorFlag) {
            var content = 'Error: The Geolocation service failed.';
          } else {
            var content = 'Error: Your browser doesn\'t support geolocation.';
          }

          var options = {
            map: map,
            position: new google.maps.LatLng(16.053578, 108.217543),
            content: content
          };

          var infowindow = new google.maps.InfoWindow(options);
          map.setCenter(options.position);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        $('#curPos').click(function() {
            map.setCenter(locationPos);

            startMarker.setMap(null);
            startMarker = new google.maps.Marker({
                    position: locationPos,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable: true,
                    icon: 'img/home.png'
            });
        });

        $('#start-point').keypress(function(e) {
            if (e.which == '13') {
                e.preventDefault();
                codeAddress($('#start-point').val());
                map.setCenter(curPos);

                startMarker.setMap(null);
                startMarker = new google.maps.Marker({
                    position: curPos,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable: true
                });
            }
        });

        $('#end-point').keypress(function(e) {
            if (e.which == '13') {
                e.preventDefault();
                codeAddress($('#end-point').val());
                map.setCenter(curPos);

                endMarker.setMap(null);
                endMarker = new google.maps.Marker({
                    position: curPos,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable: true
                });
            }
        });

        function codeAddress(address) {
            geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                // alert(results[0].geometry.location);
                setCurPos(results[0].geometry.location);
            } else {
                showError('Địa chỉ bạn tìm không có!');
            }
            });
        }

        function setCurPos(_pos) {
            curPos = _pos;
        }

        function getListItinerary(pos) {
            $('#map-control-loading').css('display', 'block');
            $.post("controller/itinerary.php",
                    {
                        _lat: pos.lat(),
                        _long: pos.lng()
                    },
                    function(data, status){
                        data = data.split('&');
                        error = data[0];
                        if (status == "success" && error==0) {
                            $('#map-control-loading').css('display', 'none');
                            // Success message
                            for (var i = 1; i <= data.length-2; i++) {
                                var pos = data[i].split(',');
                                pos = new google.maps.LatLng(pos[0], pos[1]);
                                if (map.getBounds().contains(pos))
                                {
                                    var marker = new google.maps.Marker({
                                        position: pos,
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        draggable: true,
                                        icon: 'img/motorbike.png'
                                    });

                                    markers.push(marker);
                                } 
                            };

                            var markerCluster = new MarkerClusterer(map, markers);
                        } else {
                            alert("loi");
                            $('#map-control-loading').css('display', 'none');
                        }
            });
        }
    </script>
</body>
</html>
