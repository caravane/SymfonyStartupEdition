var lunchmap={}
var map;
var infowindow;
var pos;
var myPos;

var mapZoom = 17;

var request;
var options;
var service;
var infowindow;

var place;

var markersArray = [];
var meMarker;

lunchmap.initialize=function() {
	if($('#map').size()==0) {
		return null;	
	}
	var myOptions = {
		zoom : mapZoom,
		mapTypeControl: true,
	    mapTypeControlOptions: {
	      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	      
	    },
	    panControl: true,
	    panControlOptions: {
	        position: google.maps.ControlPosition.RIGHT_CENTER
	    },
	    zoomControl: true,
	    zoomControlOptions: {
	      style: google.maps.ZoomControlStyle.SMALL,
	      position: google.maps.ControlPosition.RIGHT_CENTER
	    },
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map'), myOptions);
	service = new google.maps.places.PlacesService(map);
	var input = document.getElementById('addressSearch');
	var autocomplete = new google.maps.places.Autocomplete(input);

	autocomplete.bindTo('bounds', map);
	// Try HTML5 geolocation
	resetPosition();
	
	
	
	
	
      
      
      
	google.maps.event.addListener(map, 'idle', function() {
		pos = map.getCenter();
		/*
		 * 
		 * 
		 * setRequest();
		 * 
		 * 
		 */
		lunch.getLunches(pos);
		
	});
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		//infowindow.close();
		var place = autocomplete.getPlace();
		if(place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			setRequest();
			setPos();
			/*
			request = {
			location : place.geometry.location,
			radius : 500,
			types : ['restaurant', 'bar', 'cafe']
			};

			var service = new google.maps.places.PlacesService(map);
			service.search(request, callback);

			map.setCenter(place.geometry.location);
			map.setZoom(mapZoom);
			*/
			// Why 17? Because it looks good.
		}

		/*  var image = new google.maps.MarkerImage(
		place.icon,
		new google.maps.Size(71, 71),
		new google.maps.Point(0, 0),
		new google.maps.Point(17, 34),
		new google.maps.Size(35, 35));
		*/
		//    marker.setIcon(image);
		//     marker.setPosition(place.geometry.location);

		var address = '';
		pos = place.geometry.location;
		myPos=pos;
		
		if(place.address_components) {
			address = [(place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')].join(' ');
		}

		//	infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		/*infowindow = new google.maps.InfoWindow({
		 map : map,
		 position : pos,
		 content : '<strong>' + place.name + '</strong><br>' + address
		 });
		 */

		meMarker.setPosition(myPos);
		map.setCenter(myPos);
		/*
		meMarker = new google.maps.Marker({
		map : map,
		position : pos,
		icon : 'http://luncharoundme.local/assets/icons/you-are-here.png',
		title: "You are here"
		});
		*/
		// infowindow.open(map, marker);

		//lunch.getLunches(place.geometry.location);
		// markerCluster = new MarkerClusterer(map, gmarkers);

	});
}

lunchmap.resize=function() {
	$('#map').height($(window).height()-$('#footer').height()-$('#header').height());
	$('#map').css('margin-top',$('#header').height());
}
    
    
function handleNoGeolocation(errorFlag) {
	if(errorFlag) {
		var content = 'Error: The Geolocation service failed.';
	} else {
		var content = 'Error: Your browser doesn\'t support geolocation.';
	}

	var options = {
		map : map,
		position : new google.maps.LatLng(60, 105),
		content : content
	};

	var infowindow = new google.maps.InfoWindow(options);

	map.setCenter(options.position);
}

function callback(results, status) {

	if(status == google.maps.places.PlacesServiceStatus.OK) {
		for(var i = 0; i < results.length; i++) {
			createMarker(results[i]);
		}
	}
}

function createMarker(place) {

	//alert(markersArray);
	var tId = place.geometry.location;
	//console.log(place.id);
	if( tId in  oc(markersArray)) {
	} else {
		markersArray.push(tId);
		console.log(":" + tId);
		var placeLoc = place.geometry.location;

		var marker = new google.maps.Marker({
			map : map,
			position : place.geometry.location,
			icon : 'http://luncharoundme.local/assets/icons/symbol_inter.png'
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.close();
			infowindow.setContent(place.name);
			infowindow.open(map, this);
		});
	}
}

function createLocalMarker(lat, lng, name, lunch, iconUrl) {
	var tPos = new google.maps.LatLng(lat, lng);
	var tId = tPos;
	if( tId in  oc(markersArray)) {
	} else {
		markersArray.push(tId);
		console.log("=" + tId);
		var marker = new google.maps.Marker({
			position : tPos,
			map : map,
			icon : iconUrl
		});
		//marker.set("lunchId", "point");
		//google.maps.Map.prototype.addMarker(marker);
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.close();
			infowindow.setContent(lunch + "<br/>" + name);
			infowindow.open(map, this);
		});
		return marker;
	}
}

function setRequest() {
	request = {
		location : pos,
		radius : 500,
		types : ['restaurant', 'bar', 'cafe']
	};

	service.search(request, callback);
}

function setPos() {

	map.setCenter(pos);

	lunch.setMarkers();

}

function setCenter(lat, lng) {
	pos = new google.maps.LatLng(lat, lng);
	setPos();
}

function oc(a) {
	var o = {};
	for(var i = 0; i < a.length; i++) {
		o[a[i]] = '';
	}
	return o;
}


function resetPosition() {
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			myPos=pos;
			
			/*	infowindow = new google.maps.InfoWindow({
			 map : map,
			 position : pos,
			 content : 'You are here'
			 });
			 */
			meMarker = new google.maps.Marker({
				map : map,
				position : pos,
				icon : 'http://luncharoundme.local/assets/icons/you-are-here.png'
			});
/*             find other restatuarants
 * 
 * setRequest();
 * 
 * 
 */
		
			setPos();
			/*
			 request = {
			 location : pos,
			 radius : 500,
			 types : ['restaurant', 'bar', 'cafe']
			 };

			 service = new google.maps.places.PlacesService(map);
			 service.search(request, callback);

			 map.setCenter(pos);

			 lunch.setMarkers();
			 */
		}, function() {
			handleNoGeolocation(true);
		});
	} else {
		// Browser doesn't support Geolocation
		handleNoGeolocation(false);
	}
}
google.maps.event.addDomListener(window, 'load', initialize);
