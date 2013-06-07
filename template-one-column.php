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

<div id="main" class="wrapper container-fluid">
	<div class="row-fluid">
		<section id="main-content" class="row-fluid">
			<section id="content" role="main" class="span12">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
					<?php t_em_edit_post_link(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

<?php endwhile; ?>
			</section><!-- #content -->
		</section><!-- #main-content .rwo-fluid -->
	</div><!-- .row-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
