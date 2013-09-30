jQuery(document).ready(function($){
	$('#slider').nivoSlider({
		effect: 	'fade',
		animSpeed: 	500,
		pauseTime: 5000,
		pauseOnHover: 1,
		manualAdvance: 0, // Disable pause time!!!
		directionNav: 1,
		controlNav: 1,
		// controlNavThumbs: false,
		prevText: 	'<span class="icon-double-angle-left"></span>',
		nextText: 	'<span class="icon-double-angle-right"></span>',
	});
});
