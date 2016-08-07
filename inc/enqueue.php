<?php
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
 * @link			http://twenty-em.com/
 * @since 			Twenty'em 1.0
 */

/**
 * Twenty'em register scripts and styles.
 *
 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/wp_register_script
 */

/**
 * Load the compiled less file before than Child Theme
 */
function t_em_enqueue_compiled_style(){
	global $t_em_theme_data;
	$less_files = array( T_EM_THEME_DIR_CSS_PATH . '/style.less' => T_EM_THEME_DIR_CSS_URL );
	$options = array( 'compress' => true );
	wp_enqueue_style( 'style-less', t_em_lessphp_compiler( $less_files, $options ), '', $t_em_theme_data['Version'], 'all' );
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_compiled_style', 5 );

/**
 * Register Style Sheet and Javascript to beautify the Twenty'em theme
 */
function t_em_enqueue_styles_and_scripts(){
	global $t_em, $t_em_theme_data;

	// Load default style sheet style.css
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri(), '', $t_em_theme_data['Version'], 'all' );

	// Load theme layout width
	wp_enqueue_style( 't-em-width', t_em_theme_layout_width() );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	// Load the html5 shiv.
	wp_enqueue_script( 'html5-shiv', T_EM_THEME_DIR_JS_URL . '/html5.js', array(), $t_em_theme_data['Version'] );
	wp_script_add_data( 'html5-shiv', 'conditional', 'lt IE 9' );

	// Load the icomoon.js for IE 7.
	wp_enqueue_script( 'icomoon-js', T_EM_THEME_DIR_JS_URL . '/icomoon.lte-ie7.js', array(), $t_em_theme_data['Version'] );
	wp_script_add_data( 'icomoon-js', 'conditional', 'lt IE 7' );

	// Register Carousel Bootstrap Plugins when needed
	if ( 'slider' == $t_em['header_set'] ) :
		t_em_register_bootstrap_plugin( 'carousel.min.js', 'script.slider.js', T_EM_THEME_DIR_JS_URL . '/script.slider.js' );
	endif;

	// Register Collapse Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-collapsible-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.min.js' );
	endif;
	if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'navigation-menu' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.min.js' );
	endif;

	// Register Tab Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-tabs-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'tab.min.js', 'script.tabs.js', T_EM_THEME_DIR_JS_URL . '/script.tabs.js' );
	endif;
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );

/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	global $t_em;
?>
<style type="text/css" media="all">
	.wrapper{
		max-width: <?php echo $t_em['layout_width']; ?>px;
	}
</style>
<?php
}
?>
