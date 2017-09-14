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
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0
 */

/**
 * The template for the sidebar containing the main widget area.
 */

global $t_em;

if ( 'one-column' != $t_em['layout_set'] ) :
?>

		<section id="sidebar" role="complementary" <?php t_em_breakpoint( 'sidebar' ); ?>>
			<?php
			t_em_action_sidebar_before();
			if ( is_active_sidebar( 'sidebar' ) ) :
				dynamic_sidebar( 'sidebar' );
			endif;
			t_em_action_sidebar_after();
			?>
		</section><!-- #sidebar .widget-area -->

<?php endif; // If there is sidebar or not! ?>
