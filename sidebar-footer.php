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
 * The template for the sidebar containing the footer widget area.
 */
?>

		<div id="colophon" class="py-5">
		<?php t_em_action_colophon_before(); ?>
		<?php
			/* The footer widget area is triggered if any of the areas
			 * have widgets. So let's check that first.
			 *
			 * If none of the sidebars have widgets, then let's bail early.
			 */

			if ( ( is_active_sidebar( 'first-footer-widget-area'  )
				|| is_active_sidebar( 'second-footer-widget-area' )
				|| is_active_sidebar( 'third-footer-widget-area'  )
				|| is_active_sidebar( 'fourth-footer-widget-area' )
				) && 'no-footer-widget' != t_em( 'footer_set' ) ) :

			// If we get this far, we have widgets. Let do this.
		?>
			<section id="footer-widget-area" class="<?php t_em_container(); ?>" role="complementary">
				<div class="row widget-area">
				<?php t_em_action_sidebar_footer_before(); ?>

			<?php if ( is_active_sidebar( 'first-footer-widget-area' )
					&& 'no-footer-widget' != t_em( 'footer_set' ) ) : ?>
					<aside id="first" <?php t_em_breakpoint( 'footer-widget-area' ); ?>>
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</aside><!-- #first .widget-area -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'second-footer-widget-area' )
					&& in_array( t_em( 'footer_set' ),
						array( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' ) ) ) : ?>
					<aside id="second" <?php t_em_breakpoint( 'footer-widget-area' ); ?>>
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</aside><!-- #second .widget-area -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'third-footer-widget-area' )
					&& in_array( t_em( 'footer_set' ),
						array( 'three-footer-widget', 'four-footer-widget' ) ) ) : ?>
					<aside id="third" <?php t_em_breakpoint( 'footer-widget-area' ); ?>>
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</aside><!-- #third .widget-area -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'fourth-footer-widget-area' )
					&& in_array( t_em( 'footer_set' ),
						array( 'four-footer-widget' ) ) ) : ?>
					<aside id="fourth" <?php t_em_breakpoint( 'footer-widget-area' ); ?>>
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</aside><!-- #fourth .widget-area -->
			<?php endif; ?>
				<?php t_em_action_sidebar_footer_after(); ?>
				</div><!-- .row .widget-area -->
			</section><!-- #footer-widget-area .wrapper .container -->

		<?php endif; // If there is any sidebar active ?>
		<?php t_em_action_colophon_after(); ?>
		</div><!-- #colophon -->
