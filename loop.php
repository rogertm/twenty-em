<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Twenty_Em_Five
 * @since Twenty Ten Five 1.0
 */
?>

<?php t_em_page_navi( 'nav-above' ); ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<header>
			<h1 class="entry-title"><?php _e( 'Not Found', 't_em' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 't_em' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>

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
				<?php t_em_featured_post_thumbnail( $thumb_heigth, $thumb_width, 'featured-post-thumbnail', true ); ?>
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

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 't_em' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 't_em' ) ); ?></div>
				</nav><!-- #nav-below -->
<?php endif; ?>
