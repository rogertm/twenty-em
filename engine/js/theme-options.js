jQuery(document).ready(function($) {

	// Media Upload
	function t_em_upload_media( container, button ){
		var clicked_button = false;
		var container_id = false;

		$(button).click(function(event){
			event.preventDefault();
			var clicked_button = $(this);
			var button_id = $(clicked_button).attr('id');
			var container_id = $(clicked_button).siblings(container).attr('id');

			// configuration of the media manager new instance
			wp.media.frames.t_em_upload_media_frame = wp.media({
				title: t_em_l10n_admin.upm_title,
				multiple: false,
				library: {
					type: 'image',
				},
				button: {
					text: t_em_l10n_admin.upm_button,
				}
			});

			// Function used for the object selection and media manager closing
			var t_em_uploaded_media = function(){
				var selection = wp.media.frames.t_em_upload_media_frame.state().get('selection');

				// If no selection
				if (!selection) {
					return;
				}

				// iterate through selected elements
				selection.each(function(attachment){
					var file = attachment.attributes.url;
					var element = $('#'+container_id);
					$(element).val(file);

				})
			};

			// closing event for media manger
			wp.media.frames.t_em_upload_media_frame.on('close', null);
			// media selection event
			wp.media.frames.t_em_upload_media_frame.on('select', t_em_uploaded_media);
			// showing media manager
			wp.media.frames.t_em_upload_media_frame.open();

		});
	}
	t_em_upload_media( '.media-url', '.media-selector' );

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
		$(this).children('input:radio').attr({
			'checked':'checked'
		});
	});

	// Radio Images Options
	$('.radio-image').click(function(){
		$(this).addClass('radio-image-active').siblings().removeClass('radio-image-active');
	});

	// Datepicker
	$(function() {
		$( "#datepicker" ).datepicker({
			dateFormat: "yy/mm/dd",
		});
	});
});
