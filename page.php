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
 * @subpackage Twenty_Em_Five
 * @since Twenty Ten Five 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 't_em' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
