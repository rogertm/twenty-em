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
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/enqueue.php
 * @link			http://codex.wordpress.org/Plugin_API/Action_Reference/wp_register_script
 * @since			Version 0.1
 */
?>
<?php
/**
 * Register Style Sheet and Javascript to beautify the Twenty'em theme
 */
function t_em_enqueue_styles_and_scripts(){
	global	$t_em_theme_options,
			$t_em_tools_box_options,
			$t_em_theme_data;

	// Load default style sheet style.css
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri(), '', $t_em_theme_data['Version'], 'all' );

	// Load theme layout width
	wp_enqueue_style( 't-em-width', t_em_theme_layout_width(), '', $t_em_theme_data['Version'], 'all' );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	// Register and enqueue Modernizr JS
	wp_register_script( 'modernizr', T_EM_THEME_DIR_JS.'/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );

	// Display Golden Grid Systen if is set by the user
	if ( '1' == $t_em_tools_box_options['golden-grid-system'] ) :
		wp_register_script( 'golden-grid-system', T_EM_THEME_DIR_JS.'/ggs.js', array(), '1.01', false );
		wp_enqueue_script( 'golden-grid-system' );
		wp_register_script( 'script-ggs', T_EM_THEME_DIR_JS . '/script.ggs.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'script-ggs' );
		wp_register_style( 'ggs', t_em_ggs_style() );
		wp_enqueue_style( 'ggs' );
	endif;

	// Load JQuery Nivo Slider just if is needed
	if ( 'slider' == $t_em_theme_options['header-set'] ) :
		wp_register_style( 'style-nivo-slider', T_EM_THEME_DIR_CSS . '/nivo-slider/nivo-slider.css', array(), '3.2', 'all' );
		wp_enqueue_style( 'style-nivo-slider' );
		wp_register_style( 'style-nivo-slider-theme-'.$t_em_theme_options['nivo-style'].'', T_EM_THEME_DIR_CSS . '/nivo-slider/themes/'.$t_em_theme_options['nivo-style'].'/'.$t_em_theme_options['nivo-style'].'.css', array(), '3.2', $media = 'all' );
		wp_enqueue_style( 'style-nivo-slider-theme-'.$t_em_theme_options['nivo-style'].'' );
		wp_register_script( 'nivo-slider', T_EM_THEME_DIR_JS.'/jquery.nivo.slider.pack.js', array( 'jquery' ), '3.2', false );
		wp_enqueue_script( 'nivo-slider' );
		wp_register_script( 'script-jquery-nivo-slider', T_EM_THEME_DIR_JS.'/script.jquery.nivo.slider.js', array( 'jquery', 'nivo-slider' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'script-jquery-nivo-slider' );
	endif;

	wp_register_script( 'navigation', T_EM_THEME_DIR_JS.'/navigation.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'navigation' );
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
	#wrap{
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
	if ( '0' == $t_em_theme_options['layout-width'] ) :
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
		top: 0;
		bottom: 0;
		height: 100%;
		position: fixed;
		right: 0;
		left: 0;
		margin: 0 auto;
		max-width: '.$layout_width.';
		overflow: hidden;
	}
	.ggs{
		height: 100%;
		top: 0;
		bottom: 0;
		margin: 0 auto;
		left: -5.55556%;
		right: -5.55556%;
		position: absolute;
		max-width: 110%;
		overflow: hidden;
	}
</style>'."\n";
}

/**
 * The "rel" element in the html returned by the function wp_enqueue_style()
 * is just like rel="stylesheet". LESS needs something else like
 * rel="stylesheet/less", so, we need do it this way.
 */
add_action( 'wp_head', 't_em_enqueue_less_css' );
function t_em_enqueue_less_css(){
	echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS.'/style.less' .'">'."\n";
	echo '<script src="'. T_EM_THEME_DIR_JS.'/less-1.3.0.min.js'.'"></script>'."\n";

}

/**
 * Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions.
 *
 * As we need the conditional comment for older
 * IE version we load html5 shiv script this way.
 */
add_action( 'wp_head', 't_em_enqueue_html5shiv' );
function t_em_enqueue_html5shiv(){
?>
	<!--[if lt IE 9]>
	<script src="<?php echo T_EM_THEME_DIR_JS; ?>/html5.js" type="text/javascript"></script>
	<![endif]-->
<?php
}
?>
