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
		</div><!-- #inner-main .row-fluid -->
		<?php t_em_main_after(); ?>
	</div><!-- #main .container-fluid -->


	<footer id="footer" role="contentinfo">
		<?php t_em_footer_before(); ?>
<?php
	/* A sidebar in the footer? Yep. You can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
		<div id="site-info" class="container-fluid">
			<div id="inner-site-info" class="wrapper row-fluid">
				<?php t_em_site_info(); ?>
			</div><!-- .row-fluid -->
		</div><!-- #site-info .container-fluid -->
		<?php t_em_footer_after(); ?>
	</footer><!-- #footer -->

</div><!-- #wrap -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
