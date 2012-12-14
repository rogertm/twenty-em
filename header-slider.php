<?php
/**
 * Display Slider of posts under featured category
 */
$options = t_em_get_theme_options();

if ( ( '1' == $options['slider-home-only'] && is_home() ) || '0' == $options['slider-home-only'] ) :

// How big are our thumbnails?
$thumb_heigth = ( ( array_key_exists( 'slider-thumbnail-height', $options ) && $options['slider-thumbnail-height'] != '' ) ? $options['slider-thumbnail-height'] : get_option( 'medium_size_h' ) );
$thumb_width = ( ( array_key_exists( 'slider-thumbnail-width', $options ) && $options['slider-thumbnail-width'] != '' ) ? $options['slider-thumbnail-width'] : get_option( 'medium_size_w' ) );

if ( 'slider-thumbnail-full' == $options['slider-thumbnail'] ) :
	$thumb_width = $options['layout-width'];
endif;

if ( 'slider-thumbnail-full' != $options['slider-thumbnail'] ) :
	$wrapper = 'class="wrapper"';
endif;

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
	<div id="slider-content" <?php echo $wrapper ?>>
		<?php
		/**
		 * NOTE: This is a bug fixed.
		 * We set the #slider-wrapper height directly in the element
		 * because for an strange reason some times the slider height just
		 * fly away. So, we fix it this way.
		 */
		?>
		<ul id="slider-wrapper" style="height:<?php echo $thumb_heigth; ?>px;">
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article id="slider-post-<?php the_ID(); ?>" <?php post_class( $options['slider-thumbnail'] . ' slider-post' ); ?>>
					<div class="slider-image">
						<?php t_em_featured_post_thumbnail( $thumb_heigth, $thumb_width, 'slider-thumbnail' ); ?>
					</div>
					<div class="slider-sumary">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title() ?></a></h2>
						<?php the_excerpt(); ?>
					</div>
				</article>
			</li>
	<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
		</ul><!-- #slider-wrapper -->
	</div><!-- #slider-content -->
</section><!-- #slider -->
<?php
endif;
?>
