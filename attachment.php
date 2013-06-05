<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<div id="content" role="main" class="span12">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<h2 class="entry-title"><span class="icon-paper-clip font-icon"></span><?php the_title(); ?></h2>
					<span class="entry-meta">
						<?php
							$published_text  = __( '<span class="icon-calendar font-icon"></span><span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 't_em' );
							$post_title = get_the_title( $post->post_parent );
							if ( empty( $post_title ) || 0 == $post->post_parent )
								$published_text  = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

							printf( $published_text,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( $post_title ) ),
								$post_title
							);

							$metadata = wp_get_attachment_metadata();
							printf( '<span class="icon-zoom-in font-icon"></span><span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
								esc_url( wp_get_attachment_url() ),
								esc_attr__( 'Link to full-size image', 't_em' ),
								__( 'Full resolution', 't_em' ),
								$metadata['width'],
								$metadata['height']
							);
						?>
					</span><!-- .entry-meta -->
				</header>
				<div class="entry-content">
					<div class="entry-attachment">
<?php if ( wp_attachment_is_image() ) :
$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
foreach ( $attachments as $k => $attachment ) {
	if ( $attachment->ID == $post->ID )
		break;
}
$k++;
// If there is more than 1 image attachment in a gallery
if ( count( $attachments ) > 1 ) {
	if ( isset( $attachments[ $k ] ) )
		// get the URL of the next image attachment
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	else
		// or get the URL of the first image attachment
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
} else {
	// or, if there's only 1 image attachment, get the URL of the image
	$next_attachment_url = wp_get_attachment_url();
}
?>
					<p class="attachment">
						<figure id="atachment-<?php echo $attachment->ID ?>">
							<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
								<?php $attachment_size = apply_filters( 't_em_attachment_size', 900 );
									echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height. ?>
							</a>
						</figure>
					</p>

					<div id="nav-below" class="navigation">
						<div class="nav-previous"><?php previous_image_link( false ); ?></div>
						<div class="nav-next"><?php next_image_link( false ); ?></div>
					</div><!-- #nav-below -->
<?php else : ?>
					<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
					</div><!-- .entry-attachment -->
					<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>

				</div><!-- .entry-content -->

				<footer class="entry-utility">
					<?php t_em_posted_in(); ?>
					<?php t_em_edit_post_link(); ?>
				</footer><!-- .entry-utility -->
			</article><!-- #post-## -->

<?php comments_template(); ?>

<?php endwhile; ?>

		</div><!-- #content -->

<?php get_footer(); ?>
