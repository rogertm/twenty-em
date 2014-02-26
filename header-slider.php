<?php
/**
 * Display a Carousel of featured posts
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
	$slider_pause = ( $t_em['bootstrap_carousel_pause'] == '1' ) ? 'hover' : 'null';
?>
	<section id="slider-carousel" data-ride="carousel" data-pause="<?php echo $slider_pause; ?>" data-interval="<?php echo $t_em['bootstrap_carousel_interval'] ?>" class="wrapper container carousel slide <?php echo $t_em['slider_text'] ?>">
<?php if ( have_posts() ) : ?>
			<ol class="carousel-indicators">
		<?php $s = 0; while ( $s < $tp ) : ?>
				<li data-target="#slider-carousel" data-slide-to="<?php echo $s ?>"></li>
		<?php $s++; endwhile; ?>
			</ol><!-- .carousel-indicators -->
			<div class="carousel-inner">
<?php
		while ( have_posts() ) : the_post();
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
				<div class="item">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$t_em['layout_width'].'&amp;h='.$t_em['slider_height'].'&amp;src='. $image_src ?>" />
					</a>
					<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="carousel-caption">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3>
						<div class="hidden-xs hidden-sm"><?php the_excerpt(); ?></div>
					</div>
				</div><!-- .item -->
<?php
		endwhile;
		wp_reset_query();
?>
			</div><!-- .carousel-inner -->
			<a class="left carousel-control" href="#slider-carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#slider-carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
<?php endif; ?>
	</section><!-- #slider-carousel -->
<?php endif; ?>
