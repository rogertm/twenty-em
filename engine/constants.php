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
 * Define Twenty'em CONSTANTS
 */

// Twenty'em Site
define ( 'T_EM_SITE',													'https://themingisprose.com/twenty-em' );
define ( 'T_EM_BLOG',													'https://themingisprose.com/twenty-em/blog' );
define ( 'T_EM_WIKI', 													'https://themingisprose.com/twenty-em/documentacion' );
define ( 'T_EM_ICON_PACK', 												'https://themingisprose.com/icon-pack' );
define ( 'T_EM_PAYPAL', 												'https://paypal.me/themingisprose' );

// WordPress version in which Twenty'em has been tested
define ( 'T_EM_WORDPRESS_VERSION',										'4.9.8' );

// Twenty'em Version
define ( 'T_EM_FRAMEWORK_NAME',											'Twenty\'em' );
define ( 'T_EM_FRAMEWORK_VERSION',										'1.4.0' );
define ( 'T_EM_FRAMEWORK_VERSION_NAME',									__( 'Campephilus principalis', 't_em' ) );
define ( 'T_EM_FRAMEWORK_VERSION_STATUS',								'Beta' );
define ( 'T_EM_DB_VERSION',												'20180810' ); // In date format Ymd

// Third Party Softwares
define ( 'T_EM_BOOTSTRAP_VERSION',										'4.1.3' );

// Theme Directory Path
define( 'T_EM_THEME_DIR_PATH', 											get_template_directory() );
define( 'T_EM_CHILD_THEME_DIR_PATH', 									get_stylesheet_directory() );

// Engine Directory Path
define ( 'T_EM_ENGINE_DIR_PATH',										T_EM_THEME_DIR_PATH . '/engine' );
define ( 'T_EM_ENGINE_DIR_CSS_PATH',									T_EM_ENGINE_DIR_PATH . '/css' );
define ( 'T_EM_ENGINE_DIR_IMG_PATH',									T_EM_ENGINE_DIR_PATH . '/images' );
define ( 'T_EM_ENGINE_DIR_JS_PATH',										T_EM_ENGINE_DIR_PATH . '/js' );

// Engine Directory URL
define ( 'T_EM_ENGINE_DIR_URL',											get_template_directory_uri().'/engine' );
define ( 'T_EM_ENGINE_DIR_CSS_URL',										T_EM_ENGINE_DIR_URL . '/css' );
define ( 'T_EM_ENGINE_DIR_IMG_URL',										T_EM_ENGINE_DIR_URL . '/images' );
define ( 'T_EM_ENGINE_DIR_JS_URL',										T_EM_ENGINE_DIR_URL . '/js' );

// Theme Directory Path
define ( 'T_EM_THEME_DIR_INC_PATH',										T_EM_THEME_DIR_PATH . '/inc' );
define ( 'T_EM_THEME_DIR_LANG_PATH',									T_EM_THEME_DIR_PATH . '/languages' );
define ( 'T_EM_THEME_DIR_CSS_PATH',										T_EM_THEME_DIR_PATH . '/css' );
define ( 'T_EM_THEME_DIR_IMG_PATH',										T_EM_THEME_DIR_PATH . '/images' );
define ( 'T_EM_THEME_DIR_JS_PATH',										T_EM_THEME_DIR_PATH . '/js' );
define ( 'T_EM_THEME_DIR_PAGE_TEMPLATES_PATH',							T_EM_THEME_DIR_PATH . '/page-templates' );
define ( 'T_EM_THEME_DIR_TEMPLATES_PATH',								T_EM_THEME_DIR_PATH . '/templates' );
define ( 'T_EM_THEME_DIR_NODE_PATH',									T_EM_THEME_DIR_PATH . '/node_modules' );
define ( 'T_EM_THEME_DIR_BOOTSTRAP_PATH',								T_EM_THEME_DIR_NODE_PATH . '/bootstrap' );
define ( 'T_EM_THEME_DIR_JQUERY_PATH',									T_EM_THEME_DIR_NODE_PATH . '/jquery' );
define ( 'T_EM_THEME_DIR_ICON_PACK_PATH',								T_EM_THEME_DIR_NODE_PATH . '/@themingisprose/icon-pack' );

// Theme Directory URL
define ( 'T_EM_THEME_DIR_URL',											get_template_directory_uri() );
define ( 'T_EM_CHILD_THEME_DIR_URL',									get_stylesheet_directory_uri() );
define ( 'T_EM_THEME_DIR_CSS_URL',										T_EM_THEME_DIR_URL . '/css' );
define ( 'T_EM_THEME_DIR_IMG_URL',										T_EM_THEME_DIR_URL . '/images' );
define ( 'T_EM_THEME_DIR_JS_URL',										T_EM_THEME_DIR_URL . '/js' );
define ( 'T_EM_THEME_DIR_INC_URL',										T_EM_THEME_DIR_URL . '/inc' );
define ( 'T_EM_THEME_DIR_PAGE_TEMPLATES_URL',							T_EM_THEME_DIR_URL . '/page-templates' );
define ( 'T_EM_THEME_DIR_TEMPLATES_URL',								T_EM_THEME_DIR_URL . '/templates' );
define ( 'T_EM_THEME_DIR_NODE_URL',										T_EM_THEME_DIR_URL . '/node_modules' );
define ( 'T_EM_THEME_DIR_BOOTSTRAP_URL',								T_EM_THEME_DIR_NODE_URL . '/bootstrap' );
define ( 'T_EM_THEME_DIR_JQUERY_URL',									T_EM_THEME_DIR_NODE_URL . '/jquery' );
define ( 'T_EM_THEME_DIR_ICON_PACK_URL',								T_EM_THEME_DIR_NODE_URL . '/@themingisprose/icon-pack' );

/**
 * Register default values through constants
 */
if ( ! defined( 'T_EM_SLIDER_DEFAULT_HEIGHT' ) )						define( 'T_EM_SLIDER_DEFAULT_HEIGHT', 350 );
if ( ! defined( 'T_EM_SLIDER_MAX_HEIGHT' ) )							define( 'T_EM_SLIDER_MAX_HEIGHT', 500 );
if ( ! defined( 'T_EM_SLIDER_MIN_HEIGHT' ) )							define( 'T_EM_SLIDER_MIN_HEIGHT', 200 );

if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE' ) )	define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE', 5000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE', 10000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE', 1000 );

if ( ! defined( 'T_EM_HEADER_IMAGE_WIDTH' ) )							define( 'T_EM_HEADER_IMAGE_WIDTH', 1600 );
if ( ! defined( 'T_EM_HEADER_IMAGE_HEIGHT' ) )							define( 'T_EM_HEADER_IMAGE_HEIGHT', 560 );
?>
