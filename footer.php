<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?>


	<footer id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
			<div id="site-info" class="container-fluid">
				<div class="row-fluid">

					<div id="copyright" class="wrapper span2 pull-left">
						<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</div><!-- #copyright -->

					<?php echo t_em_user_social_network() ?>

					<?php /* The Footer Menu, if it's active by the user we display it, else, we get nothing */ ?>
					<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<h3 id="footer-toggle" class="screen-menu"><span class="hidden-desktop"><?php _e( 'Select a page:', 't_em' ); ?><span class="icon-reorder font-icon"></span></span></h3>
					<?php /* This is a secundary menu, and will be hidden on small screens like phones */ ?>
						<nav id="footer-menu" class="wrapper span10 text-right pull-right">
							<?php wp_nav_menu( array ( 'container_class' => 'menu-footer', 'theme_location' => 'footer-menu', 'depth' => 1 ) ); ?>
						</nav>
					<?php endif; ?>

					<?php get_template_part( 'footer', 't-em-link' ); ?>

				</div><!-- .row-fluid -->
			</div><!-- #site-info .container-fluid -->

		</div><!-- #colophon -->
	</footer><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
