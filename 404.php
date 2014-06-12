<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="col-md-12">
			<section id="content" role="main" class="col-md-12">
				<?php t_em_hook_content_before(); ?>

				<article id="post-0" class="post error404 not-found hentry">
					<header>
						<h1 class="entry-title page-header"><?php _e( 'Error 404 - Page not found!', 't_em' ); ?></h1>
					</header>
					<?php t_em_hook_post_content_before(); ?>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 't_em' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
					<?php t_em_hook_post_content_after(); ?>
				</article><!-- #post-0 -->

				<?php t_em_hook_content_after(); ?>
			</section><!-- #content -->
		</section><!-- #main-content -->

<?php get_footer(); ?>
