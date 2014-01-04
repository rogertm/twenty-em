<?php
/**
 * Twenty'em Widgets.
 *
 * @file			widgets.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/widgets.php
 * @link			http://codex.wordpress.org/Widgets_API
 * @since			Twenty'em 1.0
 */

?>
<?php
/**
 * Recent_Posts Widget Class
 *
 * @uses t_em_featured_post_thumbnail() and timthumb
 *
 * @since Twenty'em 1.0
 */
class Twenty_Em_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 't_em_recents_news', 'description' => __( 'Display the most Recent Posts on your site, including thumbnail and excerpt', 't_em' ) );
		parent::__construct('t_em_recents_news', sprintf( __( 'Recent Posts %1$s', 't_em' ), '[Twenty&#8217;em]' ), $widget_ops);
		$this->alt_option_name = 't_em_recents_news';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('t_em_widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Recent Posts', 't_em' ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = get_option( 'posts_per_page' );

			if ( 1 == $instance['thumbnail'] ) :

				// We pass to the query only posts with images attached
				$all_posts = get_posts( array( 'posts_per_page' => 99 ) );
				$i = 1;
				$p = array();
				foreach ( $all_posts as $cp ) :
					$img = get_children( array( 'post_parent' => $cp->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
					if ( ! empty( $img ) ) :
						$tp = $cp->ID;
						array_push( $p, $tp );
					endif;
				endforeach;
				$tp = count( $p );
				$lp = $tp - $number;
				while ( $i <= $lp ) :
					array_pop( $p );
					$i++;
				endwhile;
				$tp = count( $p );

				$recent_posts_args = new WP_Query( array (
												'posts_per_page' => $tp,
												'post__in' => $p,
												'no_found_rows' => true,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true
												)
											);
			else :
				$recent_posts_args = new WP_Query( array (
												'posts_per_page' => $number,
												'no_found_rows' => true,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true
												)
											);
			endif;
		if ($recent_posts_args->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($recent_posts_args->have_posts()) : $recent_posts_args->the_post(); ?>
		<li class="t-em-recent-post-wrapper">
			<?php t_em_featured_post_thumbnail( 100, 100, 't-em-recent-post-thumbnail' ) ?>
			<div class="t-em-recent-post-content">
				<a class="t-em-recent-post-title" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				<?php $widget_trim_word = apply_filters( 'the_content', get_the_content() ); ?>
				<div class="t-em-recent-post-sumary"><?php echo wp_trim_words( $widget_trim_word, 15, null ) ?></div>
			</div>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('t_em_widget_recent_posts', $cache, 'widget');

		global $t_em_theme_data;
		wp_register_style( 'widget-recent-posts-style', T_EM_THEME_DIR_CSS_URL . '/widget-recent-posts-style.css', array(), $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'widget-recent-posts-style' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnail'] = ! empty( $new_instance['thumbnail'] ) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['t_em_recents_news']) )
			delete_option('t_em_recents_news');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('t_em_widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : get_option( 'posts_per_page' );
		$thumbnail = isset( $instance['thumbnail'] ) ? (bool) $instance['thumbnail'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 't_em' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><input type="checkbox" id="<?php echo $this->get_field_id( 'thumbnail' ) ?>" class="checkbox" name="<?php echo $this->get_field_name( 'thumbnail' ) ?>" <?php checked( $thumbnail ) ?> />
		<label for="<?php echo $this->get_field_id( 'thumbnail' ) ?>"><?php _e( 'Display only posts with thumbnails', 't_em' ) ?></label></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', 't_em' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

/**
 * Popular_Posts Widget Class
 *
 * @since Twenty'em 1.0
 */
class Twenty_Em_Widget_Popular_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 't_em_popular_entries', 'description' => __( 'The most Popular Posts on your site', 't_em') );
		parent::__construct('t_em_popular_entries', sprintf( __( 'Popular Posts %1$s', 't_em' ), '[Twenty&#8217;em]' ), $widget_ops);
		$this->alt_option_name = 't_em_popular_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('t_em_widget_popular_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Popular Posts', 't_em' ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = get_option( 'posts_per_page' );

			if ( 1 == $instance['thumbnail'] ) :

				// We pass to the query only posts with images attached
				$all_posts = get_posts( array( 'posts_per_page' => 99, 'orderby' => 'comment_count', 'order' => 'DESC' ) );
				$i = 1;
				$p = array();
				foreach ( $all_posts as $cp ) :
					$img = get_children( array( 'post_parent' => $cp->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
					if ( ! empty( $img ) ) :
						$tp = $cp->ID;
						array_push( $p, $tp );
					endif;
				endforeach;
				$tp = count( $p );
				$lp = $tp - $number;
				while ( $i <= $lp ) :
					array_pop( $p );
					$i++;
				endwhile;
				$tp = count( $p );

				$popular_posts_args = new WP_Query( array (
												'posts_per_page' => $tp,
												'post__in' => $p,
												'no_found_rows' => true,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true,
												'orderby' => 'comment_count',
												'order' => 'DESC'
												)
											);
			else :
				$popular_posts_args = new WP_Query( array (
												'posts_per_page' => $number,
												'no_found_rows' => true,
												'post_status' => 'publish',
												'ignore_sticky_posts' => true,
												'orderby' => 'comment_count',
												'order' => 'DESC'
												)
											);
			endif;

		if ($popular_posts_args->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($popular_posts_args->have_posts()) : $popular_posts_args->the_post(); ?>

		<li class="t-em-popular-post-wrapper">
			<?php t_em_featured_post_thumbnail( 100, 100, 't-em-popular-post-thumbnail' ) ?>
			<div class="t-em-popular-post-content">
				<a class="t-em-popular-post-title" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
				<small><?php $comments_number = ( 1 == $instance['comment_count'] ) ? comments_number( '- 0 Comments', '- 1 Comment', '- % Comments' ) : null; ?></small>
				<?php $widget_trim_word = apply_filters( 'the_content', get_the_content() ); ?>
				<div class="t-em-popular-post-sumary"><?php echo wp_trim_words( $widget_trim_word, 15, null ) ?></div>
			</div>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('t_em_widget_popular_posts', $cache, 'widget');

		global $t_em_theme_data;
		wp_register_style( 'widget-popular-posts-style', T_EM_THEME_DIR_CSS_URL . '/widget-popular-posts-style.css', array(), $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'widget-popular-posts-style' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnail'] = ! empty( $new_instance['thumbnail'] ) ? 1 : 0;
		$instance['comment_count'] = ! empty( $new_instance['comment_count'] ) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['t_em_popular_entries']) )
			delete_option('t_em_popular_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('t_em_widget_popular_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : get_option( 'posts_per_page' );
		$thumbnail = isset( $instance['thumbnail'] ) ? (bool) $instance['thumbnail'] : false;
		$comment_count = isset( $instance['comment_count'] ) ? (bool) $instance['comment_count'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 't_em' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><input type="checkbox" id="<?php echo $this->get_field_id( 'thumbnail' ) ?>" class="checkbox" name="<?php echo $this->get_field_name( 'thumbnail' ) ?>" <?php checked( $thumbnail ) ?> />
		<label for="<?php echo $this->get_field_id( 'thumbnail' ) ?>"><?php _e( 'Display only posts with thumbnails', 't_em' ) ?></label><br />

		<input type="checkbox" id="<?php echo $this->get_field_id( 'comment_count' ) ?>" class="checkbox" name="<?php echo $this->get_field_name( 'comment_count' ) ?>" <?php checked( $comment_count ) ?> />
		<label for="<?php echo $this->get_field_id( 'comment_count' ) ?>"><?php _e( 'Show comment count', 't_em' ) ?></label></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to show:', 't_em' ); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}

/**
 * Image_Gallery Widget Class
 *
 * @since Twenty'em 1.0
 */
class Twenty_Em_Widget_Image_Gallery extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 't_em_image_gallery', 'description' => __( 'Display all images on your site attached to a post', 't_em' ) );
		parent::__construct('t_em_image_gallery', sprintf( __( 'Image Gallery %1$s', 't_em' ), '[Twenty&#8217;em]' ), $widget_ops);
		$this->alt_option_name = 't_em_image_gallery';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('t_em_widget_image_gallery', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Image Gallery', 't_em' ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = get_option( 'posts_per_page' );

		$gallery_args = new WP_Query( array (
						'post_type'			=> 'attachment',
						'post_status'		=> 'inherit',
						'posts_per_page'	=> $number,
						)
					);
		if ($gallery_args->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div class="row-fluid">
<?php
			if ( $gallery_args->have_posts() ) :
				$i = 0;
				while ($gallery_args->have_posts()) : $gallery_args->the_post();
					if ( 0 == $i % $instance['columns'] ) :
						echo '</div>';
						echo '<div class="row-fluid row-wrapper">';
					endif;
					$image_id = get_the_ID();
					if ( wp_attachment_is_image( $image_id ) ) :
						$image_attr = wp_get_attachment_image_src( $image_id );
						$ancestor_id = get_post_ancestors( $image_id );
						$image_link = ( $ancestor_id ) ? $ancestor_id[0] : $image_id;
						$image_alt = ( $ancestor_id ) ? $ancestor_id[0] : $image_id;
						// Any way, just display images attached to a post.
						if ( ! empty( $ancestor_id[0] ) ) :
							$span = 12 / $instance['columns'];
?>
						<a href="<?php echo get_permalink( $image_link ); ?>" title="<?php echo get_the_title( $image_alt ); ?>" class="span<?php echo $span ?>">
							<img src="<?php echo $image_attr[0]; ?>" alt="<?php echo get_the_title( $image_alt ); ?>" class="img-gallery-thumbnail img-rounded img-polaroid">
						</a>
<?php
						endif;
					endif;
					$i++;
				endwhile;
?>
		</div><!-- .row-fluid -->
<?php
			endif;
?>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('t_em_widget_image_gallery', $cache, 'widget');

		global $t_em_theme_data;
		wp_register_style( 'widget-image-gallery-style', T_EM_THEME_DIR_CSS_URL . '/widget-image-gallery-style.css', array(), $t_em_theme_data['Version'], 'all' );
		wp_enqueue_style( 'widget-image-gallery-style' );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['columns'] = (int) $new_instance['columns'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['t_em_image_gallery']) )
			delete_option('t_em_image_gallery');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('t_em_widget_image_gallery', 'widget');
	}

	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr($instance['title'] ) : '';
		$number = isset( $instance['number']) ? absint($instance['number'] ) : get_option( 'posts_per_page' );
		$columns = isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 2;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 't_em' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of images to show:', 't_em' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'columns' ) ?>"><?php _e( 'Show images in columns', 't_em' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'columns' ) ?>" name="<?php echo $this->get_field_name( 'columns' ) ?>">
			<option value="1" <?php selected( 1, $columns, true ) ?>>1</option>
			<option value="2" <?php selected( 2, $columns, true ) ?>>2</option>
			<option value="3" <?php selected( 3, $columns, true ) ?>>3</option>
		</select>
		</p>
<?php
	}
}

/**
 * Register widgets
 */
function t_em_register_widgets() {
	register_widget( 'Twenty_Em_Widget_Popular_Posts' );
	register_widget( 'Twenty_Em_Widget_Image_Gallery' );
	register_widget( 'Twenty_Em_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 't_em_register_widgets' );
?>
