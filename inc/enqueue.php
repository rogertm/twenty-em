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
 * @link			https://themingisprose.com/twenty-em
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
// add_action( 'wp_enqueue_scripts', 't_em_enqueue_compiled_style', 5 );

/**
 * Register Style Sheet and Javascript to beautify the Twenty'em theme
 */
function t_em_enqueue_styles_and_scripts(){
	global $t_em, $t_em_theme_data;

	// Load default style sheet style.css
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri(), '', $t_em_theme_data['Version'], 'all' );

	// Get Bootstrap
/*	wp_register_style( 'bootstrap', T_EM_THEME_DIR_BOOTSTRAP_URL . '/css/bootstrap.min.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_register_style( 'bootstrap-grid', T_EM_THEME_DIR_BOOTSTRAP_URL . '/css/bootstrap-grid.min.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_register_style( 'bootstrap-reboot', T_EM_THEME_DIR_BOOTSTRAP_URL . '/css/bootstrap-reboot.min.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'bootstrap-grid' );
	wp_enqueue_style( 'bootstrap-reboot' );*/
	wp_register_style( 'bootstrap', T_EM_THEME_DIR_CSS_URL . '/style.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'bootstrap' );

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
		t_em_register_bootstrap_plugin( 'carousel.js', 'script.slider.js', T_EM_THEME_DIR_JS_URL . '/script.slider.js' );
	endif;

	// Register Collapse Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-collapsible-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.js' );
	endif;
	if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'navigation-menu' ) ) :
		t_em_register_bootstrap_plugin( 'collapse.js' );
	endif;

	// Register Tab Bootstrap Plugins when needed
	if ( is_page_template( 'page-templates/template-tabs-content.php' ) ) :
		t_em_register_bootstrap_plugin( 'tab.js', 'script.tabs.js', T_EM_THEME_DIR_JS_URL . '/script.tabs.js' );
	endif;

	// Countdown jQuery plugin for Maintenance Mode
	$nonce = ( isset( $_GET['maintenance-mode'] ) ) ? $_GET['maintenance-mode'] : null;
	// Check if the current user can see the site
	$current_user = wp_get_current_user();
	$user_can = array_intersect( t_em_maintenance_mode_role_active(), $current_user->roles );
	if ( $t_em['maintenance_mode'] == 1 && (
				! is_user_logged_in() ||
				empty( $user_can ) ||
				( isset( $_GET['maintenance-mode'] ) && wp_verify_nonce( $nonce, 'maintenance_mode' ) )
			) ) :
		wp_register_script( 'countdown', T_EM_THEME_DIR_JS_URL . '/jquery.countdown.min.js', array( 'jquery' ), $t_em_theme_data['Version'] );
		wp_enqueue_script( 'countdown' );
	endif;

	// Container Fluid
	if ( $t_em['layout_fluid_width'] == 1 ) :
		wp_register_script( 'fluid-width', T_EM_THEME_DIR_JS_URL . '/script.container-fluid.js', array( 'jquery' ), $t_em_theme_data['Version'] );
		wp_enqueue_script( 'fluid-width' );
	endif;
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );

/**
 * The Head tags
 */
function t_em_head(){
?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 't_em_head' );
?>
