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

jQuery(document).ready(function($){
	var form_table = $('#t-em-setting'),
		filters = form_table.find('td');
		filters.addClass('table-content');
		$('#t-em-setting tr:eq(0)').addClass('primera');
		$('#t-em-setting tr:eq(1)').addClass('segunda');
		$('#t-em-setting tr:eq(2)').addClass('tercera');
		$('#t-em-setting tr:eq(3)').addClass('cuarta');
	filters.hide();
	$('#t-em-setting .primera').click(function(){
		$('.table-content').toggleClass('selected-option');
	});
	$('#t-em-setting .segunda').click(function(){
		$('.table-content').toggleClass('selected-option');
	});
	$('#t-em-setting .tercera').click(function(){
		$('.table-content').toggleClass('selected-option');
	});
	$('#t-em-setting .cuarta').click(function(){
		$('.table-content').toggleClass('selected-option');
	});
});
