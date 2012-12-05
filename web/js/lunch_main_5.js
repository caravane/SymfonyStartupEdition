var lunch={};



$(document).ready(function() {
	lunchmap.initialize();
	lunchmap.resize();
	$(window).resize(function() {
	 	lunchmap.resize();
	});
});


