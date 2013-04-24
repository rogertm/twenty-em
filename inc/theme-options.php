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
 * but it is loaded just if we are in the right place.
 */
if ( $_SERVER['QUERY_STRING'] == (	'page=theme-options' ||
									'page=theme-tools-box' ||
									'page=theme-webmaster-tools' ||
									'page=theme-update' ) ) :
	add_action( 'admin_init', 't_em_admin_css_style_stylesheet' );
	add_action( 'admin_init', 't_em_admin_javascript_script' );
endif;
function t_em_admin_css_style_stylesheet(){
	// Check the theme version right from the style sheet
	global $t_em_theme_data;
	$style_data = wp_get_theme();
	$style_version = $style_data->display('Version');

	wp_register_style( 'style-admin-t-em', T_EM_FUNCTIONS_DIR_CSS . '/theme-options.css', false, $t_em_theme_data['Version'], 'all' );
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
	add_settings_field( 't_em_general_set',	__( 'General Options', 't_em' ),		't_em_settings_field_general_options_set',	'theme-options',	'general' );
	add_settings_field( 't_em_header_set',	__( 'Header Options', 't_em' ),			't_em_settings_field_header_set',			'theme-options',	'general' );
	add_settings_field( 't_em_archive_set',	__( 'Archive Options', 't_em' ),		't_em_settings_field_archive_set',			'theme-options',	'general' );
	add_settings_field( 't_em_layout_set',	__( 'Layout Options', 't_em' ),			't_em_settings_field_layout_set',			'theme-options',	'general' );
	add_settings_field( 't_em_social_set',	__( 'Social Network Options', 't_em' ),	't_em_settings_field_socialnetwork_set',	'theme-options',	'general' );
}

add_action( 'admin_menu', 't_em_theme_options_add_page' );
function t_em_theme_options_add_page(){
	global $t_em_theme_data;

	$theme_page		=	add_menu_page( $t_em_theme_data['Name'] . ' ' . __( 'Theme Options', 't_em' ), $t_em_theme_data['Name'], 'edit_theme_options', 'theme-options', 't_em_theme_options_page', T_EM_FUNCTIONS_DIR_IMG . '/t-em-favicon.png', 61 );

	$theme_tools_box_page	=	add_submenu_page( 'theme-options',	__( 'Tools Box', 't_em' ),	__( 'Tools Box', 't_em' ),	'edit_theme_options',	'theme-tools-box',		't_em_theme_tools_box_options' );
						add_submenu_page( 'theme-options',	__( 'Webmaster Tools', 't_em' ),	__( 'Webmaster Tools', 't_em' ),	'edit_theme_options',	'theme-webmaster-tools',	't_em_theme_webmaster_tools' );
						add_submenu_page( 'theme-options',	__( 'Update', 't_em' ),				__( 'Update', 't_em' ),				'edit_theme_options',	'theme-update',				't_em_theme_update' );

	if ( ! $theme_page ) return;
	if ( ! $theme_tools_box_page ) return;

	add_action( "load-$theme_page", 't_em_theme_options_help' );
	add_action( "load-$theme_tools_box_page", 't_em_tools_box_options_help' );
}

require( get_template_directory() . '/inc/theme-tools-box.php' );
require( get_template_directory() . '/inc/theme-webmaster-tools.php' );
require( get_template_directory() . '/inc/theme-update.php' );
require( get_template_directory() . '/inc/help.php' );

/**
 * Redirect users to Twenty'em options page after activation
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) :
	wp_redirect( 'admin.php?page=theme-options' );

	/**
	 * Register the default options at first time the theme is loaded
	 */
	add_option( 't_em_theme_options', t_em_default_theme_options() );
	add_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
	add_option( 't_em_webmaster_tools_options', t_em_webmaster_tools_default_options() );
endif;

/**
 * Return the default options for Twenty'em
 */
function t_em_default_theme_options(){
	$default_theme_options = array (
		't-em-link'					=> '1',
		'single-featured-img'		=> '1',
		'single-related-posts'		=> '1',
		'header-set'				=> 'no-header-image',
		'header-featured-image'		=> '1',
		'slider-home-only'			=> '0',
		'slider-category'			=> get_option( 'default_category' ),
		'slider-number'				=> '5',
		'slider-text'				=> 'slider-text-center',
		'archive-set'				=> 'the-content',
		'layout-set'				=> 'sidebar-right',
		'layout-width'				=> '960',
		'excerpt-set'				=> 'thumbnail-left',
		'slider-height'				=> '350',
		'slider-width'				=> '960',
		'slider-style'				=> 't-em',
		'excerpt-thumbnail-height'	=> get_option( 'thumbnail_size_h' ),
		'excerpt-thumbnail-width'	=> get_option( 'thumbnail_size_w' ),
		'twitter-set'				=> '',
		'facebook-set'				=> '',
		'googlepluss-set'			=> '',
		'delicious-set'				=> '',
		'linkedin-set'				=> '',
		'youtube-set'				=> '',
		'flickr-set'				=> '',
		'feedburner-set'			=> '',
		'rss-set'					=> '',
		'dropbox-set'				=> '',
	);

	return apply_filters( 't_em_default_theme_options', $default_theme_options );
}

/**
 * Return an array of variables we need
 * to access to the database
 **********************************************************************************/
function t_em_set_globals(){
	global	$t_em_theme_options,
			$t_em_tools_box_options,
			$t_em_webmaster_tools_options;

	$t_em_theme_options				= t_em_get_theme_options();
	$t_em_tools_box_options				= t_em_get_tools_box_options();
	$t_em_webmaster_tools_options	= t_em_get_webmaster_tools_options();

	// If options are empties, we load default settings.
	if ( empty( $t_em_theme_options ) )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
	if ( empty( $t_em_tools_box_options ) )
		update_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
	if ( empty( $t_em_webmaster_tools_options ) )
		update_option( 't_em_webmaster_tools_options', t_em_webmaster_tools_default_options() );
}

/**
 * Return an array of general options for Twenty'en
 */
function t_em_general_options(){
	$general_options = array (
		't-em-link'				=> array (
			'name'			=> 't-em-link',
			'label'			=> __( 'Show <strong><a href="http://twenty-em.com" target="_blank">Twenty\'em.com</a></strong> and <strong><a href="http://wordpress.org/" target="_blank">WordPress.org</a></strong> home page link at the bottom of your site?', 't_em' ),
		),
		'single-featured-img'	=> array (
			'name'			=> 'single-featured-img',
			'label'			=> __( 'When a single post is displayed, show featured image on top of the post?', 't_em' ),
		),
		'single-related-posts'	=> array (
			'name'			=> 'single-related-posts',
			'label'			=> __( 'When a single post is displayed, show related posts?', 't_em' ),
		),
	);

	return apply_filters( 't_em_general_options', $general_options );
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
	global $t_em_theme_options;
	$extend_header = '';
	$extend_header .= '<p>'. sprintf( __( 'To manage your header image options <a href="%1$s" target="_blank">Click here</a>.', 't_em' ), admin_url( 'themes.php?page=custom-header' ) ) .'</p>';
	if ( get_header_image() ) :
		$checked_option = checked( $t_em_theme_options['header-featured-image'], '1', false );
		$extend_header .= '<figure><img src="'.get_header_image().'" width="500"></figure>';
		$extend_header .= '<label class="description">';
		$extend_header .=	 __( 'Display featured image in single posts and pages? ', 't_em' );
		$extend_header .=	'<input type="checkbox" name="t_em_theme_options[header-featured-image]" value="1" '. $checked_option .' />';
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
	global	$t_em_theme_options,
			$slider_layout,
			$list_categories;

	$slider_layout = array (
		'slider-text-center' => array (
			'value' => 'slider-text-center',
			'label' => __( 'Slider text on center', 't_em' ),
			'title' => T_EM_FUNCTIONS_DIR_IMG . '/slider-text-center.png',
		),
		'slider-text-left' => array (
			'value' => 'slider-text-left',
			'label' => __( 'Slider text on left', 't_em' ),
			'title' => T_EM_FUNCTIONS_DIR_IMG . '/slider-text-left.png',
		),
		'slider-text-right' => array (
			'value' => 'slider-text-right',
			'label' => __( 'Slider text on right', 't_em' ),
			'title' => T_EM_FUNCTIONS_DIR_IMG . '/slider-text-right.png',
		),
	);

	$slider_style = array (
		'style-t-em'	=> array (
			'value'	=> 't-em',
			'label'	=> __( 'Twenty&#8217;em', 't_em' ),
		),
		'style-default'	=> array (
			'value'	=> 'default',
			'label'	=> __( 'Nivo Default', 't_em' ),
		),
		'style-dark'	=> array (
			'value'	=> 'dark',
			'label'	=> __( 'Nivo Dark', 't_em' ),
		),
		'style-light'	=> array (
			'value'	=> 'light',
			'label'	=> __( 'Nivo Light', 't_em' ),
		),
		'style-bar'	=> array (
			'value'	=> 'bar',
			'label'	=> __( 'Nivo Bar', 't_em' ),
		),
	);

	$extend_slider = '';

	// Show Slider only at home page?
	$checked_option = checked( $t_em_theme_options['slider-home-only'], '1', false );
	$extend_slider .= '<label class="description">';
	$extend_slider .= 	__( 'Show Slider only at home page?', 't_em' );
	$extend_slider .= 	'<input type="checkbox" name="t_em_theme_options[slider-home-only]" value="1" '. $checked_option .' />';
	$extend_slider .= '</label>';

	// Display images options
	$extend_slider .= '<div class="image-radio-option-group">';
	foreach ( $slider_layout as $slider ) :
		$checked_option = checked( $t_em_theme_options['slider-text'], $slider['value'], false );
		$extend_slider .=	'<div class="layout image-radio-option slider-layout">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<input type="radio" name="t_em_theme_options[slider-text]" class="sub-radio-option" value="'.esc_attr($slider['value']).'" '. $checked_option .' />';
		$extend_slider .=			'<span><img src="'.$slider['title'].'" width="136" />'.$slider['label'].'</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div>';

	// Slider Style
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>' . __( 'Select your slider style.', 't_em' ) . '</p>';
	$extend_slider .= '<p>' . __( '<strong>Important:</strong> The options above only works with Twenty&#8217;em Style.', 't_em' ) . '</p>';
	foreach ($slider_style as $style) :
		$checked_option = checked( $t_em_theme_options['slider-style'], $style['value'], false );
		$extend_slider .=	'<div class="layout radio-option">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=		'<input type="radio" name="t_em_theme_options[slider-style]" class="sub-radio-option" value="'.esc_attr( $style['value'] ).'" '. $checked_option .' />';
		$extend_slider .=		'<span>'. $style['label'] .'</span>';
		$extend_slider .=		'</label>';

		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Define Height of Nivo Slider
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>'. __( 'By default slider width is the same than layout width. Here you may enter the value you wish to be your slider height. If empty the value will be <strong>350px</strong>', 't_em' ) .'</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label><span>'. __( 'Slider Height', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[slider-height]" value="'.esc_attr( $t_em_theme_options['slider-height'] ).'" /><span class="unit">px</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Display a select list of categories
	$list_categories = get_categories( array ( 'pad_count' => 1 ) );
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<p>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</p>';
	$extend_slider .= 		'<select name="t_em_theme_options[slider-category]">';
	foreach ( $list_categories as $slider_category ) :
		$selected_option = selected( $t_em_theme_options['slider-category'], $slider_category->term_id, false );
		$extend_slider .= 	'<option value="'.$slider_category->term_id.'" '.$selected_option.'>'.$slider_category->name.'</option>';
	endforeach;
	$extend_slider .= 		'</select>';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	// How meny slides to show?
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<p>'. __( 'Introduce the number of slides you want to show', 't_em' ) .'</p>';
	$extend_slider .= 		'<input type="number"  name="t_em_theme_options[slider-number]" value="'. esc_attr( $t_em_theme_options['slider-number'] ) .'" />';
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
	global	$t_em_theme_options,
			$excerpt_options;

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
	$extend_excerpt .= '<div class="image-radio-option-group">';
	foreach ( $excerpt_options as $excerpt ) :
		$checked_option = checked( $t_em_theme_options['excerpt-set'], $excerpt['value'], false );
		$extend_excerpt .=	'<div class="layout image-radio-option theme-excerpt">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[excerpt-set]" value="'.esc_attr( $excerpt['value'] ).'" '.$checked_option.' />';
		$extend_excerpt .=			'<span><img src="'.esc_url( $excerpt['thumbnail'] ).'" width="136" height="122" alt="" />'.$excerpt['label'].'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div>';

	$extend_excerpt .= '<div class="sub-extend">';
	$thumb = t_em_thumbnail_sizes( 'excerpt' );
	$extend_excerpt .= '<p>'. sprintf( __( 'Set thumbnail <strong>width</strong> and <strong>height</strong> in pixels. If empty, will be used the default thumbnail sizes (<strong>%2$s</strong> x <strong>%3$s</strong>) set at your <a href="%1$s" target="_blank">Media Settings</a> options.', 't_em' ),
		admin_url( 'options-media.php' ),
		get_option( 'thumbnail_size_w' ),
		get_option( 'thumbnail_size_h' ) ) .'</p>';
	foreach ( $thumb as $thumbnail ) :
		$extend_excerpt .= 		'<div class="layout text-option thumbnail">';
		$extend_excerpt .=			'<label><span>'. $thumbnail['label'] .'</span>';
		$extend_excerpt .=				'<input type="number" name="t_em_theme_options['.$thumbnail['name'].']" value="'.esc_attr( $t_em_theme_options[$thumbnail['name']] ).'" /><span class="unit">px</span>';
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
	global $t_em_theme_options;

	$layout_width = '';
	$layout_width .= '<div class="sub-extend">';
	$layout_width .= 	'<div class="layout text-option layout-width">';
	$layout_width .= 		'<p>'. __( 'Enter the value you wish to be your theme width. If empty, the value will be <strong>960px</strong>.', 't_em' ) .'</p>';
	$layout_width .= 		'<label>';
	$layout_width .= 			'<input type="number" name="t_em_theme_options[layout-width]" value="'.$t_em_theme_options['layout-width'].'" /><span class="unit">px</span>';
	$layout_width .= 		'</label>';
	$layout_width .= 	'</div>';
	$layout_width .= '</div>';

	return $layout_width;
}

/**
 * Return an array of social network options for Twenty'em
 */
function t_em_social_network_options(){
	global $socialnetwork_options;
	$socialnetwork_options = array (
		'twitter-set' => array (
			'value' => '',
			'name' => 'twitter-set',
			'label' => __( 'Twitter URL', 't_em' ),
			'item' => __( 'Twitter', 't_em' ),
		),
		'facebook-set' => array (
			'value' => '',
			'name' => 'facebook-set',
			'label' => __( 'Facebook URL', 't_em' ),
			'item' => __( 'Facebook', 't_em' ),
		),
		'googlepluss-set' => array (
			'value' => '',
			'name' => 'googlepluss-set',
			'label' => __( 'Google + URL', 't_em' ),
			'item' => __( 'Google +', 't_em' ),
		),
		'delicious-set' => array (
			'value' => '',
			'name' => 'delicious-set',
			'label' => __( 'Delicious URL', 't_em' ),
			'item' => __( 'Delicious', 't_em' ),
		),
		'linkedin-set' => array (
			'value' => '',
			'name' => 'linkedin-set',
			'label' => __( 'Linked In URL', 't_em' ),
			'item' => __( 'Linked In', 't_em' ),
		),
		'youtube-set' => array (
			'value' => '',
			'name' => 'youtube-set',
			'label' => __( 'YouTube URL', 't_em' ),
			'item' => __( 'YouTube', 't_em' ),
		),
		'flickr-set' => array (
			'value' => '',
			'name' => 'flickr-set',
			'label' => __( 'Flickr URL', 't_em' ),
			'item' => __( 'Flickr', 't_em' ),
		),
		'dropbox-set'	=> array(
			'value'	=> '',
			'name' => 'dropbox-set',
			'label' => __( 'Dropbox URL', 't_em' ),
			'item' => __( 'Dropbox', 't_em' ),
		),
		'feedburner-set' => array (
			'value' => '',
			'name' => 'feedburner-set',
			'label' => __( 'Feedburner URL', 't_em' ),
			'item' => __( 'Feedburner', 't_em' ),
		),
		'rss-set' => array (
			'value' => '',
			'name' => 'rss-set',
			'label' => __( 'Feed or RSS URL', 't_em' ),
			'item' => __( 'Feed / RSS', 't_em' ),
		),
	);

	return apply_filters( 't_em_social_network_options', $socialnetwork_options );
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
 * Return the options array for Twenty'em
 */
function t_em_get_theme_options(){
	return get_option( 't_em_theme_options', t_em_default_theme_options() );
}

/**
 * Render the General Options setting field
 */
function t_em_settings_field_general_options_set(){
	global $t_em_theme_options;
?>
	<div id="general-options">
<?php
	foreach( t_em_general_options() as $general ) :
?>
		<div class="layout checkbox-option general">
			<label class="description single-option">
				<span><?php echo $general['label']; ?></span>
				<?php $checked_option = checked( $t_em_theme_options[$general['name']], '1', false ); ?>
				<input type="checkbox" name="t_em_theme_options[<?php echo $general['name'] ?>]" value="1" <?php echo $checked_option; ?> >
			</label>
		</div>
<?php
	endforeach;
?>
	</div><!-- #general-options -->
<?php
}

/**
 * Render the Header setting field
 */
function t_em_settings_field_header_set(){
	global $t_em_theme_options;
?>
	<div id="header-options">
<?php
	foreach ( t_em_header_options() as $header ) :
?>
		<div class="layout radio-option header">
			<label class="description">
				<input type="radio" name="t_em_theme_options[header-set]" class="head-radio-option" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $t_em_theme_options['header-set'], $header['value'] ); ?> />
				<span><?php echo $header['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_header_options() as $sub_header ) :
		if ( $sub_header['extend'] != '' ) :
			$selected_option = ( $t_em_theme_options['header-set'] == $sub_header['value'] ) ? 'selected-option' : '';
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
	global $t_em_theme_options;
?>
	<div id="archive-options">
<?php
	foreach ( t_em_archive_options() as $archive ) :
?>
		<div class="layout radio-option archive">
			<label class="description">
				<input type="radio" class="head-radio-option" name="t_em_theme_options[archive-set]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php checked( $t_em_theme_options['archive-set'], $archive['value'] ); ?> />
				<span><?php echo $archive['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	foreach ( t_em_archive_options() as $sub_archive ) :
		if ( $sub_archive['extend'] != '' ) :
		$selected_option = ( $t_em_theme_options['archive-set'] == $sub_archive['value'] ) ? 'selected-option' : '';
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
	global $t_em_theme_options;
?>
<div class="image-radio-option-group">
<?php
	foreach ( t_em_layout_options() as $layout ) :
?>
	<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="t_em_theme_options[layout-set]" value="<?php echo esc_attr( $layout['value'] ) ?>" <?php checked( $t_em_theme_options['layout-set'], $layout['value'] ); ?> />
			<span><img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" /><?php echo $layout['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
?>
</div>
<?php
	echo t_em_layout_width();
}

/**
 * Render the Socialnetwork setting field
 */
function t_em_settings_field_socialnetwork_set(){
	global $t_em_theme_options;
	foreach ( t_em_social_network_options() as $social ) :
?>
	<div class="layout text-option social">
		<label>
			<span><?php echo $social['label'];?></span>
			<input type="url" class="regular-text" name="t_em_theme_options[<?php echo $social['name']; ?>]" value="<?php echo esc_url( $t_em_theme_options[$social['name']] ); ?>" />
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
		't-em-link',
		'single-featured-img',
		'single-related-posts',
		'header-featured-image',
		'slider-home-only',
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
			'set'		=> 'slider-text',
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
		'slider-width',
		'slider-height',
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
		'delicious-set',
		'linkedin-set',
		'youtube-set',
		'flickr-set',
		'feedburner-set',
		'rss-set',
		'dropbox-set',
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
	global $t_em_theme_options;
	$layout_set = $t_em_theme_options['layout-set'];

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
	global $t_em_theme_options;
	$archive_set = $t_em_theme_options['archive-set'];
	$excerpt_set = $t_em_theme_options['excerpt-set'];

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
