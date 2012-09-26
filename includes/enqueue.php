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
 * @filesource		wp-content/themes/twenty-em/includes/enqueue.php
 * @link			http://codex.wordpress.org/Plugin_API/Action_Reference/wp_register_script
 * @since			Version 1.0
 */

function t_em_javascript_scripts(){
	wp_register_script( 'modernizr', get_template_directory_uri().'/js/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );
}
add_action( 'wp_enqueue_scripts', 't_em_javascript_scripts' );

function t_em_css_style_stylesheet(){
	// Check the theme version right from the style sheet
	$style_data = wp_get_theme();
	$style_version = $style_data->display('Version');

	wp_register_style( 'style-t-em', get_template_directory_uri().'/css/style-t-em.css', array(), $style_version, 'all' );
	wp_enqueue_style( 'style-t-em' );
}
add_action( 'wp_enqueue_scripts', 't_em_css_style_stylesheet' );
?>
