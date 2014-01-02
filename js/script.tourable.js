jQuery(document).ready(function($) {
	$('#tourable-list li > a:first').tab('show');
	$('#tourable-list li > a').click(function(e){
		e.preventDefault();
		$(this).tab('show');
	})
	$('#tourable-content .tab-pane').addClass('fade in');
});
