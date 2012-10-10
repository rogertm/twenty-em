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
 * Register Style Sheet to beautify the admin option page
 */
add_action( 'admin_init', 't_em_admin_css_style_stylesheet' );
add_action( 'admin_init', 't_em_admin_javascript_script' );
function t_em_admin_css_style_stylesheet(){
	// Check the theme version right from the style sheet
	$style_data = wp_get_theme();
	$style_version = $style_data->display('Version');

	wp_register_style( 'style-admin-t-em', get_template_directory_uri() . '/inc/theme-options.css', false, $style_version, 'all' );
	wp_enqueue_style( 'style-admin-t-em' );
}

function t_em_admin_javascript_script(){
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'script-admin-t-em', get_template_directory_uri() . '/inc/theme-options.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'script-admin-t-em' );
}

/**
 * Register Style Sheet and Javascript to beautify the Twenty'em theme
 */
function t_em_javascript_scripts(){
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_register_script( 'modernizr', get_template_directory_uri().'/js/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );
	wp_register_script( 'ggs', get_template_directory_uri().'/js/ggs.js', array(), '1.01', false );
	wp_enqueue_script( 'ggs' );
}
add_action( 'wp_enqueue_scripts', 't_em_javascript_scripts' );

function t_em_css_style_stylesheet(){
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 't_em_css_style_stylesheet' );
?>
