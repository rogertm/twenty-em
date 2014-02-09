<?php
/**
 * Template Name: Image Gallery
 *
 * A custom page template to display site map.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-image-gallery.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-image-gallery.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

				<?php t_em_template_content() ?>

				<article id="gallery">


<?php
// Query for custom Loop

$args = array ( 'post_type' => 'attachment',
				'post_status' => 'inherit',
				'posts_per_page' => -1,
		);
$wp_query = new WP_Query ( $args );

if ( have_posts() ) :

	// Start the custom Loop
	while( have_posts() ) : the_post();
		$image_id = get_the_ID();
		$post_parent = $post->post_parent;
		$post_parent_id = get_post( $post_parent, ARRAY_A );

		if ( wp_attachment_is_image( $image_id ) ) :
			$image_attr = wp_get_attachment_image_src( $image_id );
			$ancestor_id = get_post_ancestors( $image_id );
			$image_link = ( $ancestor_id ) ? $ancestor_id[0] : $image_id;
			$image_alt = ( $ancestor_id ) ? $ancestor_id[0] : $image_id;
			// Any way, just display images attached to a post.
			if ( $post_parent_id['post_status'] == 'publish' ) :
?>
					<a href="<?php echo get_permalink( $image_link ); ?>" title="<?php echo get_the_title( $image_alt ); ?>">
						<img src="<?php echo $image_attr[0]; ?>" alt="<?php echo get_the_title( $image_alt ); ?>" class="gallery-thumbnail img-thumbnail" >
					</a>
<?php
			endif;
		endif;
	endwhile;
	wp_reset_postdata();
	else :
		get_template_part( 'content', 'none' );
endif;
wp_reset_query();
?>


				</article><!-- #gallery -->
				<?php t_em_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
