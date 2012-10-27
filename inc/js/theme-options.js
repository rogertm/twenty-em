jQuery(document).ready(function($){
	var form_header = $('#header-options'),
		filters = form_header.find('.header-extend');
	filters.hide();
	form_header.find('.head-radio-option').change(function() {
		filters.slideUp('fast').removeClass('selected-option');
		switch ( $(this).val() ) {
			case 'header-image': $('#header-image').slideDown(); break;
			case 'slider': $('#slider').slideDown(); break;
		}
	});
});

jQuery(document).ready(function($){
	var form_archive = $('#archive-options'),
		filters = form_archive.find('.archive-extend');
	filters.hide();
	form_archive.find('.head-radio-option').change(function(){
		filters.slideUp('fast').removeClass('selected-option');
		switch ( $(this).val() ) {
			case 'the-excerpt': $('#the-excerpt').slideDown(); break;
		}
	});
});
