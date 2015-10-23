jQuery(document).ready(function($) {
	$('#t-em-setting .form-table tr').addClass('panel');
	$('#t-em-setting .panel th').addClass('panel-heading');
	$('#t-em-setting .panel td').addClass('panel-body');

	// Accordion
	$(function() {
		$( "#t-em-setting" ).accordion({
			collapsible: true,
			active: false,
			header: '.panel-heading',
			heightStyle: 'content',
		});
	});

	// Tabs
	$(function() {
		$( ".tabs" ).tabs({
			hide: true
		});
	});

	// Active Tabs
	$('.tabs .tab-heading').click(function(){
		$(this).children('input').attr({
			'checked':'checked'
		});
	});

	// Radio Images Options
	$('.radio-image').click(function(){
		$(this).addClass('radio-image-active').siblings().removeClass('radio-image-active');
	});
});
