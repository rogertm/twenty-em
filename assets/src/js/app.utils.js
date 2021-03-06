/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.2
 */

 /**
  * JavaScripts for Twenty'em WordPress Framework
  */
jQuery(document).ready(function($){
	// Bootstrap Tabs
	if ( $().tab ){
		$('.tab-content .tab-pane.active').addClass('show');
	}

	// Bootstrap Carousel
	if ( $().carousel ){
		$('.carousel-indicators li').first().addClass('active');
		$('.carousel-inner .carousel-item').first().addClass('active');
		$('.carousel').carousel();
	}

	// Bootstrap Tooltips
	$('[data-toggle="tooltip"]').tooltip();

	// Bootstrap Popover
	$('[data-toggle="popover"]').popover();

	// Countdown timer in Maintenance Mode
	$(function(){
		if ( ! t_em_l10n.maintenanceMode ) return;
		// @TODO: This send a warning!
		$("#countdowntimer").countdowntimer({
			dateAndTime : t_em_l10n.countdownTimer + " 00:00:00",
			displayFormat : "DHMS",
			labelsFormat : true,
		});
	});
});
