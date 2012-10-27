jQuery(document).ready(function($){
	$('.ggs-guide').wrapAll('<div class="ggs" />');
	$('.ggs').wrapAll('<div class="ggs-wrapper" />');

	$('#slider-wrapper').cycle({
		fx:		'scrollLeft'
	});
	$('#slider-wrapper').slideUp( 1000, 'easeOutCirc' );
});
