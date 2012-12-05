var lunch={};



$(document).ready(function() {
	
});



lunch.getLunches=function(map,pos,lat,lng) {
	$.get(Routing.generate('lunch_list',{'zoom':map.zoom,'lat':lat,'lng':lng}),function(data) {
		$('#lunchesListContainer').html(data);
		$('#lunchesListContainer tr td.restaurant').each(function() {
			lunchMap.setLunch(map,$(this).text(),$(this).attr('data-lat'),$(this).attr('data-lng'));
		});
	});
}
