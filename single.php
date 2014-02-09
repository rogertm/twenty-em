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
			<?php t_em_content_before(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php t_em_post_before(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_post_inside_before(); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<span class="entry-meta">
					<?php t_em_posted_on(); ?>
				</span><!-- .entry-meta -->
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<?php t_em_author_meta(); ?>

			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->

			<?php t_em_post_inside_after(); ?>
		</article><!-- #post-## -->

		<?php t_em_post_after() ?>

<?php endwhile; // end of the loop. ?>

		<?php comments_template( '', true ); ?>

				<?php t_em_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
