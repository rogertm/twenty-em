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
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after.
 * Calls sidebar-footer.php for bottom widgets.
 */
?>
		</div><!-- #inner-main .row -->
		<?php do_action( 't_em_action_main_after' ); ?>
	</div><!-- #main .container -->


	<footer id="footer" role="contentinfo">
		<?php do_action( 't_em_action_footer_before' ); ?>
<?php
	/* A sidebar in the footer? Yep. You can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
		<div class="site-info py-3">
			<?php do_action( 't_em_action_site_info_before' ); ?>
			<div class="<?php t_em_container(); ?>">
				<div class="row">
					<?php if ( has_action( 't_em_action_site_info_top' ) ) : ?>
					<div class="<?php echo t_em_grid( '12' ) ?> site-info-before">
						<?php do_action( 't_em_action_site_info_top' ); ?>
					</div>
					<?php endif; ?>
					<?php if ( has_action( 't_em_action_site_info_left' ) ) : ?>
					<div class="<?php echo t_em_grid( '6' ) ?> site-info-left">
						<?php do_action( 't_em_action_site_info_left' ); ?>
					</div>
					<?php endif; ?>
					<?php if ( has_action( 't_em_action_site_info_right' ) ) : ?>
					<div class="<?php echo t_em_grid( '6' ) ?> site-info-right">
						<?php do_action( 't_em_action_site_info_right' ); ?>
					</div>
					<?php endif; ?>
					<?php if ( has_action( 't_em_action_site_info_bottom' ) ) : ?>
					<div class="<?php echo t_em_grid( '12' ) ?> site-info-after">
						<?php do_action( 't_em_action_site_info_bottom' ); ?>
					</div>
					<?php endif; ?>
				</div><!-- .row -->
			</div>
			<?php do_action( 't_em_action_site_info_after' ); ?>
		</div><!-- .site-info -->
		<?php do_action( 't_em_action_footer_after' ); ?>
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
