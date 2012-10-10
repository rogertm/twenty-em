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
 * @filesource		wp-content/themes/twenty-em/inc/theme-options.php
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
	add_settings_field( 't_em_header_stuff',	__( 'Header Options', 't_em' ),			't_em_settings_field_header_stuff',			'theme-options',	'general' );
	add_settings_field( 't_em_archive_stuff',	__( 'Archive Options', 't_em' ),		't_em_settings_field_archive_stuff',		'theme-options',	'general' );
	add_settings_field( 't_em_layout_stuff',	__( 'Layout Options', 't_em' ),			't_em_settings_field_layout_stuff',			'theme-options',	'general' );
	add_settings_field( 't_em_social_stuff',	__( 'Social Network Options', 't_em' ),	't_em_settings_field_socialnetwork_stuff',	'theme-options',	'general' );
}

add_action( 'admin_menu', 't_em_theme_options_add_page' );
function t_em_theme_options_add_page(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');

	$theme_page = add_menu_page( $theme_name . ' ' . __( 'Theme Options', 't_em' ), __( 'Theme Options', 't_em' ), 'edit_theme_options', 'theme-options', 't_em_theme_options_page', get_template_directory_uri() . '/images/t-em-favicon.jpg', 61 );
	//~ require( get_template_directory() . '/inc/theme-options-dev.php' );
	//~ require( get_template_directory() . '/inc/theme-update.php' );
	if ( ! $theme_page ) return;

	add_action( "load-$theme_page", 't_em_theme_contextual_help' );
}

/**
 * Add contextual help to theme options screen
 */
function t_em_theme_contextual_help(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
	$help = '<p>' . sprintf( __( '<strong>Twenty\'em Framework</strong> provide customization options that are grouped together on this Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, <strong>%s</strong>, provides the following Theme Options:', 't_em' ), $theme_data ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>Header Options</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Archive Options</strong>: Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Layout Options</strong>: Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Social Network Options</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty\'em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) :
		// WordPress 3.3
		$screen->add_help_tab( array(
			'title' => __( 'Overview', 't_em' ),
			'id' => 'theme-options-help',
			'content' => $help,
			)
		);

		$screen->set_help_sidebar( $sidebar );
	else :
		// WordPress 3.2
		add_contextual_help( $screen, $help . $sidebar );
	endif;
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
			'label' => __( 'No header image', 't_em' ),
			'extend' => '',
		),
		'header-image' => array (
			'value' => 'header-image',
			'label' => __( 'Header image', 't_em' ),
			'extend' => t_em_header_image_extend(),
		),
		'slideshow' => array (
			'value' => 'slideshow',
			'label' => __( 'Slideshow', 't_em' ),
			'extend' => t_em_slider_extend(),
		),
	);

	return apply_filters( 't_em_header_options', $header_options );
}

/**
 * Extend setting for header image option
 */
function t_em_header_image_extend(){
	$extend_header = '';
	$extend_header .= "<p>". sprintf( __( 'To manage your header image options <a href="%1$s" target="_blank">Click here</a>.', 't_em' ), admin_url( 'themes.php?page=custom-header' ) ) ."</p>";
	if ( get_header_image() ) :
		$extend_header .= '<img src="'.get_header_image().'" width="450">';
	else :
		$extend_header .= "<p>". __( 'Oops! No image choosen yet', 't_em' ) ."</p>";
	endif;

	return $extend_header;
}

/**
 * Extend setting for slideshow option
 */
function t_em_slider_extend(){
	$extend_content = 'a por ellos con slider...';
	return $extend_content;
}

/**
 * Return an array of archive options for Twenty'em
 */
function t_em_archive_options(){
	$archive_options = array (
		'the-content' => array(
			'value' => 'the-content',
			'label' => __( 'Display the content', 't_em' ),
			'extend' => '',
		),
		'the-excerpt' => array(
			'value' => 'the-excerpt',
			'label' => __( 'Display the excerpt', 't_em' ),
			'extend' => t_em_excerpt_extend(),
		),
	);

	return apply_filters( 't_em_archive_options', $archive_options );
}

/**
 * Extend setting for archive option
 */
function t_em_excerpt_extend(){
	$excerpt_options = array (
		'thumbnail-left' => array(
			'value' => 'thumbnail-left',
			'label' => __( 'Thumbnail on left', 't_em' ),
			'thumbnail' => get_template_directory_uri().'/inc/images/thumbnail-left.png',
		),
		'thumbnail-right' => array(
			'value' => 'thumbnail-right',
			'label' => __( 'Thumbnail on right', 't_em' ),
			'thumbnail' => get_template_directory_uri().'/inc/images/thumbnail-right.png',
		),
		'thumbnail-center' => array(
			'value' => 'thumbnail-center',
			'label' => __( 'Thumbnail on center', 't_em' ),
			'thumbnail' => get_template_directory_uri().'/inc/images/thumbnail-center.png',
		),
	);

	$extend_excerpt = '';
	$options = t_em_get_theme_options();
	foreach ( $excerpt_options as $excerpt ) :
		$checked_option = ( $options['excerpt-stuff'] == $excerpt['value'] ) ? 'checked="checked"' : '';
		$extend_excerpt .=	'<div class="layout image-radio-option theme-excerpt">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" class="radio-option" name="t_em_theme_options[excerpt-stuff]" value="'.esc_attr( $excerpt['value'] ).'" '.$checked_option.' />';
		$extend_excerpt .=			'<span><img src="'.esc_url( $excerpt['thumbnail'] ).'" width="136" height="122" alt="" />'.$excerpt['label'].'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	return $extend_excerpt;
}

/**
 * Return an array of layout options for Twenty'em
 */
function t_em_layout_options(){
	$layout_options = array (
		'sidebar-right' => array(
			'value' => 'sidebar-right',
			'label' => __( 'Content on right', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-right.png',
		),
		'sidebar-left' => array(
			'value' => 'sidebar-left',
			'label' => __( 'Content on left', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-left.png',
		),
		'one-column' => array(
			'value' => 'one-column',
			'label' => __( 'One-column, no sidebar', 't_em' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/one-column.png',
		),
	);

	return apply_filters( 't_em_layout_options', $layout_options );
}

/**
 * Return an array of social network options for Twenty'em
 */
function t_em_socialnetwork_options(){
	$socialnetwork_options = array (
		'twitter-stuff' => array (
			'value' => '',
			'name' => 'twitter-stuff',
			'label' => __( 'Twitter URL', 't_em' ),
		),
		'facebook-stuff' => array (
			'value' => '',
			'name' => 'facebook-stuff',
			'label' => __( 'Facebook URL', 't_em' ),
		),
		'googlepluss-stuff' => array (
			'value' => '',
			'name' => 'googlepluss-stuff',
			'label' => __( 'Google Pluss URL', 't_em' ),
		),
		'rss-stuff' => array (
			'value' => '',
			'name' => 'rss-stuff',
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
		'header-stuff'		=> 'no-header-image',
		'archive-stuff'		=> 'the-content',
		'layout-stuff'		=> 'sidebar-right',
		'excerpt-stuff'		=> 'thumbnail-left',
		'twitter-stuff'		=> '',
		'facebook-stuff'	=> '',
		'googlepluss-stuff'	=> '',
		'rss-stuff'			=> '',
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
?>
	<div id="header-options">
<?php
	foreach ( t_em_header_options() as $header ) :
?>
		<div class="layout radio-option header">
			<label class="description">
				<input type="radio" name="t_em_theme_options[header-stuff]" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $options['header-stuff'], $header['value'] ); ?> />
				<span><?php echo $header['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_header_options() as $sub_header ) :
		if ( $sub_header['extend'] != '' ) :
			$selected_option = ( $options['header-stuff'] == $sub_header['value'] ) ? 'selected-option' : '';
?>
		<div id="<?php echo $sub_header['value']; ?>" class="sub-layout header-extend <?php echo $selected_option; ?>">
			<?php echo $sub_header['extend']; ?>
		</div>
<?php
endif;
	endforeach;
?>
	</div><!-- #header-options -->
<?php
}

/**
 * Render the Archive setting field
 */
function t_em_settings_field_archive_stuff(){
	$options = t_em_get_theme_options();
?>
	<div id="archive-options">
<?php
	foreach ( t_em_archive_options() as $archive ) :
?>
		<div class="layout radio-option archive">
			<label class="description">
				<input type="radio" name="t_em_theme_options[archive-stuff]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php checked( $options['archive-stuff'], $archive['value'] ); ?> />
				<span><?php echo $archive['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_archive_options() as $sub_archive ) :
		if ( $sub_archive['extend'] != '' ) :
		$selected_option = ( $options['archive-stuff'] == $sub_archive['value'] ) ? 'selected-option' : '';
?>
		<div id="<?php echo $sub_archive['value'] ?>" class="sub-layout archive-extend <?php echo $selected_option; ?>">
			<?php echo $sub_archive['extend']; ?>
		</div>
<?php
		endif;
	endforeach;
?>
	</div><!-- #archive-options -->
<?php
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
			<span><?php echo $social['label'];?></span>
			<input type="text" name="t_em_theme_options['<?php echo $social['name']; ?>']" value="<?php echo esc_attr( $options[$social['name']] ) ?>" />
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

		<form id="t-em-setting" method="post" action="options.php">
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

	// Excerpt thumbnail stuff must be in our array of excerpt thumbnail stuff
	if ( isset( $input['excerpt-stuff'] ) && array_key_exists( $input['excerpt-stuff'], t_em_excerpt_extend() ) ) :
		$output['excerpt-stuff'] = $input['excerpt-stuff'];
	endif;

	// Socialnetwork stuff
	foreach ( t_em_socialnetwork_options() as $social ) :
		if ( isset( $input[$social['name']] ) && array_key_exists( $input[$social['name']], t_em_socialnetwork_options() ) ) :
			$output[$social['name']] = wp_filter_nohtml_kses( $input[$social['name']] );
		endif;
	endforeach;

	return apply_filters( 't_em_theme_options_validate', $output, $input, $defaults );
}
?>
