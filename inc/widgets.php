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

		if ( is_active_widget( false, false, $this->id_base ) )
			add_action( 'wp_head', array( $this, 't_em_recent_posts_style' ) );

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function t_em_recent_posts_style(){
?>
	<style type="text/css">
		.t-em-recent-post-wrapper{
			margin-top: 10px !important;
			clear: both;
			overflow: hidden;
			padding: 5px 0 5px 5px;
		}
		.t-em-recent-post-title{
			font-weight: bold;
		}
		.t-em-recent-post-thumbnail{
			float: left;
			margin-right: 2.5641%;
		}
		.t-em-recent-post-thumbnail img{
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			-webkit-box-shadow: 0 1px 4px #dedede;
			-moz-box-shadow: 0 1px 4px #dedede;
			box-shadow: 0 1px 4px #dedede;
		}
		.t-em-recent-post-thumbnail figcaption{
			display: none;
		}
		.t-em-recent-post-thumbnail + .t-em-recent-post-content{
			margin-left: 110px;
		}
	</style>
<?php
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
 * @uses t_em_featured_post_thumbnail() and timthumb
 *
 * @since Twenty'em 1.0
 */
class Twenty_Em_Widget_Popular_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 't_em_popular_posts', 'description' => __( 'The most Popular Posts on your site', 't_em') );
		parent::__construct('t_em_popular_posts', sprintf( __( 'Popular Posts %1$s', 't_em' ), '[Twenty&#8217;em]' ), $widget_ops);
		$this->alt_option_name = 't_em_popular_posts';

		if ( is_active_widget( false, false, $this->id_base ) )
			add_action( 'wp_head', array( $this, 't_em_popular_posts_style' ) );

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function t_em_popular_posts_style(){
?>
		<style type="text/css">
			.t-em-popular-post-wrapper{
				margin-top: 10px !important;
				clear: both;
				overflow: hidden;
				padding: 5px 0 5px 5px;
			}
			.t-em-popular-post-title{
				font-weight: bold;
			}
			.t-em-popular-post-thumbnail{
				float: left;
				margin-right: 2.5641%;
			}
			.t-em-popular-post-thumbnail img{
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				-webkit-box-shadow: 0 1px 4px #dedede;
				-moz-box-shadow: 0 1px 4px #dedede;
				box-shadow: 0 1px 4px #dedede;
			}
			.t-em-popular-post-thumbnail figcaption{
				display: none;
			}
			.t-em-popular-post-thumbnail + .t-em-popular-post-content{
				margin-left: 110px;
			}
		</style>
<?php
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
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnail'] = ! empty( $new_instance['thumbnail'] ) ? 1 : 0;
		$instance['comment_count'] = ! empty( $new_instance['comment_count'] ) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['t_em_popular_posts']) )
			delete_option('t_em_popular_posts');

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

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array($this, 't_em_gallery_style') );

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function t_em_gallery_style(){
?>
		<style type="text/css">
			.row.t-em-img-gallery-row-wrapper{
				margin: 0;
			}
			.t-em-img-gallery-row-wrapper{
				margin-top: 15px;
			}
			figure.t-em-img-gallery-thumbnail,
			.t-em-img-gallery-thumbnail img{
				max-width: 100%;
				width: auto;
			}
			.t-em-img-gallery-thumbnail img{
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				-webkit-box-shadow: 0 1px 4px #dedede;
				-moz-box-shadow: 0 1px 4px #dedede;
				box-shadow: 0 1px 4px #dedede;
			}
			.t-em-img-gallery-thumbnail figcaption{
				display: none;
			}
			.t-em-img-gallery-row-wrapper .col-md-6.thumbnail{
				margin: 0 2.5% 2.5%;
				max-width: 45%;
			}
			.t-em-img-gallery-row-wrapper .col-md-4.thumbnail{
				margin: 0 1.5% 1.5%;
				max-width: 30%;
			}
		@media( max-width: 767px ){
				.t-em-img-gallery-row-wrapper{
					margin: 1% 0 auto 0;
				}
				.t-em-img-gallery-thumbnail img{
					margin-left: 3%;
					width: 97%;
				}
				.t-em-img-gallery-thumbnail img:first-child{
					margin-left: 0;
				}
				/** Fix one columns widget, displayed in two columns */
				.t-em-img-gallery-row-wrapper.t-em-one-column-gallery{
					float: left;
					width: 50%;
				}
				/** Fix two columns widget */
				.t-em-img-gallery-row-wrapper > div.col-md-6{
					float: left;
					width: 50%;
				}
				/** Fix three columns widget */
				.t-em-img-gallery-row-wrapper > div.col-md-4{
					float: left;
					width: 33%;
				}
			}
		</style>
<?php
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

			$gallery_args = new WP_Query( array (
							'post_type'			=> 'post',
							'post__in'			=> $p,
							'posts_per_page'	=> $tp,
							)
						);
		if ($gallery_args->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div class="row">
<?php
			if ( $gallery_args->have_posts() ) :
				$i = 0;
				while ($gallery_args->have_posts()) : $gallery_args->the_post();
					if ( 0 == $i % $instance['columns'] ) :
						$one_column_gallery = ( 1 == $instance['columns'] ) ? 't-em-one-column-gallery' : null;
						echo '</div>';
						echo '<div class="row t-em-img-gallery-row-wrapper '. $one_column_gallery .'">';
					endif;
					$span = 12 / $instance['columns'];
					echo '<div class="col-md-'. $span .' thumbnail">';
						t_em_featured_post_thumbnail( 500, 500, 't-em-img-gallery-thumbnail' );
					echo '</div>';
					$i++;
				endwhile;
?>
		</div><!-- .row -->
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
 * Recent_Comments widget class
 *
 * @since 2.8.0
 */
class Twenty_Em_Widget_Recent_Comments extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 't_em_recent_comments', 'description' => __( 'The most recent comments', 't_em' ) );
		parent::__construct('t_em_recent_comments', sprintf( __('Recent Comments %1$s'), '[Twenty&#8217;em]' ), $widget_ops);
		$this->alt_option_name = 't_em_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array($this, 't_em_recent_comments_style') );

		add_action( 'comment_post', array($this, 'flush_widget_cache') );
		add_action( 'edit_comment', array($this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array($this, 'flush_widget_cache') );
	}

	function t_em_recent_comments_style() {
?>
	<style type="text/css">
		.t-em-recent-comments{
			margin-top: 10px !important;
			clear: both;
			overflow: hidden;
			padding: 5px 0 5px 5px;
		}
		.t-em-recent-comments figure{
			display: inline;
			float: left;
			margin-right: 5px;
		}
		.t-em-recent-comments .avatar{
			display: inline-block;
			width: 64px !important;
			height: 64px !important;
		}
		.t-em-recent-comments a{
			display:inline !important;
			padding:0 !important;
			margin:0 !important;
		}
	</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('t_em_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('t_em_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : get_option( 'posts_per_page' );
		if ( ! $number )
 			$number = get_option( 'posts_per_page' );

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'type' => 'comment' ) ) );
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="t-em-recent-comments">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				$comment_author_avatar = '<figure title="'. get_comment_author() .'">'. get_avatar( get_the_author_meta( 'ID' ), 64 ) .'</figure>';
				$comment_author_link = ( 1 == $instance['author_name_url'] ) ? get_comment_author_link() : null;
				$output .=  '<li class="t-em-recent-comments">' . /* translators: comments widget: 1: comment author, 2: post link */ sprintf(_x('%1$s on %2$s', 'widgets'), $comment_author_avatar . $comment_author_link, '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('t_em_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$instance['author_name_url'] = ! empty( $new_instance['author_name_url'] ) ? 1 : 0;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['t_em_recent_comments']) )
			delete_option('t_em_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : get_option( 'posts_per_page' );
		$author_name_url = isset( $instance['author_name_url'] ) ? (bool) $instance['author_name_url'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input type="checkbox" id="<?php echo $this->get_field_id( 'author_name_url' ) ?>" class="checkbox" name="<?php echo $this->get_field_name( 'author_name_url' ) ?>" <?php checked( $author_name_url ) ?>>
		<label for="<?php echo $this->get_field_id( 'author_name_url' ) ?>"><?php _e( 'Show author name/url', 't_em' ) ?></label></p>
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
	register_widget( 'Twenty_Em_Widget_Recent_Comments' );
}
add_action( 'widgets_init', 't_em_register_widgets' );
?>
