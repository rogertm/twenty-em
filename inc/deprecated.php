<?php
/**
 * Twenty'em deprecated functions.
 *
 * @file			deprecated.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/functions.php
 * @link			N/A
 * @since			Version 1.0
 */

/**
 * Set in porcentage (%) the width of the elements
 * .slider-image and .slider-sumary in to the slider
 */
function t_em_slider_content_width(){
	global $t_em_theme_options;

	$total_width = ( ( $t_em_theme_options['layout-width'] != '' ) ? $t_em_theme_options['layout-width'] : '960' );
	$thumb_width = ( ( $t_em_theme_options['slider-thumbnail-width'] != '' ) ? $t_em_theme_options['slider-thumbnail-width'] : get_option( 'medium_size_w' ) );

	$slider_img_w = $total_width / $thumb_width;
	if ( 'slider-thumbnail-full' != $t_em_theme_options['slider-thumbnail'] ) :
		// Get .slider-image width %
		$slider_img_p = 100 / $slider_img_w;
		// Get .slider-sumary width %
		$slider_sum_p = 100 - $slider_img_p;
	else :
		$slider_img_p = 100;
		$slider_sum_p = 100;
	endif;

	echo '
<style type="text/css" media="all">
	#slider-wrapper .slider-image{
		width: '.$slider_img_p.'%;
	}
	#slider-wrapper .slider-sumary{
		width: '.$slider_sum_p.'%;
	}
</style>'."\n";
}
?>
