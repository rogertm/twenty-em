<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0
 */

/**
 * Twenty'em theme options.
 */

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
 * @since Twenty'em 1.0
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
	add_settings_field( 't_em_maintenance_mode', 	__( 'Maintenance Mode Options', 't_em' ),	't_em_settings_field_maintenance_mode_set', 	'twenty-em-options', 	'twenty-em-section' );

	do_action( 't_em_admin_action_add_settings_field' );
}
add_action( 'admin_init', 't_em_register_setting_options_init' );

/**
 * Register Style Sheet and Javascript to beautify the admin option page.
 * This function is attached ti the admin_init() action hook, but just if we are in the right place.
 *
 * @global $t_em_theme_data See t_em_theme_data()
 *
 * @since Twenty'em 1.0
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
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_register_script( 'script-admin-t-em', T_EM_ENGINE_DIR_JS_URL . '/theme-options.js', array( 'jquery', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-ui-datepicker' ), $t_em_theme_data['Version'], true );
		// L10n for theme-options.js
		$l10n = array(
			'upm_title'		=> __( 'Select Image', 't_em' ),
			'upm_button'	=> __( 'Use selected image', 't_em' ),
		);
		wp_localize_script( 'script-admin-t-em', 't_em_l10n_admin', $l10n );
		wp_enqueue_script( 'script-admin-t-em' );
		wp_enqueue_media();
		wp_enqueue_style( 'media' );
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
 * @since Twenty'em 1.0
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
 * This function is attached to the 'wp' action hook.
 *
 * @global $t_em This var provide the main structure of our theme.
 * See t_em_default_theme_options() in /engine/theme-options.php file for a full list of "key => value"
 * array.
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.1.1 Hooked in 'wp' in substitution of 'after_setup_theme'
 */
function t_em_restore_from_scratch(){
	global $t_em;
	// If options are empties, we load default settings.
	if ( ! $t_em )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
}
add_action( 'wp', 't_em_restore_from_scratch' );

/**
 * Return the default options values for Twenty'em after the theme is loaded for first time. This
 * function manage the main option sections like General, Header, Archive, Layout and Social Network
 * Options in the Twenty'em admin panel.
 *
 * @return array
 *
 * @since Twenty'em 1.0
 */
function t_em_default_theme_options( $default_theme_options = '' ){
	$default_theme_options = array(
		// Generals Options
		't_em_credit'									=> '1',
		'single_featured_img'							=> '1',
		'single_related_posts'							=> '1',
		'breadcrumb_path'								=> '1',
		'separate_comments_pings_tracks'				=> '1',
		'single_page_comments'							=> '1',
		'shortcode_buttoms'								=> '1',
		'show_debug_panel'								=> '0',
		// Header Options
		'header_set'									=> 'no-header',
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
		'text_widget_template'							=> 'template-jumbotron',
		// Archive Options
		'archive_set'									=> 'the-content',
		'excerpt_length'								=> '55',
		'excerpt_set'									=> 'thumbnail-left',
		'excerpt_thumbnail_width'						=> get_option( 'thumbnail_size_w' ),
		'excerpt_thumbnail_height'						=> get_option( 'thumbnail_size_h' ),
		'archive_in_columns'							=> '1',
		'archive_pagination_set'						=> 'prev-next',
		// Layout Options
		'layout_set'									=> 'two-columns-content-left',
		'footer_set'									=> 'four-footer-widget',
		'layout_fluid_width'							=> '',
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
		'xing_set'										=> '',
		'soundcloud_set'								=> '',
		'steam_set'										=> '',
		'dribbble_set'									=> '',
		'yelp_set'									=> '',
		'feed_set'										=> '',
		// Search Engines ID and Tracker Options
		'google_id'										=> '',
		'bing_id'										=> '',
		'pinterest_id'									=> '',
		'stats_tracker_header_tag'						=> '',
		'stats_tracker_body_tag'						=> '',
		// Maintenance Mode Options
		'maintenance_mode'								=> '',
		'maintenance_mode_headline'						=> '',
		'maintenance_mode_headline_icon_class'			=> '',
		'maintenance_mode_content'						=> '',
		'maintenance_mode_thumbnail_src'				=> '',
		'maintenance_mode_primary_button_text'			=> '',
		'maintenance_mode_primary_button_icon_class'	=> '',
		'maintenance_mode_primary_button_link'			=> '',
		'maintenance_mode_secondary_button_text'		=> '',
		'maintenance_mode_secondary_button_icon_class'	=> '',
		'maintenance_mode_secondary_button_link'		=> '',
		'maintenance_mode_timer'						=> '',
		'maintenance_mode_reactive'						=> '',
		'maintenance_mode_title_tag'					=> __( 'Site in Maintenance', 't_em' ),
	);

	/**
	 * Filter the array list of default theme options
	 *
	 * @param array An array of default options
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_default_theme_options', $default_theme_options );
}

/**
 * Finally a Options Page is displayed.
 * Referenced via t_em_theme_options_admin_page(), add_menu_page() callback
 *
 * @uses settings_fields() Output nonce, action, and option_page fields for a settings page.
 * @uses do_settings_sections() Prints out all settings sections added to /engine/theme-options.php.
 *
 * @link http://codex.wordpress.org/Settings_API
 * @link http://codex.wordpress.org/Administration_Menus
 *
 * @since Twenty'em 1.0
 */
function t_em_theme_options_page(){
	global $t_em;
?>
	<div class="wrap">
		<h2><?php echo T_EM_FRAMEWORK_NAME . ' ' . T_EM_FRAMEWORK_VERSION . ' ' . T_EM_FRAMEWORK_VERSION_STATUS ?></h2>
		<?php if ( $t_em['maintenance_mode'] ) : ?>
		<div class="updated" style="border-color:#00a0d2">
			<p><?php printf( __( 'You are using the <a href="%s"><strong>Maintenance Mode</strong></a>.', 't_em' ), wp_nonce_url( home_url( '/' ), 'maintenance_mode', 'maintenance-mode' ) ) ?></p>
		</div>
		<?php endif; ?>
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
 * @since Twenty'em 1.0
 */
function t_em_theme_options_validate( $input ){
	if ( $input != null ) :

		// All the checkbox are either 0 or 1
		foreach ( array(
			't_em_credit',
			'single_featured_img',
			'single_related_posts',
			'breadcrumb_path',
			'separate_comments_pings_tracks',
			'single_page_comments',
			'shortcode_buttoms',
			'show_debug_panel',
			'header_featured_image_home_only',
			'header_featured_image',
			'slider_home_only',
			'bootstrap_carousel_pause',
			'bootstrap_carousel_wrap',
			'static_header_home_only',
			'layout_fluid_width',
			'maintenance_mode',
			'maintenance_mode_reactive',
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
			'front-page-template'	=> array(
				'set'		=> 'text_widget_template',
				'callback'	=> t_em_front_page_witgets_templates(),
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
		) as $int ) :
			$input[$int] = wp_filter_nohtml_kses( $input[$int] );
		endforeach;

		// Validate all url (input[type="url"]) options
		foreach ( array(
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
			'yelp_set',
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
			'maintenance_mode_thumbnail_src',
			'maintenance_mode_primary_button_link',
			'maintenance_mode_secondary_button_link',
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
			'static_header_secondary_button_text',
			'primary_button_text_text_widget_one',
			'headline_text_widget_one',
			'primary_button_link_text_widget_one',
			'secondary_button_link_text_widget_one',
			'headline_text_widget_two',
			'primary_button_link_text_widget_two',
			'secondary_button_link_text_widget_two',
			'headline_text_widget_three',
			'primary_button_link_text_widget_three',
			'secondary_button_link_text_widget_three',
			'headline_text_widget_four',
			'primary_button_link_text_widget_four',
			'secondary_button_link_text_widget_four',
			'secondary_button_text_text_widget_one',
			'primary_button_text_text_widget_two',
			'secondary_button_text_text_widget_two',
			'primary_button_text_text_widget_three',
			'secondary_button_text_text_widget_three',
			'primary_button_text_text_widget_four',
			'secondary_button_text_text_widget_four',
			'maintenance_mode_headline',
			'maintenance_mode_content',
			'maintenance_mode_primary_button_text',
			'maintenance_mode_secondary_button_text',
			'maintenance_mode_title_tag',
		) as $text_field ) :
			$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( $input[$text_field] ) : '';
		endforeach;

		// Validate the Datepicker
		$year = date( 'Y' );
		$month = date( 'm' );
		$day = date( 'd' );
		$default_date = $year + 1 .'-'. $month .'-'. $day;
		$date = date_create( $input['maintenance_mode_timer'] );
		$input['maintenance_mode_timer'] = ( empty( $input['maintenance_mode_timer'] ) || date_format( $date, 'Y-m-d' ) == $input['maintenance_mode_timer'] ) ? $input['maintenance_mode_timer'] : $default_date;

		// Validate all text field icon-class options
		foreach ( array(
			'static_header_primary_button_icon_class',
			'static_header_secondary_button_icon_class',
			'headline_icon_class_text_widget_one',
			'primary_button_icon_class_text_widget_one',
			'secondary_button_icon_class_text_widget_one',
			'headline_icon_class_text_widget_two',
			'primary_button_icon_class_text_widget_two',
			'secondary_button_icon_class_text_widget_two',
			'headline_icon_class_text_widget_three',
			'primary_button_icon_class_text_widget_three',
			'secondary_button_icon_class_text_widget_three',
			'headline_icon_class_text_widget_four',
			'primary_button_icon_class_text_widget_four',
			'secondary_button_icon_class_text_widget_four',
			'maintenance_mode_headline_icon_class',
			'maintenance_mode_primary_button_icon_class',
			'maintenance_mode_secondary_button_icon_class',
		) as $text_field ) :
			$input[$text_field] = ( isset( $input[$text_field] ) ) ? trim( sanitize_text_field( $input[$text_field] ) ) : '';
		endforeach;

		// Validate all textarea options
		foreach ( array(
			'content_text_widget_one',
			'content_text_widget_two',
			'content_text_widget_three',
			'content_text_widget_four',
			'static_header_content',
		) as $textarea ) :
			$input[$textarea] = ( isset( $input[$textarea] ) ) ? trim( $input[$textarea] ) : '';
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
				$input[$content_key] = trim( urldecode( $match[1] ) );
			else :
				$input[$content_key] = trim( $input[$content_key] );
			endif;
		endforeach;

		// Validate all textarea (trackers) options
		$dirty_tracker = array( '<script type="text/javascript">', '<script>', '</script>', '\t', '\n', '\r', ' ' );
		foreach ( array(
			'stats_tracker_header_tag',
			'stats_tracker_body_tag',
		) as $text_tracker ) :
			$input[$text_tracker] = trim( str_replace( $dirty_tracker, '', $input[$text_tracker] ) );
		endforeach;

		add_settings_error( 't-em-update', 't-em-update', sprintf( __( 'Settings saved. <a href="%1$s">Visit your site</a>.', 't_em' ), home_url() ), 'updated' );

		/**
		 * Filter the array list of options to validate before to insert them in the data base
		 *
		 * @param array An array of options to validate
		 * @since Twenty'em 1.0
		 */
		return apply_filters( 't_em_admin_filter_theme_options_validate', $input );
	else :
		add_settings_error( 't-em-update', 't-em-update', t_em_rand_error_code(), 'error' );
	endif;
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

/**
 * Helper. Array fields order...
 */
function t_em_sort_by_order( $a, $b ){
	if ( $a['order'] == $b['order'] )
		return 0;
	return ( $a['order'] < $b['order'] ) ? -1 : 1;
}

/**
 * And thank you all :)
 * This function is attached to the admin_footer_text Filter Hook
 *
 * @since Twenty'em 1.0
 */
function t_em_thank_you_all(){
	$text = sprintf( __( 'Thank you for creating with <a href="%s">WordPress</a> and <a href="%s">%s</a>.', 't_em' ),
						__( 'https://wordpress.org/' ),
						T_EM_SITE,
						T_EM_FRAMEWORK_NAME );
	return '<span id="footer-thankyou"><em>' . $text . '</em></span>';
}
add_filter( 'admin_footer_text', 't_em_thank_you_all' );
?>
