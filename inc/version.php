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
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/version.php
 * @link			N/A
 * @since			Version 0.1
 */
?>
<?php
function t_em_theme_version(){
	global $t_em_theme_data;
	echo '<meta name="theme-name" content="' . $t_em_theme_data['Name'] . '">' . "\n";
	echo '<meta name="theme-version" content="' . $t_em_theme_data['Version'] . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $t_em_theme_data['Author'] ) . '">' . "\n";
}
add_action( 'wp_head', 't_em_theme_version' );
?>
