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
 * @link			http://codex.wordpress.org/Settings_API
 * @since			Version 1.0
 */
?>
<?php
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

		<div class="dashboard-options-wrap">

			<div id="header-option" class="option-wrapper">
				<div class="option-name">
					<h3><?php _e( 'Header Options', 't_em' ); ?></h3>
				</div><!-- .option-name -->
				<div class="option-holder">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
				</div><!-- .option-holder -->
			</div><!-- #header-option -->

			<div id="archive-option" class="option-wrapper">
				<div class="option-name">
					<h3><?php _e( 'Archive Options', 't_em' ); ?></h3>
				</div><!-- .option-name -->
				<div class="option-holder">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
				</div><!-- .option-holder -->
			</div><!-- #archive-option -->

			<div id="layout-option" class="option-wrapper">
				<div class="option-name">
					<h3><?php _e( 'Layout Options', 't_em' ); ?></h3>
				</div><!-- .option-name -->
				<div class="option-holder">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
				</div><!-- .option-holder -->
			</div><!-- #layout-option -->

			<div id="socialnetwork-option" class="option-wrapper">
				<div class="option-name">
					<h3><?php _e( 'Social Network Options', 't_em' ); ?></h3>
				</div><!-- .option-name -->
				<div class="option-holder">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris. Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.</p>
				</div><!-- .option-holder -->
			</div><!-- #socialnetwork-option -->

		</div><!-- .dashboard-options-wrap -->

	</div><!-- .wrap -->
<?php
}
?>
