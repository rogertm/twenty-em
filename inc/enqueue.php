<?php
/**
 * Twenty'em register scripts and styles.
 *
 * @file			enqueue.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/enqueue.php
 * @link			http://codex.wordpress.org/Plugin_API/Action_Reference/wp_register_script
 * @since			Version 1.0
 */
?>
<?php
/**
 * Register Style Sheet and Javascript to beautify the Twenty'em theme
 */
function t_em_enqueue_styles_and_scripts(){
	global	$t_em_theme_options,
			$t_em_dev_options;

	// Load default style sheet style.css
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri() );

	// Load theme layout width
	wp_enqueue_style( 't-em-width', t_em_theme_layout_width() );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	// Load modernizr javascript library
	$modernizr = $t_em_dev_options['modernizr'];
	if ( '1' == $modernizr ) :
		wp_register_script( 'modernizr', T_EM_THEME_DIR_JS.'/modernizr.min.2.5.3.js', array(), '2.5.3', false );
		wp_enqueue_script( 'modernizr' );
	endif;

	// Display Golden Grid Systen if is set by the user
	$golden_grid_system = $t_em_dev_options['golden-grid-system'];
	if ( '1' == $golden_grid_system ) :
		wp_register_script( 'golden-grid-system', T_EM_THEME_DIR_JS.'/ggs.js', array(), '1.01', false );
		wp_enqueue_script( 'golden-grid-system' );
		wp_register_script( 'script-ggs', T_EM_THEME_DIR_JS . '/script.ggs.js', array( 'jquery' ), '1.0', false );
		wp_register_style( 'ggs', t_em_ggs_style() );
		wp_enqueue_style( 'ggs' );
		wp_enqueue_script( 'script-ggs' );
	endif;

	// Load JQuery Cycle just if is needed
	$header_options = $t_em_theme_options['header-set'];

	if ( 'slider' == $header_options ) :
		wp_register_style( 'style-slider', T_EM_THEME_DIR_CSS . '/style-slider.css' );
		wp_enqueue_style( 'style-slider' );

		wp_register_style( 'slider-content-width', t_em_slider_content_width() );
		wp_enqueue_style( 'slider-content-width' );

		// Load JQuery Cycle Lite if is set by the user, otherwise use JQuery Cycle
		$jquery_cycle_lite = ! empty( $t_em_dev_options['jquery-cycle-lite'] );
		if ( '1' == $jquery_cycle_lite ) :
			wp_register_script( 'jquery-cycle-lite', T_EM_THEME_DIR_JS.'/jquery.cycle.lite.js', array( 'jquery' ), '1.6', false );
			wp_enqueue_script( 'jquery-cycle-lite' );
			wp_register_script( 'script-jquery-cycle-lite', T_EM_THEME_DIR_JS.'/script.jquery.cycle.lite.js', array( 'jquery', 'jquery-cycle-lite' ), '1.0', false );
			wp_enqueue_script( 'script-jquery-cycle-lite' );
		else :
			wp_register_script( 'jquery-cycle-all', T_EM_THEME_DIR_JS.'/jquery.cycle.all.js', array( 'jquery' ), '2.9999.6', false );
			wp_enqueue_script( 'jquery-cycle-all' );
			wp_register_script( 'script-jquery-cycle-all', T_EM_THEME_DIR_JS.'/script.jquery.cycle.all.js', array( 'jquery', 'jquery-cycle-all' ), '1.0', false );
			wp_enqueue_script( 'script-jquery-cycle-all' );
		endif;

	endif;

	// Load JQuery Easing if is set by the user
	$jquery_easing = ! empty( $t_em_dev_options['jquery-easing'] );
	if ( '1' == $jquery_easing ) :
		wp_register_script( 'jquery-easing', T_EM_THEME_DIR_JS.'/jquery.easing.1.3.js', array( 'jquery' ), '1.3', false );
		wp_enqueue_script( 'jquery-easing' );
	endif;

}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );

/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	global $t_em_theme_options;
	if ( !array_key_exists( 'layout-width', $t_em_theme_options ) || $t_em_theme_options['layout-width'] == '' || !is_numeric( $t_em_theme_options['layout-width'] ) ) :
		$layout_width = '960px';
	else :
		$layout_width = $t_em_theme_options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	.menu-header,
	#wrap,
	#masthead,
	#colophon,
	#branding,
	#main{
		max-width: '.$layout_width.' !important;
		margin: 0 auto;
	}
</style>'."\n";
}

/**
 * Styles the Golden Grid System to take the site width from theme options
 */
function t_em_ggs_style(){
	global $t_em_theme_options;
	if ( !array_key_exists( 'layout-width', $t_em_theme_options ) || $t_em_theme_options['layout-width'] == '' || !is_numeric( $t_em_theme_options['layout-width'] ) ) :
		$layout_width = '960px';
	else :
		$layout_width = $t_em_theme_options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	.ggs-hidden .ggs-wrapper,
	.ggs-hidden .ggs{
		display: none;
	}
	.ggs-wrapper{
		top: 0pt;
		bottom: 0pt;
		height: 100%;
		position: fixed;
		right: 0pt;
		left: 0pt;
		margin: 0pt auto;
		max-width: '.$layout_width.';
		overflow: hidden;
	}
	.ggs{
		height: 100%;
		top: 0pt;
		bottom: 0pt;
		margin: 0pt auto;
		left: -5.55556%;
		right: -5.55556%;
		position: absolute;
		max-width: 110%;
		overflow: hidden;
	}
</style>'."\n";
}

/**
 * Set in porcentage (%) the width of the elements
 * .slider-image and .slider-sumary in to the slider
 */
function t_em_slider_content_width(){
	global $t_em_theme_options;

	$total_width = ( ( array_key_exists( 'layout-width', $t_em_theme_options ) && $t_em_theme_options['layout-width'] != '' ) ? $t_em_theme_options['layout-width'] : '960' );
	$thumb_width = ( ( array_key_exists( 'slider-thumbnail-width', $t_em_theme_options ) && $t_em_theme_options['slider-thumbnail-width'] != '' ) ? $t_em_theme_options['slider-thumbnail-width'] : get_option( 'medium_size_w' ) );

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

/**
 * The "rel" element in the html returned by the function wp_enqueue_style()
 * is just like rel="stylesheet". LESS needs something else like
 * rel="stylesheet/less", so, we need do it this way. Meanwhile we are searching
 * how to do it in the right way.
 */
add_action( 'wp_head', 't_em_enqueue_less_css' );
function t_em_enqueue_less_css(){
	global $t_em_dev_options;
	if ( '1' == $t_em_dev_options['less-css'] ) :
		echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS.'/style.less' .'">'."\n";
		echo '<script src="'. T_EM_THEME_DIR_JS.'/less-1.3.0.min.js'.'"></script>'."\n";
	endif;
}

/**
 * Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions.
 * 
 * As we need the conditional comment for older
 * IE version we load html5 shiv script this way.
 */
add_action( 'wp_head', 't_em_enqueue_html5shiv' );
function t_em_enqueue_html5shiv(){
	global $t_em_dev_options;
	$html5shiv = $t_em_dev_options['html5shiv'];
	if ( '1' == $html5shiv ) :
?>
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
<?php
	endif;
}
?>
