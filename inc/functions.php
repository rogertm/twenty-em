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
 * @since 			Twenty'em 1.0
 */

/**
 * Twenty'em Helpers Functions.
 */

/**
 * Helper. Register and Enqueue Bootstrap jQuery Plugins
 *
 * @param $plugin Required. String. Plugin name and extension (IE: transition.js)
 * @param $script Optional. String. Additional script if needed by the plugin
 * @param $script_src Optional. String. Required if $script, the $script source address
 * @param $deps Optional. Array. Array of the handles of all the registered scripts that this script depends on.
 * @param $transition Optional. Bool. Enqueue util.js Bootstrap plugin for simple transition effects
 * @param $in_footer Optional. Bool. If true, the script is placed before the </body> end tag
 *
 * @since Twenty'em 1.0
 */
function t_em_register_bootstrap_plugin( $plugin, $script = '', $script_src = '', $deps = array(), $util = true, $in_footer = false ){
	global $t_em_theme_data;
	$deps = array_merge( $deps, array( 'jquery' ) );

	if ( WP_DEBUG ) :
		$handle = ( file_exists( T_EM_THEME_DIR_BOOTSTRAP_PATH .'/js/'. $plugin .'.js' ) ) ? $plugin .'.js' : $plugin .'.min.js';
		$util = ( $util && file_exists( T_EM_THEME_DIR_BOOTSTRAP_PATH .'/js/'. 'util.js' ) ) ? 'util.js' : 'util.min.js';
	else :
		$handle = ( file_exists( T_EM_THEME_DIR_BOOTSTRAP_PATH .'/js/'. $plugin .'.min.js' ) ) ? $plugin .'.min.js' : $plugin .'.js';
		$util = ( $util && file_exists( T_EM_THEME_DIR_BOOTSTRAP_PATH .'/js/'. 'util.min.js' ) ) ? 'util.min.js' : 'util.js';
	endif;

	if ( $util ) :
		array_push( $deps, $util );
		wp_register_script( $util, T_EM_THEME_DIR_BOOTSTRAP_URL.'/js/'. $util, array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
	endif;

	wp_register_script( $handle, T_EM_THEME_DIR_BOOTSTRAP_URL .'/js/'. $handle, $deps, $t_em_theme_data['Version'], $in_footer );
	wp_enqueue_script( $handle );
	if ( $script ) :
		wp_register_script( $script, $script_src, array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
		wp_enqueue_script( $script );
	endif;
}

/**
 * Get javascript files
 * This functions loads minify scripts if the site is running online, otherwise (WP_DEBUG == true),
 * loads the beautify script.
 * @param string $handle 	Script handle. If the file is named my.script.min.js, $handle = 'my.script'
 * 							Both files should exists: my.script.min.js and my.script.js
 * @param string $path  	File path. If is a child theme set this parameter to T_EM_CHILD_THEME_DIR_PATH .'/path/to/js-dir/'
 * @param string $url  		File url. If is a child theme set this parameter to T_EM_CHILD_THEME_DIR_URL .'/url/to/js-dir/'
 * @return string  			File URL. False if file does not exist
 *
 * @since Twenty'em 1.2
 */
function t_em_get_js( $handle, $path = T_EM_THEME_DIR_JS_PATH, $url = T_EM_THEME_DIR_JS_URL ){
	if ( WP_DEBUG ) :
		$file = ( file_exists( $path .'/'. $handle .'.js' ) ) ? $handle .'.js' : $handle .'.min.js';
	else :
		$file = ( file_exists( $path .'/'. $handle .'.min.js' ) ) ? $handle .'.min.js' : $handle .'.js';
	endif;
	if ( file_exists( $path .'/'. $file ) ) :
		$file_url = $url .'/'. $file;
		return $file_url;
	endif;
	return false;
}

/**
 * Add Bootstrap CSS Classes dynamically.
 *
 * @param string $section Required. The name of the section that Bootstrap CSS Classes are needed.
 *
 * @since Twenty'em 1.0
 */
function t_em_breakpoint( $section ){
	global $t_em;

	$breakpoint = array();

	/** Main Content, Content, Sidebar and Sidebar Alt */
	$layout_set = $t_em['layout_set'];
	$one_column = in_array( $layout_set, array( 'one-column' ) );
	$two_column = in_array( $layout_set,
						array( 'two-columns-content-right',
							   'two-columns-content-left' ) );
	$three_column = in_array( $layout_set,
						array( 'three-columns-content-left',
							   'three-columns-content-right',
							   'three-columns-content-middle' ) );

	// #main-content
	if ( 'main-content' == $section ) :
		$breakpoint[] = 'row';
	endif;
	// #content and three-column or one-column
	if ( 'content' == $section && $three_column ) :
		$breakpoint[] = t_em_grid( '6' );
	elseif ( 'content' == $section && $one_column ) :
		$breakpoint[] = t_em_grid( '12' );
	endif;
	// #content && #main-content One column templates
	if ( 'content-one-column' == $section ) :
		$breakpoint[] = t_em_grid( '12' );
		$breakpoint[] = 'one-column';
	endif;
	// #sidebar and three-column
	if ( 'sidebar' == $section && $three_column ) :
		$breakpoint[] = t_em_grid( '3' );
		$breakpoint[] = 'widget-area';
	endif;
	// #sidebar-alt and three-column
	if ( 'sidebar-alt' == $section && $three_column ) :
		$breakpoint[] = t_em_grid( '3' );
		$breakpoint[] = 'widget-area';
	endif;
	// #content and two-column
	if ( 'content' == $section && $two_column && ! ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' ) ) :
		$breakpoint[] = t_em_grid( '8' );
	endif;
	// #content and front_page_set['widgets-front-page']
	if ( 'content' == $section && is_front_page() && $t_em['front_page_set'] == 'widgets-front-page' ) :
		$breakpoint[] = t_em_grid( '12' );
	endif;
	// #sidebar and two-column
	if ( 'sidebar' == $section && $two_column ) :
		$breakpoint[] = t_em_grid( '4' );
		$breakpoint[] = 'widget-area';
	endif;

	/** Static Header Content and Image */
	if ( 'static-header' == $section ) :
		$static_header_img = ( ! empty ( $t_em['static_header_img_src'] ) ) ? '1' : '0';
		$static_header_content = ( ! empty ( $t_em['static_header_headline'] )
								|| ! empty ( $t_em['static_header_content'] )
								|| ! empty ( $t_em['static_header_primary_button_text'] )
								|| ! empty ( $t_em['static_header_secondary_button_text'] )
								) ? '1' : '0';
		$total_static_header = array_sum( array( $static_header_img, $static_header_content ) );
		$cols = 12 / $total_static_header;
		$breakpoint[] = t_em_grid( $cols );
	endif;

	/** Front Page Widgets Area */
	if ( 'primary-featured-widget-area' == $section ) :
		$breakpoint[] = t_em_grid( '12', 'md' );
	endif;
	// Classes are needed for secondaries widgets only (two, three and four).
	if ( 'secondary-featured-widget-area' == $section ) :
		$widget_two		= ( ! empty ( $t_em['headline_text_widget_two'] ) || ! empty ( $t_em['content_text_widget_two'] ) ) ? '1' : '0' ;
		$widget_three	= ( ! empty ( $t_em['headline_text_widget_three'] ) || ! empty ( $t_em['content_text_widget_three'] ) ) ? '1' : '0' ;
		$widget_four	= ( ! empty ( $t_em['headline_text_widget_four'] ) || ! empty ( $t_em['content_text_widget_four'] ) ) ? '1' : '0' ;
		$total_widgets = array_sum( array( $widget_two, $widget_three, $widget_four ) );
		$cols = 12 / $total_widgets;
		$breakpoint[] = t_em_grid( $cols, 'md' );
	endif;

	/** Footer Widgets Area */
	if ( 'footer-widget-area' == $section ) :
		$one_widget_footer = ( 'no-footer-widget' != $t_em['footer_set'] ) ? '1' : '0';
		$two_widget_footer = ( in_array( $t_em['footer_set'],
								array( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' )
							 ) ) ? '1' : '0';
		$three_widget_footer = ( in_array( $t_em['footer_set'],
									array( 'three-footer-widget', 'four-footer-widget' )
								 ) ) ? '1' : '0';
		$four_widget_footer = ( in_array( $t_em['footer_set'],
									array( 'four-footer-widget' )
								 ) ) ? '1' : '0';
		$total_widgets = array_sum( array( $one_widget_footer, $two_widget_footer, $three_widget_footer, $four_widget_footer ) );
		$cols = 12 / $total_widgets;
		$breakpoint[] = t_em_grid( $cols );
	endif;

	/**
	 * Filter the list of CSS Bootstrap classes on the current template.
	 * The dynamic portion of the hook name, "$section", refers to the parameter $section where this
	 * functions is called.
	 *
	 * @param array Bootstrap CSS classes
	 * @since Twenty'em 1.0
	 */
	$classes = apply_filters( "t_em_filter_breakpoint_{$section}", $breakpoint );
	$classes = array_unique( $classes );
	echo 'class="' . implode( ' ', $classes ) . '"';
}

/**
 * Grid breakpoint
 * @param string $cols 			Columns
 * @param string $breakpoint 	breakpoint. Default 'lg'
 *
 * @since Twenty'em 1.2
 */
function t_em_grid( $cols, $breakpoint = '' ){
	/**
	 * Filter the default breakpoint
	 * @param string $breakpoint	Default breakpoint
	 *
	 * @since Twenty'em 1.2
	 */
	$bp = ( ! $breakpoint ) ? apply_filters( 't_em_filter_default_breakpoint', 'lg' ) : $breakpoint;
	$sep = ( $bp ) ? '-' : null;
	$class = 'col-'. $bp . $sep . $cols;
	return $class;
}

/**
 * Container or Container Fluid, that's the meollo
 * @param bool 		$echo. Echo or return the result
 * @return string 	.container or .container-fluid class, set by the user in the admin panel Layout Options
 *
 * @since Twenty'em 1.2
 */
function t_em_container( $echo = true ){
	global $t_em;
	$container = ( $t_em['layout_fluid_width'] ) ? 'container-fluid' : 'container';
	if ( $echo )
		echo $container;
	else
		return $container;
}

/**
 * Display featured image in posts archives when "Display the Excerpt" option is
 * activated in admin theme option page.
 *
 * @param int $width Require Thumbnail width.
 * @param int $height Require Thumbnail height.
 * @param boolean $link Optional The image will be linkable or not. Default: true.
 * @param string $class Optional CSS class.
 * @param int $post_id Optional. Post ID. Default is ID of the global $post.
 *
 * @global $post
 * @global $t_em
 *
 * @return string 			HTML "img" tag
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Deleted "figure" and "figcaption" wrapped element
 */
function t_em_featured_post_thumbnail( $width, $height, $link = true, $class = null, $post_id = 0 ){
	global $t_em;

	$post_id = absint( $post_id );
	if ( ! $post_id )
		$post_id = get_the_ID();

	$open_link = ( $link ) ? '<a href="'. get_permalink( $post_id ) .'" rel="bookmark">' : null;
	$close_link = ( $link ) ? '</a>' : null;
	$thumbnail = t_em_image_resize( $width, $height, $post_id );

	if ( $thumbnail ) :
		echo $open_link; ?>
		<img class="featured-post-thumbnail <?php echo $class ?>" alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo $thumbnail ?>" width="<?php echo $width ?>" height="<?php echo $height ?>"/>
<?php 	echo $close_link;
	endif;
}

/**
 * Resize images on the fly
 *
 * @param int $width Required. New image width
 * @param int $height Required. New image height
 * @param int $post_id Optional. Current Post ID. Default is ID of the global $post.
 * @param bool $crop Optional. Crop image. Default true
 *
 * @return string|null URL of the new image if the current post ($post_id) has a post thumbnail or
 * 					   any image associate to it, Or null if there are no images associated to the
 * 					   current post.
 */
function t_em_image_resize( $width, $height, $post_id = 0, $crop = true ){
	global $t_em;

	$post_id = absint( $post_id );
	if ( ! $post_id )
		$post_id = get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) :
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
		$image_path = get_attached_file( get_post_thumbnail_id( $post_id ) );
	else :
		$images = get_children( array( 'post_parent' => $post_id, 'post_type' => 'attachment', 'order' => 'ASC', 'post_mime_type' => 'image', 'numberposts' => 9999 ) );
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_url = ( ! empty($image) ) ? wp_get_attachment_image_src( $image->ID, 'full' ) : null;
		if ( $total_images >= 1 ) :
			$image_path = get_attached_file( $image->ID );
		else :
			$image_path = null;
		endif;
	endif;
	if ( $image_path ) :
		// Image data
		$image_src = $image_url[0]; // Original image
		$image_edit = wp_get_image_editor( $image_url[0] );
		$image_info = pathinfo( $image_path );

		// Image dimensions
		$image_size = getimagesize( $image_path );

		// If Width and Height are bigger than original size we use the original image
		if ( $width >= $image_size[0] && $height >= $image_size[1] ) :
			$image_thumbnail = $image_src;
		else :
			// Set dimensions
			$max_width = ( $width >= $image_size[0] ) ? $image_size[0] : $width;
			$max_height = ( $height >= $image_size[1] ) ? $image_size[1] : $height;

			// Image to be saved
			$image_to_save = $image_info['dirname'] .'/'. $image_info['filename'] .'-'. $max_width .'x'. $max_height .'.'. $image_info['extension'];


			// Create the new image
			if ( ! file_exists( $image_to_save ) ) :
				if ( ! is_wp_error( $image_edit ) ) :
					$image_edit->resize( $max_width, $max_height, $crop );
					$image_edit->save( $image_to_save );
				endif;
			endif;
			$image_thumbnail = str_replace( $image_info['filename'], $image_info['filename'] .'-'. $max_width .'x'. $max_height, $image_src );
		endif;
	else :
		/**
		 * Filter default image to show if the current post has no image associated to it
		 *
		 * @param null $default_post_thumbnail. URL of the default post thumbnail
		 * @since Twenty'em 1.0
		 */
		$image_thumbnail = apply_filters( 't_em_filter_default_post_thumbnail', null );
	endif;
	return $image_thumbnail;
}

/**
 * Helper. Wrap paragraphs into <p> ...</p> tags, and clean empty lines
 *
 * @param string $paragraph Require Paragraph to be wrapped into <p> ...</p> tags
 *
 * @return string
 *
 * @since Twenty'em 1.0
 */
function t_em_wrap_paragraph( $paragraph ){
	$wrap_paragraph = explode( "\n", $paragraph );
	$i = 0;
	$ps = count($wrap_paragraph) - 1;
	while ( $i <= $ps ) :
		$p[$i] = "<p>" . $wrap_paragraph[$i] . "</p>";
		$clean_paragraph[$i] = str_replace( "<p>\r</p>", "", $p[$i] );
		$i++;
	endwhile;
	return implode( "", $clean_paragraph );
}
?>
