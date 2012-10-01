<?php
/**
 * Twenty'em control version.
 *
 * @file			version.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/includes/version.php
 * @link			N/A
 * @since			Version 1.0
 */
?>
<?php
function t_em_theme_version(){
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
	$theme_version = $theme_data->display('Version');
	$theme_author = $theme_data->display('Author');

	echo '<meta name="theme-name" content="' . $theme_name . '">' . "\n";
	echo '<meta name="theme-version" content="' . $theme_version . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $theme_author ) . '">' . "\n";
}
add_action( 'wp_head', 't_em_theme_version' );
?>
