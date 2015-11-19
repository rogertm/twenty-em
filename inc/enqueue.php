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
	global	$t_em,
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

	// Register Carousel Twitter Bootstrap Plugins when needed
	if ( 'slider' == $t_em['header_set'] ) :
		t_em_register_bootstrap_plugin( 'carousel.js', 'script.slider.js', T_EM_THEME_DIR_JS_URL . '/script.slider.js' );
	endif;

	// Register Collapse Twitter Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-collapsible-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.js' );
	endif;
	if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'navigation-menu' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.js' );
	endif;

	// Register Tab Twitter Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-tabbable-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'tab.js', 'script.tabbable.js', T_EM_THEME_DIR_JS_URL . '/script.tabbable.js' );
	endif;
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );

/**
 * Register and Enqueue Bootstrap jQuery Plugins
 *
 * @param $plugin Required. String. Plugin name and extension (IE: transition.js)
 * @param $script Optional. String. Additional script if needed by the pluggin
 * @param $script_src Optional. String. Required if $script, the $script source address
 * @param $transition Optional. Bool. Enqueue transition.js Bootstrap plugin for simple transition effects
 * @param $in_footer Optional. Bool. If true, the script is placed before the </body> end tag
 *
 * @since Twenty'em 1.0
 */
function t_em_register_bootstrap_plugin( $plugin, $script = '', $script_src = '', $transition = true, $in_footer = false ){
	global $t_em_theme_data;
	/**
	 * Filter the list of dependencies for the current Bootstrap jQuery Plugin
	 *
	 * @param array An array of dependencies
	 * @since Twenty'em 1.0
	 */
	$deps = apply_filters( 't_em_filter_bootstrap_plugin_deps', array( 'jquery' ) );
	if ( $transition ) :
		$transition = 'transition.js';
		array_push( $deps, $transition );
		wp_register_script( 'transition.js', T_EM_THEME_DIR_JS_URL.'/bootstrap/transition.js', array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
	endif;
	wp_register_script( $plugin, T_EM_THEME_DIR_JS_URL.'/bootstrap/'.$plugin, $deps, $t_em_theme_data['Version'], $in_footer );
	wp_enqueue_script( $plugin );
	if ( $script ) :
		wp_register_script( $script, $script_src, array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
		wp_enqueue_script( $script );
	endif;
}

/**
 * Load the html5 shiv for IE8 and below.
 */
function t_em_load_html5shiv(){
	echo '<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->' . "\n";
}
add_action( 'wp_head', 't_em_load_html5shiv' );

/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	global $t_em;
?>
<style type="text/css" media="all">
	.wrapper{
		max-width: <?php echo $t_em['layout_width']; ?>px !important;
	}
</style>
<?php
}

/**
 * Add Twitter Bootstrap meta on the <head> tag. Note that we use Bootstrap in LESS form, this make
 * it mush more customizable.
 *
 * @since Twenty'em 1.0
 */
function t_em_bootstrapped_head(){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">'."\n";
	echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS_URL .'/bootstrap/bootstrap.min.less">'."\n";
}
add_action( 'wp_head', 't_em_bootstrapped_head', 15 );

/**
 * Enqueue LESS Style for the theme
 *
 * @since Twenty'em 1.0
 */
function t_em_enqueue_less_css(){
	echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS_URL.'/style.less' .'">'."\n";

}
add_action( 'wp_head', 't_em_enqueue_less_css', 20 );

/**
 * Enqueue LESS Javascript for the theme
 *
 * @since Twenty'em 1.0
 */
function t_em_enqueue_less_js(){
	echo '<script src="'. T_EM_THEME_DIR_JS_URL.'/less.js'.'" type="text/javascript"></script>'."\n";
}
add_action( 'wp_head', 't_em_enqueue_less_js', 30 );

/**
 * Loads IcoMoon javascript supports to IE 7 and IE 6...
 */
function t_em_enqueue_icomoon(){
	echo '<!--[if lt IE 7]><script src="<?php echo T_EM_THEME_DIR_JS_URL; ?>/icomoon.lte-ie7.js" type="text/javascript"></script><![endif]-->'."\n";
}
add_action( 'wp_head', 't_em_enqueue_icomoon' );
?>
