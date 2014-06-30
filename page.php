<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
				<?php if ( is_front_page() ) { ?>
					<h2 class="page-header"><?php the_title(); ?></h2>
				<?php } else { ?>
					<h1 class="page-header"><?php the_title(); ?></h1>
				<?php } ?>
			</header>

			<?php t_em_action_post_content_before(); ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<?php t_em_action_post_content_after(); ?>

			<footer class="entry-utility">
				<?php t_em_edit_post_link(); ?>
			</footer>
			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->

		<?php t_em_action_post_after() ?>

<?php endwhile; ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
