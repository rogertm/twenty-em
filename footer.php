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
		<div id="colophon">

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

			<div id="site-generator">
				<?php do_action( 't_em_credits' ); ?>
				<a href="<?php echo esc_url( __('http://wordpress.org/', 't_em') ); ?>"
						title="<?php esc_attr_e('Semantic Personal Publishing Platform', 't_em'); ?>" rel="generator">
					<?php printf( __('Proudly powered by %s.', 't_em'), 'WordPress' ); ?>
				</a>
			</div><!-- #site-generator -->

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
