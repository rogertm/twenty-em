<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

			<section id="footer-widget-area" class="wrapper container-fluid" role="complementary">
				<div class="row-fluid">

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
					<aside id="first" class="widget-area span3">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</aside><!-- #first .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
					<aside id="second" class="widget-area span3">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</aside><!-- #second .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
					<aside id="third" class="widget-area span3">
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</aside><!-- #third .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
					<aside id="fourth" class="widget-area span3">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</aside><!-- #fourth .widget-area -->
<?php endif; ?>
				</div><!-- .row-fluid -->
			</section><!-- #footer-widget-area .container-fluid -->
