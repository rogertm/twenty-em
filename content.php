<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 1.0
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<p class="entry-meta">
					<?php t_em_posted_on(); ?>
				</p><!-- .entry-meta -->
			</header>
<?php
	$options = t_em_get_theme_options();
	$archive_set = $options['archive-set'];

	// How big are our thumbnails?
	$thumb_heigth = ( ( array_key_exists( 'excerpt-thumbnail-height', $options ) && $options['excerpt-thumbnail-height'] != '' ) ? $options['excerpt-thumbnail-height'] : get_option( 'thumbnail_size_h' ) );
	$thumb_width = ( ( array_key_exists( 'excerpt-thumbnail-width', $options ) && $options['excerpt-thumbnail-width'] != '' ) ? $options['excerpt-thumbnail-width'] : get_option( 'thumbnail_size_w' ) );

	if ( 'the-excerpt' == $archive_set ) :
?>
			<div class="entry-summary">
				<?php t_em_featured_post_thumbnail( $thumb_heigth, $thumb_width, $options['excerpt-set'] . ' featured-post-thumbnail', true ); ?>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
<?php
	else :
?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 't_em' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
<?php
	endif;
?>
			<footer class="entry-utility">
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 't_em' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 't_em' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 't_em' ), __( '1 Comment', 't_em' ), __( '% Comments', 't_em' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 't_em' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-utility -->
		</article><!-- #post-## -->
