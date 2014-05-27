<?php
/**
 * Twenty'em admin helpers functions.
 *
 * @file			helpers.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/helpers.php
 * @link			http://codex.wordpress.org/Settings_API
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Render some Theme and Framework Data as meta description.
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_version(){
	global $t_em_theme_data;
	echo '<meta name="framework-name" content="' . T_EM_FRAMEWORK_NAME . '">' . "\n";
	echo '<meta name="framework-version" content="' . T_EM_FRAMEWORK_VERSION . ' ' . T_EM_FRAMEWORK_VERSION_STATUS . '">' . "\n";
	echo '<meta name="theme-name" content="' . $t_em_theme_data['Name'] . '">' . "\n";
	echo '<meta name="theme-version" content="' . $t_em_theme_data['Version'] . '">' . "\n";
	echo '<meta name="theme-uri" content="' . $t_em_theme_data['ThemeURI'] . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $t_em_theme_data['Author'] ) . '">' . "\n";
	echo '<meta name="theme-description" content="' . $t_em_theme_data['Description'] . '">' . "\n";
	echo '<meta name="theme-tags" content="' . $t_em_theme_data['Tags'] . '">' . "\n";
}
add_action( 't_em_hook_head', 't_em_theme_version' );

/**
 * Return Width and Height text boxes for thumbnails in forms
 *
 * @param string $contex Require In which form ($contex) you want to use this function.
 * Example: You have a new slider plugin, and you want set Width and Height for yours thumbnail in
 * slideshow. So, you may call this function like this: $thumb = t_em_thumbnail_sizes( 'slideshow' );
 * See t_em_excerpt_callback() in /inc/archive-options.php file
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_thumbnail_sizes( $contex ){
	$thumbnail_sizes = array (
		'excerpt_thumbnail_width' => array(
			'value' => '',
			'name' => $contex . '_thumbnail_width',
			'label' => __( 'Width', 't_em' ),
		),
		'excerpt_thumbnail_height' => array(
			'value' => '',
			'name' => $contex . '_thumbnail_height',
			'label' => __( 'Height', 't_em' ),
		),
	);

	return $thumbnail_sizes;
}

/**
 * Add Twenty'em layout clases to the array of boddy clases
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_classes( $existing_classes ){
	global $t_em;
	$layout_set = $t_em['layout_set'];
	$static_header_set = $t_em['static_header_text'];

	// In front page and 'front-page-set => widgets-front-page' one column is enogh
	if ( $t_em['front_page_set'] == 'widgets-front-page' && is_front_page() ) :
		$classes = array ( 'one-column' );
	elseif ( in_array( $layout_set, array( 'two-column-content-left', 'two-column-content-right' ) ) ) :
		$classes = array ( 'two-column' );
	elseif ( in_array( $layout_set, array( 'three-column-content-left', 'three-column-content-right', 'three-column-content-middle' ) ) ) :
		$classes = array ( 'three-column' );
	else :
		$classes = array ( 'one-column' );
	endif;

	if ( 'static-header-text-right' == $static_header_set )
		$static_header_classes = 'static-header-text-right';
	elseif ( 'static-header-text-left' == $static_header_set )
		$static_header_classes = 'static-header-text-left';
	else
		$static_header_classes = '';
		$classes[] = $static_header_classes;

	if ( 'two-column-content-left' == $layout_set )
		$classes[] = 'two-column-content-left';
	elseif ( 'two-column-content-right' == $layout_set )
		$classes[] = 'two-column-content-right';
	elseif ( 'three-column-content-left' == $layout_set )
		$classes[] = 'three-column-content-left';
	elseif ( 'three-column-content-right' == $layout_set )
		$classes[] = 'three-column-content-right';
	elseif ( 'three-column-content-middle' == $layout_set )
		$classes[] = 'three-column-content-middle';
	else
		$classes[] = $layout_set;

	$classes[] = $t_em['slider_text'];

	$classes = apply_filters( 't_em_layout_classes', $classes, $layout_set );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 't_em_layout_classes' );

/**
 * Add Twenty'em archive classes to the array of posts classes
 *
 * @since Twenty'em 0.1
 */
function t_em_archive_classes( $existing_classes ){
	global $t_em;
	$archive_set = $t_em['archive_set'];
	$excerpt_set = $t_em['excerpt_set'];

	if ( 'the-excerpt' == $archive_set ) :
		if ( 'thumbnail-left' == $excerpt_set ) :
			$classes[] = 'thumbnail-left';
		elseif ( 'thumbnail-right' == $excerpt_set ) :
			$classes[] = 'thumbnail-right';
		else :
			$classes[] = 'thumbnail-center';
		endif;
		$classes[] = 'excerpt-post';
	else :
		$classes[] = 'full-post';
	endif;

	$classes = apply_filters( 't_em_archive_classes', $classes, $archive_set );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'post_class', 't_em_archive_classes' );

/**
 * Add custom avatar option to users edit screen. This function is attached to the show_user_profile()
 * and the edit_user_profile() action hooks.
 * Only users with upload_files capabilities will access to this option
 *
 * @param $user_id int A user ID
 *
 * @since Twenty'em 1.0
 */
function t_em_add_custom_avatar_url( $user_id ){
	global $user_id, $t_em;
	if ( current_user_can( 'upload_files' ) && '1' == $t_em['custom_avatar'] ) :
?>
	<h3><?php _e( 'Custom avatar', 't_em' ); ?></h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="custom_avatar_url"><?php _e( 'Avatar url', 't_em' ); ?></label></th>
				<td>
				<?php
				$custom_avatar_url = get_user_meta( $user_id, 'custom_avatar_url', true );
				if ( $custom_avatar_url ) :
				?>
					<p><img src="<?php echo $custom_avatar_url ?>" width="150" height="150"></p>
				<?php
				endif;
				?>
					<input id="custom_avatar_url" class="regular-text code" type="url" name="custom_avatar_url" value="<?php echo $custom_avatar_url; ?>"></td>
			</tr>
		</tbody>
	</table>
<?php
	endif;
}
add_action( 'show_user_profile', 't_em_add_custom_avatar_url' );
add_action( 'edit_user_profile', 't_em_add_custom_avatar_url' );

/**
 * Save data for custom avatar option in users edit screen. This function is attached to the
 * personal_options_update() and edit_user_profile_update() actions hooks.
 * Only users with upload_files capabilities will access to this option
 *
 * @param $user_id int A user ID
 *
 * @since Twenty'em 1.0
 */
function t_em_update_custom_avatar_url( $user_id ){
	global $user_id, $t_em;
	if ( current_user_can( 'upload_files' ) && '1' == $t_em['custom_avatar'] ) :
		if ( current_user_can( 'edit_users', $user_id ) ) :
			update_user_meta( $user_id, 'custom_avatar_url', $_POST['custom_avatar_url'] );
		endif;
	endif;
}
add_action( 'personal_options_update', 't_em_update_custom_avatar_url' );
add_action( 'edit_user_profile_update', 't_em_update_custom_avatar_url' );

/**
 * Wrap paragraphs into <p> ...</p> tags, and clean empty lines
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

/**
 * Add Bootstrap CSS Classes dynamically.
 *
 * @param string $section Required. The name of the section that Bootstrap CSS Classes are needed.
 *
 * @global $t_em
 *
 * @return string CSS Class name
 *
 * @since Twenty'em 1.0
 */
function t_em_add_bootstrap_class( $section ){
	global $t_em;

	$bootstrap_classes = '';

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
	if ( 'main-content' == $section && $three_column ) :
		$bootstrap_classes = 'col-md-9';
	elseif ( 'main-content' == $section && ( $two_column || $one_column ) ) :
		$bootstrap_classes = 'col-md-12';
	endif;
	// #content and three-column or one-column
	if ( 'content' == $section && $three_column ) :
		$bootstrap_classes = 'col-md-8';
	elseif ( 'content' == $section && $one_column ) :
		$bootstrap_classes = 'col-md-12';
	endif;
	// #sidebar and three-column
	if ( 'sidebar' == $section && $three_column ) :
		$bootstrap_classes = 'col-md-4';
	endif;
	// #sidebar-alt and three-column
	if ( 'sidebar-alt' == $section && $three_column ) :
		$bootstrap_classes = 'col-md-3';
	endif;
	// #content and two-column
	if ( 'content' == $section && $two_column ) :
		$bootstrap_classes = 'col-md-8';
	endif;
	// #content and front_page_set['widgets-front-page']
	if ( 'content' == $section && is_front_page() && $t_em['front_page_set'] == 'widgets-front-page' ) :
		$bootstrap_classes = 'col-md-12';
	endif;
	// #sidebar and two-column
	if ( 'sidebar' == $section && $two_column ) :
		$bootstrap_classes = 'col-md-4';
	endif;

	// Archive columns
	if ( 'archive-columns' == $section ) :
		$cols = 12 / $t_em['archive_in_columns'];
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/** Static Header Content and Image */
	if ( 'static-header' == $section ) :
		$static_header_img = ( ! empty ( $t_em['static_header_img_src'] ) ) ? '1' : '0';
		$static_header_content = ( ! empty ( $t_em['static_header_headline'] )
								|| ! empty ( $t_em['static_header_content'] )
								|| ! empty ( $t_em['static_header_primary_button_text'] )
								|| ! empty ( $t_em['static_header_secondary_button_text'] )
								) ? '1' : '0';
		$total_static_header = array_sum( array ( $static_header_img, $static_header_content ) );
		$cols = 12 / $total_static_header;
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/** Static Header Buttons */
	if ( 'static-header-button' == $section ) :
		$static_header_primary_button = ( ! empty ( $t_em['static_header_primary_button_text'] ) ) ? '1' : '0';
		$static_header_secondary_button = ( ! empty ( $t_em['static_header_secondary_button_text'] ) ) ? '1' : '0';
		$total_static_header_button = array_sum( array ( $static_header_primary_button, $static_header_secondary_button ) );
		$cols = 12 / $total_static_header_button;
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/** Front Page Widgets Area */
	// Classes are needed for secondaries widgets only (two, three and four).
	if ( 'featured-widget-area' == $section ) :
		$widget_two		= ( ! empty ( $t_em['headline_text_widget_two'] ) || ! empty ( $t_em['content_text_widget_two'] ) ) ? '1' : '0' ;
		$widget_three	= ( ! empty ( $t_em['headline_text_widget_three'] ) || ! empty ( $t_em['content_text_widget_three'] ) ) ? '1' : '0' ;
		$widget_four	= ( ! empty ( $t_em['headline_text_widget_four'] ) || ! empty ( $t_em['content_text_widget_four'] ) ) ? '1' : '0' ;
		$total_widgets = array_sum( array ( $widget_two, $widget_three, $widget_four ) );
		$cols = 12 / $total_widgets;
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/** Footer Widgets Area */
	if ( 'footer-widget-area' == $section ) :
		$one_widget_footer = ( 'no-footer-widget' != $t_em['footer_set'] ) ? '1' : '0';
		$two_widget_footer = ( in_array( $t_em['footer_set'],
								array ( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' )
							 ) ) ? '1' : '0';
		$three_widget_footer = ( in_array( $t_em['footer_set'],
									array ( 'three-footer-widget', 'four-footer-widget' )
								 ) ) ? '1' : '0';
		$four_widget_footer = ( in_array( $t_em['footer_set'],
									array ( 'four-footer-widget' )
								 ) ) ? '1' : '0';
		$total_widgets = array_sum( array ( $one_widget_footer, $two_widget_footer, $three_widget_footer, $four_widget_footer ) );
		$cols = 12 / $total_widgets;
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	return $bootstrap_classes;
}

/**
 * Return arguments for slider query. Only post with images attached to it will be displayed
 *
 * @return array Query arguments
 *
 * @since Twenty'em 1.0
 */
function t_em_slider_query_args(){
	global $t_em;
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

	return $args;
}
?>
