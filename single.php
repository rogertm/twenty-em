<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_action_content_before(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php t_em_action_post_before(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_action_post_inside_before(); ?>
			<header>
				<h1 class="page-header"><?php the_title(); ?></h1>
				<span class="entry-meta">
					<?php t_em_posted_on(); ?>
				</span><!-- .entry-meta -->
			</header>

			<?php t_em_action_post_content_before(); ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<?php t_em_action_post_content_after(); ?>

			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_comments_link(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->

			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->
		<?php t_em_action_post_after(); ?>

<?php endwhile; // end of the loop. ?>

				<?php t_em_comments_template(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
