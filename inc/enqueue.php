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
function t_em_enqueue_styles_and_scripts(){
	$options = t_em_get_theme_options();
	$options_dev = t_em_get_dev_options();

	// Load default style sheet style.css
	wp_enqueue_style( 'style-t-em', get_stylesheet_uri() );

	// Load theme layout width
	wp_enqueue_style( 't-em-width', t_em_theme_layout_width() );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
		wp_enqueue_script( 'comment-reply' );
	endif;

	wp_register_script( 'modernizr', T_EM_THEME_DIR_JS.'/modernizr.min.2.5.3.js', array(), '2.5.3', false );
	wp_enqueue_script( 'modernizr' );


	// Display Golden Grid Systen if is set by the user
	$golden_grid_system = ! empty( $options_dev['golden-grid-system'] );
	if ( '1' == $golden_grid_system ) :
		wp_register_script( 'golden-grid-system', T_EM_THEME_DIR_JS.'/ggs.js', array(), '1.01', false );
		wp_enqueue_script( 'golden-grid-system' );
		wp_register_script( 'scripts', T_EM_THEME_DIR_JS . '/scripts.js', array( 'jquery' ), '1.0', false );
		wp_register_style( 'ggs', t_em_ggs_style() );
		wp_enqueue_style( 'ggs' );
	endif;

	// Load JQuery Cycle just if is needed
	$header_options = $options['header-set'];
	//~ $jquery_cycle = '';
	if ( 'slider' == $header_options ) :
		wp_register_style( 'style-slider', T_EM_THEME_DIR_CSS . '/style-slider.css' );
		wp_enqueue_style( 'style-slider' );

		// Display JQuery Cycle Lite if is set by the user, otherwise use JQuery Cycle
		$jquery_cycle_lite = ! empty( $options_dev['jquery-cycle-lite'] );
		if ( '1' == $jquery_cycle_lite ) :
			wp_register_script( 'jquery-cycle-lite', T_EM_THEME_DIR_JS.'/jquery.cycle.lite.js', array( 'jquery' ), '1.6', false );
			wp_enqueue_script( 'jquery-cycle-lite' );
			$jquery_cycle = 'jquery-cycle-lite';
		else :
			wp_register_script( 'jquery-cycle-all', T_EM_THEME_DIR_JS.'/jquery.cycle.all.js', array( 'jquery' ), '2.9999.6', false );
			wp_enqueue_script( 'jquery-cycle-all' );
			$jquery_cycle = 'jquery-cycle-all';
		endif;

		// Display JQuery Easing if is set by the user
		$jquery_easing = ! empty( $options_dev['jquery-easing'] );
		if ( '1' == $jquery_easing ) :
			wp_register_script( 'jquery-easing', T_EM_THEME_DIR_JS.'/jquery.easing.1.3.js', array( 'jquery' ), '1.3', false );
			wp_enqueue_script( 'jquery-easing' );
		endif;

		wp_register_script( 'scripts', T_EM_THEME_DIR_JS.'/scripts.js', array( 'jquery', $jquery_cycle, 'jquery-easing' ), '1.0', false );
	endif;

	wp_enqueue_script( 'scripts' );
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );

/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	$options = t_em_get_theme_options();
	if ( !array_key_exists( 'layout-width', $options ) || $options['layout-width'] == '' || !is_numeric( $options['layout-width'] ) ) :
		$layout_width = '100%';
	else :
		$layout_width = $options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	#access .menu-header,
	div.menu,
	#colophon,
	#branding,
	#main,
	#wrapper{
		max-width: '.$layout_width.' !important;
	}
</style>'."\n";
}

/**
 * Styles the Golden Grid System to take the site width from theme options
 */
function t_em_ggs_style(){
	$options = t_em_get_theme_options();
	if ( !array_key_exists( 'layout-width', $options ) || $options['layout-width'] == '' || !is_numeric( $options['layout-width'] ) ) :
		$layout_width = '100%';
	else :
		$layout_width = $options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	.ggs-hidden .ggs-wrapper,
	.ggs-hidden .ggs{
		display: none;
	}
	.ggs-wrapper{
		top: 0pt;
		bottom: 0pt;
		height: 100%;
		position: fixed;
		right: 0pt;
		left: 0pt;
		margin: 0pt auto;
		max-width: '.$layout_width.';
		overflow: hidden;
	}
	.ggs{
		height: 100%;
		top: 0pt;
		bottom: 0pt;
		margin: 0pt auto;
		left: -5.55556%;
		right: -5.55556%;
		position: absolute;
		max-width: 110%;
		overflow: hidden;
	}
</style>'."\n";
}

?>
