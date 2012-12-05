var lunch={};

var sortBy='distance';
var filterBy='';
var sorting=false;

var tlunches=[];

$(document).ready(function() {
	lunch.sortList();
	lunch.filterList();
});



lunch.getLunches=function(map,pos,boundaries) {
	
	$.get(Routing.generate('lunch_list',{'zoom':map.zoom,'lat':pos.lat(),'lng':pos.lng()}),{'boundaries':boundaries,'sortBy':sortBy},function(data) {
		$('#lunchesListContainer').html(data);
		if(sorting==false) {
			lunch.setMarkers();
			lunch.sortBy();
			//lunch.filterBy();
			//lunch.sortList();
		}
	});
}
lunch.setMarkers=function() {
	map=lunchMap.getMap();
	
	$('#lunchesListContainer li div.restaurant').each(function() {
		var li=$(this).closest('li');
		var id=li.attr('data-id');
		var category=li.attr('data-category');
		var content="<b>"+li.find('.lunch').text()+"</b><br/>"+li.find('.price').text()+"<br/>"+$(this).text();
		if(!lunchMarkers[id]) {
			$(this).closest('li').marker=lunchMap.setLunch(map,$(this).text(),$(this).attr('data-lat'),$(this).attr('data-lng'),id,content,category);
		}
		$(li).click(function() {
			google.maps.event.trigger(lunchMarkers[id], 'click');
		});	
	});
	
}

lunch.sortList=function() {
	$('#lunchesListSortBy ul.dropdown-menu li a').unbind('click');
	
	$('#lunchesListSortBy ul.dropdown-menu li a').click(function() {
		$('#lunchesListSortBy ul.dropdown-menu li').removeClass('active');
		$(this).parent().addClass('active');
		sortBy=$(this).attr('data-sortby');
		lunch.sortBy();
		//$('#lunchesListContainer ul>li').tsort({attr:'data-'+sortBy});
		
	});
	
	
	
}


lunch.sortBy=function() {
	var $Ul = $('#lunchesListContainer ul');
		//$Ul.css({position:'relative',height:$Ul.height(),display:'block'});
		var iLnH;
		var $Li = $('#lunchesListContainer ul>li');
		$Li.each(function(i,el){
			var iY = $(el).position().top;
			$.data(el,'h',iY);
			if (i===1) iLnH = iY;
		});
		$Li.tsort({attr:'data-'+sortBy}).each(function(i,el){
			var $El = $(el);
			var iFr = $.data(el,'h');
			var iTo = i*iLnH;
			//$El.css({position:'absolute',top:iFr}).animate({top:iTo},500);
		});
}


lunch.filterList=function() {
	$('#lunchesListFilterBy ul.dropdown-menu li a').unbind('click');
	
	$('#lunchesListFilterBy ul.dropdown-menu li a').click(function() {
		$('#lunchesListFilterBy ul.dropdown-menu li').removeClass('active');
		$(this).parent().addClass('active');
		filterBy=$(this).attr('data-filterby');
		lunch.filterBy();
		//$('#lunchesListContainer ul>li').tsort({attr:'data-'+sortBy});
		
	});
}

lunch.filterBy=function() {
	
	var $Ul = $('#lunchesListContainer ul');
	var $Li = $('#lunchesListContainer ul>li');
	$Li.each(function() {
		if($(this).attr('data-category')!=filterBy && filterBy!='') {
			$(this).hide();
		}
		else {
			$(this).show();
		}
	}); 
}

function compare(a, b){
   return a.name - b.name;
}

