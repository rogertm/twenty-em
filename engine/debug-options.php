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
 * @since 			Twenty'em 1.2
 */

/**
 * If WP_DEBUG is set to true, show debug information for the user
 */
function t_em_register_debug_init(){
	if ( WP_DEBUG ) :
		add_settings_field( 't_em_debug_info', __( 'Debug Information', 't_em' ), 't_em_settings_field_debug_set', 'twenty-em-options', 'twenty-em-section' );
	endif;
}
add_action( 't_em_admin_action_add_settings_field', 't_em_register_debug_init', 999 );

/**
 * Return an array of Debug Options for Twenty'em admin panel.
 * @return array
 *
 * @since Twenty'em 1.2
 */
function t_em_debug_options(){
	$debug_options = array(
		'theme-data'	=> array(
			'value'		=> 'theme-data',
			'label'		=> __( 'Theme Data', 't_em' ),
			'callback'	=> ( apply_filters( 't_em_admin_filter_debug_options_theme_data', true ) ) ? t_em_debug_theme_data_callback() : null,
		),
		'theme-setting'	=> array(
			'value'		=> 'theme-setting',
			'label'		=> __( 'Theme Setting', 't_em' ),
			'callback'	=> ( apply_filters( 't_em_admin_filter_debug_options_theme_setting', true ) ) ? t_em_debug_theme_setting_callback() : null,
		),
		'default-setting'	=> array(
			'value'		=> 'default-setting',
			'label'		=> __( 'Default Setting', 't_em' ),
			'callback'	=> ( apply_filters( 't_em_admin_filter_debug_options_default_setting', true ) ) ? t_em_debug_default_setting_callback() : null,
		),
		'system-info'	=> array(
			'value'		=> 'system-info',
			'label'		=> __( 'System Information', 't_em' ),
			'callback'	=> ( apply_filters( 't_em_admin_filter_debug_options_system_info', true ) ) ? t_em_debug_system_info_callback() : null,
		),
	);

	/**
	 * Filter the Debug Options Set
	 *
	 * @param array An array of new options in the Debug Options Set.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'label', and 'callback' keys.
	 * @since Twenty'em 1.2
	 */
	return apply_filters( 't_em_admin_filter_debug_options', $debug_options );
}

/**
 * Theme Data
 *
 * @since Twenty'em 1.2
 */
function t_em_debug_theme_data_callback(){
	global $t_em_theme_data;

	$output = '<div class="sub-extend option-group">';
	// Theme Data
	$output .= '<strong>'. __( 'Theme Data', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=		'<dt>'. __( 'Framework:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. T_EM_FRAMEWORK_NAME .' '. T_EM_FRAMEWORK_VERSION .' <em>'. T_EM_FRAMEWORK_VERSION_NAME .'</em></dd>';
	$output .=		'<dt>'. __( 'Status:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. T_EM_FRAMEWORK_VERSION_STATUS .'</dd>';
	$output .=		'<dt>'. __( 'Data Base Version:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. T_EM_DB_VERSION .'</dd>';
	$output .=		'<dt>'. __( 'Current Theme:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. $t_em_theme_data['Name'] .' '. $t_em_theme_data['Version'] .'</dd>';
	$output .=		'<dt>'. __( 'Theme URI:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. $t_em_theme_data['ThemeURI'] .'</dd>';
	$output .=		'<dt>'. __( 'Theme Author:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. $t_em_theme_data['Author'] .'</dd>';
	$output .=		'<dt>'. __( 'Theme Tags:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. $t_em_theme_data['Tags'] .'</dd>';
	$output .=		'<dt>'. __( 'Theme Text Domain:', 't_em' ) .'</dt>';
	$output .=		'<dd>'. $t_em_theme_data['TextDomain'] .'</dd>';
	$output .= '</dl>';

	// CONSTANTS
	$output .= '<strong>'. __( 'CONSTANTS Values', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=		'<dt title="T_EM_WORDPRESS_VERSION"><code>'. __( 'T_EM_WORDPRESS_VERSION', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_WORDPRESS_VERSION .'</dd>';
	$output .=		'<dt title="T_EM_BOOTSTRAP_VERSION"><code>'. __( 'T_EM_BOOTSTRAP_VERSION', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_BOOTSTRAP_VERSION .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_PATH"><code>'. __( 'T_EM_THEME_DIR_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_PATH .'</dd>';
	$output .=		'<dt title="T_EM_CHILD_THEME_DIR_PATH"><code>'. __( 'T_EM_CHILD_THEME_DIR_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_CHILD_THEME_DIR_PATH .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_PATH"><code>'. __( 'T_EM_ENGINE_DIR_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_PATH .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_CSS_PATH"><code>'. __( 'T_EM_ENGINE_DIR_CSS_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_CSS_PATH .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_IMG_PATH"><code>'. __( 'T_EM_ENGINE_DIR_IMG_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_IMG_PATH .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_JS_PATH"><code>'. __( 'T_EM_ENGINE_DIR_JS_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_JS_PATH .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_URL"><code>'. __( 'T_EM_ENGINE_DIR_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_URL .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_CSS_URL"><code>'. __( 'T_EM_ENGINE_DIR_CSS_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_CSS_URL .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_IMG_URL"><code>'. __( 'T_EM_ENGINE_DIR_IMG_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_IMG_URL .'</dd>';
	$output .=		'<dt title="T_EM_ENGINE_DIR_JS_URL"><code>'. __( 'T_EM_ENGINE_DIR_JS_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_ENGINE_DIR_JS_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_INC_PATH"><code>'. __( 'T_EM_THEME_DIR_INC_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_INC_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_LANG_PATH"><code>'. __( 'T_EM_THEME_DIR_LANG_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_LANG_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_CSS_PATH"><code>'. __( 'T_EM_THEME_DIR_CSS_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_CSS_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_IMG_PATH"><code>'. __( 'T_EM_THEME_DIR_IMG_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_IMG_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_JS_PATH"><code>'. __( 'T_EM_THEME_DIR_JS_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_JS_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_FONTS_PATH"><code>'. __( 'T_EM_THEME_DIR_FONTS_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_FONTS_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_PAGE_TEMPLATES_PATH"><code>'. __( 'T_EM_THEME_DIR_PAGE_TEMPLATES_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_PAGE_TEMPLATES_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_TEMPLATES_PATH"><code>'. __( 'T_EM_THEME_DIR_TEMPLATES_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_TEMPLATES_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_BOOTSTRAP_PATH"><code>'. __( 'T_EM_THEME_DIR_BOOTSTRAP_PATH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_BOOTSTRAP_PATH .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_URL"><code>'. __( 'T_EM_THEME_DIR_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_URL .'</dd>';
	$output .=		'<dt title="T_EM_CHILD_THEME_DIR_URL"><code>'. __( 'T_EM_CHILD_THEME_DIR_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_CHILD_THEME_DIR_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_CSS_URL"><code>'. __( 'T_EM_THEME_DIR_CSS_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_CSS_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_IMG_URL"><code>'. __( 'T_EM_THEME_DIR_IMG_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_IMG_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_JS_URL"><code>'. __( 'T_EM_THEME_DIR_JS_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_JS_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_FONTS_URL"><code>'. __( 'T_EM_THEME_DIR_FONTS_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_FONTS_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_INC_URL"><code>'. __( 'T_EM_THEME_DIR_INC_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_INC_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_PAGE_TEMPLATES_URL"><code>'. __( 'T_EM_THEME_DIR_PAGE_TEMPLATES_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_PAGE_TEMPLATES_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_TEMPLATES_URL"><code>'. __( 'T_EM_THEME_DIR_TEMPLATES_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_TEMPLATES_URL .'</dd>';
	$output .=		'<dt title="T_EM_THEME_DIR_BOOTSTRAP_URL"><code>'. __( 'T_EM_THEME_DIR_BOOTSTRAP_URL', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_THEME_DIR_BOOTSTRAP_URL .'</dd>';
	$output .=		'<dt title="T_EM_SLIDER_DEFAULT_HEIGHT"><code>'. __( 'T_EM_SLIDER_DEFAULT_HEIGHT', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_SLIDER_DEFAULT_HEIGHT .'</dd>';
	$output .=		'<dt title="T_EM_SLIDER_MAX_HEIGHT"><code>'. __( 'T_EM_SLIDER_MAX_HEIGHT', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_SLIDER_MAX_HEIGHT .'</dd>';
	$output .=		'<dt title="T_EM_SLIDER_MIN_HEIGHT"><code>'. __( 'T_EM_SLIDER_MIN_HEIGHT', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_SLIDER_MIN_HEIGHT .'</dd>';
	$output .=		'<dt title="T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE"><code>'. __( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE .'</dd>';
	$output .=		'<dt title="T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE"><code>'. __( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE .'</dd>';
	$output .=		'<dt title="T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE"><code>'. __( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE .'</dd>';
	$output .=		'<dt title="T_EM_HEADER_IMAGE_WIDTH"><code>'. __( 'T_EM_HEADER_IMAGE_WIDTH', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_HEADER_IMAGE_WIDTH .'</dd>';
	$output .=		'<dt title="T_EM_HEADER_IMAGE_HEIGHT"><code>'. __( 'T_EM_HEADER_IMAGE_HEIGHT', 't_em' ) .'</code></dt>';
	$output .=		'<dd>'. T_EM_HEADER_IMAGE_HEIGHT .'</dd>';

	$output .= '</dl>';
	$output .= '</div>';


	return $output;
}

/**
 * Theme Setting
 *
 * @since Twenty'em 1.2
 */
function t_em_debug_theme_setting_callback(){
	global $t_em;
	ksort( $t_em );
	$output = '<div class="sub-extend option-group">';
		$output .= '<header>'. sprintf( __( 'Current Option: <code>%s</code>', 't_em' ), 't_em_theme_options' ) .'</header>';
		$output .= '<p class="alert alert-info">'. __( 'You can access these values through the <code>$t_em</code> global variable', 't_em' ) .'</p>';
		$output .= '<dl class="dl-horizontal">';
		foreach ( $t_em as $key => $value ) :
			$output .=		'<dt title="'. $key .'"><code>'. '['. $key .']' .'</code></dt>';
			$output .=		'<dd>'. '=> '. $value .'</dd>';
		endforeach;
		$output .= '</dl>';
	$output .= '</div>';
	return $output;
}

/**
 * Default Setting
 *
 * @since Twenty'em 1.2
 */
function t_em_debug_default_setting_callback(){
	$defaults = t_em_default_theme_options();
	ksort( $defaults );
	$output = '<div class="sub-extend option-group">';
		$output .= '<header>'. sprintf( __( 'Current Function: <code>%s</code>', 't_em' ), 't_em_default_theme_options()' ) .'</header>';
		$output .= '<p class="alert alert-info">'. __( 'This function return the defaults values of your theme', 't_em' ) .'</p>';
		$output .= '<dl class="dl-horizontal">';
		foreach ( $defaults as $key => $value ) :
			$output .=		'<dt title="'. $key .'"><code>'. '['. $key .']' .'</code></dt>';
			$output .=		'<dd>'. '=> '. $value .'</dd>';
		endforeach;
		$output .= '</dl>';
	$output .= '</div>';
	return $output;
}

/**
 * System Information
 *
 * @since Twenty'em 1.2
 */
function t_em_debug_system_info_callback(){
	global $t_em_theme_data, $wpdb;

	$output = '<div class="sub-extend option-group">';
	// Site Info
	$output .= '<strong>'. __( 'Site Info', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'Site URL:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. site_url() .'</dd>';
	$output .=	'<dt>'. __( 'Home URL:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. home_url() .'</dd>';
	$output .=	'<dt>'. __( 'Multisite:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( is_multisite() ? __( 'Yes', 't_em' ) : __( 'No', 't_em' ) ) .'</dd>';
	$output .= '</dl>';

	//  Hosting Provider
	$output .= '<strong>'. __( 'Hosting Provider', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'Domain:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $_SERVER['SERVER_NAME'] .'</dd>';
	$output .=	'<dt>'. __( 'IP:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $_SERVER['SERVER_ADDR'] .'</dd>';
	$output .= '</dl>';

	// Browser
	$output .= '<strong>'. __( 'Browser', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'User Agent:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $_SERVER['HTTP_USER_AGENT'] .'</dd>';
	$output .= '</dl>';

	// WordPress COnfiguration
	$locale = get_locale();
	$parent_theme = $t_em_theme_data['Template'];
	if ( ! empty( $parent_theme ) ) :
		$parent_theme_data	= wp_get_theme( $parent_theme );
		$parent_theme 		= $parent_theme_data->Name . ' ' . $parent_theme_data->Version;
	else :
		$parent_theme 		= __( 'N/A', 't_em' );
	endif;

	$output .= '<strong>'. __( 'WordPress Configuration', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'Version:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. get_bloginfo( 'version' ) .'</dd>';
	$output .=	'<dt>'. __( 'Language:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( ! empty( $locale ) ? $locale : __( 'en_US', 't_em' ) ) .'</dd>';
	$output .=	'<dt>'. __( 'Permalink Structure:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( get_option( 'permalink_structure' ) ? get_option( 'permalink_structure' ) : __( 'Default', 't_em' ) ) .'</dd>';
	$output .=	'<dt>'. __( 'Active Theme:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $t_em_theme_data['Name'] .' '. $t_em_theme_data['Version'] .'</dd>';
	$output .=	'<dt>'. __( 'Parent Theme:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $parent_theme .'</dd>';
	$output .=	'<dt>'. __( 'Show On Front:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. get_option( 'show_on_front', true ) .'</dd>';
	if ( get_option( 'show_on_front' ) == 'page' ) :
		$front_page_id = get_option( 'page_on_front' );
		$blog_page_id = get_option( 'page_for_posts' );
	$output .=	'<dt>'. __( 'Page On Front:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( $front_page_id != 0 ? sprintf( __( 'Title: %s - ID: %s', 't_em' ), get_the_title( $front_page_id ), $front_page_id ) : __( 'N/A', 't_em' ) ) .'</dd>';
	$output .=	'<dt>'. __( 'Page For Posts:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( $blog_page_id != 0 ? sprintf( __( 'Title: %s - ID: %s', 't_em' ), get_the_title( $blog_page_id ), $blog_page_id ) : __( 'N/A', 't_em' ) ) .'</dd>';
	endif;
	$output .=	'<dt>'. __( 'ABSPATH:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ABSPATH .'</dd>';
	$output .=	'<dt>'. __( 'Table Prefix:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. sprintf( __( '"%s". Length: %s. Status: %s', 't_em' ), $wpdb->prefix, strlen( $wpdb->prefix ), ( strlen( $wpdb->prefix ) > 16 ? __( 'ERROR: Too long', 't_em' ) : __( 'Acceptable', 't_em' ) ) ) .'</dd>';
	$output .=	'<dt>'. __( 'WP_DEBUG:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? __( 'Enabled', 't_em' ) : __( 'Disabled', 't_em' ) : __( 'N/A', 't_em' ) ) .'</dd>';
	$output .=	'<dt>'. __( 'Memory Limit:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. WP_MEMORY_LIMIT .'</dd>';
	$output .=	'<dt>'. __( 'Registered Post Stati:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. implode( ', ', get_post_stati() ) .'</dd>';
	$output .=	'<dt>'. __( 'Registered Post Types:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. implode( ', ', get_post_types() ) .'</dd>';
	$output .= '</dl>';

	// Active Plugins
	$updates = get_plugin_updates();
	$plugins = get_plugins();
	$active_plugins = get_option( 'active_plugins', array() );

	$output .= '<strong>'. __( 'Active Plugins', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	foreach ( $plugins as $plugins_path => $plugin ) :
		if ( ! in_array( $plugins_path, $active_plugins ) )
			continue;
			$update = ( array_key_exists( $plugins_path, $updates ) ) ? sprintf( __( 'Update Available - %s', 't_em' ), $updates[$plugins_path]->update->new_version ) : null;
		$output .= 	'<dt>'. $plugin['Name'] .'</dt>';
		$output .= 	'<dd>'. $plugin['Version'] .' '. $update .'</dd>';
	endforeach;
	$output .= '</dl>';

	// Inactive Plugins
	$output .= '<strong>'. __( 'Inactive Plugins', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	foreach ( $plugins as $plugins_path => $plugin ) :
		if ( in_array( $plugins_path, $active_plugins ) )
			continue;
			$update = ( array_key_exists( $plugins_path, $updates ) ) ? sprintf( __( 'Update Available - %s', 't_em' ), $updates[$plugins_path]->update->new_version ) : null;
		$output .= 	'<dt>'. $plugin['Name'] .'</dt>';
		$output .= 	'<dd>'. $plugin['Version'] .' '. $update .'</dd>';
	endforeach;
	$output .= '</dl>';

	// Multisite Plugins
	if ( is_multisite() ) :
		$plugins = wp_get_active_network_plugins();
		$active_plugins = get_site_option( 'active_sitewide_plugins', array() );

		$output .= '<strong>'. __( 'Network Active Plugins', 't_em' ) .'</strong>';
		$output .= '<dl class="dl-horizontal">';
		foreach ( $plugins as $plugin_path ) :
			$plugin_base = plugin_basename( $plugin_path );
			if( ! array_key_exists( $plugin_base, $active_plugins ) )
				continue;
			$update	= ( array_key_exists( $plugin_path, $updates ) ) ? sprintf( __( 'Update Available - %s', 't_em' ), $updates[$plugin_path]->update->new_version ) : null;
			$plugin = get_plugin_data( $plugin_path );
			$output .= 	'<dt>'. $plugin['Name'] .'</dt>';
			$output .= 	'<dd>'. $plugin['Version'] .' '. $update .'</dd>';
		endforeach;
		$output .= '</dl>';
	endif;

	// Webserver Configuration
	$output .= '<strong>'. __( 'Webserver Configuration', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'PHP Version:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. PHP_VERSION .'</dd>';
	$output .=	'<dt>'. __( 'MySQL Version:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $wpdb->db_version() .'</dd>';
	$output .=	'<dt>'. __( 'Webserver:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. $_SERVER['SERVER_SOFTWARE'] .'</dd>';
	$output .= '</dl>';

	// PHP Configuration
	$output .= '<strong>'. __( 'PHP Configuration', 't_em' ) .'</strong>';
	$output .= '<dl class="dl-horizontal">';
	$output .=	'<dt>'. __( 'Memory Limit:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ini_get( 'memory_limit' ) .'</dd>';

	$output .=	'<dt>'. __( 'Upload Max Size:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ini_get( 'upload_max_filesize' ) .'</dd>';

	$output .=	'<dt>'. __( 'Post Max Filesize:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ini_get( 'post_max_size' ) .'</dd>';

	$output .=	'<dt>'. __( 'Time Limit:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ini_get( 'max_execution_time' ) .'</dd>';

	$output .=	'<dt>'. __( 'Max Input Vars:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ini_get( 'max_input_vars' ) .'</dd>';

	$output .=	'<dt>'. __( 'Display Errors:', 't_em' ) .'</dt>';
	$output .=	'<dd>'. ( ini_get( 'display_errors' ) ? sprintf( __( 'On: %s', 't_em' ), ini_get( 'display_errors' ) ) : __( 'N/A', 't_em' ) ) .'</dd>';
	$output .= '</dl>';
	$output .= '</div>';
	return $output;
}

/**
 * The DEBUG
 */
function t_em_settings_field_debug_set(){
	global $t_em;
?>
	<div id="debug-options" class="tabs">
	<ul>
<?php
	foreach ( t_em_debug_options() as $header ) :
		if ( $header['callback'] ) :
?>
		<li>
			<a href="#<?php echo $header['value'] ?>" class="tab-heading">
				<?php echo $header['label']; ?>
			</a>
		</li>
<?php
		endif;
	endforeach;
?>
	</ul>
<?php

	/* If our 'callback' key brings something, then we display our callback function.
	 * Header Image or Slider, that's the question.
	 */
	foreach ( t_em_debug_options() as $sub_header ) :
		if ( $sub_header['callback'] ) :
?>
		<div id="<?php echo $sub_header['value']; ?>" class="sub-layout header-extend">
			<?php // do_action( "t_em_admin_action_header_option_{$sub_header['value']}_before" ); ?>
			<?php echo $sub_header['callback']; ?>
			<?php // do_action( "t_em_admin_action_header_option_{$sub_header['value']}_after" ); ?>
		</div>
<?php
		endif;
	endforeach;
?>
	</div>
<?php
}

function _t_em_debug_info(){
	global $t_em;
?>
	<div class="sub-extend option-group">
		<header><?php printf( __( 'Current Option: <code>%s</code>', 't_em' ), 't_em_theme_options' ) ?></header>
		<p class="alert alert-info"><?php _e( 'You can access these values through the <code>$t_em</code> global variable', 't_em' ) ?></p>
		<pre><?php print_r( get_option( 't_em_theme_options' ) ) ?></pre>
	</div>
<?php
}
?>