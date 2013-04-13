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
 * @filesource		wp-content/themes/twenty-em/inc/theme-options.php
 * @link			N/A
 * @since			Version 1.0
 */
?>
<?php
function t_em_theme_update(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Update', 't_em' ) ?></h2>
		<h3><?php _e( 'Oops! Stay pressing F5 key...', 't_em' ); ?></h3>
	</div><!-- .wrap -->
<?php
}
?>
