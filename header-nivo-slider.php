<?php
/**
 * Display featured image post thumbnail
 * for the Nivo SLider jQuery Plugin
 */
global	$post,
		$t_em_theme_options;

if ( ( '1' == $t_em_theme_options['slider-home-only'] && is_home() ) || '0' == $t_em_theme_options['slider-home-only'] ) :

	// Define the slider Width and Height
	if ( '' != $t_em_theme_options['layout-width'] ) :
		$slider_width = $t_em_theme_options['layout-width'];
	elseif ( '' == $t_em_theme_options['layout-width'] ) :
		$slider_width = '960';
	endif;

	if ( '' != $t_em_theme_options['slider-height'] ) :
		$slider_height = $t_em_theme_options['slider-height'];
	elseif ( '' == $t_em_theme_options['slider-height'] ) :
		$slider_height = '350';
	endif;

	// Take category and number of slides to show from theme options
	$args = array (
		'post_type'			=> 'post',
		'cat'				=> $t_em_theme_options['slider-category'],
		'posts_per_page'	=> $t_em_theme_options['slider-number'],
		'orderby'			=> 'date',
		'order'				=> 'DESC',
	);
	query_posts ( $args );
		?>
		<section id="nivo-slider" class="slider-wrapper theme-<?php echo $t_em_theme_options['nivo-style']; ?> <?php echo $t_em_theme_options['slider-text'] ?>">
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
						<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR .'/timthumb.php?zc=1&amp;w='.$slider_width.'&amp;h='.$slider_height.'&amp;src='. $image_src ?>" title="#<?php echo $post->post_name ?>-<?php echo $post->ID; ?>"/>
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
				<?php the_excerpt(); ?>
			</div>
			<?php
			endwhile;
			wp_reset_query();
		endif;
		?>
		</section><!-- #nivo-slider .slider-wrapper .theme-default -->
	<?php
endif;
?>
