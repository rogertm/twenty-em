<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Em_Five 
 * @since Twenty Ten Five 1.0
 */
?>
	</div><!-- #main -->

	<footer role="contentinfo">
		<div id="colophon" class="wrapper">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->

			<?php /* The Footer Menu, if it's active by the user we display it, else, we get nothing */ ?>
			<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
			<nav id="footer-menu">
				<?php wp_nav_menu( array ( 'container_class' => 'menu-footer', 'theme_location' => 'footer-menu', 'depth' => 1 ) ); ?>
			</nav>
			<?php endif; ?>

			<?php get_template_part( 'footer', 't-em-link' ); ?>

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
