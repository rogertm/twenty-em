<?php
/**
 * Twenty'em CONSTANTS.
 *
 * @file			constants.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/constants.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Define Twenty'em $GLOBALS
 */

/**
 * $t_em. Array. Contains all the options store in the data base.
 * See t_em_default_theme_options() in /inc/theme-options.php for a complete list of 'key' => 'value'
 * pairs
 */
$t_em = get_option( 't_em_theme_options' );
/**
 * $t_em_theme_data. Array. Contains theme's information stored in style.css file.
 */
$t_em_theme_data = array(
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

/**
 * Define Twenty'em CONSTANTS
 */

// Twenty'em Site
define ( 'T_EM_SITE',													'http://twenty-em.com' );

// Twenty'em Version
define ( 'T_EM_FRAMEWORK_NAME',											'Twenty\'em' );
define ( 'T_EM_FRAMEWORK_VERSION',										'1.0' );
define ( 'T_EM_FRAMEWORK_VERSION_STATUS',								'Beta' );
define ( 'T_EM_DB_VERSION',												'20151117' ); // In date format Ymd

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
define ( 'T_EM_THEME_DIR_FONTS_PATH',									T_EM_THEME_DIR_PATH . '/fonts' );
define ( 'T_EM_THEME_DIR_TEMPLATES_PATH',								T_EM_THEME_DIR_PATH . '/page-templates' );

// Theme Directory URL
define ( 'T_EM_THEME_DIR_URL',											get_template_directory_uri() );
define ( 'T_EM_CHILD_THEME_DIR_URL',									get_stylesheet_directory_uri() );
define ( 'T_EM_THEME_DIR_CSS_URL',										T_EM_THEME_DIR_URL . '/css' );
define ( 'T_EM_THEME_DIR_IMG_URL',										T_EM_THEME_DIR_URL . '/images' );
define ( 'T_EM_THEME_DIR_JS_URL',										T_EM_THEME_DIR_URL . '/js' );
define ( 'T_EM_THEME_DIR_FONTS_URL',									T_EM_THEME_DIR_URL . '/fonts' );
define ( 'T_EM_THEME_DIR_INC_URL',										T_EM_THEME_DIR_URL . '/inc' );
define ( 'T_EM_THEME_DIR_TEMPLATES_URL',								T_EM_THEME_DIR_URL . '/page-templates' );

/**
 * Register default values through constants
 */
if ( ! defined( 'T_EM_LAYOUT_WIDTH_DEFAULT_VALUE' ) )					define( 'T_EM_LAYOUT_WIDTH_DEFAULT_VALUE', 960 );
if ( ! defined( 'T_EM_LAYOUT_WIDTH_MAX_VALUE' ) )						define( 'T_EM_LAYOUT_WIDTH_MAX_VALUE', 1170 );
if ( ! defined( 'T_EM_LAYOUT_WIDTH_MIN_VALUE' ) )						define( 'T_EM_LAYOUT_WIDTH_MIN_VALUE', 600 );

if ( ! defined( 'T_EM_SLIDER_DEFAULT_HEIGHT' ) )						define( 'T_EM_SLIDER_DEFAULT_HEIGHT', 350 );
if ( ! defined( 'T_EM_SLIDER_MAX_HEIGHT' ) )							define( 'T_EM_SLIDER_MAX_HEIGHT', 500 );
if ( ! defined( 'T_EM_SLIDER_MIN_HEIGHT' ) )							define( 'T_EM_SLIDER_MIN_HEIGHT', 200 );

if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE' ) )	define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE', 5000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE', 10000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE', 1000 );

if ( ! defined( 'T_EM_HEADER_IMAGE_WIDTH' ) )							define( 'T_EM_HEADER_IMAGE_WIDTH', 1600 );
if ( ! defined( 'T_EM_HEADER_IMAGE_HEIGHT' ) )							define( 'T_EM_HEADER_IMAGE_HEIGHT', 560 );

/**
 * Register Data Base version
 */
function t_em_db_version(){
	add_option( 't_em_db_version', T_EM_DB_VERSION );
	return get_option( 't_em_db_version' );
}
add_action( 'after_switch_theme', 't_em_db_version' );

/**
 * Register Framework version
 */
function t_em_framework_version(){
	add_option( 't_em_framework_version', T_EM_FRAMEWORK_VERSION );
	return get_option( 't_em_framework_version' );
}
add_action( 'after_switch_theme', 't_em_framework_version' );

/**
 * Merge DB Version and Framework Version in to $t_em
 */
function t_em_merge_versions(){
	global $t_em;
	$versions = array(
		't_em_db_version' => get_option( 't_em_db_version' ),
		't_em_framework_version' => get_option( 't_em_framework_version' ),
	);
	$t_em = array_merge( $t_em, $versions );
}
add_action( 'after_setup_theme', 't_em_merge_versions' );
?>
