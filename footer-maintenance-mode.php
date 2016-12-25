<?php
/**
 * Maintenance Mode Footer
 *
 * Contains the closing of the id=main div and all content after.
 * Calls sidebar-footer.php for bottom widgets.
 */
?>
		</div><!-- #inner-main .row -->
		<?php t_em_action_maintenance_mode_main_after(); ?>
	</div><!-- #main .container -->

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
