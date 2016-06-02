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
 * @link			http://twenty-em.com/
 * @since 			Twenty'em 1.0
 */

/**
 * Twenty'em Helpers Functions.
 */

/**
 * Helper. LESS files compiler
 * @uses less.php
 * @link https://github.com/oyejorge/less.php
 *
 * @param array $less_files Required. array( $key => $value ). Where $key is the path to the file to
 * 									  compile and $value the url of the file.
 * @param array $options Optional. Array of options.
 * @param array $modify_vars Optional. Array of modified vars.
 * @param bool $delete_garbage Optional. Delete all the garbage generated by less.php. Default True
 *
 * @return string Name of the compiled file or Error on fail.
 *
 * @since Twenty'em 1.0
 */
function t_em_lessphp_compiler( $less_files, $options = array(), $modify_vars = array(), $delete_garbage = true ){
	require_once T_EM_THEME_DIR_INC_PATH . '/less-php/Autoloader.php';
	Less_Autoloader::register();

	$dir		= '/cache/';
	$parent_dir	= T_EM_THEME_DIR_CSS_PATH;
	$dir_path	= T_EM_THEME_DIR_CSS_PATH . $dir;
	$dir_url	= T_EM_THEME_DIR_CSS_URL . $dir;

	if ( ! is_writable( $parent_dir ) && ! file_exists( $dir_path ) ) :
		$error = sprintf( __( '%s could not create the css files cache directory in <strong><code>%s</code></strong>. Make this directory writable before continue.<br />
							   See the Codex for more information about <a href="%s">Changing File Permissions</a>.', 't_em' ),
								T_EM_FRAMEWORK_NAME,
								$parent_dir,
								'https://codex.wordpress.org/Changing_File_Permissions' );
		wp_die( $error );
	endif;

	if ( ! file_exists( $dir_path ) ) :
		mkdir( $dir_path );
		copy( $parent_dir .'/index.php', $dir_path .'index.php' );
	endif;
	$cache_dir = $dir_path;

	$cache_options = array(
		'cache_dir'	=> $cache_dir,
	);
	$options = array_merge( $cache_options, $options );

	$font_path = sprintf( str_replace( '%s', '', T_EM_THEME_DIR_FONTS_URL .'/' ), get_home_url() );
	$cache_vars = array(
		'icon-font-path' => "'$font_path'",
	);
	$modify_vars = array_merge( $cache_vars, $modify_vars );

	$css_file_name = Less_Cache::Get( $less_files, $options, $modify_vars );
	$compiled = $dir_url . $css_file_name;

	if ( $delete_garbage ) :
		$garbage = t_em_garbage_cleaner( $dir_path, 'lesscache', 'ext' );
		foreach ( $garbage as $file ) :
			unlink( $file );
		endforeach;
	endif;

	return $compiled;
}

/**
 * Helper. Clean garbage into a directory. Used by t_em_lessphp_compiler() to clean the trash generated
 * by less.php
 *
 * @param string $directory Required. Directory where to search for garbage
 * @param string $search Required. Search string
 * @param string $type Optional. Search type: Values 'search' or 'ext' (file-extension or searchterm within filename)
 * @param bool $save_path Optional. Return also the file path. Default true
 *
 * @return array Array of files in $directory
 *
 * @since Twenty'em 1.0
 */
function t_em_garbage_cleaner( $directory, $search, $type = 'search', $save_path = true ){
	$garbage = array();
	$dir = dir( $directory );
	while ( false !== ( $file = $dir->read() ) ) :
		if ( $file != '.' && $file != '..' ) :
			$file = $directory . $file;
			if ( is_dir( $file ) ) :
				$garbage = array_merge( $garbage, t_em_garbage_cleaner( $file . '/', $search, $type, $save_path ) );
			else :
				if ( $type == 'search'
						? substr_count( $file, $search ) > 0
						: ( $type == 'ext'
							? substr( $file, - strlen( $search ) ) === $search
							: true ) ) :
					$garbage[] = $file;
				endif;
			endif;
		endif;
	endwhile;
	$dir->close();
	sort( $garbage, SORT_STRING );
	if ( ! $save_path ) $garbage = str_replace( $directory, '', array_values( $garbage ) );
	return $garbage;
}

/**
 * Helper. Register and Enqueue Bootstrap jQuery Plugins
 *
 * @param $plugin Required. String. Plugin name and extension (IE: transition.js)
 * @param $script Optional. String. Additional script if needed by the plugin
 * @param $script_src Optional. String. Required if $script, the $script source address
 * @param $deps Optional. Array. Array of the handles of all the registered scripts that this script depends on.
 * @param $transition Optional. Bool. Enqueue transition.js Bootstrap plugin for simple transition effects
 * @param $in_footer Optional. Bool. If true, the script is placed before the </body> end tag
 *
 * @since Twenty'em 1.0
 */
function t_em_register_bootstrap_plugin( $plugin, $script = '', $script_src = '', $deps = array(), $transition = true, $in_footer = false ){
	global $t_em_theme_data;
	$deps = array_merge( $deps, array( 'jquery' ) );
	if ( $transition ) :
		$transition = 'transition.js';
		array_push( $deps, $transition );
		wp_register_script( 'transition.js', T_EM_THEME_DIR_JS_URL.'/bootstrap/transition.js', array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
	endif;
	wp_register_script( $plugin, T_EM_THEME_DIR_JS_URL.'/bootstrap/'.$plugin, $deps, $t_em_theme_data['Version'], $in_footer );
	wp_enqueue_script( $plugin );
	if ( $script ) :
		wp_register_script( $script, $script_src, array( 'jquery' ), $t_em_theme_data['Version'], $in_footer );
		wp_enqueue_script( $script );
	endif;
}

/**
 * Add Bootstrap CSS Classes dynamically.
 *
 * @param string $section Required. The name of the section that Bootstrap CSS Classes are needed.
 *
 * @since Twenty'em 1.0
 */
function t_em_add_bootstrap_class( $section ){
	global $t_em;

	$bootstrap_classes = array();

	/** Main Content, Content, Sidebar and Sidebar Alt */
	$layout_set = $t_em['layout_set'];
	$one_column = in_array( $layout_set, array( 'one-column' ) );
	$two_column = in_array( $layout_set,
						array( 'two-column-content-right',
							   'two-column-content-left' ) );
	$three_column = in_array( $layout_set,
						array( 'three-column-content-left',
							   'three-column-content-right',
							   'three-column-content-middle' ) );

	// #main-content and three-column or ( two-column or one-column )
	if ( 'main-content' == $section && $three_column && ! ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' ) ) :
		$bootstrap_classes[] = 'col-md-9';
	elseif ( 'main-content' == $section && ( $two_column || $one_column || ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' && $three_column ) ) ) :
		$bootstrap_classes[] = 'col-md-12';
	endif;
	// #content and three-column or one-column
	if ( 'content' == $section && $three_column ) :
		$bootstrap_classes[] = 'col-md-8';
	elseif ( 'content' == $section && $one_column ) :
		$bootstrap_classes[] = 'col-md-12';
	endif;
	// #content && #main-content One column templates
	if ( 'content-one-column' == $section ) :
		$bootstrap_classes[] = 'col-md-12';
		$bootstrap_classes[] = 'one-column';
	endif;
	// #sidebar and three-column
	if ( 'sidebar' == $section && $three_column ) :
		$bootstrap_classes[] = 'col-md-4';
		$bootstrap_classes[] = 'widget-area';
	endif;
	// #sidebar-alt and three-column
	if ( 'sidebar-alt' == $section && $three_column ) :
		$bootstrap_classes[] = 'col-md-3';
		$bootstrap_classes[] = 'widget-area';
	endif;
	// #content and two-column
	if ( 'content' == $section && $two_column && ! ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' ) ) :
		$bootstrap_classes[] = 'col-md-8';
	endif;
	// #content and front_page_set['widgets-front-page']
	if ( 'content' == $section && is_front_page() && $t_em['front_page_set'] == 'widgets-front-page' ) :
		$bootstrap_classes[] = 'col-md-12';
	endif;
	// #sidebar and two-column
	if ( 'sidebar' == $section && $two_column ) :
		$bootstrap_classes[] = 'col-md-4';
		$bootstrap_classes[] = 'widget-area';
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
		$bootstrap_classes[] = 'col-md-' . $cols;
	endif;

	/** Front Page Widgets Area */
	if ( 'primary-featured-widget-area' == $section ) :
		$bootstrap_classes[] = 'col-md-12';
	endif;
	// Classes are needed for secondaries widgets only (two, three and four).
	if ( 'secondary-featured-widget-area' == $section ) :
		$widget_two		= ( ! empty ( $t_em['headline_text_widget_two'] ) || ! empty ( $t_em['content_text_widget_two'] ) ) ? '1' : '0' ;
		$widget_three	= ( ! empty ( $t_em['headline_text_widget_three'] ) || ! empty ( $t_em['content_text_widget_three'] ) ) ? '1' : '0' ;
		$widget_four	= ( ! empty ( $t_em['headline_text_widget_four'] ) || ! empty ( $t_em['content_text_widget_four'] ) ) ? '1' : '0' ;
		$total_widgets = array_sum( array( $widget_two, $widget_three, $widget_four ) );
		$cols = 12 / $total_widgets;
		$bootstrap_classes[] = 'col-md-' . $cols;
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
		$bootstrap_classes[] = 'col-md-' . $cols;
	endif;

	/**
	 * Filter the list of CSS Bootstrap classes on the current template.
	 * The dynamic portion of the hook name, "$section", refers to the parameter $section where this
	 * functions is called.
	 *
	 * @param array Bootstrap CSS classes
	 * @since Twenty'em 1.0
	 */
	$classes = apply_filters( "t_em_filter_bootstrap_classes_{$section}", $bootstrap_classes );
	$classes = array_unique( $classes );
	echo 'class="' . implode( ' ', $classes ) . '"';
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
 * @return string HTML content describing embedded figure
 *
 * @since Twenty'em 1.0
 */
function t_em_featured_post_thumbnail( $width, $height, $link = true, $class = null, $post_id = 0 ){
	global $t_em;

	$post_id = absint( $post_id );
	if ( ! $post_id )
		$post_id = get_the_ID();

	$open_link = ( $link ) ? '<a href="'. get_permalink( $post_id ) .'" title="'.  get_the_title( $post_id ) .'" rel="bookmark">' : null;
	$close_link = ( $link ) ? '</a>' : null;
	$thumbnail = t_em_image_resize( $width, $height, $post_id );

	if ( $thumbnail ) :
		echo $open_link;
			?>
				<figure id="post-attachment-<?php echo $post_id; ?>" class="<?php echo $class ?>" style="width:<?php echo $width ?>px">
					<img alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo $thumbnail ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" title="<?php echo get_the_title( $post_id ); ?>"/>
					<figcaption><?php echo get_the_title( $post_id ); ?></figcaption>
				</figure>
			<?php
		echo $close_link;
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
