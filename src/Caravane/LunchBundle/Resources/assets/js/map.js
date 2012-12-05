var lunchMap={}

var map;
var myPositionMarker;
var infowindow;
var lunchMarkers=Array();

lunchMap.getMap=function() {
	return cMap;
}
lunchMap.init=function() {
	infowindow = new google.maps.InfoWindow;
	lunchMap.resizeMap('map_main_canvas');
	
//	lunchMap.setClientPosition('map_main_canvas');
}


lunchMap.resizeMap=function(mapCanvas) {
	var h= $(window).height()-$('#header').height()-$('#footer').height();
	var w= $('#lunchesMapContainer').width();
	$('#'+mapCanvas).height(h);	
	$('#'+mapCanvas).width(w);	
}


lunchMap.setClientPosition=function(map) {
	cMap=map;
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			lunchMap.setMyPosition(map,pos);
           /* to use ??????? 
            * 
            * 
            * lunchMap.codeLatLng(map,pos);
            */ 
            lunch.getLunches(map,pos,lunchMap.getBoundaries(map));
            
          }, function() {
            handleNoGeolocation(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }
}

lunchMap.setMyPosition=function(map,pos) {
	myPositionMarker = new google.maps.Marker({
		position: pos,
		map: map,
		title:"You are here"
	});
	map.setCenter(pos);
	google.maps.event.addListener(map, 'idle', function() {
	    lunch.getLunches(map,pos,lunchMap.getBoundaries(map));
	});
	/*google.maps.event.addListener(map, 'center_changed', function() {
	    lunch.getLunches(map,pos,lunchMap.getBoundaries(map));
	});
	google.maps.event.addListener(map, 'zoom_changed', function() {
	    lunch.getLunches(map,pos,lunchMap.getBoundaries(map));
	});
	*/
}

lunchMap.codeLatLng =function(map,pos) {
  	cMap=map;
	geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
   geocoder.geocode({'latLng': pos}, function(results, status) {
    /* Si le géocodage inversé a réussi */
    if (status == google.maps.GeocoderStatus.OK) {
     if (results[1]) {
     
      /* Affichage de l'infowindow sur le marker avec l'adresse récupérée */
     alert(results[1].formatted_address);
      infowindow.setContent(results[1].formatted_address);
      infowindow.open(map, marker);
     }
    } else {
     alert("Le geocodage a echoue pour la raion suivante : " + status);
    }
   });
  }

lunchMap.setLunch=function(map,name,lat,lng,id,content,category) {
	
	cMap=map;
	var pos = new google.maps.LatLng(lat,lng);
	var image='/assets/icons/restaurant_'+category+'.png';
	var marker = new google.maps.Marker({
	      position: pos,
	      map: map,
	      title:name,
	      icon: image
	  });

	
	google.maps.event.addListener(marker, 'click', function() {
		
		infowindow.setContent(content);
		infowindow.open(map, marker);

	});
/*
	google.maps.event.addListener(marker, 'click', function() {
	 var boxText = document.createElement("div");
        boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: yellow; padding: 5px;";
        boxText.innerHTML = "City Hall, Sechelt<br>British Columbia<br>Canada";
        
        var ib = new InfoBox(myOptions);
        ib.open(theMap, marker);
     });   
     */
	lunchMarkers[id]=marker;
	return marker;
}


lunchMap.getBoundaries=function(map) {
	var boundaries = {};
	var bounds = map.getBounds();
	var sw = bounds.getSouthWest();
	var ne = bounds.getNorthEast();
	
	boundaries.s = sw.lat();
	boundaries.w = sw.lng();
	boundaries.n = ne.lat();
	boundaries.e = ne.lng();
	
	return boundaries.n+','+boundaries.e+','+boundaries.s+','+boundaries.w;
}
  
$(window).resize(function() {
	console.log('resizing ');
	lunchMap.resizeMap('map_main_canvas');
});
