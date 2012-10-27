<?php
/**
 * Twenty'em theme options.
 *
 * @file			theme-update.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/theme-webmaster-tools.php
 * @link			N/A
 * @since			Version 1.0
 */
?>
<?php
function t_em_theme_webmaster_tools(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Webmaster Tools', 't_em' ) ?></h2>
	</div><!-- .wrap -->
<?php
}
?>
