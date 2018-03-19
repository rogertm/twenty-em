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
 * @since 			Twenty'em 1.3
 */

/**
 * Main configuration function
 * @param $option string 	Option stored in t_em_theme_options in the data base option table
 * 							Optional. Default null
 * @return array|string 	Array containing all options in t_em_theme_options or string if $option
 * 							is set.
 *
 * @since Twenty'em 1.3
 */
function t_em( $option = null ){
	$t_em = get_option( 't_em_theme_options' );
	if ( $option )
		$t_em = $t_em[$option];
	else
		$t_em = $t_em;
	return $t_em;
}

/**
 * Get the Theme's headers
 * @param $header string 	Style sheet header.
 * 							Name, Description, Author, Version, ThemeURI, AuthorURI, Status, Tags, Template, TextDomain, DomainPath
 * @return string|array		Value of the given header or array if $header is not set.
 *
 * @since Twenty'em 1.3
 */
function t_em_theme( $header = null ){
	if ( $header )
		$theme = wp_get_theme()->display( $header );
	else
		$theme = array(
			'Name'			=> wp_get_theme()->display( 'Name' ),
			'ThemeURI'		=> esc_url( wp_get_theme()->display( 'ThemeURI' ) ),
			'Description'	=> wp_get_theme()->display( 'Description' ),
			'Author'		=> wp_get_theme()->display( 'Author' ),
			'AuthorURI'		=> esc_url( wp_get_theme()->display( 'AuthorURI' ) ),
			'Version'		=> wp_get_theme()->display( 'Version' ),
			'Template'		=> wp_get_theme()->display( 'Template' ),
			'Status'		=> wp_get_theme()->display( 'Status' ),
			'Tags'			=> wp_get_theme()->display( 'Tags' ),
			'TextDomain'	=> wp_get_theme()->display( 'TextDomain' ),
			'DomainPath'	=> wp_get_theme()->display( 'DomainPath' ),
		);
	return $theme;
}

/**
 * Register Data Base version
 *
 * @since Twenty'em N/A
 */
function t_em_db_version(){
	add_option( 't_em_db_version', T_EM_DB_VERSION );
	return get_option( 't_em_db_version' );
}
add_action( 'after_switch_theme', 't_em_db_version' );

/**
 * Register Framework version
 *
 * @since Twenty'em N/A
 */
function t_em_framework_version(){
	add_option( 't_em_framework_version', T_EM_FRAMEWORK_VERSION );
	return get_option( 't_em_framework_version' );
}
add_action( 'after_switch_theme', 't_em_framework_version' );

/**
 * Checks if something goes wrong with the data base, in case of scratch, default set up will be
 * loaded.
 * This function is attached to the 'wp' action hook.
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.1.1 Hooked in 'wp' in substitution of 'after_setup_theme'
 */
function t_em_restore_from_scratch(){
	// If options are empties, we load default settings.
	if ( ! t_em() )
		update_option( 't_em_theme_options', t_em_default_theme_options() );
}
add_action( 'wp', 't_em_restore_from_scratch' );

/**
 * Load the defaults values
 *
 * @since Twenty'em 1.3
 */
function t_em_load_defaults(){
	update_option( 't_em_theme_options', t_em_default_theme_options() );
}
add_action( 'after_switch_theme', 't_em_load_defaults' );

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
		'yelp_set'										=> '',
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
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 * Referenced via t_em_register_setting_options_init(), register_setting() callback.
 *
 * @since Twenty'em 1.0
 */
function t_em_theme_options_validate( $input ){
	if ( $input != null ) :

		// All the checkbox are either 1 or 0
		foreach ( array(
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
 * Helper. Array fields order...
 */
function t_em_sort_by_order( $a, $b ){
	if ( $a['order'] == $b['order'] )
		return 0;
	return ( $a['order'] < $b['order'] ) ? -1 : 1;
}
?>
