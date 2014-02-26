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
 * $GLOBALS
 */
// $GLOBALS['t_em'] = get_option( 't_em_theme_options' );

/**
 * Define Twenty'em CONSTANTS
 */

// Twenty'em Version
define ( 'T_EM_FRAMEWORK_NAME',		'Twenty’em' );
define ( 'T_EM_FRAMEWORK_VERSION',	'1.0' );

// Theme Directory URL
define ( 'T_EM_THEME_DIR_URL',					get_template_directory_uri() );
define ( 'T_EM_THEME_DIR_CSS_URL',				get_template_directory_uri().'/css' );
define ( 'T_EM_THEME_DIR_IMG_URL',				get_template_directory_uri().'/images' );
define ( 'T_EM_THEME_DIR_JS_URL',				get_template_directory_uri().'/js' );
define ( 'T_EM_THEME_DIR_DOCS_URL',				get_template_directory_uri().'/docs' );

/** Because of Less enqueue way can't be overwritten from a Child Theme:
 * <link rel="stylesheet/less" type="text/css" href="styles.less">
 * <script src="less.js" type="text/javascript"></script>
 * We use this constant for Less Style files
 */
define ( 'T_EM_THEME_DIR_CSS_LESS_STYLE_URL',	get_stylesheet_directory_uri().'/css' );

// Theme Includes Directory URL
define ( 'T_EM_INC_DIR_URL',			get_template_directory_uri().'/inc' );
define ( 'T_EM_INC_DIR_CSS_URL',		get_template_directory_uri().'/inc/css' );
define ( 'T_EM_INC_DIR_IMG_URL',		get_template_directory_uri().'/inc/images' );
define ( 'T_EM_INC_DIR_JS_URL',			get_template_directory_uri().'/inc/js' );

// Some direct path we need
define ( 'T_EM_INC_DIR_PATH',			get_template_directory().'/inc' );
define ( 'T_EM_THEME_DIR_LANG_PATH',	get_template_directory().'/languages' );

/**
 * Register default values through constants
 */
if ( ! defined( 'T_EM_SLIDER_DEFAULT_HEIGHT' ) )						define( 'T_EM_SLIDER_DEFAULT_HEIGHT', 350 );
if ( ! defined( 'T_EM_SLIDER_MAX_HEIGHT' ) )							define( 'T_EM_SLIDER_MAX_HEIGHT', 500 );
if ( ! defined( 'T_EM_SLIDER_MIN_HEIGHT' ) )							define( 'T_EM_SLIDER_MIN_HEIGHT', 200 );

if ( ! defined( 'T_EM_LAYOUT_WIDTH_DEFAULT_VALUE' ) )					define( 'T_EM_LAYOUT_WIDTH_DEFAULT_VALUE', 960 );
if ( ! defined( 'T_EM_LAYOUT_WIDTH_MAX_VALUE' ) )						define( 'T_EM_LAYOUT_WIDTH_MAX_VALUE', 1600 );
if ( ! defined( 'T_EM_LAYOUT_WIDTH_MIN_VALUE' ) )						define( 'T_EM_LAYOUT_WIDTH_MIN_VALUE', 600 );

if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE' ) )	define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE', 5000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE', 10000 );
if ( ! defined( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE' ) )		define( 'T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE', 1000 );

if ( ! defined( 'T_EM_NIVO_PAUSE_TIME_DEFAULT_VALUE' ) )				define( 'T_EM_NIVO_PAUSE_TIME_DEFAULT_VALUE', 5000 );
if ( ! defined( 'T_EM_NIVO_PAUSE_TIME_MAX_VALUE' ) )					define( 'T_EM_NIVO_PAUSE_TIME_MAX_VALUE', 10000 );
if ( ! defined( 'T_EM_NIVO_PAUSE_TIME_MIN_VALUE' ) )					define( 'T_EM_NIVO_PAUSE_TIME_MIN_VALUE', 1000 );

if ( ! defined( 'T_EM_NIVO_ANIM_SPEED_DEFAULT_VALUE' ) )				define( 'T_EM_NIVO_ANIM_SPEED_DEFAULT_VALUE', 500 );
if ( ! defined( 'T_EM_NIVO_ANIM_SPEED_MAX_VALUE' ) )					define( 'T_EM_NIVO_ANIM_SPEED_MAX_VALUE', 1000 );
if ( ! defined( 'T_EM_NIVO_ANIM_SPEED_MIN_VALUE' ) )					define( 'T_EM_NIVO_ANIM_SPEED_MIN_VALUE', 100 );

?>
