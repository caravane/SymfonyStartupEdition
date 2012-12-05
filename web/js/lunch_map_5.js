var lunchMap={}


lunchMap.init=function() {
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
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

            /*var infowindow = new google.maps.InfoWindow({
              map: map,
              position: pos,
              content: 'Location found using HTML5.'
            });*/
            
            var marker = new google.maps.Marker({
      position: pos,
      map: map,
      title:"You are here"
  });

            map.setCenter(pos);
           /* to use ??????? 
            * 
            * 
            * lunchMap.codeLatLng(map,pos);
            */ 
            lunch.getLunches(map,pos,position.coords.latitude,position.coords.longitude);
            
          }, function() {
            handleNoGeolocation(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }
}


lunchMap.codeLatLng =function(map,pos) {
  
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

lunchMap.setLunch=function(map,name,lat,lng) {
	var pos = new google.maps.LatLng(lat,lng);
	 var marker = new google.maps.Marker({
	      position: pos,
	      map: map,
	      title:name
	  });
}
  
$(window).resize(function() {
	console.log('resizing ');
	lunchMap.resizeMap('map_main_canvas');
});
