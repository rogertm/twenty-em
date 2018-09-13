<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.2
 */


if ( ! function_exists( 't_em_header_image' ) ) :
/**
 * Pluggable Function: Display header image if it's set by the user in 'Header Options' admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_header_image(){
	global $post;
	if ( ( 'header-image' == t_em( 'header_set' ) )
		&& ( ( '1' == t_em( 'header_featured_image_home_only' ) && is_home() )
		|| ( '0' == t_em( 'header_featured_image_home_only' ) ) ) ) :

		$header_image = get_header_image();
		if ( $header_image ) :
			$header_image_width = get_theme_support( 'custom-header', 'width' );
			$header_image_height = get_theme_support( 'custom-header', 'height' );
?>
		<section id="header-image">
		<?php
		/**
		 * Fires before the header image section. Full width;
		 *
		 * @since Twenty'em 1.1
		 */
		do_action( 't_em_action_header_image_before' );
		?>
			<div id="header-image-inner" class="container-fluid">
		<?php
		/**
		 * Fires in and before the header image section. Container width;
		 *
		 * @since Twenty'em 1.1
		 */
		do_action( 't_em_action_header_image_inner_before' );
		?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php
			// Check if the user choose to display featured image in single posts and pages
			if ( '1' == t_em( 'header_featured_image' ) &&
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
?>
					</a>
		<?php
		/**
		 * Fires in and after the header image section. Container width;
		 *
		 * @since Twenty'em 1.1
		 */
		do_action( 't_em_action_header_image_inner_after' );
		?>
			</div><!-- #header-image-inner -->
		<?php
		/**
		 * Fires after the header image section. Full width;
		 *
		 * @since Twenty'em 1.1
		 */
		do_action( 't_em_action_header_image_after' );
		?>
		</section><!-- #header-image -->
<?php
		endif;
	endif;
}
endif; // function t_em_header_image()
add_action( 't_em_action_header', 't_em_header_image', 5 );

if ( ! function_exists( 't_em_slider_bootstrap_carousel' ) ) :
/**
 * Pluggable Function: Display Bootstrap carousel of featured posts if it's set by the user in
 * 'Header Options > Slider' admin panel
 *
 * @param $args array Query arguments
 *
 * @since Twenty'em 1.0
 */
function t_em_slider_bootstrap_carousel( $args ){
	global $post;
	if ( ( 'slider' == t_em( 'header_set' ) )
		&& ( ( '1' == t_em( 'slider_home_only' ) && is_home() )
		|| ( '0' == t_em( 'slider_home_only' ) ) ) ) :

		if ( ! $args ) $args = t_em_slider_query_args();

			$slider_posts = get_posts( $args );
			$slider_fade = ( t_em( 'bootstrap_carousel_fade' ) ) ? 'carousel-fade' : null;
			$slider_wrap = ( t_em( 'bootstrap_carousel_wrap' ) ) ? 'false' : 'true';
			$slider_pause = ( t_em( 'bootstrap_carousel_pause' ) ) ? 'hover' : 'false';
	?>
			<section id="slider-carousel" class="carousel slide container-fluid <?php echo $slider_fade ?>" data-ride="carousel" data-wrap="<?php echo $slider_wrap; ?>" data-pause="<?php echo $slider_pause; ?>" data-interval="<?php echo t_em( 'bootstrap_carousel_interval' ) ?>">
			<?php
			/**
			 * Fires before the slider carousel section. Full width;
			 *
			 * @since Twenty'em 1.1
			 */
			do_action( 't_em_action_slider_before' );
			?>
<?php 		if ( $slider_posts ) : ?>
<?php 			$tp = count( $slider_posts ) ?>
				<ol class="carousel-indicators">
			<?php $s = 0; while ( $s < $tp ) : ?>
					<li data-target="#slider-carousel" data-slide-to="<?php echo $s ?>"></li>
			<?php $s++; endwhile; ?>
				</ol><!-- .carousel-indicators -->
				<div class="carousel-inner">
				<?php
				/**
				 * Fires in and before the slider carousel section. Container width;
				 *
				 * @since Twenty'em 1.1
				 */
				do_action( 't_em_action_slider_inner_before' );
				?>
				<?php foreach ( $slider_posts as $post ) : setup_postdata( $post );
					$thumbnail = t_em_image_resize( 1200, t_em( 'slider_height' ), $post->ID ); ?>
					<div class="carousel-item">
						<?php t_em_featured_post_thumbnail( 1200, t_em( 'slider_height' ), false, 'd-block w-100', $post->ID ); ?>
						<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="carousel-caption">
							<h3 class="item-title">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a>
							</h3>
							<p class="item-summary d-none d-md-block"><?php t_em_get_post_excerpt(); ?></p>
						</div>
					</div><!-- .item -->
				<?php endforeach; wp_reset_postdata(); ?>
				<?php
				/**
				 * Fires in and after the slider carousel section. Container width;
				 *
				 * @since Twenty'em 1.1
				 */
				do_action( 't_em_action_slider_inner_after' );
				?>
				</div><!-- .carousel-inner -->
				<a class="carousel-control-prev" href="#slider-carousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Previous', 't_em' ); ?></span>
				</a>
				<a class="carousel-control-next" href="#slider-carousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Next', 't_em' ) ?></span>
				</a>
<?php 	endif; ?>
		<?php
		/**
		 * Fires after the slider carousel section. Full width;
		 *
		 * @since Twenty'em 1.1
		 */
		do_action( 't_em_action_slider_after' );
		?>
	</section><!-- #slider-carousel -->
<?php
	endif;
}
endif; // function t_em_slider_bootstrap_carousel()
add_action( 't_em_action_header', 't_em_slider_bootstrap_carousel', 5 );

/**
 * Return arguments for slider query. Only post with featured images attached to it will be displayed
 *
 * @return array 			Query arguments
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.3 	Get only post with '_thumbnail_id' meta key.
 */
function t_em_slider_query_args(){
	$args = array(
		'post_type'			=> 'post',
		'cat'				=> t_em( 'slider_category' ),
		'posts_per_page'	=> t_em( 'slider_number' ),
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		'meta_key'			=> '_thumbnail_id',
	);

	/**
	 * Filter the Slider query arguments
	 *
	 * @param array $args An array of arguments
	 * @link http://codex.wordpress.org/Class_Reference/WP_Query
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_filter_slider_query_args', $args );
}

if ( ! function_exists( 't_em_static_header' ) ) :
/**
 * Pluggable Function: Display Static Header if it's set by the user in
 * 'Header Options > Static Header' admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_static_header(){
	if ( ( 'static-header' == t_em( 'header_set' ) )
		&& ( ( '1' == t_em( 'static_header_home_only' ) && is_home() )
		|| ( '0' == t_em( 'static_header_home_only' ) ) ) ) :

		$header = ( t_em( 'static_header_template' ) != 'static-header-hero' ) ? 'jumbotron' : 'hero';
		get_template_part( '/template-parts/static-header', $header );

	endif;
}
endif; // function t_em_static_header()
add_action( 't_em_action_header', 't_em_static_header', 5 );

if ( ! function_exists( 't_em_static_header_bg' ) ) :
/**
 * Pluggable Function: Get and set the background image for the Hero Header
 *
 * @since Twenty'em 1.3.1
 */
function t_em_static_header_bg(){
	if ( t_em( 'static_header_template' ) != 'static-header-hero' )
		return;
	if ( ! t_em( 'static_header_img_src' ) )
		return;
?>
	<style type="text/css">
		#static-header-inner{
			background-image: url( <?php echo t_em( 'static_header_img_src' ); ?> );
		}
	</style>
<?php
}
endif;
add_action( 'wp_head', 't_em_static_header_bg' );
?>
