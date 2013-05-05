<?php
/**
 * Is the query for the blog homepage?
 * This is the page which shows the time based blog content of your site.
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_for_posts'.
 * If you set a static page for the front page of your site, this file will be returned only on the
 * page you set as the "Posts page".
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
