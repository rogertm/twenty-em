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
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/theme-options.php
 * @link			http://codex.wordpress.org/Settings_API
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Register directory and sub-directories through constants
 */
// Theme directory
define ( 'T_EM_THEME_DIR',			get_template_directory_uri() );
define ( 'T_EM_THEME_DIR_CSS',		get_template_directory_uri().'/css' );
define ( 'T_EM_THEME_DIR_IMG',		get_template_directory_uri().'/images' );
define ( 'T_EM_THEME_DIR_JS',		get_template_directory_uri().'/js' );
define ( 'T_EM_THEME_DIR_LANG',		get_template_directory_uri().'/lang' );
define ( 'T_EM_THEME_DIR_DOCS',		get_template_directory_uri().'/docs' );

// Theme Options Directory
define ( 'T_EM_INC_DIR',			get_template_directory_uri().'/inc' );
define ( 'T_EM_INC_DIR_CSS',		get_template_directory_uri().'/inc/css' );
define ( 'T_EM_INC_DIR_IMG',		get_template_directory_uri().'/inc/images' );
define ( 'T_EM_INC_DIR_JS',			get_template_directory_uri().'/inc/js' );

/**
 * Register Style Sheet and Javascript to beautify the admin option page.
 * This function is attached ti the admin_init() action hook, but just if we are in the right place.
 *
 * @global $t_em_theme_data See t_em_theme_data()
 *
 * @since Twenty'em 0.1
 */
function t_em_admin_styles_and_scripts(){
	// Check the theme version right from the style sheet
	global $t_em_theme_data;
	wp_register_style( 'style-admin-t-em', T_EM_INC_DIR_CSS . '/theme-options.css', false, $t_em_theme_data['Version'], 'all' );
	wp_enqueue_style( 'style-admin-t-em' );
	wp_register_script( 'script-admin-t-em', T_EM_INC_DIR_JS . '/theme-options.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'script-admin-t-em' );
}
if ( $_SERVER['QUERY_STRING'] == (	'page=theme-options' ||
									'page=theme-tools-box' ||
									'page=theme-webmaster-tools' ||
									'page=theme-backup' ) ) :
	add_action( 'admin_init', 't_em_admin_styles_and_scripts' );
endif;

/**
 * Register the form setting for our t_em_theme_options array.
 * This function is attached to the admin_menu() action hook.
 *
 * @uses register_setting() Register a setting and its sanitization callback.
 * @uses add_settings_section() This are groups of settings you see on Twenty'em settings pages with
 * a shared heading.
 * @uses add_settings_field() Register a settings field to a settings page and section.
 *
 * @link http://codex.wordpress.org/Settings_API
 *
 * @since Twenty'em 0.1
 */
function t_em_register_setting_options_init(){
	register_setting( 't_em_options', 't_em_theme_options', 't_em_theme_options_validate' );

	// Register our settings field group
	add_settings_section( 'general', '', '__return_false', 'theme-options' );

	// Register our individual settings fields
	add_settings_field( 't_em_general_set',			__( 'General Options', 't_em' ),			't_em_settings_field_general_options_set',		'theme-options',	'general' );
	add_settings_field( 't_em_header_set',			__( 'Header Options', 't_em' ),				't_em_settings_field_header_set',				'theme-options',	'general' );
	add_settings_field( 't_em_front_page_set',		__( 'Front Page Options', 't_em' ),			't_em_settings_field_front_page_options_set',	'theme-options',	'general' );
	add_settings_field( 't_em_archive_set',			__( 'Archive Options', 't_em' ),			't_em_settings_field_archive_set',				'theme-options',	'general' );
	add_settings_field( 't_em_layout_set',			__( 'Layout Options', 't_em' ),				't_em_settings_field_layout_set',				'theme-options',	'general' );
	add_settings_field( 't_em_social_set',			__( 'Social Network Options', 't_em' ),		't_em_settings_field_socialnetwork_set',		'theme-options',	'general' );
	add_settings_field( 't_em_webmaster_tools_set', __( 'Webmaster Tools Options', 't_em' ),	't_em_settings_field_webmaster_tools_set', 		'theme-options', 	'general' );
}
add_action( 'admin_init', 't_em_register_setting_options_init' );

/**
 * Add our theme options page to the admin menu, including some help documentation.
 * This function is attached to the admin_menu() action hook.
 *
 * @uses add_menu_page() Add a top level menu page.
 * @uses add_submenu_page() Add a sub menu page.
 * @uses $t_em_theme_data See t_em_theme_data().
 *
 * @link http://codex.wordpress.org/Administration_Menus
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_options_admin_page(){
	global $t_em_theme_data;

	$theme_page 		= add_menu_page( $t_em_theme_data['Name'] . ' ' . __( 'Theme Options', 't_em' ), $t_em_theme_data['Name'], 'edit_theme_options', 'theme-options', 't_em_theme_options_page', T_EM_INC_DIR_IMG . '/t-em-favicon.png', 61 );
	$theme_backup_page	= add_submenu_page( 'theme-options', __( 'Backup', 't_em' ), __( 'Backup', 't_em' ), 'edit_theme_options', 'theme-backup', 't_em_theme_backup' );

	// We call our help screens
	if ( ! $theme_page ) return;
	if ( ! $theme_backup_page ) return;

	add_action( "load-$theme_page", 't_em_theme_options_help' );
}
add_action( 'admin_menu', 't_em_theme_options_admin_page' );

// Now we call this files we need to complete the Twenty'em engine.
require( get_template_directory() . '/inc/generals-options.php' );
require( get_template_directory() . '/inc/header-options.php' );
require( get_template_directory() . '/inc/front-page-options.php' );
require( get_template_directory() . '/inc/archive-options.php' );
require( get_template_directory() . '/inc/layout-options.php' );
require( get_template_directory() . '/inc/social-network-options.php' );
require( get_template_directory() . '/inc/webmaster-tools-options.php' );
require( get_template_directory() . '/inc/theme-backup.php' );
require( get_template_directory() . '/inc/shortcodes.php' );
require( get_template_directory() . '/inc/help.php' );

/**
 * Redirect users to Twenty'em options page after theme activation and register the default options
 * at first time the theme is loaded.
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) :
	wp_redirect( 'admin.php?page=theme-options' );
	add_option( 't_em_theme_options', t_em_default_theme_options() );
endif;

/**
 * This function returns an array of theme's information stored in style.css file.
 * This function is attached to the after_setup_theme() action hook.
 *
 * @uses wp_get_theme() Gets a WP_Theme object for a theme.
 *
 * @global $t_em_theme_data When you set to global this var, you can access to this function for the
 * theme information stored in style.css file.
 * For example, if you want to know or display the theme name and version into a function:
 * <?php
 * function my_function(){
 * 	global $t_em_theme_data;
 * 	echo "My theme is:" . $t_em_theme_data['Name'] . "Version:" . $t_em_theme_data['Version'];
 * }
 * ?>
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_data(){
	global $t_em_theme_data;
	$theme_data = wp_get_theme();
	$t_em_theme_data = array (
		'Name'			=> $theme_data->display( 'Name' ),
		'ThemeURI'		=> esc_url( $theme_data->display( 'ThemeURI' ) ),
		'Description'	=> $theme_data->display( 'Description' ),
		'Author'		=> $theme_data->display( 'Author' ),
		'AuthorURI'		=> esc_url( $theme_data->display( 'AuthorURI' ) ),
		'Version'		=> $theme_data->display( 'Version' ),
		'Template'		=> $theme_data->display( 'Template' ),
		'Status'		=> $theme_data->display( 'Status' ),
		'Tags'			=> $theme_data->display( 'Tags' ),
		'TextDomain'	=> $theme_data->display( 'TextDomain' ),
		'DomainPath'	=> $theme_data->display( 'DomainPath' ),
	);
}
add_action( 'after_setup_theme', 't_em_theme_data' );

/**
 * Return three variables we need to access to the database. Also check if something goes wrong
 * with the data base, in case of scratch, default set up will be loaded.
 * This function is attached to the after_setup_theme() action hook.
 *
 * @global $t_em_theme_options This var provide the main structure of our theme.
 * See t_em_default_theme_options() in /inc/theme-options.php file for a full list of
 * "key => option" array.
 *
 * @since Twenty'em 0.1
 */
function t_em_set_globals(){
	global	$t_em_theme_options;

	$t_em_theme_options = t_em_get_theme_options();

	// If options are empties, we load default settings.
	if ( empty( $t_em_theme_options ) )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
}
add_action( 'after_setup_theme', 't_em_set_globals' );

/**
 * Return the default options values for Twenty'em after the theme is loaded for first time. This
 * function manage the main option sections like General, Header, Archive, Layout and Social Network
 * Options in the Twenty'em admin panel.
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_default_theme_options(){
	$default_theme_options = array (
		// Generals Options
		't-em-link'						=> '1',
		'single-featured-img'			=> '1',
		'single-related-posts'			=> '1',
		// Header Options
		'header-set'					=> 'no-header-image',
		'header-featured-image'			=> '1',
		'slider-home-only'				=> '0',
		'slider-category'				=> get_option( 'default_category' ),
		'slider-number'					=> get_option( 'posts_per_page' ),
		'slider-text'					=> 'slider-text-center',
		'nivo-style'					=> 't-em',
		// Front Page Text Witgets Options
		'front-page-set'				=> 'wp-front-page',
		'headline-text-widget-one'		=> '',
		'content-text-widget-one'		=> '',
		'css-classes-text-widget-one'	=> '',
		'icon-src-text-widget-one'		=> '',
		'link-url-text-widget-one'		=> '',
		'headline-text-widget-two'		=> '',
		'content-text-widget-two'		=> '',
		'css-classes-text-widget-two'	=> '',
		'icon-src-text-widget-two'		=> '',
		'link-url-text-widget-two'		=> '',
		'headline-text-widget-three'	=> '',
		'content-text-widget-three'		=> '',
		'css-classes-text-widget-three'	=> '',
		'icon-src-text-widget-three'	=> '',
		'link-url-text-widget-three'	=> '',
		'headline-text-widget-four'		=> '',
		'content-text-widget-four'		=> '',
		'css-classes-text-widget-four'	=> '',
		'icon-src-text-widget-four'		=> '',
		'link-url-text-widget-four'		=> '',
		// Archive Options
		'archive-set'					=> 'the-content',
		'layout-set'					=> 'sidebar-right',
		'layout-width'					=> '960',
		'excerpt-set'					=> 'thumbnail-left',
		'slider-height'					=> '350',
		'excerpt-thumbnail-height'		=> get_option( 'thumbnail_size_h' ),
		'excerpt-thumbnail-width'		=> get_option( 'thumbnail_size_w' ),
		// Social Networks Options
		'twitter-set'					=> '',
		'facebook-set'					=> '',
		'googleplus-set'				=> '',
		'delicious-set'					=> '',
		'linkedin-set'					=> '',
		'github-set'					=> '',
		'wordpress-set'					=> '',
		'youtube-set'					=> '',
		'flickr-set'					=> '',
		'instagram-set'					=> '',
		'vimeo-set'						=> '',
		'reddit-set'					=> '',
		'picassa-set'					=> '',
		'lastfm-set'					=> '',
		'stumbleupon-set'				=> '',
		'pinterest-set'					=> '',
		'deviantart-set'				=> '',
		'myspace-set'					=> '',
		'xing-set'						=> '',
		'soundcloud-set'				=> '',
		'steam-set'						=> '',
		'dribbble-set'					=> '',
		'forrst-set'					=> '',
		'feed-set'						=> '',
		// Search Engines ID and Tracker Options
		'google-id'						=> '',
		'yahoo-id'						=> '',
		'bing-id'						=> '',
		'stats-tracker'					=> '',
	);

	return apply_filters( 't_em_default_theme_options', $default_theme_options );
}

/**
 * Return Width and Height text boxes for thumbnails in forms
 *
 * @param string $contex Require In which form ($contex) you want to use this function.
 * Example: You have a new slider plugin, and you want set Width and Height for yours thumbnail in
 * slideshow. So, you may call this function like this: $thumb = t_em_thumbnail_sizes( 'slideshow' );
 * See t_em_excerpt_callback() in /inc/archive-options.php file
 *
 * @return array
 *
 * @since Twenty'em 0.1
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
 * Return the whole configuration for Theme Options stored in the data base.
 * Referenced via t_em_set_globals() in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_get_theme_options(){
	return get_option( 't_em_theme_options', t_em_default_theme_options() );
}

/**
 * Finally a Options Page is displayed.
 * Referenced via t_em_theme_options_admin_page(), add_menu_page() callback
 *
 * @uses settings_fields() Output nonce, action, and option_page fields for a settings page.
 * @uses do_settings_sections() Prints out all settings sections added to /inc/theme-options.php.
 *
 * @link http://codex.wordpress.org/Settings_API
 * @link http://codex.wordpress.org/Administration_Menus
 *
 * @since Twenty'em 0.1
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
 * Referenced via t_em_register_setting_options_init(), register_setting() callback.
 *
 * @since Twenty'em 0.1
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
		'googleplus-set',
		'delicious-set',
		'linkedin-set',
		'github-set',
		'wordpress-set',
		'youtube-set',
		'flickr-set',
		'instagram-set',
		'vimeo-set',
		'reddit-set',
		'picassa-set',
		'lastfm-set',
		'stumbleupon-set',
		'pinterest-set',
		'deviantart-set',
		'myspace-set',
		'feed-set',
		'icon-src-text-widget-one',
		'link-url-text-widget-one',
		'icon-src-text-widget-two',
		'link-url-text-widget-two',
		'icon-src-text-widget-three',
		'link-url-text-widget-three',
		'icon-src-text-widget-four',
		'link-url-text-widget-four',
	) as $url ) :
		$input[$url] = esc_url_raw( $input[$url] );
	endforeach;

	// Validate all select list options
	$select_options = array (
		'slider-cat'		=> array (
			'set'		=> 'slider-category',
			'callback'	=> $list_categories,
		),
	);
	foreach ( $select_options as $select ) :
		if ( array_key_exists( $input[$select['set']], $select['callback'] ) )
			$input[$select] = $input[$select['set']];
	endforeach;

	// Validate all text options
	foreach ( array (
		'google-id',
		'yahoo-id',
		'bing-id',
		'headline-text-widget-one',
		'css-classes-text-widget-one',
		'headline-text-widget-two',
		'css-classes-text-widget-two',
		'headline-text-widget-three',
		'css-classes-text-widget-three',
		'headline-text-widget-four',
		'css-classes-text-widget-four',
	) as $text ) :
		$input[$text] = htmlentities( $input[$text] );
	endforeach;

	// Validate all textarea options
	foreach ( array (
		'stats-tracker',
		'content-text-widget-one',
		'content-text-widget-two',
		'content-text-widget-three',
		'content-text-widget-four',
	) as $textarea ) :
		$input[$textarea] = htmlentities( $input[$textarea] );
	endforeach;

	return $input;
}

/**
 * Add Twenty'em layout clases to the array of boddy clases
 *
 * @since Twenty'em 0.1
 */
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
add_filter( 'body_class', 't_em_layout_classes' );

/**
 * Add Twenty'em archive classes to the array of posts classes
 *
 * @since Twenty'em 0.1
 */
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
add_filter( 'post_class', 't_em_archive_classes' );
?>
