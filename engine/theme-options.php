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
// First of all we call this files we need to complete the Twenty'em engine.
require_once( T_EM_ENGINE_DIR_PATH . '/generals-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/header-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/front-page-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/archive-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/layout-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/social-network-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/webmaster-tools-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/theme-backup.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/actions.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/help.php' );
require_once( T_EM_INC_DIR_PATH . '/enqueue.php' );
require_once( T_EM_INC_DIR_PATH . '/shortcodes.php' );
require_once( T_EM_INC_DIR_PATH . '/widgets.php' );


/**
 * Register the form setting for our t_em_theme_options array.
 * This function is attached to the admin_init() action hook.
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
	add_settings_section( 'twenty-em-section', '', '__return_false', 'twenty-em-options' );

	// Register our individual settings fields
	add_settings_field( 't_em_general_set',			__( 'General Options', 't_em' ),			't_em_settings_field_general_options_set',		'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_header_set',			__( 'Header Options', 't_em' ),				't_em_settings_field_header_set',				'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_front_page_set',		__( 'Front Page Options', 't_em' ),			't_em_settings_field_front_page_options_set',	'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_archive_set',			__( 'Archive Options', 't_em' ),			't_em_settings_field_archive_set',				'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_layout_set',			__( 'Layout Options', 't_em' ),				't_em_settings_field_layout_set',				'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_social_set',			__( 'Social Network Options', 't_em' ),		't_em_settings_field_socialnetwork_set',		'twenty-em-options',	'twenty-em-section' );
	add_settings_field( 't_em_webmaster_tools_set', __( 'Webmaster Tools Options', 't_em' ),	't_em_settings_field_webmaster_tools_set', 		'twenty-em-options', 	'twenty-em-section' );

	do_action( 't_em_admin_action_add_settings_field' );
}
add_action( 'admin_init', 't_em_register_setting_options_init' );

/**
 * Register Style Sheet and Javascript to beautify the admin option page.
 * This function is attached ti the admin_init() action hook, but just if we are in the right place.
 *
 * @global $t_em_theme_data See t_em_theme_data()
 *
 * @since Twenty'em 0.1
 */
function t_em_admin_styles_and_scripts(){
	$screen = get_current_screen();
	if ( $screen->id == 'toplevel_page_twenty-em-options' ):
		// Check the theme version right from the style sheet
		global $t_em_theme_data;
		wp_register_style( 'style-admin-t-em', T_EM_ENGINE_DIR_CSS_URL . '/theme-options.css', false, $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'style-admin-t-em' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_register_script( 'script-admin-t-em', T_EM_ENGINE_DIR_JS_URL . '/theme-options.js', array( 'jquery', 'jquery-ui-accordion', 'jquery-ui-tabs' ), $t_em_theme_data['Version'], false );
		wp_enqueue_script( 'script-admin-t-em' );
	endif;
}
add_action( 'admin_enqueue_scripts', 't_em_admin_styles_and_scripts' );

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

	$theme_page 		= add_menu_page( T_EM_FRAMEWORK_NAME . ' ' . T_EM_FRAMEWORK_VERSION . ' ' . T_EM_FRAMEWORK_VERSION_STATUS, T_EM_FRAMEWORK_NAME, 'edit_theme_options', 'twenty-em-options', 't_em_theme_options_page', T_EM_ENGINE_DIR_IMG_URL . '/twenty-em-logo.png', '2.25031992' );
	$theme_backup_page	= add_submenu_page( 'twenty-em-options', __( 'Backup', 't_em' ), __( 'Backup', 't_em' ), 'edit_theme_options', 'twenty-em-backup', 't_em_theme_backup' );

	// We call our help screens
	if ( ! $theme_page ) return;
	if ( ! $theme_backup_page ) return;

	add_action( "load-$theme_page", 't_em_theme_options_help' );
	add_action( "load-$theme_backup_page", 't_em_theme_backup_help' );
}
add_action( 'admin_menu', 't_em_theme_options_admin_page' );

/**
 * Checks if something goes wrong with the data base, in case of scratch, default set up will be
 * loaded.
 * This function is attached to the after_setup_theme() action hook.
 *
 * @global $t_em This var provide the main structure of our theme.
 * See t_em_default_theme_options() in /inc/theme-options.php file for a full list of "key => value"
 * array.
 *
 * @since Twenty'em 0.1
 */
function t_em_restore_from_scratch(){
	global $t_em;
	// If options are empties, we load default settings.
	if ( empty( $t_em ) )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
}
add_action( 'after_setup_theme', 't_em_restore_from_scratch' );

/**
 * Return the default options values for Twenty'em after the theme is loaded for first time. This
 * function manage the main option sections like General, Header, Archive, Layout and Social Network
 * Options in the Twenty'em admin panel.
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_default_theme_options( $default_theme_options = '' ){
	$default_theme_options = array(
		// Generals Options
		't_em_link'										=> '1',
		'single_featured_img'							=> '1',
		'single_related_posts'							=> '1',
		'breadcrumb_path'								=> '1',
		'separate_comments_pings_tracks'				=> '1',
		'single_page_comments'							=> '1',
		'shortcode_buttoms'								=> '1',
		'favicon_url'									=> T_EM_THEME_DIR_IMG_URL . '/favicon.png',
		// Header Options
		'header_set'									=> 'no-header-image',
		'header_featured_image_home_only'				=> '0',
		'header_featured_image'							=> '1',
		'slider_home_only'								=> '0',
		'slider_category'								=> get_option( 'default_category' ),
		'slider_number'									=> get_option( 'posts_per_page' ),
		'slider_height'									=> T_EM_SLIDER_DEFAULT_HEIGHT,
		'bootstrap_carousel_interval'					=> T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE,
		'bootstrap_carousel_pause'						=> '1',
		'bootstrap_carousel_wrap'						=> '1',
		'static_header_home_only'						=> '0',
		'static_header_text'							=> 'static-header-text-right',
		'static_header_headline'						=> '',
		'static_header_img_src'							=> '',
		'static_header_content'							=> '',
		'static_header_primary_button_text'				=> '',
		'static_header_primary_button_icon_class'		=> '',
		'static_header_primary_button_link'				=> '',
		'static_header_secondary_button_text'			=> '',
		'static_header_secondary_button_icon_class'		=> '',
		'static_header_secondary_button_link'			=> '',
		// Front Page Text Witgets Options
		'front_page_set'								=> 'wp-front-page',
		'headline_text_widget_one'						=> '',
		'content_text_widget_one'						=> '',
		'headline_icon_class_text_widget_one'			=> '',
		'thumbnail_src_text_widget_one'					=> '',
		'primary_button_text_text_widget_one'			=> '',
		'primary_button_link_text_widget_one'			=> '',
		'primary_button_icon_class_text_widget_one'		=> '',
		'secondary_button_text_text_widget_one'			=> '',
		'secondary_button_link_text_widget_one'			=> '',
		'secondary_button_icon_class_text_widget_one'	=> '',
		'headline_text_widget_two'						=> '',
		'content_text_widget_two'						=> '',
		'headline_icon_class_text_widget_two'			=> '',
		'thumbnail_src_text_widget_two'					=> '',
		'primary_button_text_text_widget_two'			=> '',
		'primary_button_link_text_widget_two'			=> '',
		'primary_button_icon_class_text_widget_two'		=> '',
		'secondary_button_text_text_widget_two'			=> '',
		'secondary_button_link_text_widget_two'			=> '',
		'secondary_button_icon_class_text_widget_two'	=> '',
		'headline_text_widget_three'					=> '',
		'content_text_widget_three'						=> '',
		'headline_icon_class_text_widget_three'			=> '',
		'thumbnail_src_text_widget_three'				=> '',
		'primary_button_text_text_widget_three'			=> '',
		'primary_button_link_text_widget_three'			=> '',
		'primary_button_icon_class_text_widget_three'	=> '',
		'secondary_button_text_text_widget_three'		=> '',
		'secondary_button_link_text_widget_three'		=> '',
		'secondary_button_icon_class_text_widget_three'	=> '',
		'headline_text_widget_four'						=> '',
		'content_text_widget_four'						=> '',
		'headline_icon_class_text_widget_four'			=> '',
		'thumbnail_src_text_widget_four'				=> '',
		'primary_button_text_text_widget_four'			=> '',
		'primary_button_link_text_widget_four'			=> '',
		'primary_button_icon_class_text_widget_four'	=> '',
		'secondary_button_text_text_widget_four'		=> '',
		'secondary_button_link_text_widget_four'		=> '',
		'secondary_button_icon_class_text_widget_four'	=> '',
		// Archive Options
		'archive_set'									=> 'the-content',
		'excerpt_length'								=> '55',
		'excerpt_set'									=> 'thumbnail-left',
		'excerpt_thumbnail_width'						=> get_option( 'thumbnail_size_w' ),
		'excerpt_thumbnail_height'						=> get_option( 'thumbnail_size_h' ),
		'archive_in_columns'							=> '1',
		'archive_pagination_set'						=> 'prev-next',
		// Layout Options
		'layout_set'									=> 'two-column-content-left',
		'footer_set'									=> 'four-footer-widget',
		'layout_width'									=> T_EM_LAYOUT_WIDTH_DEFAULT_VALUE,
		// Social Networks Options
		'twitter_set'									=> '',
		'facebook_set'									=> '',
		'googleplus_set'								=> '',
		'delicious_set'									=> '',
		'linkedin_set'									=> '',
		'github_set'									=> '',
		'wordpress_set'									=> '',
		'youtube_set'									=> '',
		'flickr_set'									=> '',
		'tumblr_set'									=> '',
		'instagram_set'									=> '',
		'vimeo_set'										=> '',
		'reddit_set'									=> '',
		'picassa_set'									=> '',
		'lastfm_set'									=> '',
		'stumbleupon_set'								=> '',
		'pinterest_set'									=> '',
		'deviantart_set'								=> '',
		'myspace_set'									=> '',
		'xing_set'										=> '',
		'soundcloud_set'								=> '',
		'steam_set'										=> '',
		'dribbble_set'									=> '',
		'forrst_set'									=> '',
		'feed_set'										=> '',
		// Search Engines ID and Tracker Options
		'google_id'										=> '',
		'bing_id'										=> '',
		'pinterest_id'									=> '',
		'stats_tracker_header_tag'						=> '',
		'stats_tracker_body_tag'						=> '',
	);

	return apply_filters( 't_em_admin_filter_default_theme_options', $default_theme_options );
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
	global $t_em;
?>
	<div class="wrap">
		<h2><?php echo T_EM_FRAMEWORK_NAME . ' ' . T_EM_FRAMEWORK_VERSION . ' ' . T_EM_FRAMEWORK_VERSION_STATUS ?></h2>
		<?php if ( empty( $t_em ) ) : ?>
		<div class="error">
			<p><?php t_em_theme_explode(); ?></p>
		</div>
		<?php elseif ( t_em_db_version() < T_EM_DB_VERSION ) :
			// Check for updates!
			$options_diff = array_diff_key( t_em_default_theme_options(), $t_em );
			$options_update = array_merge( $options_diff, $t_em );
		?>
			<div class="updated">
		<?php 		if ( ! isset( $_GET['update-twenty-em'] ) ) : ?>
				<p><?php echo sprintf( __( 'Thank you for updating <strong>%1$s</strong>. Currently running <strong>Framework Version %2$s</strong> and <strong>Database Version %3$s</strong>. Before to continue, you need to update your database setting. For more security, please, <a href="%4$s">backup your setting</a>.', 't_em' ),
								T_EM_FRAMEWORK_NAME,
								T_EM_FRAMEWORK_VERSION,
								T_EM_DB_VERSION,
								admin_url( 'admin.php?page=twenty-em-backup' ) ); ?></p>
		<?php 		elseif ( isset( $_GET['update-twenty-em'] ) && $_GET['update-twenty-em'] == true ) : ?>
				<p><?php echo sprintf( __( 'Update completed. Back to <a href="%1$s">Theme Options</a> screen', 't_em' ), admin_url( 'admin.php?page=twenty-em-options' ) ) ?></p>
		<?php 		endif; ?>
			</div><!-- .updated -->

		<?php 		if ( ! isset( $_GET['update-twenty-em'] ) ) : ?>
			<a href="<?php echo admin_url( 'admin.php?page=twenty-em-options&amp;update-twenty-em=true' ) ?>" class="button button-hero button-primary">
				<?php printf( __( 'Update %s', 't_em' ), T_EM_FRAMEWORK_NAME ); ?>
			</a>
		<?php 		endif; ?>
		<?php 		if ( isset( $_GET['update-twenty-em'] ) && $_GET['update-twenty-em'] == true ) :
						update_option( 't_em_db_version', T_EM_DB_VERSION );
						update_option( 't_em_framework_version', T_EM_FRAMEWORK_VERSION );
						update_option( 't_em_theme_options', $options_update );
					endif;
		?>
		<?php else : ?>
			<?php settings_errors( 't-em-update' ); ?>
			<form id="t-em-setting" method="post" action="options.php">
				<?php
					settings_fields( 't_em_options' );
					do_settings_sections( 'twenty-em-options' );
					submit_button();
				?>
			</form>
		<?php endif; ?>
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
	if ( $input != null ) :

		// All the checkbox are either 0 or 1
		foreach ( array(
			't_em_link',
			'single_featured_img',
			'single_related_posts',
			'breadcrumb_path',
			'separate_comments_pings_tracks',
			'single_page_comments',
			'shortcode_buttoms',
			'header_featured_image_home_only',
			'header_featured_image',
			'slider_home_only',
			'bootstrap_carousel_pause',
			'bootstrap_carousel_wrap',
			'static_header_home_only',
		) as $checkbox ) :
			if ( !isset( $input[$checkbox] ) )
				$input[$checkbox] = null;
			$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
		endforeach;

		// Validate all radio options
		$radio_options = array(
			'header-options'	=> array(
				'set'		=> 'header_set',
				'callback'	=> t_em_header_options(),
			),
			'static-header-options'	=> array(
				'set'		=> 'static_header_text',
				'callback'	=> t_em_static_header_layout_options(),
			),
			'front-page-options'	=> array(
				'set'		=> 'front_page_set',
				'callback'	=> t_em_front_page_options(),
			),
			'archive-options'	=> array(
				'set'		=> 'archive_set',
				'callback'	=> t_em_archive_options(),
			),
			'archive-columns-options'	=> array(
				'set'		=> 'archive_in_columns',
				'callback'	=> t_em_archive_in_columns(),
			),
			'archive-pagination-options'	=> array(
				'set'		=> 'archive_pagination_set',
				'callback'	=> t_em_archive_pagination_options(),
			),
			'excerpt-options'	=> array(
				'set'		=> 'excerpt_set',
				'callback'	=> t_em_excerpt_options(),
			),
			'layout-options'	=> array(
				'set'		=> 'layout_set',
				'callback'	=> t_em_layout_options(),
			),
			'footer-options'	=> array(
				'set'		=> 'footer_set',
				'callback'	=> t_em_footer_options(),
			),
		);
		foreach ( $radio_options as $radio ) :
			if ( ! isset( $input[$radio['set']] ) )
				$input[$radio['set']] = null;
			if ( ! array_key_exists( $input[$radio['set']], $radio['callback'] ) )
				$input[$radio['set']] = null;
		endforeach;

		// Reset the columns
		if ( $input['archive_set'] == 'the-content' ) :
			$input['archive_in_columns'] = '1';
		endif;

		// Reset front page options
		if ( $input['front_page_set'] == 'widgets-front-page' ) :
			update_option( 'show_on_front', 'posts' );
			update_option( 'page_on_front', '0' );
			update_option( 'page_for_posts', '0' );
		endif;

		// Validate all int (input[type="number"]) options

		// Slider Height values: default: 350, max: 500, min: 200.
		if ( ( $input['slider_height'] < T_EM_SLIDER_MIN_HEIGHT || $input['slider_height'] > T_EM_SLIDER_MAX_HEIGHT ) || empty( $input['slider_height'] ) || ! is_numeric( $input['slider_height'] ) ) :
			$input['slider_height'] = T_EM_SLIDER_DEFAULT_HEIGHT;
		else :
			$input['slider_height'] = $input['slider_height'];
		endif;

		// Slider Number values: default: get_option( 'posts_per_page' );
		if ( empty( $input['slider_number'] ) || $input['slider_number'] < 0 || ! is_numeric( $input['slider_number'] ) ) :
			$input['slider_number'] = get_option( 'posts_per_page' );
		else :
			$input['slider_number'] = $input['slider_number'];
		endif;

		// Excerpt length value: default: 55
		if ( empty( $input['excerpt_length'] ) || ! is_numeric( $input['excerpt_length'] ) ) :
			$input['excerpt_length'] = 55;
		endif;

		// Excerpt Thumbnail Width values: default: get_option( 'thumbnail_size_w' );
		if ( empty( $input['excerpt_thumbnail_width'] ) || ! is_numeric( $input['excerpt_thumbnail_width'] ) ) :
			$input['excerpt_thumbnail_width'] = get_option( 'thumbnail_size_w' );
		else :
			$input['excerpt_thumbnail_width'] = $input['excerpt_thumbnail_width'];
		endif;

		// Excerpt Thumbnail Height values: default: get_option( 'thumbnail_size_h' );
		if ( empty( $input['excerpt_thumbnail_height'] ) || ! is_numeric( $input['excerpt_thumbnail_height'] ) ) :
			$input['excerpt_thumbnail_height'] = get_option( 'thumbnail_size_h' );
		else :
			$input['excerpt_thumbnail_height'] = $input['excerpt_thumbnail_height'];
		endif;

		// Layout Width values: default: 960, max: 1600, min: 600.
		if ( ( $input['layout_width'] < T_EM_LAYOUT_WIDTH_MIN_VALUE || $input['layout_width'] > T_EM_LAYOUT_WIDTH_MAX_VALUE ) || empty( $input['layout_width'] ) || ! is_numeric( $input['layout_width'] ) ) :
			$input['layout_width'] = T_EM_LAYOUT_WIDTH_DEFAULT_VALUE;
		else :
			$input['layout_width'] = $input['layout_width'];
		endif;

		// Bootstrap Carousel Interval: default: 5000, max: 10000, min: 1000.
		if ( ( $input['bootstrap_carousel_interval'] < T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE || $input['bootstrap_carousel_interval'] > T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE ) || empty( $input['bootstrap_carousel_interval'] ) || ! is_numeric( $input['bootstrap_carousel_interval'] ) ) :
			$input['bootstrap_carousel_interval'] = T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE;
		else :
			$input['bootstrap_carousel_interval'] = $input['bootstrap_carousel_interval'];
		endif;

		foreach( array(
			'slider_height',
			'slider_number',
			'bootstrap_carousel_interval',
			'excerpt_thumbnail_width',
			'excerpt_thumbnail_height',
			'layout_width',
		) as $int ) :
			$input[$int] = wp_filter_nohtml_kses( $input[$int] );
		endforeach;

		// Validate all url (input[type="url"]) options
		foreach ( array(
			'favicon_url',
			'twitter_set',
			'facebook_set',
			'googleplus_set',
			'delicious_set',
			'linkedin_set',
			'github_set',
			'wordpress_set',
			'youtube_set',
			'flickr_set',
			'tumblr_set',
			'instagram_set',
			'vimeo_set',
			'reddit_set',
			'picassa_set',
			'lastfm_set',
			'stumbleupon_set',
			'pinterest_set',
			'deviantart_set',
			'myspace_set',
			'feed_set',
			'thumbnail_src_text_widget_one',
			'primary_button_link_text_widget_one',
			'thumbnail_src_text_widget_two',
			'primary_button_link_text_widget_two',
			'thumbnail_src_text_widget_three',
			'primary_button_link_text_widget_three',
			'thumbnail_src_text_widget_four',
			'primary_button_link_text_widget_four',
			'static_header_img_src',
			'static_header_primary_button_link',
			'static_header_secondary_button_link',
		) as $url ) :
			$input[$url] = ( isset( $input[$url] ) ) ? esc_url_raw( $input[$url] ) : '';
		endforeach;

		// Validate all select list options
		$select_options = array(
			'slider-cat'	=> array(
				'set'		=> 'slider_category',
				'callback'	=> t_em_slider_list_taxonomies(),
			),
		);
		foreach ( $select_options as $select ) :
			if ( array_key_exists( $input[$select['set']], $select['callback'] ) )
				$input[$select] = $input[$select['set']];
		endforeach;

		// Validate all text field options
		foreach ( array(
			'static_header_headline',
			'static_header_primary_button_text',
			'static_header_primary_button_icon_class',
			'static_header_secondary_button_text',
			'static_header_secondary_button_icon_class',
			'primary_button_text_text_widget_one',
			'headline_text_widget_one',
			'headline_icon_class_text_widget_one',
			'primary_button_link_text_widget_one',
			'primary_button_icon_class_text_widget_one',
			'secondary_button_link_text_widget_one',
			'secondary_button_icon_class_text_widget_one',
			'headline_text_widget_two',
			'headline_icon_class_text_widget_two',
			'primary_button_link_text_widget_two',
			'primary_button_icon_class_text_widget_two',
			'secondary_button_link_text_widget_two',
			'secondary_button_icon_class_text_widget_two',
			'headline_text_widget_three',
			'headline_icon_class_text_widget_three',
			'primary_button_link_text_widget_three',
			'primary_button_icon_class_text_widget_three',
			'secondary_button_link_text_widget_three',
			'secondary_button_icon_class_text_widget_three',
			'headline_text_widget_four',
			'headline_icon_class_text_widget_four',
			'primary_button_link_text_widget_four',
			'primary_button_icon_class_text_widget_four',
			'secondary_button_link_text_widget_four',
			'secondary_button_icon_class_text_widget_four',
			'secondary_button_text_text_widget_one',
			'primary_button_text_text_widget_two',
			'secondary_button_text_text_widget_two',
			'primary_button_text_text_widget_three',
			'secondary_button_text_text_widget_three',
			'primary_button_text_text_widget_four',
			'secondary_button_text_text_widget_four',
		) as $text_field ) :
			$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( esc_textarea( $input[$text_field] ) ) : '';
		endforeach;

		// Validate all textarea options
		foreach ( array(
			'content_text_widget_one',
			'content_text_widget_two',
			'content_text_widget_three',
			'content_text_widget_four',
			'static_header_content',
		) as $textarea ) :
			$input[$textarea] = ( isset( $input[$textarea] ) ) ? trim( esc_textarea( $input[$textarea] ) ) : '';
		endforeach;

		// Validate all Verification Services
		foreach ( array(
			'google_id',
			'bing_id',
			'pinterest_id',
		) as $content_key ) :
			$pattern = '/content=["\']?([^"\' ]*)["\' ]/is';
			preg_match( $pattern, $input[$content_key], $match );
			if ( $match ) :
				$input[$content_key] = trim( htmlentities( $match[1] ) );
			else :
				$input[$content_key] = trim( htmlentities( $input[$content_key] ) );
			endif;
		endforeach;

		// Validate all textarea (trackers) options
		$dirty_tracker = array( '<script type="text/javascript">', '<script>', '</script>', '\t', '\n', '\r', ' ' );
		foreach ( array(
			'stats_tracker_header_tag',
			'stats_tracker_body_tag',
		) as $text_tracker ) :
			$input[$text_tracker] = trim( htmlentities( str_replace( $dirty_tracker, '', $input[$text_tracker] ) ) );
		endforeach;

		add_settings_error( 't-em-update', 't-em-update', sprintf( __( 'Settings saved. <a href="%1$s">Visit your site</a>.', 't_em' ), home_url() ), 'updated' );

		return apply_filters( 't_em_admin_filter_theme_options_validate', $input );
	else :
		add_settings_error( 't-em-update', 't-em-update', t_em_rand_error_code(), 'error' );
	endif;
}

/**
 * If WP_DEBUG is set to true, show debug information for the user
 */
function t_em_register_debug_init(){
	if ( WP_DEBUG ) :
		add_settings_field( 't_em_debug_info', __( 'Debug Information', 't_em' ), 't_em_debug_info', 'twenty-em-options', 'twenty-em-section' );
	endif;
}
add_action( 't_em_admin_action_add_settings_field', 't_em_register_debug_init', 999 );

function t_em_debug_info(){
	global $t_em;
?>
	<div class="sub-extend option-group">
		<header><?php printf( __( 'Current Option: <code>%s</code>' ), 't_em_theme_options' ) ?></header>
		<p class="alert alert-info"><?php _e( 'You can access these values through the <code>$t_em</code> global variable', 't_em' ) ?></p>
		<pre><?php print_r( get_option( 't_em_theme_options' ) ) ?></pre>
	</div>
<?php
}

/**
 * Useful to generate an error code number when $input is totally null xD
 *
 * @return int Error code ID
 *
 * @since Twenty'em 1.0
 */
function t_em_rand_error_code(){
	echo sprintf( __( 'Oops! An error has occurred. Error ID: <strong>%1$s</strong>', 't_em' ), md5( rand() ) );
}

/**
 * Idem...
 */
function t_em_theme_explode(){
	echo sprintf( __( 'Oops! Your theme explode... Error ID: <strong>%1$s</strong>', 't_em' ), md5( rand() ) );
}
?>
