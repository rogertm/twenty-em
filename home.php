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

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
				<?php t_em_action_content_before(); ?>
				<?php t_em_loop(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
