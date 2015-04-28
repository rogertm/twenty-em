jQuery(document).ready(function($) {
	$('#tabbable-list li > a:first').tab('show');
	$('#tabbable-list li > a').click(function(e){
		e.preventDefault();
		$(this).tab('show');
	})
	$('#tabbable-content .tab-pane').addClass('fade in');
});
