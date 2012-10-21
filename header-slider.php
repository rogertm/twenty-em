<?php
/**
 * Display Slider of posts under featured category
 */
$options = t_em_get_theme_options();

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
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php t_em_featured_post_thumbnail( $options['slider-thumbnail-height'], $options['slider-thumbnail-width'] ); ?>
						<h2><?php the_title() ?></h2>
					</a>
				</article>
			</li>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
		</ul><!-- #slider-wrapper -->
	</div><!-- #slider-content -->
</section><!-- #slider -->
