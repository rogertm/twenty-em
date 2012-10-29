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
		$('#t-em-setting tr:eq(0)').addClass('header-option full-option');
		$('#t-em-setting tr:eq(1)').addClass('archive-option full-option');
		$('#t-em-setting tr:eq(2)').addClass('layout-option full-option');
		$('#t-em-setting tr:eq(3)').addClass('slocial-network-option full-option');
	filters.hide();
	$('#t-em-setting .header-option th').click(function(){
		$(this).toggleClass('selected').next().slideToggle('fast');
		return false;
	});
	$('#t-em-setting .archive-option th').click(function(){
		$(this).toggleClass('selected').next().slideToggle('fast');
		return false;
	});
	$('#t-em-setting .layout-option th').click(function(){
		$(this).toggleClass('selected').next().slideToggle('fast');
		return false;
	});
	$('#t-em-setting .slocial-network-option th').click(function(){
		$(this).toggleClass('selected').next().slideToggle('fast');
		return false;
	});

	var full_option = $('.full-option');
		$(full_option).after('<tr class="empty-option">&nbsp;</tr>');
});

jQuery(document).ready(function($){
	setTimeout(function(){
		$(".updated").fadeOut("slow", function () {
			$(".updated").remove();
		});
	}, 3000);
});;
