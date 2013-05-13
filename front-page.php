<?php
/**
 * Is the query for the front page of the site?
 * This is for what is displayed at your site's main URL.
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_on_front'.
 * If you set a static page for the front page of your site, this file will be returned when viewing
 * that page.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
<?php
	$front_page = get_option( 'show_on_front' ) ;
	if ( 'page' == $front_page ) :
?>
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

<?php endwhile; ?>
<?php else : ?>
			<?php if ( have_posts() ) : ?>
				<?php t_em_page_navi( 'nav-above' ); ?>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				<?php t_em_page_navi( 'nav-below' ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #primary -->
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
