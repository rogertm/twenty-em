<?php
/**
 * Display featured image post thumbnail
 * for the Nivo SLider jQuery Plugin
 */
global	$post,
		$t_em;

if ( ( '1' == $t_em['slider_home_only'] && is_home() ) || '0' == $t_em['slider_home_only'] ) :

	// We pass to the query only posts with images attached
	$cat_posts = get_posts( array( 'category' => $t_em['slider_category'], 'posts_per_page' => 99 ) );
	$i = 1;
	$p = array();
	foreach ( $cat_posts as $cp ) :
		$img = get_children( array( 'post_parent' => $cp->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
		if ( ! empty( $img ) ) :
			$tp = $cp->ID;
			array_push( $p, $tp );
		endif;
	endforeach;
	$tp = count( $p );
	$lp = $tp - $t_em['slider_number'];
	while ( $i <= $lp ) :
		array_pop( $p );
		$i++;
	endwhile;
	$tp = count( $p );

	$args = array (
		'post_type'			=> 'post',
		'cat'				=> $t_em['slider_category'],
		'post__in'			=> $p,
		'posts_per_page'	=> $tp,
		'orderby'			=> 'date',
		'order'				=> 'DESC',
	);
	query_posts ( $args );
		?>
		<section id="nivo-slider" class="container">
			<div class="slider-wrapper theme-<?php echo $t_em['nivo_style']; ?> wrapper row">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					// Display the thumbnails
					if ( has_post_thumbnail( $post->ID ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$image_src = $image_url[0];
					else :
						$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'order' => 'ASC', 'post_mime_type' => 'image', 'numberposts' => 9999 ) );
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_url = wp_get_attachment_image_src( $image->ID, 'full' );
							$image_src = $image_url[0];
					endif;
						?>
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$t_em['layout_width'].'&amp;h='.$t_em['slider_height'].'&amp;src='. $image_src ?>" title="#<?php echo $post->post_name ?>-<?php echo $post->ID; ?>"/>
						</a>
						<?php
				endwhile;
			endif;
			?>
				</div><!-- #slider .nivoSlider -->
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
				?>
				<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="nivo-html-caption nivo-post">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
					<div class="entry-summary hidden-xs hidden-sm"><?php the_excerpt(); ?></div>
				</div>
				<?php
				endwhile;
				wp_reset_query();
			endif;
			?>
			</div><!-- .slider-wrapper .theme-$theme -->
		</section><!-- #nivo-slider -->
	<?php
endif;
?>
