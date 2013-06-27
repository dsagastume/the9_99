$(document).ready(function(e) {

$(".exhibition_nav a").click(function() {
	var toLoad = $(this).attr("name");
	if ($(".selected").length == 0) {
		$("." + toLoad).fadeIn("fast").addClass("selected");
	}
	else {
		$(".selected").fadeOut("fast", function() {
			$("." + toLoad).fadeIn("fast").addClass("selected");
		}).removeClass("selected");
	}
});


$(".artist_nav a").click(function() {
	var toLoad = $(this).html();
	if ($(".selected").length == 0) {
		$("." + toLoad).fadeIn("fast").addClass("selected");
	}
	else {
		$(".selected").fadeOut("fast", function() {
			$("." + toLoad).fadeIn("fast").addClass("selected");
		}).removeClass("selected");
	}
});

$(".works nav a").click(function() {
	var index = $(".works nav a").index(this);
//	alert(index);
	$(".artist").fadeOut("fast", function() {
		$(".work").eq(index).fadeIn("fast", function() {
			$(".works_list_wrapper").fadeIn("fast");
		}).addClass("selected_work");
	});
});

$(".back").click(function() {
	$(".work").fadeOut("fast", function() {
		$(".selected_work").removeClass("selected_work");
		$(".works_list_wrapper").fadeOut("fast", function() {
			$(".artist").fadeIn("fast");
		});
	});
});

$(".prev").click(function() {
	var index = $(".selected_work").index();
	var length = $(".work").length - 1;
	if (index == 0) {
		$(".selected_work").fadeOut("fast", function() {
			$(".work").eq(length).fadeIn("fast").addClass(" selected_work");
		}).removeClass("selected_work");
	}
	else {
		$(".selected_work").fadeOut("fast", function() {
			$(".work").eq(index - 1).fadeIn("fast").addClass(" selected_work");
		}).removeClass("selected_work");		
	}
//	alert(index + " " + length);
	
});

$(".next").click(function() {
	var index = $(".selected_work").index();
	var length = $(".work").length - 1;
	if (index == length) {
		$(".selected_work").fadeOut("fast", function() {
			$(".work").eq(0).fadeIn("fast").addClass(" selected_work");
		}).removeClass("selected_work");
	}
	else {
		$(".selected_work").fadeOut("fast", function() {
			$(".work").eq(index + 1).fadeIn("fast").addClass(" selected_work");
		}).removeClass("selected_work");		
	}
//	alert(index + " " + length);
	
});

	$("#nav_toggle").click(function() {
		//alert("omg");
		if ($(".toggleOn").length == 1) {
			$("#header nav").css("display", "none").removeClass("toggleOn");
		}
		else {
			$("#header nav").css("display", "block").addClass("toggleOn");
		}
	});

	$(window).resize(function() {
		if(Modernizr.mq('screen and (min-width:721px)')) {
            // action for screen widths including and above 768 pixels 
			$("#header nav").css("display", "block");
        }
		else if(Modernizr.mq('screen and (max-width:720px)')) {
            // action for screen widths below 768 pixels 
			$("#header nav").css("display", "none");			
        }
		
	});
	
	if ($("#map").length == 1) {
		var mapCanvas = document.getElementById('map');
		var latLng = new google.maps.LatLng(14.638255,-90.515451);
		var mapOptions = {
		  center: latLng,
		  zoom: 16,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(mapCanvas, mapOptions);
		
		var markerShadow = {
			url: 'marker_shadow.png',
			anchor: new google.maps.Point(20, 65)
		};
	
		var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			icon: 'marker.png',
//			shadow: markerShadow
		});
	}



});

