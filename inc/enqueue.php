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
	wp_register_script( 'modernizr', T_EM_THEME_DIR_JS.'/modernizr.js', array(), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'modernizr' );

	// Register and enqueue Twitter Bootstrap Framework
	wp_register_style( 'bootstrap', T_EM_THEME_DIR_CSS.'/bootstrap.css', '', $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_register_script( 'bootstrap', T_EM_THEME_DIR_JS.'/bootstrap.js', array( 'jquery' ), $t_em_theme_data['Version'], true );
	wp_enqueue_script( 'bootstrap' );

	// Load IcoMoon set if is set by the user
	wp_register_style( 'icomoon-style', T_EM_THEME_DIR_CSS . '/icomoon-style.css', array(), $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'icomoon-style' );

	// Load JQuery Nivo Slider just if is needed
	if ( 'slider' == $t_em_theme_options['header-set'] ) :
		wp_register_style( 'style-nivo-slider', T_EM_THEME_DIR_CSS . '/nivo-slider/nivo-slider.css', array(), $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-nivo-slider' );
		wp_register_style( 'style-nivo-slider-theme-'.$t_em_theme_options['nivo-style'].'', T_EM_THEME_DIR_CSS . '/nivo-slider/themes/'.$t_em_theme_options['nivo-style'].'/'.$t_em_theme_options['nivo-style'].'.css', array(), $t_em_theme_data['Version'], $media = 'all' );
		wp_enqueue_style( 'style-nivo-slider-theme-'.$t_em_theme_options['nivo-style'].'' );
		wp_register_script( 'nivo-slider', T_EM_THEME_DIR_JS.'/jquery.nivo.slider.pack.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'nivo-slider' );
		wp_register_script( 'script-jquery-nivo-slider', T_EM_THEME_DIR_JS.'/script.jquery.nivo.slider.js', array( 'jquery', 'nivo-slider' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'script-jquery-nivo-slider' );
	endif;

	wp_register_script( 'navigation', T_EM_THEME_DIR_JS.'/navigation.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'navigation' );
}
add_action( 'wp_enqueue_scripts', 't_em_enqueue_styles_and_scripts' );


/**
 * Get the theme width set in theme options
 */
function t_em_theme_layout_width(){
	global $t_em_theme_options;
	if ( $t_em_theme_options['layout-width'] <= '0' || !is_numeric( $t_em_theme_options['layout-width'] ) ) :
		$layout_width = '960px';
	else :
		$layout_width = $t_em_theme_options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	#wrap{
		max-width: '.$layout_width.' !important;
		margin: 0 auto;
	}
</style>'."\n";
}

/**
 * Styles the Golden Grid System to take the site width from theme options
 */
function t_em_ggs_style(){
	global $t_em_theme_options;
	if ( '0' == $t_em_theme_options['layout-width'] ) :
		$layout_width = '960px';
	else :
		$layout_width = $t_em_theme_options['layout-width'].'px';
	endif;
	echo '
<style type="text/css" media="all">
	.ggs-hidden .ggs-wrapper,
	.ggs-hidden .ggs{
		display: none;
	}
	.ggs-wrapper{
		top: 0;
		bottom: 0;
		height: 100%;
		position: fixed;
		right: 0;
		left: 0;
		margin: 0 auto;
		max-width: '.$layout_width.';
		overflow: hidden;
	}
	.ggs{
		height: 100%;
		top: 0;
		bottom: 0;
		margin: 0 auto;
		left: -5.55556%;
		right: -5.55556%;
		position: absolute;
		max-width: 110%;
		overflow: hidden;
	}
</style>'."\n";
}

/**
 * Add Twitter Bootstrap meta on the <head> tag
 */
function t_em_bootstrap_meta(){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">'."\n";
}
add_action( 'wp_head', 't_em_bootstrap_meta' );

/**
 * The "rel" element in the html returned by the function wp_enqueue_style()
 * is just like rel="stylesheet". LESS needs something else like
 * rel="stylesheet/less", so, we need do it this way.
 */
function t_em_enqueue_less_css(){
	echo '<link rel="stylesheet/less" type="text/css" href="'. T_EM_THEME_DIR_CSS.'/style.less' .'">'."\n";
	echo '<script src="'. T_EM_THEME_DIR_JS.'/less.js'.'"></script>'."\n";

}
add_action( 'wp_head', 't_em_enqueue_less_css' );

/**
 * Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions.
 */
function t_em_enqueue_html5shiv(){
?>
	<!--[if lt IE 9]>
	<script src="<?php echo T_EM_THEME_DIR_JS; ?>/html5shiv.js" type="text/javascript"></script>
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
	<script src="<?php echo T_EM_THEME_DIR_JS; ?>/icomoon.lte-ie7.js" type="text/javascript"></script>
	<![endif]-->
<?php
}
add_action( 'wp_head', 't_em_enqueue_icomoon' );
?>
