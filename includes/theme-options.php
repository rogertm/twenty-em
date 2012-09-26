<?php
/**
 * Twenty'em theme options.
 *
 * @file			theme-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/includes/theme-options.php
 * @link			http://themeshaper.com/2010/06/03/sample-theme-options/
 * @since			Version 1.0
 */
?>
<?php
function t_em_admin_css_style_stylesheet(){
	// Check the theme version right from the style sheet
	$style_data = wp_get_theme();
	$style_version = $style_data->display('Version');

	wp_register_style( 'style-admin-t-em', get_template_directory_uri() . '/includes/theme-options.css', false, $style_version, 'all' );
	wp_enqueue_style( 'style-admin-t-em' );
}
add_action( 'admin_init', 't_em_admin_css_style_stylesheet' );

add_action( 'admin_menu', 't_em_theme_options' );
function t_em_theme_options(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
	
	add_menu_page( $theme_name . ' ' . __( 'Theme Options', 't_em' ), __( 'Theme Options', 't_em' ), 'edit_theme_options', 'theme-options', 't_em_theme_options_page', get_template_directory_uri() . '/images/t-em-favicon.jpg', 61 );
}
/**
 * Redirect users to Twenty'em options page after activation
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) :
	wp_redirect( 'admin.php?page=theme-options' );
endif;

function t_em_theme_options_page(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Theme Options', 't_em' ) ?></h2>
	</div><!-- .wrap -->
<?php
}
?>
