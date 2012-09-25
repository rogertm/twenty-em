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

function t_em_theme_version(){
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	$theme_name = $theme_data['Name'];
	$theme_version = $theme_data['Version'];
	$theme_uri = $theme_data['URI'];
	$theme_author = $theme_data['Author'];
	$theme_author_uri = $theme_data['AuthorURI'];

	echo '<meta name="theme-name" content="' . $theme_name . '">' . "\n";
	echo '<meta name="theme-version" content="' . $theme_version . '">' . "\n";
	echo '<meta name="theme-uri" content="' . $theme_uri . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $theme_author ) . '">' . "\n";
	echo '<meta name="theme-author-uri" content="' . $theme_author_uri . '">' . "\n";
}
add_action( 'wp_head', 't_em_theme_version' );
?>
