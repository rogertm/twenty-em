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
	add_settings_field( 't_em_archive_stuff', __( 'Archive Options', 't_em' ), 't_em_settings_field_archive_stuff', 'theme-options', 'general' );
	add_settings_field( 't_em_layout_stuff', __( 'Layout Options', 't_em' ), 't_em_settings_field_layout_stuff', 'theme-options', 'general' );
	add_settings_field( 't_em_social_stuff', __( 'Social Network Options', 't_em' ), 't_em_settings_field_socialnetwork_stuff', 'theme-options', 'general' );
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

/**
 * Return an array of archive options for Twenty'em
 */
function t_em_archive_options(){
	$archive_options = array (
		'the-content' => array(
			'value' => 'the-content',
			'label' => __( 'Display the content', 't_em' )
		),
		'the-excerpt' => array(
			'value' => 'the-excerpt',
			'label' => __( 'Display the excerpt', 't_em' )
		),
	);

	return apply_filters( 't_em_archive_options', $archive_options );
}

/**
 * Return an array of layout options for Twenty'em
 */
function t_em_layout_options(){
	$layout_options = array (
		'sidebar-right' => array(
			'value' => 'sidebar-right',
			'label' => __( 'Content on right', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/sidebar-right.png',
		),
		'sidebar-left' => array(
			'value' => 'sidebar-left',
			'label' => __( 'Content on left', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/sidebar-left.png',
		),
		'one-column' => array(
			'value' => 'one-column',
			'label' => __( 'One-column, no sidebar', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/includes/images/one-column.png',
		),
	);

	return apply_filters( 't_em_layout_options', $layout_options );
}

/**
 * Return an array of social network options for Twenty'em
 */
function t_em_socialnetwork_options(){
	$socialnetwork_options = array (
		'twitter' => array (
			'value' => '',
			'name' => 'twitter',
			'label' => __( 'Twitter URL', 't_em' ),
		),
		'facebook' => array (
			'value' => '',
			'name' => 'facebook',
			'label' => __( 'Facebook URL', 't_em' ),
		),
		'googlepluss' => array (
			'value' => '',
			'name' => 'googlepluss',
			'label' => __( 'Google Pluss URL', 't_em' ),
		),
		'rss' => array (
			'value' => '',
			'name' => 'rss',
			'label' => __( 'Feed or RSS URL', 't_em' ),
		),
	);

	return apply_filters( 't_em_socialnetwork_options', $socialnetwork_options );
}

/**
 * Return the default options for Twenty'em
 */
function t_em_get_default_theme_options(){
	$default_theme_options = array (
		'header-stuff' => 'no-header-image',
		'archive-stuff' => 'the-content',
		'layout-stuff' => 'sidebar-right',
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
			<span><?php echo $header['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
}

/**
 * Render the Archive setting field
 */
function t_em_settings_field_archive_stuff(){
	$options = t_em_get_theme_options();
	foreach ( t_em_archive_options() as $archive ) :
?>
	<div class="some-class">
		<label class="description">
			<input type="radio" name="t_em_theme_options[archive-stuff]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php checked( $options['archive-stuff'], $archive['value'] ); ?> />
			<span><?php echo $archive['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
}

/**
 * Render the Layout setting field
 */
function t_em_settings_field_layout_stuff(){
	$options = t_em_get_theme_options();
	foreach ( t_em_layout_options() as $layout ) :
?>
	<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="t_em_theme_options[layout-stuff]" value="<?php echo esc_attr( $layout['value'] ) ?>" <?php checked( $options['layout-stuff'], $layout['value'] ); ?> />
			<span><img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" /><?php echo $layout['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
}

/**
 * Render the Socialnetwork setting field
 */
function t_em_settings_field_socialnetwork_stuff(){
	$options = t_em_get_theme_options();
	foreach ( t_em_socialnetwork_options() as $social ) :
?>
	<div class="layout text-option social">
		<label>
			<span><?php echo $social['label']; ?></span>
			<input type="text" name="t_em_theme_options['social-<?php echo $social['name']; ?>-stuff']" value="<?php echo esc_attr( $social['value'] ) ?>" />
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
	if ( isset( $input['header-stuff'] ) && array_key_exists( $input['header-stuff'], t_em_header_options() ) ) :
		$output['header-stuff'] = $input['header-stuff'];
	endif;

	// Archive stuff must be in our array of archive stuff options
	if ( isset( $input['archive-stuff'] ) && array_key_exists( $input['archive-stuff'], t_em_archive_options() ) ) :
		$output['archive-stuff'] = $input['archive-stuff'];
	endif;

	// Layout stuff must be in our array of layout stuff options
	if ( isset( $input['layout-stuff'] ) && array_key_exists( $input['layout-stuff'], t_em_layout_options() ) ) :
		$output['layout-stuff'] = $input['layout-stuff'];
	endif;

	return apply_filters( 't_em_theme_options_validate', $output, $input, $defaults );
}
?>
