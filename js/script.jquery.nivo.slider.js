jQuery(document).ready(function($){
	$('#slider').nivoSlider({
		effect: 	'fade',
		prevText: 	'<span class="icon-arrow-thin-left" aria-hidden="true"></span>',
		nextText: 	'<span class="icon-arrow-thin-right" aria-hidden="true"></span>',
	});
	$('#nivo-slider .nivo-control').wrap('<span class="icon-dot" aria-hidden="true" />');
});
