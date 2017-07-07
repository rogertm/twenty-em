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
 * The template for displaying Category Archive pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

		<section id="main-content" <?php t_em_add_bootstrap_class( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_add_bootstrap_class( 'content' ); ?>>
				<?php t_em_action_content_before(); ?>
				<?php t_em_loop(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
