<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>

	<div id="content" role="main" class="span8">

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
