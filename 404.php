<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<section id="main-content" class="row-fluid">
		<section id="content" role="main" class="span12">

			<article id="post-0" class="post error404 not-found hentry">
				<h1 class="entry-title"><?php _e( 'Error 404 - Page not found!', 't_em' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 't_em' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</section><!-- #content -->
		<script type="text/javascript">
			// focus on search field after it has loaded
			document.getElementById('s') && document.getElementById('s').focus();
		</script>
	</section><!-- #main-content .rwo-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
