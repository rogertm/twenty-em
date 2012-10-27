<?php
/**
 * Display Slider of posts under featured category
 */
$options = t_em_get_theme_options();

// How big are our thumbnails?
$thumb_heigth = ( ( array_key_exists( 'slider-thumbnail-height', $options ) && $options['slider-thumbnail-height'] != '' ) ? $options['slider-thumbnail-height'] : get_option( 'medium_size_h' ) );
$thumb_width = ( ( array_key_exists( 'slider-thumbnail-width', $options ) && $options['slider-thumbnail-width'] != '' ) ? $options['slider-thumbnail-width'] : get_option( 'medium_size_w' ) );

// Take category and number of slides to show from theme options
$args = array (
	'post_type'			=> 'post',
	'cat'				=> $options['slider-category'],
	'posts_per_page'	=> $options['slider-number'],
	'orderby'			=> 'date',
	'order'				=> 'DESC',
);
query_posts ( $args );
?>
<section id="slider">
	<div id="slider-content">
		<ul id="slider-wrapper">
<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article id="slider-post-<?php the_ID(); ?>" <?php post_class( $options['slider-thumbnail'] ); ?>>
					<?php t_em_featured_post_thumbnail( $thumb_heigth, $thumb_width ); ?>
					<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title() ?></a></h2>
				</article>
			</li>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
		</ul><!-- #slider-wrapper -->
	</div><!-- #slider-content -->
</section><!-- #slider -->
