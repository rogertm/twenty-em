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
function t_em_javascript_scripts(){
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	wp_register_script( 'modernizr', get_template_directory_uri().'/js/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );

	$options_dev = t_em_get_dev_options();
	$frameworks_ggs = ! empty( $options_dev['framework-ggs'] );
	if ( 'yes' == $frameworks_ggs ) :
		wp_register_script( 'ggs', T_EM_FUNCTIONS_DIR_JS.'ggs.js', array(), '1.01', false );
		wp_enqueue_script( 'ggs' );
	endif;
}
add_action( 'wp_enqueue_scripts', 't_em_javascript_scripts' );

function t_em_css_style_stylesheet(){
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 't_em_css_style_stylesheet' );
?>
