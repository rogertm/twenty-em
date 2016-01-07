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
 * Loads IcoMoon javascript supports to IE 7 and IE 6...
 */
function t_em_enqueue_icomoon(){
	echo '<!--[if lt IE 7]><script src="<?php echo T_EM_THEME_DIR_JS_URL; ?>/icomoon.lte-ie7.js" type="text/javascript"></script><![endif]-->'."\n";
}
add_action( 'wp_head', 't_em_enqueue_icomoon' );
?>
