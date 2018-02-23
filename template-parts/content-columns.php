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
$cols = 12 / t_em( 'archive_in_columns' );
?>
		<?php do_action( 't_em_action_post_before' ); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( t_em_grid( $cols ) ); ?>>
			<?php do_action( 't_em_action_post_inside_before' ); ?>
			<?php t_em_featured_post_thumbnail( t_em( 'excerpt_thumbnail_width' ), t_em( 'excerpt_thumbnail_height' ), true ); ?>
				<header>
					<h2 class="entry-title "><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="entry-meta entry-meta-header mb-3">
						<?php do_action( 't_em_action_entry_meta_header' ) ?>
					</div><!-- .entry-meta -->
				</header>
				<div class=""><?php the_excerpt(); ?></div>
				<footer class="entry-meta entry-meta-footer mb-3">
					<?php do_action( 't_em_action_entry_meta_footer' ); ?>
				</footer><!-- .entry-meta .entry-meta-footer -->
				<?php do_action( 't_em_action_post_inside_after' ); ?>
		</article><!-- #post-## -->
		<?php do_action( 't_em_action_post_after' ); ?>
