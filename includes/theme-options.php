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
/**
 * Register setting options
 */
add_action( 'admin_init', 't_em_register_setting_options_init' );
function t_em_register_setting_options_init(){
	register_setting( 't_em_options', 't_em_theme_options', 't_em_theme_options_validate' );
}

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

/**
 * Arrays containig the options values
 */
$header_radio_options = array (
	'slideshow'		=> array (
		'value'	=> 'slideshow',
		'label'	=> __( 'Slideshow', 't_em' )
	),
	'header-image'	=> array (
		'value'	=> 'header-image',
		'label'	=> __( 'Header image', 't_em' )
	),
	'no-header-image'	=> array (
		'value'	=> 'no-header-image',
		'label'	=> __( 'No header image', 't_em' )
	)
);

function t_em_theme_options_page(){
	global $header_radio_options;
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Theme Options', 't_em' ) ?></h2>
		<?php
		if ( ! isset( $_REQUEST['settings-updated'] ) ) :
			$_REQUEST['settings-updated'] = false;
		endif;

		if ( true == $_REQUEST['settings-updated'] ) : ?>
			<div class="updated fade">
				<p><strong><?php _e( 'Options saved', 't_em' ); ?></strong>.
				<a href="<?php echo home_url() ?>"><?php _e( 'Visit site', 't_em' ); ?></a></p>
			</div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 't_em_options' ); ?>
			<?php $options = get_option( 't_em_theme_options' ); ?>
			<div class="dashboard-options-wrap">

				<div id="header-option" class="option-wrapper">
					<div class="option-name">
						<h3><?php _e( 'Header Options', 't_em' ); ?></h3>
					</div><!-- .option-name -->
					<div class="option-holder">
						<div class="option-group">
							<div class="option-header">
								<h4><?php _e( 'Header Options', 't_em' ); ?></h4>
							</div><!-- .option-header -->
							<div class="option-content">
						<?php
						if ( !isset( $checked ) )
							$checked = '';
						foreach ( $header_radio_options as $header_option ) :
							$header_option_value = $options['header-stuff'];
							if ( '' != $header_option_value ) :
								if ( $options['header-stuff'] == $header_option['value'] ) :
									$checked = "checked=\"checked\"";
								else :
									$checked = '';
								endif;
							endif;
						?>
								<label class="description">
									<input type="radio" value="<?php esc_attr_e( $header_option['value'] ); ?>" <?php echo $checked; ?> name="t_em_theme_options[header-stuff]">
									<span><?php esc_attr_e( $header_option['label'] ); ?></span>
								</label>
						<?php endforeach; ?>
							</div><!-- .option-content -->
						</div><!-- .option-group -->
					</div><!-- .option-holder -->
				</div><!-- #header-option -->

				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 't_em' ); ?>">
				</p>
			</div><!-- .dashboard-options-wrap -->

		</form>

	</div><!-- .wrap -->
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function t_em_theme_options_validate( $input ){
	global $header_radio_options;

	if ( !isset($input['header-stuff']) )
		$input['header-stuff'] = null;
	if ( !array_key_exists( $input['header-stuff'], $header_radio_options ) )
		$input['header-stuff'] = null;

	return $input;
}
?>
