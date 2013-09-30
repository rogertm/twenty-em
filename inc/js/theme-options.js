jQuery(document).ready(function($){
	var form_header = $('#header-options'),
		filters = form_header.find('.header-extend');
	filters.hide();
	form_header.find('.head-radio-option').change(function() {
		filters.slideUp('fast').removeClass('selected-option');
		switch ( $(this).val() ) {
			case 'header-image': $('#header-image').slideDown(); break;
			case 'slider': $('#slider').slideDown(); break;
			case 'static-header': $('#static-header').slideDown(); break;
		}
	});
});

	jQuery(document).ready(function($){
		var form_slider_script = $('#slider-scripts-options'),
			filters = form_slider_script.find('.slider-script-extend');
		filters.hide();
		form_slider_script.find('.slider-script-option').change(function(){
			filters.slideUp('fast').removeClass('selected-option');
			switch ( $(this).val() ) {
				case 'slider-nivo-slider': $('#slider-nivo-slider').slideDown(); break;
				case 'slider-bootstrap-carousel': $('#slider-bootstrap-carousel').slideDown(); break;
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

jQuery(document).ready(function($) {
	var form_front_page = $('#front-page-options'),
		filters = form_front_page.find('.front-page-extend');
		filters.hide();
	form_front_page.find('.head-radio-option').change(function() {
		filters.slideUp('fast').removeClass('selected-option');
		switch ( $(this).val() ) {
			case 'wp-front-page': $('#wp-front-page').slideDown(); break;
			case 'widgets-front-page': $('#widgets-front-page').slideDown(); break;
		}
	});
});

jQuery(document).ready(function($){
	var form_table = $('#t-em-setting'),
		filters = form_table.find('td');
		filters.addClass('table-content');
		$('#t-em-setting tr:eq(0)').addClass('general-option full-option');
		$('#t-em-setting tr:eq(1)').addClass('header-option full-option');
		$('#t-em-setting tr:eq(2)').addClass('front-page-option full-option');
		$('#t-em-setting tr:eq(3)').addClass('archive-option full-option');
		$('#t-em-setting tr:eq(4)').addClass('layout-option full-option');
		$('#t-em-setting tr:eq(5)').addClass('social-network-option full-option');
		$('#t-em-setting tr:eq(6)').addClass('webmaster-tools-option full-option');
	filters.hide();
	$('#t-em-setting th').click(function(){
		$(this).toggleClass('selected').next().slideToggle('fast');
		return false;
	});

	var full_option = $('.full-option');
		$(full_option).after('<tr class="empty-option">&nbsp;</tr>');
});
