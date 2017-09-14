<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0
 */

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your
 * WordPress site will use a different template.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_breakpoint( 'content' ); ?>>
			<?php t_em_action_content_before(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php t_em_action_post_before(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_action_post_inside_before(); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<?php t_em_action_post_content_before(); ?>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			<?php t_em_action_post_content_after(); ?>

			<footer class="entry-meta entry-meta-footer mb-3">
				<?php t_em_edit_post_link(); ?>
			</footer>
			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->

		<?php t_em_action_post_after() ?>

<?php endwhile; ?>

				<?php t_em_comments_template(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
