<?php
/**
 * The Sidebar containing the primary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

global $t_em_theme_options;

if ( 'one-column' != $t_em_theme_options['layout_set'] ) :
?>

		<section id="sidebar" class="widget-area <?php echo t_em_add_bootstrap_class( 'sidebar' ); ?>" role="complementary">

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
				<h3 class="widget-title"><?php _e( 'Categories', 't_em' ); ?></h3>
				<ul>
					<?php wp_list_categories( array('title_li' => '') ) ?>
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
		</section><!-- #sidebar .widget-area -->

<?php endif; // If there is sidebar or not! ?>
