<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			http://twenty-em.com/
 * @since 			Twenty'em 1.0
 */

/**
 * The template for the sidebar containing the alternative widget area.
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
