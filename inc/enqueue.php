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
 * @since			Twenty'em 0.1
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
	wp_register_script( 'modernizr', T_EM_THEME_DIR_JS_URL.'/modernizr.js', array(), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'modernizr' );

	// Register and enqueue Twitter Bootstrap JS Plugins
	if ( 'slider' == $t_em_theme_options['header_set'] ) :
		wp_register_script( 'bootstrap-transition', T_EM_THEME_DIR_JS_URL.'/bootstrap/bootstrap-transition.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'bootstrap-transition' );
		wp_register_script( 'bootstrap-carousel', T_EM_THEME_DIR_JS_URL.'/bootstrap/bootstrap-carousel.js', array( 'jquery', 'bootstrap-transition' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'bootstrap-carousel' );
		wp_register_script( 'script-jquery-slider', T_EM_THEME_DIR_JS_URL.'/script.jquery.slider.js', array( 'jquery', 'bootstrap-carousel' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'script-jquery-slider' );
		wp_register_style( 'style-slider', T_EM_THEME_DIR_CSS_URL.'/style-slider.css', array(), $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-slider' );
	endif;

	// Load IcoMoon set if is set by the user
	wp_register_style( 'icomoon-style', T_EM_THEME_DIR_CSS_URL . '/icomoon-style.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'icomoon-style' );

	wp_register_script( 'navigation', T_EM_THEME_DIR_JS_URL.'/navigation.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'navigation' );
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );


/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	global $t_em_theme_options;
	echo '
<style type="text/css" media="all">
	.wrapper{
		max-width: '.$t_em_theme_options['layout_width'].'px !important;
	}
</style>'."\n";
}

/**
 * Add Twitter Bootstrap meta on the <head> tag. Note that we use Bootstrap in LESS form, this make
 * it mush more customizable.
 *
 * @since Twenty'em 1.0
 */
function t_em_bootstrapped_head(){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">'."\n";
	echo '<link rel="stylesheet/less" href="'. T_EM_THEME_DIR_CSS_URL .'/bootstrap.less">'."\n";
}
add_action( 'wp_head', 't_em_bootstrapped_head' );

/**
 * The "rel" element in the html returned by the function wp_enqueue_style()
 * is just like rel="stylesheet". LESS needs something else like
 * rel="stylesheet/less", so, we need do it this way.
 */
function t_em_enqueue_less_css(){
	echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS_URL.'/style.less' .'">'."\n";
	echo '<script src="'. T_EM_THEME_DIR_JS_URL.'/less.js'.'"></script>'."\n";

}
add_action( 'wp_head', 't_em_enqueue_less_css' );

/**
 * Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions.
 */
function t_em_enqueue_html5shiv(){
?>
	<!--[if lt IE 9]>
	<script src="<?php echo T_EM_THEME_DIR_JS_URL; ?>/html5shiv.js" type="text/javascript"></script>
	<![endif]-->
<?php
}
add_action( 'wp_head', 't_em_enqueue_html5shiv' );

/**
 * Loads IcoMoon javascript supports to IE 7 and IE 6... Asco!
 */
function t_em_enqueue_icomoon(){
?>
	<!--[if lt IE 7]>
	<script src="<?php echo T_EM_THEME_DIR_JS_URL; ?>/icomoon.lte-ie7.js" type="text/javascript"></script>
	<![endif]-->
<?php
}
add_action( 'wp_head', 't_em_enqueue_icomoon' );
?>
