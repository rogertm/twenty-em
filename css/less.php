<?php
/**
 * Twenty'em LESS PHP.
 *
 * @file			less.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/css/less.php
 * @link			http://lesscss.org
 * @since			Twenty'em 1.0
 */
?>
<?php
/** Override the default Bootstrap font directory */
$file_path = 'css/less.php';
?>
@icon-font-path:	"<?php echo str_replace( $file_path, '', $_SERVER['PHP_SELF'] ); ?>fonts/";

// IcoMoon vars
@icomoon-font-name:		"icomoon";
@icomoon-font-svg-id:	"icomoon_regular";
