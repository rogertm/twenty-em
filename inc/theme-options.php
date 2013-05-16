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
									'page=theme-update' ) ) :
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
	add_settings_field( 't_em_general_set',	__( 'General Options', 't_em' ),		't_em_settings_field_general_options_set',	'theme-options',	'general' );
	add_settings_field( 't_em_header_set',	__( 'Header Options', 't_em' ),			't_em_settings_field_header_set',			'theme-options',	'general' );
	add_settings_field( 't_em_archive_set',	__( 'Archive Options', 't_em' ),		't_em_settings_field_archive_set',			'theme-options',	'general' );
	add_settings_field( 't_em_layout_set',	__( 'Layout Options', 't_em' ),			't_em_settings_field_layout_set',			'theme-options',	'general' );
	add_settings_field( 't_em_social_set',	__( 'Social Network Options', 't_em' ),	't_em_settings_field_socialnetwork_set',	'theme-options',	'general' );
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

	$theme_page 				= add_menu_page( $t_em_theme_data['Name'] . ' ' . __( 'Theme Options', 't_em' ), $t_em_theme_data['Name'], 'edit_theme_options', 'theme-options', 't_em_theme_options_page', T_EM_INC_DIR_IMG . '/t-em-favicon.png', 61 );
	$theme_tools_box_page 		= add_submenu_page( 'theme-options',	__( 'Tools Box', 't_em' ),			__( 'Tools Box', 't_em' ),			'edit_theme_options',	'theme-tools-box',			't_em_theme_tools_box_options' );
	$theme_webmaster_tools_page	= add_submenu_page( 'theme-options',	__( 'Webmaster Tools', 't_em' ),	__( 'Webmaster Tools', 't_em' ),	'edit_theme_options',	'theme-webmaster-tools',	't_em_theme_webmaster_tools' );


	// We call our help screens
	if ( ! $theme_page ) return;
	if ( ! $theme_tools_box_page ) return;
	if ( ! $theme_webmaster_tools_page ) return;

	add_action( "load-$theme_page", 't_em_theme_options_help' );
	add_action( "load-$theme_tools_box_page", 't_em_tools_box_options_help' );
	add_action( "load-$theme_webmaster_tools_page", 't_em_webmaster_tools_help' );
}
add_action( 'admin_menu', 't_em_theme_options_admin_page' );

// Now we call this files we need to complete the Twenty'em engine.
require( get_template_directory() . '/inc/theme-tools-box.php' );
require( get_template_directory() . '/inc/theme-webmaster-tools.php' );
require( get_template_directory() . '/inc/help.php' );
// require( get_template_directory() . '/inc/deprecated.php' );

/**
 * Redirect users to Twenty'em options page after theme activation and register the default options
 * at first time the theme is loaded.
 */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) :
	wp_redirect( 'admin.php?page=theme-options' );
	add_option( 't_em_theme_options', t_em_default_theme_options() );
	add_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
	add_option( 't_em_webmaster_tools_options', t_em_webmaster_tools_default_options() );
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
 * @global $t_em_tools_box_options This var provide a set of options to help you when you are
 * developing a Child Theme (Example: Active Golden Grid System).
 * See t_em_tools_box_default_options() in /inc/theme-tools-box.php file for a full list of
 * "key => option" array.
 * @global $t_em_webmaster_tools_option This var give you access to your webmaster tools code.
 * See t_em_webmaster_tools_default_options() in /inc/theme-webmaster-tools.php file for a full
 * list of "key => option" array.
 *
 * @since Twenty'em 0.1
 */
function t_em_set_globals(){
	global	$t_em_theme_options,
			$t_em_tools_box_options,
			$t_em_webmaster_tools_options;

	$t_em_theme_options				= t_em_get_theme_options();
	$t_em_tools_box_options			= t_em_get_tools_box_options();
	$t_em_webmaster_tools_options	= t_em_get_webmaster_tools_options();

	// If options are empties, we load default settings.
	if ( empty( $t_em_theme_options ) )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
	if ( empty( $t_em_tools_box_options ) )
		update_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
	if ( empty( $t_em_webmaster_tools_options ) )
		update_option( 't_em_webmaster_tools_options', t_em_webmaster_tools_default_options() );
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
		't-em-link'					=> '1',
		'single-featured-img'		=> '1',
		'single-related-posts'		=> '1',
		'header-set'				=> 'no-header-image',
		'header-featured-image'		=> '1',
		'slider-home-only'			=> '0',
		'slider-category'			=> get_option( 'default_category' ),
		'slider-number'				=> get_option( 'posts_per_page' ),
		'slider-text'				=> 'slider-text-center',
		'archive-set'				=> 'the-content',
		'layout-set'				=> 'sidebar-right',
		'layout-width'				=> '960',
		'excerpt-set'				=> 'thumbnail-left',
		'slider-height'				=> '350',
		'nivo-style'				=> 't-em',
		'excerpt-thumbnail-height'	=> get_option( 'thumbnail_size_h' ),
		'excerpt-thumbnail-width'	=> get_option( 'thumbnail_size_w' ),
		'twitter-set'				=> '',
		'facebook-set'				=> '',
		'googleplus-set'			=> '',
		'delicious-set'				=> '',
		'linkedin-set'				=> '',
		'github-set'				=> '',
		'wordpress-set'				=> '',
		'youtube-set'				=> '',
		'flickr-set'				=> '',
		'instagram-set'				=> '',
		'vimeo-set'					=> '',
		'reddit-set'				=> '',
		'picassa-set'				=> '',
		'lastfm-set'				=> '',
		'stumbleupon-set'			=> '',
		'pinterest-set'				=> '',
		'deviantart-set'			=> '',
		'myspace-set'				=> '',
		'xing-set'					=> '',
		'soundcloud-set'			=> '',
		'steam-set'					=> '',
		'dribbble-set'				=> '',
		'forrst-set'				=> '',
		'feed-set'					=> '',
	);

	return apply_filters( 't_em_default_theme_options', $default_theme_options );
}

/**
 * Return an array of General Options for Twenty'em admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_general_options(){
	$general_options = array (
		't-em-link'				=> array (
			'name'			=> 't-em-link',
			'label'			=> sprintf( __( 'Show <strong><a href="%1$s" target="_blank">Twenty&#8217;em.com</a></strong> and <strong><a href="http://wordpress.org/" target="_blank">WordPress.org</a></strong> home page link at the bottom of your site?', 't_em' ), 'http://twenty-em.com' ),
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
 * Return an array of Header Options for Twenty'em admin panel.
 * This function manage what is displayed in our theme header. Possibles options are:
 * 0. Nothing (no-header-image)
 * 1. Header image (header-image) defined in t_em_support_custom_header_image() function in
 * /inc/functions.php
 * 2. Slider (slider) displaying featured posts of such category
 *
 * @return array
 *
 * @since Twenty'em 0.1
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
 * Extend setting for Header Image Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
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
 * Extend setting for Header Slider Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 * @global $slider_layout Return an array with our slider's layout options.
 * @global $list_categories Havana, we have a list of categories... Should I say more?
 *
 * @since Twenty'em 0.1
 */
function t_em_slider_callback(){
	global	$t_em_theme_options,
			$slider_layout,
			$list_categories;

	$slider_layout = array (
		'slider-text-center' => array (
			'value' => 'slider-text-center',
			'label' => __( 'Slider text on center', 't_em' ),
			'title' => T_EM_INC_DIR_IMG . '/slider-text-center.png',
		),
		'slider-text-left' => array (
			'value' => 'slider-text-left',
			'label' => __( 'Slider text on left', 't_em' ),
			'title' => T_EM_INC_DIR_IMG . '/slider-text-left.png',
		),
		'slider-text-right' => array (
			'value' => 'slider-text-right',
			'label' => __( 'Slider text on right', 't_em' ),
			'title' => T_EM_INC_DIR_IMG . '/slider-text-right.png',
		),
	);

	/**
	 * Twenty'em uses Nivo SLider jQuery Plugin by default, and we create our own style. If you want
	 * add your own style, just add a new key like this:
	 * 'style-your-style'	=> array (
	 * 		'value'	=> 'your-style',
	 * 		'label'	=> __( 'My own Style', 't_em' ),
	 * ),
	 * Do not forget to save all your stuff in /css/nivo-slider/themes/your-style/your-style.css
	 */
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
		$checked_option = checked( $t_em_theme_options['nivo-style'], $style['value'], false );
		$extend_slider .=	'<div class="layout radio-option">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=		'<input type="radio" name="t_em_theme_options[nivo-style]" class="sub-radio-option" value="'.esc_attr( $style['value'] ).'" '. $checked_option .' />';
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
	$list_categories = get_categories();
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

	// How many slides to show?
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<p>'. sprintf( __( 'Introduce the number of slides you want to show. Default value will be <strong>%1$s</strong>, set at your <a href="%2$s" target="_blank">Reading Settings</a> posts per page option', 't_em' ),
		get_option( 'posts_per_page' ),
		admin_url( 'options-reading.php' ) ) .'</p>';
	$extend_slider .= 		'<input type="number"  name="t_em_theme_options[slider-number]" value="'. esc_attr( $t_em_theme_options['slider-number'] ) .'" />';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	return $extend_slider;
}

/**
 * Return an array of Archive Options for Twenty'em admin panel.
 * This function manage what and how is displayed in our theme archive. Possibles options are:
 * 0. Display the whole posts content (the-content).
 * 1. Display the posts excerpt (the-excerpt), here we call t_em_excerpt_callback() function which
 * display several sub-options.
 *
 * @return array
 *
 * @since Twenty'em 0.1
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
 * Extend setting for Archive Option in Twenty'em admin panel.
 * Referenced via t_em_archive_options().
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 * @global $excerpt_options Returns an array of our archive excerpt options.
 *
 * @since Twenty'em 0.1
 */
function t_em_excerpt_callback(){
	global	$t_em_theme_options,
			$excerpt_options;

	$excerpt_options = array (
		'thumbnail-left' => array(
			'value' => 'thumbnail-left',
			'label' => __( 'Thumbnail on left', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/thumbnail-left.png',
		),
		'thumbnail-right' => array(
			'value' => 'thumbnail-right',
			'label' => __( 'Thumbnail on right', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/thumbnail-right.png',
		),
		'thumbnail-center' => array(
			'value' => 'thumbnail-center',
			'label' => __( 'Thumbnail on center', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/thumbnail-center.png',
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
 * Return an array of Layout Options for Twenty'em admin panel.
 * This function manage how is displayed our theme layout. Possibles options are:
 * 0. Sidebar on right (sidebar-right).
 * 1. Sidebar on left (sidebar-left).
 * 2. One column, no sidebar (content).
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_options(){
	$layout_options = array (
		'sidebar-right' => array(
			'value' => 'sidebar-right',
			'label' => __( 'Sidebar on right', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/sidebar-right.png',
		),
		'sidebar-left' => array(
			'value' => 'sidebar-left',
			'label' => __( 'Sidebar on left', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/sidebar-left.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/one-column.png',
		),
	);

	return apply_filters( 't_em_layout_options', $layout_options );
}

/**
 * Display a text box into Layout Options panel where you may enter your theme width.
 * Referenced via t_em_settings_field_layout_set().
 *
 * @return string HTML Text box form.
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_width(){
	global $t_em_theme_options;

	$layout_width = '';
	$layout_width .= '<div class="sub-extend">';
	$layout_width .= 	'<div class="layout text-option layout-width">';
	$layout_width .= 		'<label>';
	$layout_width .= 		'<span>'. __( 'Enter the value you wish to be your theme width. If empty, the value will be <strong>960px</strong>.', 't_em' ) .'</span>';
	$layout_width .= 			'<input type="number" name="t_em_theme_options[layout-width]" value="'.$t_em_theme_options['layout-width'].'" /><span class="unit">px</span>';
	$layout_width .= 		'</label>';
	$layout_width .= 	'</div>';
	$layout_width .= '</div>';

	return $layout_width;
}

/**
 * Return an array of Social Network Options for Twenty'em admin panel.
 * This function manage several social network options which you may use to display your profiles
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_social_network_options(){
	$socialnetwork_options = array (
		'twitter-set' => array (
			'value' => '',
			'name' => 'twitter-set',
			'label' => __( 'Twitter URL', 't_em' ),
			'item' => __( 'Twitter', 't_em' ),
			'class' => 'icon-twitter',
		),
		'facebook-set' => array (
			'value' => '',
			'name' => 'facebook-set',
			'label' => __( 'Facebook URL', 't_em' ),
			'item' => __( 'Facebook', 't_em' ),
			'class' => 'icon-facebook',
		),
		'googleplus-set' => array (
			'value' => '',
			'name' => 'googleplus-set',
			'label' => __( 'Google + URL', 't_em' ),
			'item' => __( 'Google +', 't_em' ),
			'class' => 'icon-googleplus',
		),
		'delicious-set' => array (
			'value' => '',
			'name' => 'delicious-set',
			'label' => __( 'Delicious URL', 't_em' ),
			'item' => __( 'Delicious', 't_em' ),
			'class' => 'icon-delicious',
		),
		'linkedin-set' => array (
			'value' => '',
			'name' => 'linkedin-set',
			'label' => __( 'Linked In URL', 't_em' ),
			'item' => __( 'Linked In', 't_em' ),
			'class' => 'icon-linkedin',
		),
		'github-set' => array (
			'value' => '',
			'name' => 'github-set',
			'label' => __( 'Github URL', 't_em' ),
			'item' => __( 'Github', 't_em' ),
			'class' => 'icon-github',
		),
		'wordpress-set' => array (
			'value' => '',
			'name' => 'wordpress-set',
			'label' => __( 'WordPress URL', 't_em' ),
			'item' => __( 'WordPress', 't_em' ),
			'class' => 'icon-wordpress',
		),
		'youtube-set' => array (
			'value' => '',
			'name' => 'youtube-set',
			'label' => __( 'YouTube URL', 't_em' ),
			'item' => __( 'YouTube', 't_em' ),
			'class' => 'icon-youtube',
		),
		'flickr-set' => array (
			'value' => '',
			'name' => 'flickr-set',
			'label' => __( 'Flickr URL', 't_em' ),
			'item' => __( 'Flickr', 't_em' ),
			'class' => 'icon-flickr',
		),
		'instagram-set' => array (
			'value' => '',
			'name' => 'instagram-set',
			'label' => __( 'Instagram URL', 't_em' ),
			'item' => __( 'Instagram', 't_em' ),
			'class' => 'icon-instagram',
		),
		'vimeo-set' => array (
			'value' => '',
			'name' => 'vimeo-set',
			'label' => __( 'Vimeo URL', 't_em' ),
			'item' => __( 'Vimeo', 't_em' ),
			'class' => 'icon-vimeo',
		),
		'reddit-set' => array (
			'value' => '',
			'name' => 'reddit-set',
			'label' => __( 'Reddit URL', 't_em' ),
			'item' => __( 'Reddit', 't_em' ),
			'class' => 'icon-reddit',
		),
		'picassa-set' => array (
			'value' => '',
			'name' => 'picassa-set',
			'label' => __( 'Picassa URL', 't_em' ),
			'item' => __( 'Picassa', 't_em' ),
			'class' => 'icon-picassa',
		),
		'lastfm-set' => array (
			'value' => '',
			'name' => 'lastfm-set',
			'label' => __( 'Lastfm URL', 't_em' ),
			'item' => __( 'Lastfm', 't_em' ),
			'class' => 'icon-lastfm',
		),
		'stumbleupon-set' => array (
			'value' => '',
			'name' => 'stumbleupon-set',
			'label' => __( 'Stumbleupon URL', 't_em' ),
			'item' => __( 'Stumbleupon', 't_em' ),
			'class' => 'icon-stumbleupon',
		),
		'pinterest-set' => array (
			'value' => '',
			'name' => 'pinterest-set',
			'label' => __( 'Pinterest URL', 't_em' ),
			'item' => __( 'Pinterest', 't_em' ),
			'class' => 'icon-pinterest',
		),
		'deviantart-set' => array (
			'value' => '',
			'name' => 'deviantart-set',
			'label' => __( 'Deviantart URL', 't_em' ),
			'item' => __( 'Deviantart', 't_em' ),
			'class' => 'icon-deviantart',
		),
		'myspace-set' => array (
			'value' => '',
			'name' => 'myspace-set',
			'label' => __( 'My Space URL', 't_em' ),
			'item' => __( 'My Space', 't_em' ),
			'class' => 'icon-myspace',
		),
		'xing-set' => array (
			'value' => '',
			'name' => 'xing-set',
			'label' => __( 'Xing URL', 't_em' ),
			'item' => __( 'Xing', 't_em' ),
			'class' => 'icon-xing',
		),
		'soundcloud-set' => array (
			'value' => '',
			'name' => 'soundcloud-set',
			'label' => __( 'Soundcloud URL', 't_em' ),
			'item' => __( 'Soundcloud', 't_em' ),
			'class' => 'icon-soundcloud',
		),
		'steam-set' => array (
			'value' => '',
			'name' => 'steam-set',
			'label' => __( 'Steam URL', 't_em' ),
			'item' => __( 'Steam', 't_em' ),
			'class' => 'icon-steam',
		),
		'dribbble-set' => array (
			'value' => '',
			'name' => 'dribbble-set',
			'label' => __( 'Dribbble URL', 't_em' ),
			'item' => __( 'Dribbble', 't_em' ),
			'class' => 'icon-dribbble',
		),
		'forrst-set' => array (
			'value' => '',
			'name' => 'forrst-set',
			'label' => __( 'Sorrst URL', 't_em' ),
			'item' => __( 'Sorrst', 't_em' ),
			'class' => 'icon-forrst',
		),
		'feed-set' => array (
			'value' => '',
			'name' => 'feed-set',
			'label' => __( 'Feed or RSS URL', 't_em' ),
			'item' => __( 'Feed / RSS', 't_em' ),
			'class' => 'icon-feed',
		),
	);

	return apply_filters( 't_em_social_network_options', $socialnetwork_options );
}

/**
 * Return Width and Height text boxes for thumbnails in forms
 *
 * @param string $contex Require In which form ($contex) you want to use this function.
 * Example: You have a new slider plugin, and you want set Width and Height for yours thumbnail in
 * slideshow. So, you may call this function like this: $thumb = t_em_thumbnail_sizes( 'slideshow' );
 * See t_em_excerpt_callback() in /inc/theme-options.php file
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
 * Render the General Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
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
 * Render the Header setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
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

	/* If our 'extend' key brings something, then we display our callback function.
	 * Header Image or Slider, that's the question.
	 */
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
 * Render the Archive setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
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

	/* If our 'extend' key brings something, then we display our callback function.
	 * Let's go for the_excerpt().
	 */
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
 * Render the Layout setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback.
 *
 * @uses t_em_layout_width() Display a text box into Layout Options panel where you may enter
 * your theme width.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
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
 * Render the Socialnetwork setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
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
