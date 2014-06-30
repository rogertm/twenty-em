<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="one-column <?php echo t_em_add_bootstrap_class( 'content-one-column' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class( 'content-one-column' ); ?>">
				<?php t_em_action_content_before(); ?>

				<article id="post-0" class="post error404 not-found hentry">
					<header>
						<h1 class="entry-title page-header"><?php _e( 'Error 404 - Page not found!', 't_em' ); ?></h1>
					</header>
					<?php t_em_action_post_content_before(); ?>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 't_em' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
					<?php t_em_action_post_content_after(); ?>
				</article><!-- #post-0 -->

				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
		</section><!-- #main-content -->

<?php get_footer(); ?>
