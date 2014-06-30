<?php
/**
 * Alternative Sidebar
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
global $t_em;

if ( in_array( $t_em['layout_set'], array(
	'three-column-content-left',
	'three-column-content-right',
	'three-column-content-middle' ) ) ) :

	/* The alternative widget area is triggered if have widgets.
	 * So let's check that first.
	 */
	if ( ! is_active_sidebar( 'sidebar-alt' ) ) return;
?>
	<section id="sidebar-alt" class="widget-area <?php echo t_em_add_bootstrap_class( 'sidebar-alt' ); ?>" role="complementary">
		<?php t_em_action_sidebar_alt_before(); ?>
<?php
		if ( is_active_sidebar( 'sidebar-alt' ) ) :
			dynamic_sidebar( 'sidebar-alt' );
		endif;
?>
		<?php t_em_action_sidebar_alt_after(); ?>
	</section><!-- #sidebar-alt -->
<?php
endif;
?>
