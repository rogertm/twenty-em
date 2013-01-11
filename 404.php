<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Em
 * @since Twenty Ten 1.0
 */

get_header(); ?>

	<div id="primary" class="full-width">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found hentry">
				<h1 class="entry-title"><?php _e( 'Error 404 - Page not found!', 't_em' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 't_em' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
