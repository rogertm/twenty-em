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
global $t_em_theme_options;
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if ( (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
		&& ! is_active_sidebar( 'third-footer-widget-area'  )
		&& ! is_active_sidebar( 'fourth-footer-widget-area' )
		) || 'no-footer-widget' == $t_em_theme_options['footer_set'] )

		return;
	// If we get this far, we have widgets. Let do this.
?>
		<div id="colophon" class="container-fluid">

			<section id="footer-widget-area" class="wrapper row-fluid" role="complementary">
				<?php t_em_sidebar_footer_before(); ?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' )
			&& 'no-footer-widget' != $t_em_theme_options['footer_set'] ) : ?>
					<aside id="first" class="widget-area <?php echo t_em_add_bootstrap_class( 'footer-widget-area' ); ?>">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</aside><!-- #first .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'second-footer-widget-area' )
			&& in_array( $t_em_theme_options['footer_set'],
				array ( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' ) ) ) : ?>
					<aside id="second" class="widget-area <?php echo t_em_add_bootstrap_class( 'footer-widget-area' ); ?>">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</aside><!-- #second .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'third-footer-widget-area' )
			&& in_array( $t_em_theme_options['footer_set'],
				array ( 'three-footer-widget', 'four-footer-widget' ) ) ) : ?>
					<aside id="third" class="widget-area <?php echo t_em_add_bootstrap_class( 'footer-widget-area' ); ?>">
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</aside><!-- #third .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'fourth-footer-widget-area' )
			&& in_array( $t_em_theme_options['footer_set'],
				array ( 'four-footer-widget' ) ) ) : ?>
					<aside id="fourth" class="widget-area <?php echo t_em_add_bootstrap_class( 'footer-widget-area' ); ?>">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</aside><!-- #fourth .widget-area -->
<?php endif; ?>
				<?php t_em_sidebar_footer_after(); ?>
			</section><!-- #footer-widget-area .container-fluid -->

	</div><!-- #colophon -->
