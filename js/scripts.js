jQuery(document).ready(function($){
	$('.ggs-guide').wrapAll('<div class="ggs" />');
	$('#ggs-baseline-container').wrapAll('<div class="ggs" />');
	$('#slider-wrapper').cycle({
		fx:		'scrollLeft',
		pause:	1,
	});
});
