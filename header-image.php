<?php
/**
 * Display Image Header
 */
?>
<section id="header-image">
<?php
$options = t_em_get_theme_options();
$header_image = get_header_image();
if ( $header_image ) :
	$header_image_width = get_theme_support( 'custom-header', 'width' );
	$header_image_height = get_theme_support( 'custom-header', 'height' );
?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php
	// Check if the user choose to display featured image in single posts and pages
	if ( array_key_exists( 'header-featured-image', $options ) && 'yes' == $options['header-featured-image'] &&
		// Check if this is a post or page and there is a thumbnail to show
		is_singular() && has_post_thumbnail( $post->ID ) &&
			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
			$image[1] >= $header_image_width ) :
			// Havana, we have a new header image :P
			// If the user set to true to display featured image in posts and page, then display it
			echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
	else :
		$header_image_width = get_custom_header()->width;
		$header_image_height = get_custom_header()->height;
?>
			<img src="<?php header_image() ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
<?php
	endif;
endif;
?>
		</a>
</section><!-- #header-image -->
