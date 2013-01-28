<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Em
 * @since Twenty Ten 1.0
 */

global $t_em_theme_options;

if ( 'content' != $t_em_theme_options['layout-set'] ) :
?>

		<div id="secondary" class="widget-area" role="complementary">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<aside id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 't_em' ); ?></h3>
				<ul>
					<?php wp_get_archives( array ( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 't_em' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end primary widget area ?>
		</div><!-- #secondary .widget-area -->

<?php endif; // If there is sidebar or not! ?>
