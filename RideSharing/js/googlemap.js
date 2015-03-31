var map;
var start_marker;
var end_marker;
var start_infowindow;
var end_infowindow;
var danang = new google.maps.LatLng(16.054144447313266, 108.20207118988037);

function initialize() {
	var mapProp = {
		center : danang,
		zoom : 13,
		mapTypeId : google.maps.MapTypeId.HYBRID
	};

	map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

	// Create a DIV to hold the control and call HomeControl()
	var homeControlDiv = document.createElement('div');
	var homeControl = new HomeControl(homeControlDiv, map);
	// homeControlDiv.index = 1;
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

	//infowindow
	start_infowindow  = new google.maps.InfoWindow({
	    content: "Start"
	});
	
	end_infowindow  = new google.maps.InfoWindow({
	    content: "End"
	});
	
	// Center map
	start_marker = new google.maps.Marker({
		position : danang,
		draggable : true,
		icon: '../icons/icon-start-marker.png',
		title: "Start"
	});
	
	end_marker = new google.maps.Marker({
		position : danang,
		draggable : true,
		icon: '../icons/icon-end-marker.png',
		title: "End"
	});
	
	start_infowindow.open(map,start_marker);
	end_infowindow.open(map,end_marker);

	// The placeMarker() function places a marker where the user has clicked,
	// and shows an infowindow with the latitudes and longitudes of the marker:
//	google.maps.event.addListener(map, 'click', function(event) {
//		placeMarker(event.latLng);
//	});

	start_marker.setMap(map);
	end_marker.setMap(map);

//	google.maps.event.addListener(marker, 'click', function() {
//	//	infowindow.open(map, marker);
//		// Zoom to 9 when clicking on marker
//		map.setZoom(9);
//		map.setCenter(marker.getPosition());
//	});

	/*
	 * google.maps.event.addListener(map,'center_changed',function() { // 3
	 * seconds after the center of the map has changed, pan back to the marker
	 * window.setTimeout(function() { map.panTo(marker.getPosition()); },3000);
	 * });
	 */
}

function placeMarker(location) {
		marker.setPosition(location);
		var infowindow = new google.maps.InfoWindow({
			content : 'Latitude: ' + location.lat() + '<br>Longitude: '
					+ location.lng()
		});
	// infowindow.open(map, marker);
}

// Add a Home control that returns the user to London
function HomeControl(controlDiv, map) {
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.backgroundColor = 'yellow';
	controlUI.style.border = '1px solid';
	controlUI.style.cursor = 'pointer';
	controlUI.style.textAlign = 'center';
	controlUI.title = 'Set map to London';
	controlDiv.appendChild(controlUI);
	var controlText = document.createElement('div');
	controlText.style.fontFamily = 'Arial,sans-serif';
	controlText.style.fontSize = '12px';
	controlText.style.paddingLeft = '4px';
	controlText.style.paddingRight = '4px';
	controlText.innerHTML = '<b>Home<b>'
	controlUI.appendChild(controlText);

	// Setup click-event listener: simply set the map to London
	google.maps.event.addDomListener(controlUI, 'click', function() {
		map.setCenter(danang)
	});
}

google.maps.event.addDomListener(window, 'load', initialize);