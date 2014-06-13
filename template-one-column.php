<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="one-column <?php echo t_em_add_bootstrap_class( 'content-one-column' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class( 'content-one-column' ); ?>">
			<?php t_em_hook_content_before(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<?php t_em_hook_post_before(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php t_em_hook_post_inside_before(); ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<footer class="entry-utility">
					<?php t_em_edit_post_link(); ?>
				</footer>
				<?php t_em_hook_post_inside_after(); ?>
			</article><!-- #post-## -->

			<?php t_em_hook_post_after() ?>

<?php endwhile; ?>
				<?php t_em_hook_content_after(); ?>
			</section><!-- #content -->
		</section><!-- #main-content .rwo-fluid -->

<?php get_footer(); ?>
