<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_action_content_before(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php t_em_action_post_before(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_action_post_inside_before(); ?>
			<header>
				<h1 class="page-header"><?php the_title(); ?></h1>
				<span class="entry-meta">
					<?php t_em_attachment_meta(); ?>
				</span><!-- .entry-meta -->
			</header>

			<?php t_em_action_post_content_before(); ?>

			<div class="entry-content">
<?php
		if ( wp_attachment_is_image() ) :
			$attachments = array_values(
							get_children( array(
								'post_parent' => $post->post_parent,
								'post_status' => 'inherit',
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'order' => 'ASC',
								'orderby' => 'menu_order ID',
							)
						)
					);
			foreach ( $attachments as $k => $attachment ) :
				if ( $attachment->ID == $post->ID )
					break;
			endforeach;
			$k++;
			// If there is more than 1 image attachment in a gallery
			if ( count( $attachments ) > 1 ) :
				if ( isset( $attachments[ $k ] ) )
					// get the URL of the next image attachment
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
				else
					// or get the URL of the first image attachment
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
			else :
				// or, if there's only 1 image attachment, get the URL of the image
				$next_attachment_url = wp_get_attachment_url();
			endif;
		endif;
?>
					<div class="attachment">
						<figure id="atachment-<?php echo $attachment->ID ?>">
							<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
								<?php $attachment_size = apply_filters( 't_em_attachment_size', 900 );
									echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height. ?>
							</a>
						</figure>
					</div>
			<?php if ( has_excerpt() ) : ?>
					<div class="entry-caption"><?php the_excerpt(); ?></div>
			<?php endif; ?>

			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>

					<div id="attachment-navigation" class="attachment-pagination navi">
						<ul>
							<li class="previous"><?php previous_image_link( false ); ?></li>
							<li class="next"><?php next_image_link( false ); ?></li>
						</ul>
					</div><!-- #attachment-navigation -->
			</div><!-- .entry-content -->

			<?php t_em_action_post_content_after(); ?>

			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->

			<?php t_em_action_post_inside_after(); ?>
		</article><!-- #post-## -->
		<?php t_em_action_post_after(); ?>

<?php endwhile; // end of the loop. ?>

				<?php t_em_comments_template(); ?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
