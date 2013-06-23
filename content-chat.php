<?php
/**
 * The default template for displaying content link
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<span class="entry-format muted"><span class="icon-chat font-icon"></span><?php _e( 'Chat', 't_em' ); ?></span>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<span class="entry-meta">
					<?php t_em_posted_on(); ?>
				</span><!-- .entry-meta -->
			</header>
			<?php t_em_post_archive_set(); ?>
			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_comments_link(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->
		</article><!-- #post-## -->