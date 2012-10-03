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
	// Based on Twentyeleven WordPress Theme
	register_setting( 't_em_options', 't_em_theme_options', 't_em_theme_options_validate' );

	// Register our settings field group
	add_settings_section( 'general', '', '__return_false', 'theme-options' );

	// Register our individual settings fields
	add_settings_field( 't_em_header_stuff', __( 'Header Options', 't_em' ), 't_em_settings_field_header_stuff', 'theme-options', 'general' );
	//~ add_settings_field( 'archive-stuff', __( 'Archive Stuff', 't_em' ), 't_em_settings_field_archive_stuff', 'theme-options', 'general' );
}

add_action( 'admin_menu', 't_em_theme_options_add_page' );
function t_em_theme_options_add_page(){
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
 * Return an array of header options for Twenty'em
 */
function t_em_header_options(){
	$header_options = array (
		'no-header-image' => array (
			'value' => 'no-header-image',
			'label' => __( 'No header image', 't_em' )
		),
		'header-image' => array (
			'value' => 'header-image',
			'label' => __( 'Header image', 't_em' )
		),
		'slideshow' => array (
			'value' => 'slideshow',
			'label' => __( 'Slideshow', 't_em' )
		),
	);

	return apply_filters( 't_em_header_options', $header_options );
}

/** las otras funciones con opcions y valores aqui */

/**
 * Return the default options for Twenty'em
 */
function t_em_get_default_theme_options(){
	$default_theme_options = array (
		'header-stuff' => 'no-header-image',
	);

	return apply_filters( 't_em_get_default_theme_options', $default_theme_options );
}

/**
 * Return the options array for Twenty'em
 */
function t_em_get_theme_options(){
	return get_option( 't_em_theme_options', t_em_get_default_theme_options() );
}

/**
 * Render the Header setting field
 */
function t_em_settings_field_header_stuff(){
	$options = t_em_get_theme_options();
	foreach ( t_em_header_options() as $header ) :
?>
	<div class="some-class">
		<label class="description">
			<input type="radio" name="t_em_theme_options[header-stuff]" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $options['header-stuff'], $header['value'] ); ?> />
			<span><?php echo $header['label'] ?></span>
		</label>
	</div>
<?php
	endforeach;
}

/**
 * Finally a Options Page is displayed
 */
function t_em_theme_options_page(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Theme Options', 't_em' ) ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 't_em_options' );
				do_settings_sections( 'theme-options' );
				submit_button();
			?>
		</form>

	</div><!-- .wrap -->
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function t_em_theme_options_validate( $input ){
	$output = $defaults = t_em_get_default_theme_options();

	// Header stuff must be in our array of header stuff options
	if ( isset( $input['header-stuff'] ) && array_key_exists( $input['header-stuff'], t_em_header_options() ) )
		$output['header-stuff'] = $input['header-stuff'];

	return apply_filters( 't_em_theme_options_validate', $output, $input, $defaults );
}
?>
