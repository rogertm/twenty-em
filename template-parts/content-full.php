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
 * @since 			Twenty'em 1.2
 */

/**
 * The default template for displaying content
 */
?>
		<?php t_em_action_post_before(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_action_post_inside_before(); ?>
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-meta entry-meta-header">
					<?php t_em_action_entry_meta_header() ?>
				</div><!-- .entry-meta -->
			</header>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?>
			</div><!-- .entry-content -->
			<footer class="entry-meta entry-meta-footer">
				<?php t_em_action_entry_meta_footer(); ?>
			</footer><!-- .entry-meta .entry-meta-footer -->
			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->
		<?php t_em_action_post_after(); ?>
