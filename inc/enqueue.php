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
	$options = t_em_get_theme_options();
	$options_dev = t_em_get_dev_options();
	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	wp_register_script( 'modernizr', T_EM_THEME_DIR_JS.'/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );


	// Displaye Golden Grid Systen if is set by the user
	$golden_grid_system = ! empty( $options_dev['golden-grid-system'] );
	if ( 'yes' == $golden_grid_system ) :
		wp_register_script( 'golden-grid-system', T_EM_THEME_DIR_JS.'/ggs.js', array(), '1.01', false );
		wp_enqueue_script( 'golden-grid-system' );
	endif;

	// Load JQuery Cycle just if is needed
	$header_options = $options['header-set'];
			$jquery_cycle = '';
	if ( 'slider' == $header_options ) :
		// Display JQuery Cycle Lite if is set by the user, otherwise use JQuery Cycle
		$jquery_cycle_lite = ! empty( $options_dev['jquery-cycle-lite'] );
		if ( 'yes' == $jquery_cycle_lite ) :
			wp_register_script( 'jquery-cycle-lite', T_EM_THEME_DIR_JS.'/jquery.cycle.lite.js', array( 'jquery' ), '1.6', false );
			wp_enqueue_script( 'jquery-cycle-lite' );
			$jquery_cycle = 'jquery-cycle-lite';
		else :
			wp_register_script( 'jquery-cycle-all', T_EM_THEME_DIR_JS.'/jquery.cycle.all.js', array( 'jquery' ), '2.9999.6', false );
			wp_enqueue_script( 'jquery-cycle-all' );
			$jquery_cycle = 'jquery-cycle-all';
		endif;
	endif;

	wp_register_script( 'scripts', T_EM_THEME_DIR_JS.'/scripts.js', array( 'jquery', $jquery_cycle ), '1.0', false );
	wp_enqueue_script( 'scripts' );
}
add_action( 'wp_enqueue_scripts', 't_em_javascript_scripts' );

function t_em_css_style_stylesheet(){
	$options = t_em_get_theme_options();
	$options_dev = t_em_get_dev_options();
	
	// Load JQuery Cycle style sheet just if is needed
	$header_options = $options['header-set'];
	if ( 'slider' == $header_options ) :
		wp_register_style( 'style-slider', T_EM_THEME_DIR_CSS . '/style-slider.css' );
		wp_enqueue_style( 'style-slider' );
	endif;

	wp_enqueue_style( 'style-t-em', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 't_em_css_style_stylesheet' );
?>
