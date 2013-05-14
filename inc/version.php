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
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Render some Theme Data from style.css as meta description.
 * 0. Theme Name
 * 1. Theme Version
 * 2. Theme Author
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_version(){
	global $t_em_theme_data;
	echo '<meta name="theme-name" content="' . $t_em_theme_data['Name'] . '">' . "\n";
	echo '<meta name="theme-version" content="' . $t_em_theme_data['Version'] . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $t_em_theme_data['Author'] ) . '">' . "\n";
}
add_action( 'wp_head', 't_em_theme_version' );
?>
