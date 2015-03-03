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
		</div><!-- #inner-main .row -->
		<?php t_em_action_main_after(); ?>
	</div><!-- #main .container -->


	<footer id="footer" role="contentinfo">
		<?php t_em_action_footer_before(); ?>
<?php
	/* A sidebar in the footer? Yep. You can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
		<div id="site-info">
			<div id="inner-site-info" class="wrapper container">
				<div class="row">
					<div id="site-info-before" class="col-md-12">
						<?php t_em_action_site_info_before(); ?>
					</div>
					<div id="site-info-left" class="col-md-6">
						<?php t_em_action_site_info_left(); ?>
					</div>
					<div id="site-info-right" class="col-md-6">
						<?php t_em_action_site_info_right(); ?>
					</div>
					<div id="site-info-after" class="col-md-12">
						<?php t_em_action_site_info_after(); ?>
					</div>
				</div><!-- .row -->
			</div><!-- .wrapper .container -->
		</div><!-- #site-info -->
		<?php t_em_action_footer_after(); ?>
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
