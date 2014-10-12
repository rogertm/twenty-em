<?php
/**
 * The Sidebar containing the primary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

global $t_em;

if ( 'one-column' != $t_em['layout_set'] ) :
?>

		<section id="sidebar" class="widget-area <?php echo t_em_add_bootstrap_class( 'sidebar' ); ?>" role="complementary">
			<?php
			t_em_action_sidebar_before();
			if ( is_active_sidebar( 'sidebar' ) ) :
				dynamic_sidebar( 'sidebar' );
			endif;
			t_em_action_sidebar_after();
			?>
		</section><!-- #sidebar .widget-area -->

<?php endif; // If there is sidebar or not! ?>
