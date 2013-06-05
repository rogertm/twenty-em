<?php
/**
 * The template for displaying Post Format pages.
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
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
