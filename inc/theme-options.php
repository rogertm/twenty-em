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
 * Register Style Sheet and Javascript to beautify the admin option page
 */
add_action( 'admin_init', 't_em_admin_css_style_stylesheet' );
add_action( 'admin_init', 't_em_admin_javascript_script' );
function t_em_admin_css_style_stylesheet(){
	// Check the theme version right from the style sheet
	$style_data = wp_get_theme();
	$style_version = $style_data->display('Version');

	wp_register_style( 'style-admin-t-em', T_EM_FUNCTIONS_DIR_CSS . '/theme-options.css', false, $style_version, 'all' );
	wp_enqueue_style( 'style-admin-t-em' );
}

function t_em_admin_javascript_script(){
	wp_register_script( 'script-admin-t-em', T_EM_FUNCTIONS_DIR_JS . '/theme-options.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'script-admin-t-em' );
}

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
	add_settings_field( 't_em_header_set',	__( 'Header Options', 't_em' ),			't_em_settings_field_header_set',			'theme-options',	'general' );
	add_settings_field( 't_em_archive_set',	__( 'Archive Options', 't_em' ),		't_em_settings_field_archive_set',			'theme-options',	'general' );
	add_settings_field( 't_em_layout_set',	__( 'Layout Options', 't_em' ),			't_em_settings_field_layout_set',			'theme-options',	'general' );
	add_settings_field( 't_em_social_set',	__( 'Social Network Options', 't_em' ),	't_em_settings_field_socialnetwork_set',	'theme-options',	'general' );
}

add_action( 'admin_menu', 't_em_theme_options_add_page' );
function t_em_theme_options_add_page(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');

	$theme_page = add_menu_page( $theme_name . ' ' . __( 'Theme Options', 't_em' ), $theme_name, 'edit_theme_options', 'theme-options', 't_em_theme_options_page', T_EM_FUNCTIONS_DIR_IMG . '/t-em-favicon.jpg', 61 );

	add_submenu_page( 'theme-options',	__( 'Developers Zone', 't_em' ),	__( 'Developers Zone', 't_em' ),	'edit_theme_options',	'theme-options-dev',		't_em_theme_options_dev' );
	add_submenu_page( 'theme-options',	__( 'Webmaster Tools', 't_em' ),	__( 'Webmaster Tools', 't_em' ),	'edit_theme_options',	'theme-webmaster-tools',	't_em_theme_webmaster_tools' );
	add_submenu_page( 'theme-options',	__( 'Update', 't_em' ),				__( 'Update', 't_em' ),				'edit_theme_options',	'theme-update',				't_em_theme_update' );

	if ( ! $theme_page ) return;

	add_action( "load-$theme_page", 't_em_theme_contextual_help' );
}

require( get_template_directory() . '/inc/theme-options-dev.php' );
require( get_template_directory() . '/inc/theme-webmaster-tools.php' );
require( get_template_directory() . '/inc/theme-update.php' );

/**
 * Redirect users to Twenty'em options page after activation
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) :
	wp_redirect( 'admin.php?page=theme-options' );

	/**
	 * Register the default options at first time the theme is loaded
	 */
	add_option( 't_em_theme_options', t_em_get_default_theme_options() );
	add_option( 't_em_dev_options', t_em_dev_default_options() );
endif;

/**
 * If options are empties, we load default settings
 */
$options = t_em_get_theme_options();
$options_dev = t_em_get_dev_options();
if ( $options == '' ) :
	update_option( 't_em_theme_options', t_em_get_default_theme_options() );
endif;
if ( $options_dev == '' ) :
	update_option( 't_em_dev_options', t_em_dev_default_options() );
endif;

/**
 * Add contextual help to theme options screen
 */
function t_em_theme_contextual_help(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
	$help = '<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/framework" title="Twenty\'em Framework" target="_blank">Twenty\'em Framework</a></strong> provide customization options that are grouped together on this Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, <strong>%s</strong>, provides the following Theme Options:', 't_em' ), $theme_data ) . '</p>'.
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

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}

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
			'extend' => t_em_header_image_callback(),
		),
		'slider' => array (
			'value' => 'slider',
			'label' => __( 'Slider', 't_em' ),
			'extend' => t_em_slider_callback(),
		),
	);

	return apply_filters( 't_em_header_options', $header_options );
}

/**
 * Extend setting for header image option
 */
function t_em_header_image_callback(){
	$options = t_em_get_theme_options();
	$extend_header = '';
	$extend_header .= '<p>'. sprintf( __( 'To manage your header image options <a href="%1$s" target="_blank">Click here</a>.', 't_em' ), admin_url( 'themes.php?page=custom-header' ) ) .'</p>';
	if ( get_header_image() ) :
		$checked = ( array_key_exists( 'header-featured-image', $options ) && $options['header-featured-image'] == '1' ) ? 'checked="checked"' : '';
		$extend_header .= '<figure><img src="'.get_header_image().'" width="500"></figure>';
		$extend_header .= '<label class="description">';
		$extend_header .=	 __( 'Display featured image in single posts and pages? ', 't_em' );
		$extend_header .=	'<input type="checkbox" name="t_em_theme_options[header-featured-image]" value="1" '. $checked .' />';
		$extend_header .= '</label>';
	else :
		$extend_header .= '<p>'. __( 'Oops! No image choosen yet', 't_em' ) .'</p>';
	endif;

	return apply_filters( 't_em_header_image_callback', $extend_header );
}

/**
 * Extend setting for slider option
 */
function t_em_slider_callback(){
	global $slider_layout, $list_categories;
	$slider_layout = array (
		'slider-thumbnail-left' => array (
			'value' => 'slider-thumbnail-left',
			'label' => __( 'Slider thumbnail on left', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/slider-thumbnail-left.png',
		),
		'slider-thumbnail-right' => array (
			'value' => 'slider-thumbnail-right',
			'label' => __( 'Slider thumbnail on right', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/slider-thumbnail-right.png',
		),
		'slider-thumbnail-full' => array (
			'value' => 'slider-thumbnail-full',
			'label' => __( 'Slider thumbnail on full', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/slider-thumbnail-full.png',
		),
	);

	$options = t_em_get_theme_options();
	$extend_slider = '';

	// Display images options
	foreach ( $slider_layout as $slider ) :
		$selected_option = ( $options['slider-thumbnail'] == $slider['value'] ) ? 'checked="checked"' : '';
		$extend_slider .=	'<div class="layout image-radio-option slider-layout">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<input type="radio" name="t_em_theme_options[slider-thumbnail]" class="sub-radio-option" value="'.esc_attr($slider['value']).'" '. $selected_option .' />';
		$extend_slider .=			'<span><img src="'.$slider['thumbnail'].'" width="136" />'.$slider['label'].'</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;

	// Define Width and Height of thumbnails
	$extend_slider .= '<div class="sub-extend">';
	$thumb = t_em_thumbnail_sizes( 'slider' );
	$extend_slider .= '<p>'. sprintf( __( 'For thubnail on right or left, set <strong>width</strong> and <strong>height</strong> in pixels. If empty, will be used the default medium size (<strong>%2$s</strong> x <strong>%3$s</strong>) set at your <a href="%1$s" target="_blank">Media Settings</a> options.', 't_em' ),
		admin_url( 'options-media.php' ),
		get_option( 'medium_size_w' ),
		get_option( 'medium_size_h' ) ) .'</p>';
	foreach ( $thumb as $thumbnail ) :
		$extend_slider .= 		'<div class="layout text-option thumbnail">';
		$extend_slider .=			'<label><span>'. $thumbnail['label'] .'</span>';
		$extend_slider .=				'<input type="number" name="t_em_theme_options['.$thumbnail['name'].']" value="'.esc_attr( $options[$thumbnail['name']] ).'" /><span class="unit">px</span>';
		$extend_slider .=			'</label>';
		$extend_slider .=		'</div>';
	endforeach;
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Display a select list of categories
	$list_categories = get_categories( array ( 'pad_count' => 1 ) );
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<p>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</p>';
	$extend_slider .= 		'<select name="t_em_theme_options[slider-category]">';
	foreach ( $list_categories as $slider_category ) :
		$selected_option = ( $options['slider-category'] == $slider_category->term_id ) ? 'selected="selected"' : '';
		$extend_slider .= 	'<option value="'.$slider_category->term_id.'" '.$selected_option.'>'.$slider_category->name.'</option>';
	endforeach;
	$extend_slider .= 		'</select>';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	// How meny slides to show?
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<p>'. __( 'Introduce the number of slides you want to show', 't_em' ) .'</p>';
	$extend_slider .= 		'<input type="number"  name="t_em_theme_options[slider-number]" value="'. esc_attr( $options['slider-number'] ) .'" />';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	return $extend_slider;
}

/**
 * Return an array of archive options for Twenty'em
 */
function t_em_archive_options(){
	$archive_options = array (
		'the-content' => array (
			'value' => 'the-content',
			'label' => __( 'Display the content', 't_em' ),
			'extend' => '',
		),
		'the-excerpt' => array (
			'value' => 'the-excerpt',
			'label' => __( 'Display the excerpt', 't_em' ),
			'extend' => t_em_excerpt_callback(),
		),
	);

	return apply_filters( 't_em_archive_options', $archive_options );
}

/**
 * Extend setting for archive option
 */
function t_em_excerpt_callback(){
	global $excerpt_options;
	$excerpt_options = array (
		'thumbnail-left' => array(
			'value' => 'thumbnail-left',
			'label' => __( 'Thumbnail on left', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/thumbnail-left.png',
		),
		'thumbnail-right' => array(
			'value' => 'thumbnail-right',
			'label' => __( 'Thumbnail on right', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/thumbnail-right.png',
		),
		'thumbnail-center' => array(
			'value' => 'thumbnail-center',
			'label' => __( 'Thumbnail on center', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/thumbnail-center.png',
		),
	);

	$extend_excerpt = '';
	$options = t_em_get_theme_options();
	foreach ( $excerpt_options as $excerpt ) :
		$selected_option = ( $options['excerpt-set'] == $excerpt['value'] ) ? 'checked="checked"' : '';
		$extend_excerpt .=	'<div class="layout image-radio-option theme-excerpt">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[excerpt-set]" value="'.esc_attr( $excerpt['value'] ).'" '.$selected_option.' />';
		$extend_excerpt .=			'<span><img src="'.esc_url( $excerpt['thumbnail'] ).'" width="136" height="122" alt="" />'.$excerpt['label'].'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;

	$extend_excerpt .= '<div class="sub-extend">';
	$thumb = t_em_thumbnail_sizes( 'excerpt' );
	$extend_excerpt .= '<p>'. sprintf( __( 'For thubnail on right or left, set <strong>width</strong> and <strong>height</strong> in pixels. If empty, will be used the default thumbnail sizes (<strong>%2$s</strong> x <strong>%3$s</strong>) set at your <a href="%1$s" target="_blank">Media Settings</a> options.', 't_em' ),
		admin_url( 'options-media.php' ),
		get_option( 'thumbnail_size_w' ),
		get_option( 'thumbnail_size_h' ) ) .'</p>';
	foreach ( $thumb as $thumbnail ) :
		$extend_excerpt .= 		'<div class="layout text-option thumbnail">';
		$extend_excerpt .=			'<label><span>'. $thumbnail['label'] .'</span>';
		$extend_excerpt .=				'<input type="number" name="t_em_theme_options['.$thumbnail['name'].']" value="'.esc_attr( $options[$thumbnail['name']] ).'" /><span class="unit">px</span>';
		$extend_excerpt .=			'</label>';
		$extend_excerpt .=		'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

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
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/sidebar-right.png',
		),
		'sidebar-left' => array(
			'value' => 'sidebar-left',
			'label' => __( 'Content on left', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/sidebar-left.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 't_em' ),
			'thumbnail' => T_EM_FUNCTIONS_DIR_IMG . '/one-column.png',
		),
	);

	return apply_filters( 't_em_layout_options', $layout_options );
}

/**
 * Set the default theme width
 */
function t_em_layout_width(){
	$options = t_em_get_theme_options();
	$layout_width = '';
	$layout_width .= '<div class="sub-extend">';
	$layout_width .= 	'<div class="layout text-option layout-width">';
	$layout_width .= 		'<p>'. __( 'Enter the value you wish to be your theme width. If empty, the value will be <strong>100%</strong>', 't_em' ) .'</p>';
	$layout_width .= 		'<label>';
	$layout_width .= 			'<input type="number" name="t_em_theme_options[layout-width]" value="'.$options['layout-width'].'" /><span class="unit">px</span>';
	$layout_width .= 		'</label>';
	$layout_width .= 	'</div>';
	$layout_width .= '</div>';

	return $layout_width;
}

/**
 * Return an array of social network options for Twenty'em
 */
function t_em_socialnetwork_options(){
	$socialnetwork_options = array (
		'twitter-set' => array (
			'value' => '',
			'name' => 'twitter-set',
			'label' => __( 'Twitter URL', 't_em' ),
		),
		'facebook-set' => array (
			'value' => '',
			'name' => 'facebook-set',
			'label' => __( 'Facebook URL', 't_em' ),
		),
		'googlepluss-set' => array (
			'value' => '',
			'name' => 'googlepluss-set',
			'label' => __( 'Google Pluss URL', 't_em' ),
		),
		'rss-set' => array (
			'value' => '',
			'name' => 'rss-set',
			'label' => __( 'Feed or RSS URL', 't_em' ),
		),
	);

	return apply_filters( 't_em_socialnetwork_options', $socialnetwork_options );
}

/**
 * Return Width and Height sizes for thumbnails
 */
function t_em_thumbnail_sizes( $contex ){
	$thumbnail_sizes = array (
		'excerpt-thumbnail-width' => array(
			'value' => '',
			'name' => $contex . '-thumbnail-width',
			'label' => __( 'Width', 't_em' ),
		),
		'excerpt-thumbnail-height' => array(
			'value' => '',
			'name' => $contex . '-thumbnail-height',
			'label' => __( 'Height', 't_em' ),
		),
	);

	return $thumbnail_sizes;
}

/**
 * Return the default options for Twenty'em
 */
function t_em_get_default_theme_options(){
	$default_theme_options = array (
		'header-set'				=> 'no-header-image',
		'header-featured-image'		=> '1',
		'slider-category'			=> get_option( 'default_category' ),
		'slider-number'				=> '5',
		'slider-thumbnail'			=> 'slider-thumbnail-left',
		'archive-set'				=> 'the-content',
		'layout-set'				=> 'sidebar-right',
		'layout-width'				=> '960',
		'excerpt-set'				=> 'thumbnail-left',
		'slider-thumbnail-height'	=> get_option( 'medium_size_h' ),
		'slider-thumbnail-width'	=> get_option( 'medium_size_w' ),
		'excerpt-thumbnail-height'	=> get_option( 'thumbnail_size_h' ),
		'excerpt-thumbnail-width'	=> get_option( 'thumbnail_size_w' ),
		'twitter-set'				=> '',
		'facebook-set'				=> '',
		'googlepluss-set'			=> '',
		'rss-set'					=> '',
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
function t_em_settings_field_header_set(){
	$options = t_em_get_theme_options();
?>
	<div id="header-options">
<?php
	foreach ( t_em_header_options() as $header ) :
?>
		<div class="layout radio-option header">
			<label class="description">
				<input type="radio" name="t_em_theme_options[header-set]" class="head-radio-option" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $options['header-set'], $header['value'] ); ?> />
				<span><?php echo $header['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_header_options() as $sub_header ) :
		if ( $sub_header['extend'] != '' ) :
			$selected_option = ( $options['header-set'] == $sub_header['value'] ) ? 'selected-option' : '';
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
function t_em_settings_field_archive_set(){
	$options = t_em_get_theme_options();
?>
	<div id="archive-options">
<?php
	foreach ( t_em_archive_options() as $archive ) :
?>
		<div class="layout radio-option archive">
			<label class="description">
				<input type="radio" class="head-radio-option" name="t_em_theme_options[archive-set]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php checked( $options['archive-set'], $archive['value'] ); ?> />
				<span><?php echo $archive['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_archive_options() as $sub_archive ) :
		if ( $sub_archive['extend'] != '' ) :
		$selected_option = ( $options['archive-set'] == $sub_archive['value'] ) ? 'selected-option' : '';
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
function t_em_settings_field_layout_set(){
	$options = t_em_get_theme_options();
	foreach ( t_em_layout_options() as $layout ) :
?>
	<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="t_em_theme_options[layout-set]" value="<?php echo esc_attr( $layout['value'] ) ?>" <?php checked( $options['layout-set'], $layout['value'] ); ?> />
			<span><img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" /><?php echo $layout['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
	echo t_em_layout_width();
}

/**
 * Render the Socialnetwork setting field
 */
function t_em_settings_field_socialnetwork_set(){
	$options = t_em_get_theme_options();
	foreach ( t_em_socialnetwork_options() as $social ) :
?>
	<div class="layout text-option social">
		<label>
			<span><?php echo $social['label'];?></span>
			<input type="url" name="t_em_theme_options[<?php echo $social['name']; ?>]" value="<?php echo esc_url( $options[$social['name']] ); ?>" />
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
	global $excerpt_options, $slider_layout, $list_categories;
	// All the checkbox are either 0 or 1
	foreach ( array(
		'header-featured-image',
	) as $checkbox ) :
		if ( !isset( $input[$checkbox] ) )
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	endforeach;

	// Validate all radio options
	$radio_options = array(
		'header-options'	=> array (
			'set'		=> 'header-set',
			'callback'	=> t_em_header_options(),
		),
		'slider-options'	=> array (
			'set'		=> 'slider-thumbnail',
			'callback'	=> $slider_layout,
		),
		'archive-options'	=> array (
			'set'		=> 'archive-set',
			'callback'	=> t_em_archive_options(),
		),
		'excerpt-options'	=> array (
			'set'		=> 'excerpt-set',
			'callback'	=> $excerpt_options,
		),
		'layout-options'	=> array (
			'set'		=> 'layout-set',
			'callback'	=> t_em_layout_options(),
		),
	);
	foreach ( $radio_options as $radio ) :
		if ( ! isset( $input[$radio['set']] ) )
			$input[$radio['set']] = null;
		if ( ! array_key_exists( $input[$radio['set']], $radio['callback'] ) )
			$input[$radio['set']] = null;
	endforeach;

	// Validate all int (input[type="number"]) options
	foreach( array (
		'slider-thumbnail-width',
		'slider-thumbnail-height',
		'slider-number',
		'excerpt-thumbnail-width',
		'excerpt-thumbnail-height',
		'layout-width',
	) as $int ) :
		$input[$int] = wp_filter_nohtml_kses( $input[$int] );
	endforeach;

	// Validate all url (input[type="url"]) options
	foreach ( array (
		'twitter-set',
		'facebook-set',
		'googlepluss-set',
		'rss-set',
	) as $url ) :
		$input[$url] = esc_url_raw( $input[$url] );
	endforeach;

	// Validate all select list options
	$select_options = array ( // Pincha pero parcialmente, no agrega algunas categorias :8
		'slider-cat'		=> array (
			'set'		=> 'slider-category',
			'callback'	=> $list_categories,
		),
	);
	foreach ( $select_options as $select ) :
		if ( ! array_key_exists( $input[$select['set']], $select['callback'] ) )
			$input[$select['set']] = null;
	endforeach;

	return $input;
}

/**
 * Add Twenty'em layout clases to the array of boddy clases
 *
 * @since Twenty'em 1.0
 */
add_filter( 'body_class', 't_em_layout_classes' );
function t_em_layout_classes( $existing_classes ){
	$options = t_em_get_theme_options();
	$layout_set = $options['layout-set'];

	if ( in_array( $layout_set, array( 'sidebar-right', 'sidebar-left' ) ) )
		$classes = array ( 'two-column' );
	else
		$classes = array ( 'one-column' );

	if ( 'sidebar-right' == $layout_set )
		$classes[] = 'sidebar-right';
	elseif ( 'sidebar-left' == $layout_set )
		$classes[] = 'sidebar-left';
	else
		$classes[] = $layout_set;

	$classes = apply_filters( 't_em_layout_classes', $classes, $layout_set );

	return array_merge( $existing_classes, $classes );
}

/**
 * Add Twenty'em archive classes to the array of posts classes
 *
 * @since Twenty'em 1.0
 */
add_filter( 'post_class', 't_em_archive_classes' );
function t_em_archive_classes( $existing_classes ){
	$options = t_em_get_theme_options();
	$archive_set = $options['archive-set'];
	$excerpt_set = $options['excerpt-set'];

	if ( 'the-excerpt' == $archive_set ) :
		if ( 'thumbnail-left' == $excerpt_set ) :
			$classes[] = 'thumbnail-left';
		elseif ( 'thumbnail-right' == $excerpt_set ) :
			$classes[] = 'thumbnail-right';
		else :
			$classes[] = 'thumbnail-center';
		endif;
		$classes[] = 'excerpt-post';
	else :
		$classes[] = 'full-post';
	endif;

	$classes = apply_filters( 't_em_archive_classes', $classes, $archive_set );

	return array_merge( $existing_classes, $classes );
}
?>
