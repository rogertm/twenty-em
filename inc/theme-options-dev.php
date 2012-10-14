<?php
/**
 * Twenty'em theme options.
 *
 * @file			theme-options-dev.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/theme-options.php
 * @link			http://codex.wordpress.org/Administration_Menus
 * @since			Version 1.0
 */
?>
<?php
function t_em_theme_options_dev(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Developers Zone', 't_em' ) ?></h2>
	</div><!-- .wrap -->
<?php
}
?>
