<?php
/**
 * WARNING: Do not edit this lines.
 * Load the theme engine files
 */
require_once( get_template_directory() . '/engine/constants.php' );
require_once( get_template_directory() . '/engine/theme-options.php' );

/**
 * Twenty'em functions and definitions.
 *
 * @file			functions.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/functions.php
 * @link			http://codex.wordpress.org/Theme_Development#Functions_File
 * @since			Twenty'em 0.1
 */

/**
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, t_em_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 't_em_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 */
?>
<?php
/**
 * Sets up theme defaults and registers the various WordPress features that Twenty'em supports.
 *
 * @uses add_theme_support() To add support for thumbnails, automatic feed links, post formats,
 * custom background, custom header.
 * All this functions are treat as pluggable, so they can be override in Child Themes.
 *
 * @link http://codex.wordpress.org/Theme_Features Visit for full documentation about Theme Features
 *
 * @return void
 *
 * @since Twenty'em 0.1
 */
function t_em_setup(){

	// Adds support featured image.
	add_theme_support( 'post-thumbnails' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Adds support for variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'audio' ) );

	// Adds support for custom background
	add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );

	// This theme styles the visual editor with editor-style.css to match the theme style
	add_editor_style( 'css/editor-style.css' );

	// Adds support for custom header text (pluggable function).
	$custom_header_support = array(
		/**
		 * Filter header image Width and Height
		 *
		 * @param int Width and Height values
		 * @since Twenty'em 1.0
		 */
		'default-text-color'		=> '333',
		'width'						=> apply_filters( 't_em_filter_header_image_width', T_EM_HEADER_IMAGE_WIDTH ),
		'height'					=> apply_filters( 't_em_filter_header_image_height', T_EM_HEADER_IMAGE_HEIGHT ),
		'flex-width'				=> true,
		'flex-height'				=> true,
		'random-default'			=> true,
		'uploads'					=> true,
		'wp-head-callback'			=> 't_em_header_style',
		'admin-head-callback'		=> 't_em_admin_header_style',
		'admin-preview-callback'	=> 't_em_admin_header_image',
	);
	add_theme_support( 'custom-header', $custom_header_support );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Adds support for custom header image (pluggable function).
	t_em_support_custom_header_images();

	// This theme uses navigation menus in three locations. Woew!
	register_nav_menus ( array(
		'top-menu'			=> __('Top Menu', 't_em'),
		'navigation-menu'	=> __('Navigation Menu', 't_em'),
		'footer-menu'		=> __('Footer Menu', 't_em'),
		)
	);

	/* Make Twenty'em available for translation.
	 * Translations can be added to the language/ directory.
	 * If you're building a theme based on Twenty'em, use a find and replace to change 't_em'
	 * to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 't_em', T_EM_THEME_DIR_LANG_PATH );

}
add_action( 'after_setup_theme', 't_em_setup' );

if ( ! function_exists( 't_em_header_style' ) ) :
/**
 * Style the header image and text displayed on the site.
 * Referenced via add_theme_support( 'custom-header' ) in t_em_support_custom_header().
 *
 * @since Twenty'em 0.1
 */
function t_em_header_style(){
	global $custom_header_support;
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == $custom_header_support['default-text-color'] ) return;

	// If we get this far, we have custom styles. Let's do this.
?>
	<style type="text/css">
<?php
	// If the text is hidden
	if ( 'blank' == $text_color ) :
?>
		#site-title,
		#site-description{
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
<?php
	// If the user has set a custom color for the text use that
	else :
?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?>;
		}
<?php
	endif;
?>
	</style>
<?php
}
endif; // function t_em_header_style()

if ( ! function_exists( 't_em_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 * Referenced via add_theme_support( 'custom-header' ) in t_em_support_custom_header().
 *
 * @since Twenty'em 0.1
 */
function t_em_admin_header_style(){
	global $custom_header_support;
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	}
	#headimg h1 {
		font-size: 36px;
		margin-bottom: 10px;
		margin-top: 20px;
		font-weight: 500;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		font-size: 18px;
		margin-bottom: 20px;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != $custom_header_support['default-text-color'] ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // function t_em_admin_header_style()

if ( ! function_exists( 't_em_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 * Referenced via add_theme_support('custom-header') in t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_admin_header_image(){ ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		$style = ( $color && $color != 'blank' ) ? 'color: #'. $color .'' : 'display: none';
		?>
		<h1><a id="name" style="<?php echo $style; ?>" onclick="return false;" href="#"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc" style="<?php echo $style; ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php
}
endif; // function t_em_admin_header_image()

if ( ! function_exists( 't_em_support_custom_header_images' ) ) :
/**
 * Pluggable Function:  Default custom headers packaged with the theme.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_header_images(){
	$headers = array(
		'aqua'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/aqua.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/aqua-thumbnail.png',
			'description'	=> _x( 'Aqua', 'header image description', 't_em' ),
		),
		'fire'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/fire.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/fire-thumbnail.png',
			'description'	=> _x( 'Fire', 'header image description', 't_em' ),
		),
		'lime'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/lime.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/lime-thumbnail.png',
			'description'	=> _x( 'Lime', 'header image description', 't_em' ),
		),
		'purple'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/purple.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/purple-thumbnail.png',
			'description'	=> _x( 'Purple', 'header image description', 't_em' ),
		),
	);
	/**
	 * Filter the list of custom header images
	 *
	 * @param array An array of headers keyed by a string id.
	 * 				The ids point to arrays containing 'url', 'thumbnail_url', and 'description' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_filter_custom_header_images', register_default_headers( $headers ) );
}
endif; // function t_em_support_custom_header_images()

/**
 * Add Twenty'em layout classes to the array of body classes
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_classes( $existing_classes ){
	global $t_em;
	$layout_set = $t_em['layout_set'];

	// In front page and 'front-page-set => widgets-front-page' one column is enough
	if ( $t_em['front_page_set'] == 'widgets-front-page' && is_front_page() ) :
		$classes = array( 'one-column widgets-front-page' );
	elseif ( in_array( $layout_set, array( 'two-column-content-left', 'two-column-content-right' ) ) ) :
		$classes = array( 'two-column' );
	elseif ( in_array( $layout_set, array( 'three-column-content-left', 'three-column-content-right', 'three-column-content-middle' ) ) ) :
		$classes = array( 'three-column' );
	else :
		$classes = array( 'one-column' );
	endif;

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

	/**
	 * Filter the list of CSS body classes depending on the layout setting
	 *
	 * @since Twenty'em 1.0
	 */
	$classes = apply_filters( 't_em_filter_layout_classes', $classes, $layout_set );

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

	if ( 'the-excerpt' == $archive_set && ! is_single() ) :
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

	/**
	 * Filter the list of CSS classes for the current post depending on the Archive Set
	 *
	 * @since Twenty'em 1.0
	 */
	$classes = apply_filters( 't_em_filter_archive_classes', $classes, $archive_set );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'post_class', 't_em_archive_classes' );

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
	if ( 'main-content' == $section && $three_column && ! ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' ) ) :
		$bootstrap_classes = 'col-md-9';
	elseif ( 'main-content' == $section && ( $two_column || $one_column || ( is_home() && $t_em['front_page_set'] == 'widgets-front-page' && $three_column ) ) ) :
		$bootstrap_classes = 'col-md-12';
	endif;
	// #content and three-column or one-column
	if ( 'content' == $section && $three_column ) :
		$bootstrap_classes = 'col-md-8';
	elseif ( 'content' == $section && $one_column ) :
		$bootstrap_classes = 'col-md-12';
	endif;
	// #content && #main-content One column templates
	if ( 'content-one-column' == $section ) :
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
		$total_static_header = array_sum( array( $static_header_img, $static_header_content ) );
		$cols = 12 / $total_static_header;
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/** Front Page Widgets Area */
	// Classes are needed for secondaries widgets only (two, three and four).
	if ( 'featured-widget-area' == $section ) :
		$widget_two		= ( ! empty ( $t_em['headline_text_widget_two'] ) || ! empty ( $t_em['content_text_widget_two'] ) ) ? '1' : '0' ;
		$widget_three	= ( ! empty ( $t_em['headline_text_widget_three'] ) || ! empty ( $t_em['content_text_widget_three'] ) ) ? '1' : '0' ;
		$widget_four	= ( ! empty ( $t_em['headline_text_widget_four'] ) || ! empty ( $t_em['content_text_widget_four'] ) ) ? '1' : '0' ;
		$total_widgets = array_sum( array( $widget_two, $widget_three, $widget_four ) );
		$cols = 12 / $total_widgets;
		$bootstrap_classes = 'col-md-' . $cols;
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
		$bootstrap_classes = 'col-md-' . $cols;
	endif;

	/**
	 * Filter the list of CSS Bootstrap classes on the current template
	 *
	 * @param string Bootstrap CSS classes
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_filter_bootstrap_classes', $bootstrap_classes );
}

/**
 * Set the post excerpt length depending of the $t_em['excerpt_length'] value.
 * You don't need to override this value in a Child Theme, just because you can set this value from
 * the Twenty'em Framework interface.
 *
 * @since Twenty'em 1.0
 */
function t_em_excerpt_length( $length ){
	global $t_em;
	return $t_em['excerpt_length'];
}
add_filter( 'excerpt_length', 't_em_excerpt_length' );

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) :
	$content_width = 605;
endif;

if ( ! function_exists( 't_em_favicon' ) ) :
/**
 * Pluggable Function: Add favicon to our site, admin dashboard included
 * this function is attached to wp_head() and admin_head() action hooks
 *
 * @since Twenty'em 0.1
 */
function t_em_favicon(){
	global $t_em;
	if ( '' != $t_em['favicon_url'] ) :
		echo '<link rel="shortcut icon" href="'. $t_em['favicon_url'] .'" />'."\n";
	endif;
}
endif; // function t_em_favicon()
add_action( 'wp_head', 't_em_favicon' );
add_action( 'admin_head', 't_em_favicon' );

/**
 * Twenty'em shows a home link in wp_page_menu(), wp_nav_menu() fallback.
 *
 * @since Twenty'em 0.1
 */
function t_em_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 't_em_page_menu_args' );

if ( ! function_exists( 't_em_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty'em 0.1
 *
 * @return string "Continue Reading" link
 */
function t_em_continue_reading_link() {
	return '<a href="'. get_permalink() . '" class="more-link">' . __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) . '</a>';
}
endif;

if ( ! function_exists( 't_em_auto_excerpt_more' ) ) :
/**
 * Pluggable Function: Replaces "[...]" (appended to automatically generated excerpts) with an
 * ellipsis and t_em_continue_reading_link().
 *
 * @since Twenty'em 0.1
 *
 * @return string An ellipsis
 */
function t_em_auto_excerpt_more( $more ) {
	return ' &hellip; ' . t_em_continue_reading_link();
}
endif; // function t_em_auto_excerpt_more()
add_filter( 'excerpt_more', 't_em_auto_excerpt_more' );

if ( ! function_exists( 't_em_custom_excerpt_more' ) ) :
/**
 * Pluggable Function: Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * @since Twenty'em 0.1
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function t_em_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= t_em_continue_reading_link();
	}
	return $output;
}
endif; // function t_em_custom_excerpt_more()
add_filter( 'get_the_excerpt', 't_em_custom_excerpt_more' );

if ( ! function_exists( 't_em_single_link_pages' ) ) :
/**
 * Displays page-links for paginated posts (When include the <!--nextpage--> quicktag one or more
 * times ).
 *
 * @since Twenty'em 1.0
 */
function t_em_single_link_pages( $content ){
	$args = array(
		'before'		=> '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 't_em' ) . '</span>',
		'after'			=> '</div>',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'pagelink'		=> '<span class="sr-only">' . __( 'Page', 't_em' ) . ' </span>%',
		'separator'		=> '<span class="sr-only">, </span>',
		'echo'			=> 0,
	);

	$content = $content . wp_link_pages( $args );

	/**
	 * Filter the single link pages structure
	 *
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_filter_single_link_pages', $content );
}
endif; // function t_em_single_link_pages()
add_filter( 'the_content', 't_em_single_link_pages' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 * This function is attached to the widgets_init hook.
 * Note: Sidebars are enables just if they are needed
 *
 * @uses register_sidebar()
 *
 * @since Twenty'em 0.1
 */
function t_em_widgets_init() {
	global $t_em;

	// Sidebars Widgets Area
	if ( 'one-column' != $t_em['layout_set'] ) :
		// Area 0, located at the top of the sidebar.
		register_sidebar( array(
			'name' => __( 'Main Sidebar Widget Area', 't_em' ),
			'id' => 'sidebar',
			'description' => __( 'The main sidebar widget area', 't_em' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	endif;

	if ( in_array( $t_em['layout_set'],
			array('three-column-content-left', 'three-column-content-right', 'three-column-content-middle' )
		) ) :
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
			'name' => __( 'Alternative Sidebar Widget Area', 't_em' ),
			'id' => 'sidebar-alt',
			'description' => __( 'Alternative sidebar widget area', 't_em' ),
			'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	endif;

	// Footer Widgets Area
	if ( $t_em['footer_set'] != 'no-footer-widget' ) :
			// Area 2, located in the footer. Empty by default.
			register_sidebar( array(
				'name' => __( 'First Footer Widget Area', 't_em' ),
				'id' => 'first-footer-widget-area',
				'description' => __( 'The first footer widget area', 't_em' ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );

		if ( in_array( $t_em['footer_set'],
				array( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' )
			) ) :
			// Area 3, located in the footer. Empty by default.
			register_sidebar( array(
				'name' => __( 'Second Footer Widget Area', 't_em' ),
				'id' => 'second-footer-widget-area',
				'description' => __( 'The second footer widget area', 't_em' ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		endif;

		if ( in_array( $t_em['footer_set'],
				array( 'three-footer-widget', 'four-footer-widget' )
			) ) :
			// Area 4, located in the footer. Empty by default.
			register_sidebar( array(
				'name' => __( 'Third Footer Widget Area', 't_em' ),
				'id' => 'third-footer-widget-area',
				'description' => __( 'The third footer widget area', 't_em' ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		endif;

		if ( in_array( $t_em['footer_set'],
				array( 'four-footer-widget' )
			) ) :
			// Area 5, located in the footer. Empty by default.
			register_sidebar( array(
				'name' => __( 'Fourth Footer Widget Area', 't_em' ),
				'id' => 'fourth-footer-widget-area',
				'description' => __( 'The fourth footer widget area', 't_em' ),
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		endif;
	endif;
}
add_action( 'widgets_init', 't_em_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Twenty'em 0.1
 */
function t_em_remove_recent_comments_style(){
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 't_em_remove_recent_comments_style' );


if ( ! function_exists( 't_em_posted_in' ) ) :
/**
 * Pluggable Function: Prints HTML with meta information for the current post (category, tags and
 * permalink).
 *
 * @since Twenty'em 0.1
 */
function t_em_posted_in(){
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 't_em' ) );
	if ( $categories_list ) :
		echo '<div class="entry-categories"><span class="icomoon-folder-open icomoon"></span><span class="categories-links">'. $categories_list .'</span></div>';
	endif;

	// Translators: used between list items, there is a space after the comma.
	$tags_list = get_the_tag_list( '', __( ', ', 't_em' ) );
	if ( $tags_list ) :
		echo '<div class="entry-tags"><span class="icomoon-tags icomoon"></span><span class="tags-links">'. $tags_list .'</span></div>';
	endif;

	$post_url = sprintf( '<div class="entry-permalink"><span class="icomoon-link icomoon"></span><span class="post-link"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></div>',
					get_permalink(),
					sprintf( __( 'Permalink to %1$s', 't_em' ), the_title_attribute( 'echo=0' ) ),
					__( 'Permalink', 't_em' )
				);
	echo $post_url;
}
endif; // function t_em_posted_in()

if ( ! function_exists( 't_em_posted_on' ) ) :
/**
 * Pluggable Function: Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty'em 0.1
 */
function t_em_posted_on() {
	t_em_post_date();
	t_em_post_author();
}
endif; // function t_em_posted_on()

if ( ! function_exists( 't_em_edit_post_link' ) ) :
/**
 * Pluggable Function: Prints HTML with edit post link
 *
 * @since Twenty'em 0.1
 */
function t_em_edit_post_link(){
	edit_post_link( __( 'Edit', 't_em' ), '<div class="entry-edit"><span class="icomoon-edit icomoon"></span><span class="edit-link">', '</span></div>' );
}
endif; // function t_em_edit_post_link()

if ( ! function_exists( 't_em_comments_link' ) ) :
/**
 * Pluggable Function: Prints HTML with leave comment link
 *
 * @since Twenty'em 0.1
 */
function t_em_comments_link(){
?>
	<div class="entry-comments"><span class="icomoon-comments icomoon"></span>
	<span class="comment-link">
	<?php comments_popup_link( __( 'Leave a comment', 't_em' ), __( '1 Comment', 't_em' ), __( '% Comments', 't_em' ) ); ?>
	</span></div>
<?php
}
endif; // function t_em_comments_link()

if ( ! function_exists( 't_em_attachment_meta' ) ) :
/**
 * Pluggable Function: Prints author, date and metadata for attached files
 *
 * @since Twenty'em 0.1
 */
function t_em_attachment_meta(){
	global $post;
	echo '<span class="icomoon-calendar icomoon"></span>';
	$published_text  = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>', 't_em' );
	$post_title = get_the_title( $post->post_parent );
	if ( empty( $post_title ) || 0 == $post->post_parent )
		$published_text  = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

	printf( $published_text,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_permalink( $post->post_parent ) ),
		esc_attr( strip_tags( $post_title ) ),
		$post_title
	);

	$metadata = wp_get_attachment_metadata();
	printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
		esc_url( wp_get_attachment_url() ),
		esc_attr__( 'Link to full-size image', 't_em' ),
		__( 'Full resolution', 't_em' ),
		$metadata['width'],
		$metadata['height']
	);
}
endif; // function t_em_attachment_meta()

if ( ! function_exists( 't_em_post_author' ) ) :
/**
 * Pluggable Function: Prints HTML with author posts link
 *
 * @since Twenty'em 0.1
 */
function t_em_post_author(){
	global $post;
	$author_id = $post->post_author;
	$post_author = sprintf( '<div class="entry-author"><span class="icomoon-user icomoon"></span><span class="post-author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span></div>',
				esc_url( get_author_posts_url( $author_id ) ),
				esc_attr( sprintf( __( 'View all post by %s', 't_em' ), get_the_author_meta( 'display_name', $author_id ) ) ),
				get_the_author_meta( 'display_name', $author_id )
			);
	echo $post_author;
}
endif; // function t_em_post_author()

if ( ! function_exists( 't_em_post_date' ) ) :
/**
 * Pluggable Function: Prints HTML with post date link
 *
 * @since Twenty'em 0.1
 */
function t_em_post_date(){
	$post_date = sprintf( '<div class="entry-date"><span class="icomoon-time icomoon"></span><span class="post-date">
		<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span></div>',
					esc_url( get_permalink() ),
					esc_attr( sprintf( __( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ) ),
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
	echo $post_date;
}
endif; // function t_em_post_date()

if ( ! function_exists( 't_em_author_meta' ) ) :
/**
 * Pluggable Function: If a user has filled out their description, show a bio on their entries.
 *
 * @since Twenty'em 1.0
 */
function t_em_author_meta(){
	if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
	<div id="author-info-<?php echo get_the_author_meta( 'user_login' ); ?>" class="author-info author-archive media">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), '', '', get_the_author() ); ?>
		<div id="author-description" class="media-body">
			<h4 class="media-heading"><?php printf( esc_attr__( 'About %s', 't_em' ), get_the_author() ); ?></h4>
			<?php the_author_meta( 'description' ); ?>
			<?php if ( is_single() ) : ?>
			<div id="author-link">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php printf( __( 'View all posts by %s <span class="meta-nav">&raquo;</span>', 't_em' ), get_the_author() ); ?>
				</a>
			</div><!-- #author-link	-->
		<?php endif; ?>
		</div><!-- #author-description -->
	</div><!-- .author-info -->
<?php
	endif;
}
endif; // function t_em_author_meta()

if ( ! function_exists( 't_em_header_archive_author_meta' ) ) :
/**
 * Pluggable Function: Display Author header tag and meta in author archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_author_meta(){
	if ( is_author() ) :
		/* Queue the first post, that way we know who the author is when we try to get their name,
		 * URL, description, avatar, etc.
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) :
			the_post();
?>
	<div id="featured-header-author-<?php echo get_the_author_meta( 'user_login' ) ?>" class="featured-header featured-header-author">
		<header>
			<h1 class="page-header author"><?php printf( __( 'Author Archives: %s', 't_em' ), "<small><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></small>" ); ?></h1>
		</header>
		<?php t_em_author_meta(); ?>
	</div><!-- .featured-header -->
<?php
		/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
			rewind_posts();
		endif;
	endif;
}
endif; // function t_em_header_archive_author_meta()
add_action( 't_em_action_content_before', 't_em_header_archive_author_meta', 15 );

/**
 * Display Author meta in single post.
 * This function is attached to the t_em_action_post_content_after action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_single_author_meta(){
	if ( is_single() ) return t_em_author_meta();
}
add_action( 't_em_action_post_content_after', 't_em_single_author_meta' );

if ( ! function_exists( 't_em_term_description' ) ) :
/**
 * Pluggable Function: Display the category or tag description.
 *
 * @since Twenty'em 1.0
 */
function t_em_term_description(){
	if ( is_category() ) :
		$term_description = category_description();
		$term_id = get_term_by( 'name', single_cat_title( '', false ), 'category' );
	elseif ( is_tag() ) :
		$term_description = tag_description();
		$term_id = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' );
	elseif ( is_tax() ) :
		$query_obj = get_queried_object();
		$term_description = t_em_wrap_paragraph ( $query_obj->description );
		$term_id = get_term_by( 'id', $query_obj->term_id, $query_obj->taxonomy );
	endif;
	if ( ! empty( $term_description ) ) :
		echo '<div id="term-description-'. $term_id->term_id .'" class="archive-meta term-description">' . $term_description . '</div>';
	endif;
}
endif; // function t_em_term_description()

if ( ! function_exists( 't_em_header_archive_taxonomy' ) ) :
/**
 * Pluggable Function: Display Taxonomy header tag and description in taxonomies archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_taxonomy(){
	if ( is_category() || is_tag() || is_tax() ) :
		/* Queue the first post, that way we know if taxonomy is not empty
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) : the_post();
			$query_obj = get_queried_object();
			$labels = get_taxonomy( $query_obj->taxonomy );
			$classes = 'featured-header-'. $query_obj->taxonomy . ' ' . $query_obj->taxonomy.'-'.$query_obj->slug;
		?>
	<div id="featured-header-taxonomy-<?php echo $query_obj->term_id ?>" class="featured-header <?php echo $classes; ?>">
		<header>
			<h1 class="page-header">
				<?php printf( __( '%1$s Archives: %2$s', 't_em' ), $labels->labels->singular_name, '<small>' . single_term_title( '', false ) . '</small>' ); ?>
			</h1>
		</header>
<?php 	t_em_term_description(); ?>
	</div><!-- .featured-header -->
<?php   /* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts(); endif;
	endif;
}
endif; // function t_em_header_archive_taxonomy()
add_action( 't_em_action_content_before', 't_em_header_archive_taxonomy', 15 );

if ( ! function_exists( 't_em_header_archive_post_type_archive' ) ) :
/**
 * Pluggable Function: Display Custom Post Type header tag and description in custom post type archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_post_type_archive(){
	if ( is_post_type_archive() ) :
		$post_type_obj = get_post_type_object( get_post_type() );
		$post_type_name = ( $post_type_obj->labels->name ) ? $post_type_obj->labels->name : get_post_type();
?>
	<div id="featured-header-post-type-<?php echo get_post_type(); ?>" class="featured-header featured-header-post-type">
		<header>
			<h1 class="page-header">
				<?php printf( __( 'Archives for: %1$s', 't_em' ), '<small>' . $post_type_name . '</small>' ); ?>
			</h1>
		</header>
	</div><!-- .featured-header -->
<?php
	endif;
}
endif; // function t_em_header_archive_post_type_archive()
add_action( 't_em_action_content_before', 't_em_header_archive_post_type_archive', 15 );

if ( ! function_exists( 't_em_header_archive_date' ) ) :
/**
 * Pluggable Function: Display Date header tag in date archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_date(){
	if ( is_date() ) :
		/* Queue the first post, that way we know what date we're dealing with (if that is the case).
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) : the_post();
			if ( is_day() ) :
				$date_archive = sprintf( __( 'Daily Archives: <small>%s</small>', 't_em' ), get_the_date() );
				$archive_id = 'daily';
			elseif ( is_month() ) :
				$date_archive = sprintf( __( 'Monthly Archives: <small>%s</small>', 't_em' ), get_the_date('F Y') );
				$archive_id = 'monthly';
			elseif ( is_year() ) :
				$date_archive = sprintf( __( 'Yearly Archives: <small>%s</small>', 't_em' ), get_the_date('Y') );
				$archive_id = 'yearly';
			else :
				$date_archive = __( 'Blog Archives', 't_em' );
				$archive_id = 'archive';
			endif; ?>
	<div id="featured-header-<?php echo $archive_id; ?>" class="featured-header featured-header-date">
		<header>
			<h1 class="page-header">
			<?php echo $date_archive; ?>
			</h1>
		</header>
	</div><!-- .featured-header -->
		<?php
		/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts(); endif;
	endif;
}
endif; // function t_em_header_archive_date()
add_action( 't_em_action_content_before', 't_em_header_archive_date', 15 );

if ( ! function_exists( 't_em_header_archive_search' ) ) :
/**
 * Pluggable Function: Display Search header tag in search archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_search(){
	if ( is_search() ) :
		/* Queue the first post, that way we know if there is a search result
		 *
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) : the_post(); ?>
		<div id="featured-header-search" class="featured-header featured-header-search">
			<header>
				<h1 class="page-header"><?php printf( __( 'Search Results for: %s', 't_em' ), '<small>' . get_search_query() . '</small>' ); ?></h1>
			</header>
		</div><!-- .featured-header -->
<?php
		/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts(); endif;
	endif;
}
endif; // function t_em_header_archive_search()
add_action( 't_em_action_content_before', 't_em_header_archive_search', 15 );

if ( ! function_exists( 't_em_comment' ) ) :
/**
 * Pluggable Function: Template for comments.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own t_em_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty'em 0.1
 */
function t_em_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="media-left media-object"><?php echo get_avatar( $comment, '', '', get_comment_author() ); ?></div>
			<div class="media-body">
				<header class="comment-header media-heading">
					<div class="comment-author vcard">
						<?php printf( __( '<b class="fn">%1$s</b><span class="says">says:</span>', 't_em' ), get_comment_author_link() ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 't_em' ); ?></em>
						<br />
					<?php endif; ?>

					<time class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 't_em' ), get_comment_date(),  get_comment_time() ); ?></a>
					</time><!-- .comment-meta .commentmetadata -->
					<small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
				</header><!-- comment-heading -->
				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .media-body -->
		</div><!-- #comment-## .comment-wrap -->
	<?php
			break;
	endswitch;
}
endif; // function t_em_comment()

if ( ! function_exists( 't_em_comment_pingback_trackback' ) ) :
/**
 * Pluggable Function: Template for pingbacks and trackbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own t_em_comment_pingback_trackback(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty'em 0.1
 */
function t_em_comment_pingback_trackback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php _e( 'Pingback:', 't_em' ); ?> <?php comment_author_link(); ?> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
			break;
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php _e( 'Trackback:', 't_em' ); ?> <?php comment_author_link(); ?> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
		break;
	endswitch;
}
endif; // function t_em_comment_pingback_trackback()

if ( ! function_exists( 't_em_comment_all' ) ) :
/**
 * Pluggable Function: Template for comments, pingbacks and trackbacks
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own t_em_comment_pingback_trackback(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty'em 1.0
 */
function t_em_comment_all( $comment, $args, $depth ){
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php _e( 'Pingback:', 't_em' ); ?> <?php comment_author_link(); ?> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
			break;
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php _e( 'Trackback:', 't_em' ); ?> <?php comment_author_link(); ?> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
			break;
		default :
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="media-left media-object"><?php echo get_avatar( $comment, '', '', get_comment_author() ); ?></div>
			<div class="media-body">
				<header class="comment-header media-heading">
					<div class="comment-author vcard">
						<?php printf( __( '<b class="fn">%1$s</b> <span class="says">says:</span>', 't_em' ), get_comment_author_link() ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 't_em' ); ?></em>
						<br />
					<?php endif; ?>

					<time class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 't_em' ), get_comment_date(),  get_comment_time() ); ?></a>
					</time><!-- .comment-meta .commentmetadata -->
					<small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
				</header><!-- comment-heading -->
				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .media-body -->
		</div><!-- #comment-## .comment-wrap -->
	<?php
		break;
	endswitch;
}
endif; // function t_em_comment_all()

if ( ! function_exists( 't_em_comments_template' ) ) :
/**
 * Pluggable Function: Display comments template
 *
 * @since Twenty'em 1.0
 */
function t_em_comments_template(){
	global $t_em;
	if ( comments_open() || get_comments_number() ) :
		if ( ( is_single() )
			|| ( is_page() && $t_em['single_page_comments'] == true ) ) :
			return comments_template( '', true );
		endif;
	endif;
}
endif; // function t_em_comments_template()

if ( ! function_exists( 't_em_page_navi' ) ) :
/**
 * Pluggable Function: Display navigation to next/previous pages when applicable.
 * This function is attached to the t_em_action_content_after() action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_page_navi(){
	global $wp_query, $t_em;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 || is_404() ) :
		return;
	endif;
?>
<?php
		if ( 'prev-next' == $t_em['archive_pagination_set'] ) :
?>
	<nav id="site-pagination" class="navi">
		<ul>
			<li class="previous"><?php next_posts_link( __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Older posts', 't_em' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ) ); ?></li>
		</ul>
	</nav>
<?php
		elseif ( 'page-navi' == $t_em['archive_pagination_set'] ) :
?>
	<nav id="site-pagination" class="pagi">
<?php
			$paged 			= get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link 	= html_entity_decode( get_pagenum_link() );
			$query_args 	= array();
			$url_parts 		= explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

			$links = paginate_links( array(
				/**
				 * Filter the paginate link structure
				 *
				 * @link http://codex.wordpress.org/Function_Reference/paginate_links
				 * @since Twenty'em 1.0
				 */
				'base'					=> $pagenum_link,
				'format'				=> $format,
				'total'					=> $wp_query->max_num_pages,
				'current'				=> $paged,
				'add_args'				=> array_map( 'urlencode', $query_args ),
				'prev_text'				=> apply_filters( 't_em_filter_paginate_links_prev_text', __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Newer posts', 't_em' ) ),
				'next_text'				=> apply_filters( 't_em_filter_paginate_links_next_text', __( 'Older posts <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ) ),
				'end_size'				=> apply_filters( 't_em_filter_paginate_links_end_size', 1 ),
 				'mid_size'				=> apply_filters( 't_em_filter_paginate_links_mid_size', 2 ),
				'type'					=> apply_filters( 't_em_filter_paginate_links_type', 'list' ),
				'prev_next'				=> apply_filters( 't_em_filter_paginate_links_prev_next', true ),
				'add_fragment'			=> apply_filters( 't_em_filter_paginate_links_add_fragment', null ),
				'before_page_number'	=> apply_filters( 't_em_filter_paginate_links_before_page_number', null ),
				'after_page_number'		=> apply_filters( 't_em_filter_paginate_links_after_page_number', null ),
			) );
			if ( $links ) :
				$current_page = ( 0 == get_query_var( 'paged' ) ) ? '1' : get_query_var( 'paged' );
				$total_pages = $wp_query->max_num_pages;
?>
				<span class="pages page-numbers"><?php echo sprintf( __( 'Page %1$s of %2$s', 't_em' ), $current_page, $total_pages ); ?></span>
				<?php echo $links; ?>
<?php
			endif;
?>
	</nav>
<?php
		endif;
}
endif; // function t_em_page_navi()
add_action( 't_em_action_content_after', 't_em_page_navi' );

/**
 * Retrieve protected post password form content. This function is attached to the the_password_form
 * filter
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @return string HTML content for password form for password protected post.
 */
function t_em_the_password_form(){
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$output = 	'<form class="" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
					<div class="form-group">
						<p>' . __( 'This content is password protected. To view it please enter your password below:', 't_em' ) . '</p>
						<label for="'. $label .'">'. __( 'Password', 't_em' ) .'</label>
						<input id="' . $label . '" type="password" class="form-control" name="post_password">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit" name="Submit" title="' . esc_attr__( 'Submit', 't_em' ) . '">'. esc_attr__( 'Submit', 't_em' ) .'</button>
						</span>
					</div>
				</form>';
	return $output;
}
add_filter( 'the_password_form', 't_em_the_password_form' );

if ( ! function_exists( 't_em_custom_template_content' ) ) :
/**
 * Pluggable Function: Display Page title and content for custom pages templates.
 * This function is attached to the t_em_action_content_before action hook.
 *
 * @since Twenty'em 1.0
 */
function t_em_custom_template_content(){
	if ( is_page_template() && get_post_meta( get_the_ID(), '_wp_page_template', true ) != 'page-templates/template-one-column.php' ) :
	$template_data = get_page( get_the_ID() );
?>
	<div id="featured-header-template-<?php the_ID(); ?>" <?php post_class( 'featured-header featured-header-template custom-template-content' ); ?>>
		<header>
			<h1 class="page-header"><?php echo $template_data->post_title; ?></h1>
		</header>
<?php if ( $template_data->post_content ) : ?>
		<div class="entry-content"><?php echo apply_filters( 'the_content', $template_data->post_content ); ?></div>
<?php endif; ?>
		<footer class="entry-utility">
			<?php t_em_edit_post_link(); ?>
		</footer>
	</div><!-- .featured-header -->
<?php
	endif;
}
endif; // function t_em_custom_template_content()
add_action( 't_em_action_content_before', 't_em_custom_template_content', 15 );

if ( ! function_exists( 't_em_featured_post_thumbnail' ) ) :
/**
 * Pluggable Function: Display featured image in posts archives when "Display the Excerpt" option is
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
 * @return text HTML content describing embedded figure
 *
 * @since Twenty'em 0.1
 */
function t_em_featured_post_thumbnail( $width, $height, $link = true, $class = null, $post_id = 0 ){
	global $t_em;

	$post_id = absint( $post_id );
	if ( ! $post_id )
		$post_id = get_the_ID();

	$open_link = ( $link ) ? '<a href="'. get_permalink( $post_id ) .'" title="'.  get_the_title( $post_id ) .'" rel="bookmark">' : null;
	$close_link = ( $link ) ? '</a>' : null;

	if ( has_post_thumbnail( $post_id ) ) :
		// Display featured image assigned to the post
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
		$image_src = $image_url[0];
		echo $open_link;
		?>
			<figure id="post-attachment-<?php echo $post_id; ?>" class="<?php echo $class ?>" style="width:<?php echo $width ?>px">
				<img alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo T_EM_THEME_DIR_INC_URL .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo get_the_title( $post_id ); ?>"/>
				<figcaption><?php echo get_the_title( $post_id ); ?></figcaption>
			</figure>
		<?php
		echo $close_link;
	else :
		// Display the first image uploaded/attached to the post
		$images = get_children( array( 'post_parent' => $post_id, 'post_type' => 'attachment', 'order' => 'ASC', 'post_mime_type' => 'image', 'numberposts' => 9999 ) );
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_url = ( ! empty($image) ) ? wp_get_attachment_image_src( $image->ID, 'full' ) : '';
		if ( $total_images >= 1 ) :
			$image_src = $image_url[0];
			echo $open_link;
			?>
				<figure id="post-attachment-<?php echo $post_id; ?>" class="<?php echo $class ?>" style="width:<?php echo $width ?>px">
					<img alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo T_EM_THEME_DIR_INC_URL .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo get_the_title( $post_id ); ?>"/>
					<figcaption><?php echo get_the_title( $post_id ); ?></figcaption>
				</figure>
			<?php
			echo $close_link;
		endif;
	endif;
}
endif; // function t_em_featured_post_thumbnail()

if ( ! function_exists( 't_em_header_image' ) ) :
/**
 * Pluggable Function: Display header image if it's set by the user in 'Header Options' admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_header_image(){
	global $post, $t_em;
	if ( ( 'header-image' == $t_em['header_set'] )
		&& ( ( '1' == $t_em['header_featured_image_home_only'] && is_home() )
		|| ( '0' == $t_em['header_featured_image_home_only'] ) ) ) :

		$header_image = get_header_image();
		if ( $header_image ) :
			$header_image_width = get_theme_support( 'custom-header', 'width' );
			$header_image_height = get_theme_support( 'custom-header', 'height' );
?>
		<section id="header-image">
			<div  class="wrapper container">
				<div class="row">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php
			// Check if the user choose to display featured image in single posts and pages
			if ( '1' == $t_em['header_featured_image'] &&
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
				</div>
			</div>
		</section><!-- #header-image -->
<?php
		endif;
	endif;
}
endif; // function t_em_header_image()
add_action( 't_em_action_header_after', 't_em_header_image', 5 );

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
	global	$post, $t_em;
	if ( ( 'slider' == $t_em['header_set'] )
		&& ( ( '1' == $t_em['slider_home_only'] && is_home() )
		|| ( '0' == $t_em['slider_home_only'] ) ) ) :

		if ( ! $args ) $args = t_em_slider_query_args();

		$slider_posts = get_posts( $args );
		$slider_wrap = ( $t_em['bootstrap_carousel_wrap'] == '1' ) ? 'false' : 'true';
		$slider_pause = ( $t_em['bootstrap_carousel_pause'] == '1' ) ? 'hover' : 'null';
?>
		<section id="header-carousel">
			<div id="slider-carousel" data-ride="carousel" data-wrap="<?php echo $slider_wrap; ?>" data-pause="<?php echo $slider_pause; ?>" data-interval="<?php echo $t_em['bootstrap_carousel_interval'] ?>" class="wrapper container carousel slide">
<?php 	if ( $slider_posts ) : ?>
<?php 			$tp = count( $slider_posts ) ?>
				<ol class="carousel-indicators">
			<?php $s = 0; while ( $s < $tp ) : ?>
					<li data-target="#slider-carousel" data-slide-to="<?php echo $s ?>"></li>
			<?php $s++; endwhile; ?>
				</ol><!-- .carousel-indicators -->
				<div class="carousel-inner">
<?php 			foreach ( $slider_posts as $post ) : setup_postdata( $post );
					if ( has_post_thumbnail( $post->ID ) ) :
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$image_src = $image_url[0];
					else :
						$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'order' => 'ASC', 'post_mime_type' => 'image', 'numberposts' => 9999 ) );
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_url = wp_get_attachment_image_src( $image->ID, 'full' );
							$image_src = $image_url[0];
					endif; ?>
					<div class="item">
						<img alt="<?php the_title(); ?>" src="<?php echo T_EM_THEME_DIR_INC_URL .'/timthumb.php?zc=1&amp;w='.$t_em['layout_width'].'&amp;h='.$t_em['slider_height'].'&amp;src='. $image_src ?>" />
						<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="carousel-caption">
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a>
							</h3>
							<div class="entry-summary hidden-xs hidden-sm"><?php echo get_the_excerpt(); ?></div>
						</div>
					</div><!-- .item -->
<?php 			endforeach; wp_reset_postdata(); ?>
				</div><!-- .carousel-inner -->
				<a class="left carousel-control" href="#slider-carousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#slider-carousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
<?php 	endif; ?>
		</div>
	</section><!-- #slider-carousel -->
<?php
	endif;
}
endif; // function t_em_slider_bootstrap_carousel()
add_action( 't_em_action_header_after', 't_em_slider_bootstrap_carousel', 5 );

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

	$args = array(
		'post_type'			=> 'post',
		'cat'				=> $t_em['slider_category'],
		'post__in'			=> $p,
		'posts_per_page'	=> $tp,
		'orderby'			=> 'date',
		'order'				=> 'DESC',
	);

	/**
	 * Filter the Slider query arguments
	 *
	 * @param array An array of arguments
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
	global $t_em;
	if ( ( 'static-header' == $t_em['header_set'] )
		&& ( ( '1' == $t_em['static_header_home_only'] && is_home() )
		|| ( '0' == $t_em['static_header_home_only'] ) ) ) :
?>
		<section id="static-header" class="<?php echo $t_em['static_header_text'] ?>" role="info">
			<div id="static-header-inner" class="wrapper container">
<?php 	if ( ! empty ( $t_em['static_header_img_src'] ) ) : ?>
			<div id="static-header-image" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
				<figure>
					<img src="<?php echo $t_em['static_header_img_src']; ?>"
						alt="<?php echo sanitize_text_field( $t_em['static_header_headline'] ); ?>">
				</figure>
			</div><!-- #static-header-image -->
<?php 	endif; ?>

<?php 	if ( $t_em['static_header_headline']
			|| $t_em['static_header_content']
			|| ( $t_em['static_header_primary_button_text'] && $t_em['static_header_primary_button_link'] )
			|| ( $t_em['static_header_secondary_button_text'] && $t_em['static_header_secondary_button_link'] )
		) : ?>
			<div id="static-header-text" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
<?php 	if ( $t_em['static_header_headline'] ) : ?>
				<header><h2><?php echo $t_em['static_header_headline']; ?></h2></header>
<?php 	endif; ?>
<?php 	if ( $t_em['static_header_content'] ) : ?>
				<div class="static-header-content"><?php echo t_em_wrap_paragraph( $t_em['static_header_content'] ); ?></div>
<?php 	endif; ?>
				<footer class="actions">
<?php 	if ( ( $t_em['static_header_primary_button_text'] && $t_em['static_header_primary_button_link'] ) ) : ?>
					<a href="<?php echo $t_em['static_header_primary_button_link']; ?>"
						title="<?php echo $t_em['static_header_primary_button_text']; ?>"
						class="btn primary-button">
							<span class="<?php echo $t_em['static_header_primary_button_icon_class'] ?> icomoon"></span>
							<span class="button-text"><?php echo $t_em['static_header_primary_button_text']; ?></span>
						</a>
<?php 	endif; ?>
<?php 	if ( ( $t_em['static_header_secondary_button_text'] && $t_em['static_header_secondary_button_link'] ) ) : ?>
					<a href="<?php echo $t_em['static_header_secondary_button_link']; ?>"
						title="<?php echo $t_em['static_header_secondary_button_text']; ?>"
						class="btn secondary-button">
							<span class="<?php echo $t_em['static_header_secondary_button_icon_class'] ?> icomoon"></span>
							<span class="button-text"><?php echo $t_em['static_header_secondary_button_text']; ?></span>
						</a>
<?php 	endif; ?>
				</footer><!-- .actions -->
			</div><!-- #static-header-text -->
<?php 	endif; ?>
			</div>
		</section><!-- #static-header .container -->
<?php
	endif;
}
endif; // function t_em_static_header()
add_action( 't_em_action_header_after', 't_em_static_header', 5 );

if ( ! function_exists( 't_em_single_post_thumbnail' ) ) :
/**
 * Pluggable Function: Display featured post thumbnail on top of a single post if it is set by the
 * user in "General Options" in the admin options page. This function is attached to the
 * t_em_action_post_inside_before() action hook.
 *
 * @uses has_post_thumbnail() Returns a boolean if a post has a Featured Image
 * @uses the_post_thumbnail() Display the Featured Image for the current post, as set in that
 * post's edit screen.
 *
 * @link http://codex.wordpress.org/Post_Thumbnails
 *
 * @global $t_em
 *
 * @since Twenty'em 0.1
 */
function t_em_single_post_thumbnail(){
	global $t_em;
	if ( is_single() && '1' == $t_em['single_featured_img'] && has_post_thumbnail() ) :
?>
<figure id="featured-image-<?php the_ID() ?>" class="featured-post-thumbnail">
<?php the_post_thumbnail(); ?>
</figure>
<?php
	endif;
}
endif; // function t_em_single_post_thumbnail()
add_action( 't_em_action_post_inside_before', 't_em_single_post_thumbnail' );

if ( ! function_exists( 't_em_post_archive_set' ) ) :
/**
 * Pluggable Function: Display posts archive in excerpt or content form. Set in "Archive Options"
 * in admin theme option page.
 *
 * @uses t_em_featured_post_thumbnail() Display featured image in posts archives.
 * @uses the_excerpt() Displays the excerpt of the current post with the "..." text at the end.
 * @uses the_content() Displays the contents of the current post.
 *
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 * @link http://codex.wordpress.org/Function_Reference/the_content
 *
 * @global $t_em
 *
 * @since Twenty'em 0.1
 */
function t_em_post_archive_set(){
	global $t_em;

	t_em_action_post_content_before();
	if ( 'the-excerpt' == $t_em['archive_set'] ) :
?>
			<div class="entry-summary">
				<?php t_em_featured_post_thumbnail( $t_em['excerpt_thumbnail_width'], $t_em['excerpt_thumbnail_height'], true, 'featured-post-thumbnail' ); ?>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
<?php
	else :
?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?>
			</div><!-- .entry-content -->
<?php
	endif;
	t_em_action_post_content_after();
}
endif; // function t_em_post_archive_set()

if ( ! function_exists( 't_em_user_social_network' ) ) :
/**
 * Pluggable Function: User social network set in "Social Network Options" in the admin theme options.
 *
 * @param string $nav_id Required. HTML 'id' attribute of the navigation section
 * @param string $nav_classes Optional. HTML 'class' attribute of the <nav>...</nav> tag section (usually a Bootstrap class)
 * @param string $ul_classes Optional. HTML 'class' attribute of the <ul>...</ul> tag section (usually a Bootstrap class)
 * @param string $li_classes Optional. HTML 'class' attribute of each <li>...</li> tag item (usually a Bootstrap class)
 *
 * @uses t_em_social_network_options() See t_em_social_network_options() function
 * in /inc/social-network-options.php file.
 *
 * @global $t_em
 *
 * @return string HTML list of items
 *
 * @since Twenty'em 0.1
 */
function t_em_user_social_network( $nav_id = true, $nav_classes = '', $ul_classes = '', $li_classes = '' ){
	global 	$t_em;

	$user_social_network = t_em_social_network_options();

	$output_items = '';
	foreach ( $user_social_network as $social_network ) :
		if ( $t_em[$social_network['name']] != '' ) :
		$output_items .= '<li id="'.$social_network['name'].'" class="social-icon '. $li_classes .'"><a href="'. $t_em[$social_network['name']] .'" class="'. $social_network['class'] .' icomoon" title="'. $t_em[$social_network['name']] .'"><span class="network-label">'.$social_network['item'].'</span></a></li>';
		endif;
	endforeach;
	if ( ! empty( $output_items ) ) :
		// We are sure to not display empties <nav><ul>...</ul></nav> tags.
		$output = '<ul class="'. $ul_classes .'">' . $output_items . '</ul>';
		$output = '<nav id="'. $nav_id .'-social-network-menu" class="social-network-menu '. $nav_classes .'">' . $output . '</nav>';
	else :
		$output = '';
	endif;
	echo $output;
}
endif; // function t_em_user_social_network()

/**
 * Display user social network.
 * This function is attached to the t_em_action_site_info action hook.
 *
 * @since Twenty'em 1.0
 */
function t_em_display_user_social_network(){
	t_em_user_social_network( 't-em', '', 'text-right' );
}
add_action( 't_em_action_site_info_right', 't_em_display_user_social_network' );

if ( ! function_exists( 't_em_loop' ) ) :
/**
 * Pluggable Function: The Twenty'em Loop
 *
 * @since Twenty'em 1.0
 */
function t_em_loop(){
	global $t_em;
	if ( have_posts() ) : ?>
		<div class="row">
	<?php
		$i = 0;
		while ( have_posts() ) : the_post();
			if ( 0 == $i % $t_em['archive_in_columns'] ) :
				echo '</div>';
				echo '<div class="row">';
			endif;
			get_template_part( 'content', get_post_format() );
			$i++;
		endwhile;
	?>
		</div><!-- .row -->
	<?php
	else :
		get_template_part( 'content', 'none' );
	endif;
}
endif; // function t_em_loop()

if ( ! function_exists( 't_em_single_related_posts' ) ) :
/**
 * Pluggable Function: Show related posts to the current single post if it's set by the user in
 * "General Options" in admin theme options page.
 * This function is attached to the t_em_action_post_after() action hook.
 *
 * @global $t_em
 *
 * @return string HTML list of items
 *
 * @since Twenty'em 0.1
 */
function t_em_single_related_posts(){
	global $t_em;
	if ( is_single() && '1' == $t_em['single_related_posts'] ) :
		global $post;
		$category_terms = get_the_terms( $post->ID, 'category' );
		$tag_terms = get_the_terms( $post->ID, 'post_tag' );

		/**
		 * Filter the amount of related post to display
		 *
		 * @param int Number of posts to display
		 * @since Twenty'em 1.0
		 */
		$limit = apply_filters( 't_em_filter_single_limit_related_posts', 9 );
		$post_category_terms = array();
		$post_tag_terms = array();

		if ( $category_terms ) :
			foreach ( $category_terms as $cat_term ) :
				array_push( $post_category_terms, $cat_term->term_id );
			endforeach;
		endif;
		if ( $tag_terms ) :
			foreach ( $tag_terms as $tag_term ) :
				array_push( $post_tag_terms, $tag_term->term_id );
			endforeach;
		endif;

		$related_post_args = array(
			'posts_per_page'	=> $limit,
			'post__not_in'		=> array( $post->ID ),
			'post_status'		=> 'publish',
			'tax_query'			=> array(
				'relation'		=> 'OR',
				array(
					'taxonomy'	=> 'category',
					'field'		=> 'id',
					'terms'		=> $post_category_terms,
				),
				array(
					'taxonomy'	=> 'post_tag',
					'field'		=> 'id',
					'terms'		=> $post_tag_terms,
				),
			),
		);
		$all_posts = get_posts( $related_post_args );
?>
<?php 	if ( ! empty( $all_posts ) ) : ?>
		<section id="related-posts">
			<h3 class="related-posts-title"><?php _e( 'Related Posts', 't_em' ); ?></h3>
			<ul class="related-posts-list">
		<?php foreach( $all_posts as $post ) : setup_postdata( $post );
			$output = '<a href="'. get_permalink() .'">'. get_the_title() .'</a>';
			/**
			 * Filter the related post html output
			 *
			 * @param string HTML output
			 * @since Twenty'em 1.0
			 */
		?>
				<li><?php echo apply_filters( 't_em_filtrer_single_related_posts_output', $output ); ?></li>
		<?php endforeach; wp_reset_query(); ?>
			</ul>
		</section>
<?php 	endif; ?>
<?php
	endif;
}
endif; // function t_em_single_related_posts()
add_action( 't_em_action_post_after', 't_em_single_related_posts' );

if ( ! function_exists( 't_em_front_page_widgets' ) ) :
/**
 * Pluggable Function: Render Featured Text Widgets in front page if it's is set by the user in
 * "Front Page Options" in admin panel.
 *
 * This function is directly call from custom-front-page.php template
 *
 * @global $t_em
 *
 * @uses t_em_front_page_widgets_options()
 *
 * @return string HTML
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_widgets(){
	global $t_em;
	if ( 'widgets-front-page' == $t_em['front_page_set'] ) : ?>
		<section id="featured-widget-area" class="row">
			<?php t_em_action_custom_front_page_inside_before(); ?>

<?php
		foreach ( t_em_front_page_widgets_options() as $widget ) :
			if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
			$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
				'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' icomoon"></span>' : '';

			$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
				'<img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ).'" />' : '';

			$h_tag = ( $widget['name'] == 'text_widget_one' ) ? 'h1' : 'h3';

			$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
				'<header><'. $h_tag .'>'. $widget_icon_class . $t_em['headline_'.$widget['name'].''] .'</'. $h_tag .'></header>' : '';

			$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
				'<div>'. t_em_wrap_paragraph( do_shortcode( $t_em['content_'.$widget['name'].''] ) ) .'</div>' : '';

			$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
			$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
			$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
			$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
			$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
			$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

			if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
					$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
						'<a href="'. $primary_button_link .'" class="btn primary-button">
						<span class="'.$primary_link_icon_class.' icomoon"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

					$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
						'<a href="'. $secondary_button_link .'" class="btn secondary-button">
						<span class="'.$secondary_link_icon_class.' icomoon"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

				$widget_footer = '<footer>'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
			else :
				$widget_footer = null;
			endif;

			// First widget is a Jumbotron
			$widget_cols = ( $widget['name'] != 'text_widget_one' ) ? t_em_add_bootstrap_class( 'featured-widget-area' ) : 'col-md-12';
?>
			<div class="<?php echo $widget_cols; ?>">
				<div id="front-page-widget-<?php echo str_replace( 'text_widget_', '', $widget['name'] ) ?>" class="front-page-widget">
					<?php echo $widget_thumbnail_url; ?>
					<div class="front-page-widget-caption caption">
					<?php	echo $widget_headline;
							echo $widget_content;
							echo $widget_footer; ?>
					</div>
				</div>
			</div>
<?php
			endif;
		endforeach;
?>

			<?php t_em_action_custom_front_page_inside_after(); ?>
		</section><!-- #featured-widget-area -->
<?php
	endif;
}
endif; // function t_em_front_page_widgets()

/**
 * Load custom template for Custom Front Page (Text Widgets) option in admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_load_custom_front_page( $home_template = '' ){
	global $t_em;
	if ( 'widgets-front-page' == $t_em['front_page_set'] ) :
		$home_template = locate_template( 'custom-front-page.php' );
	endif;
	return $home_template;
}
add_action( 'home_template', 't_em_load_custom_front_page' );

if ( ! function_exists( 't_em_breadcrumb' ) ) :
/**
 * Pluggable Function: Show breadcrumb path if it's enable by the user in 'General Options' in admin panel.
 * This function is attached to the t_em_action_content_before() action hook.
 *
 * @global $t_em
 *
 * @return string HTML
 *
 * @since Twenty'em 1.0
 */
function t_em_breadcrumb(){
	global $t_em;

	if ( '1' == $t_em['breadcrumb_path'] ) :
		global $post;

		$query_obj = get_queried_object();
		$home_name = __( 'Home', 't_em' );
		$current_before = '<li class="active">';
		$current_after = '</li>';
		$home_link = '<li><a href="'. home_url() .'">'. $home_name .'</a></li>';
		$year_link = ( is_year() || is_month() || is_day() ) ? '<li><a href="'. get_year_link( get_the_time( 'Y' ) ) .'">'. get_the_time( 'Y' ) .'</a></li>' : null;
		$month_link = ( is_year() || is_month() || is_day() ) ? '<li><a href="'. get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) .'">'. get_the_time( 'F' ) .'</a></li>' : null;
		$post_type_obj = ( is_single() ) ? get_post_type_object( $post->post_type ) : null;
		$parent_post_type_obj = ( is_single() ) ? get_post_type_object( get_post_type( $post->post_parent ) ) : null;
		$post_type_archive_link = ( is_single() && empty( $post_type_obj->hierarchical ) ) ? '<li><a href="'. get_post_type_archive_link( $post->post_type ) .'">'. $post_type_obj->label .'</a></li>' : null;
		$attachment_parent_link = ( is_attachment() ) ? '<li><a href="'. get_permalink( $post->post_parent ) .'">'. get_the_title( $post->post_parent ) .'</a></li>' : null;
		$attachment_post_type_parent_link = ( is_attachment() && ! is_page() ) ? '<li><a href="'. get_post_type_archive_link( get_post_type( $post->post_parent ) ) .'">'. $parent_post_type_obj->label .'</a></li><li><a href="'. get_permalink( $post->post_parent ) .'">'. get_the_title( $post->post_parent ) .'</a></li>' : null;
?>
		<div id="you-are-here">
			<lo class="breadcrumb col-xs-12">
<?php
		if ( is_front_page() ) :
			echo $current_before . $home_name . $current_after;
			if ( get_option( 'show_on_front' ) == 'page' ) :
				echo $current_before . get_the_title() . $current_after;
			endif;
		elseif ( ! is_front_page() ) :
			echo $home_link;
		endif;
		if ( ! is_front_page() && ( is_home() && get_option( 'page_for_posts' ) == $query_obj->ID ) ) :
			echo $current_before . $query_obj->post_title . $current_after;
		endif;

		if ( is_category() ) :
			$cat_id = $query_obj->term_id;
			$current_cat = get_cat_name( $cat_id );
			$parent_cat = $query_obj->parent;
			if ( $parent_cat != 0 ) :
				$ancient_cats = get_ancestors( $cat_id, 'category' );
				foreach ( array_reverse( $ancient_cats ) as $cat ) :
					echo '<li><a href="'. get_category_link( $cat ) .'">' . get_cat_name( $cat ) . '</a></li>';
				endforeach;
			endif;
			echo $current_before . $current_cat . $current_after;
		endif;
		if ( is_tag() ) :
			$tag_id = $query_obj->term_id;
			$taxonomy = $query_obj->taxonomy;
			$current_tag = get_term( $tag_id, $taxonomy );
			echo $current_before . $current_tag->name . $current_after;
		endif;
		if ( is_tax() ) :
			echo $current_before . $query_obj->name . $current_after;
		endif;
		if ( is_post_type_archive() ) :
			echo $current_before . $query_obj->label . $current_after;
		endif;

		if ( is_day() ) :
			echo $year_link . $month_link . $current_before . get_the_time( 'd' ) . $current_after;
		endif;
		if ( is_month() ) :
			echo $year_link . $current_before . get_the_time( 'F' ) . $current_after;
		endif;
		if ( is_year() ) :
			echo $current_before . get_the_time( 'Y' ) . $current_after;
		endif;

		if ( is_author() ) :
			$author_name = $query_obj->display_name;
			echo $current_before . $author_name . $current_after;
		endif;

		if ( is_search() ) :
			echo $current_before . sprintf( __( 'Search: %s', 't_em' ), get_search_query() ) . $current_after;
		endif;
		if ( is_404() ) :
			echo $current_before . __( 'Error 404', 't_em' ) . $current_after;
		endif;

		// Also works for page's attachments
		if ( is_page() && ! ( is_home() || is_front_page() ) ) :
			if ( $post->post_parent != 0 ) :
				$parent_id = $post->post_parent;
				$breadcrumb_page = array();
				while ( $parent_id ) :
					$parent_page = get_page( $parent_id );
					$breadcrumb_page[] = '<li><a href="'. get_permalink( $parent_page->ID ) .'">'. get_the_title( $parent_page->ID ) .'</a></li>';
					$parent_id = $parent_page->post_parent;
				endwhile;
				foreach ( array_reverse( $breadcrumb_page ) as $crumb_page ) :
					echo $crumb_page;
				endforeach;
			endif;
			echo $current_before . get_the_title() . $current_after;
		endif;

		if ( is_single() && ! is_attachment() ) :
			if ( $post->post_type == 'post' ) :
				$post_cat = get_the_category();
				foreach ( $post_cat as $cat ) :
					echo '<li><a href="'. get_category_link( $cat->term_id ) .'">'. $cat->cat_name .'</a></li>';
				endforeach;
				echo $current_before . get_the_title() . $current_after;
			elseif ( ! in_array( $post->post_type, array( 'post', 'page', 'attachment', 'revision', 'nav_menu_item' ) ) ) :
				if ( is_post_type_hierarchical( get_post_type() ) ) :
					echo '<li><a href="'. get_post_type_archive_link( get_post_type() ) .'">'. $post_type_obj->label .'</a></li>';
					$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
					foreach ( $ancestors as $ancestor ) :
						echo '<li><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>';
					endforeach;
					echo $post_type_archive_link . $current_before . get_the_title() . $current_after;
				else :
					echo $post_type_archive_link . $current_before . get_the_title() . $current_after;
				endif;
			endif;
		endif;

		// We manage page's attachment two if() statements above
		if ( is_attachment() && ! is_page() ) :
			$parent_cat = ( get_post_type( $post->post_parent ) == 'post' ) ? get_the_category( $post->post_parent ) : null;
			if ( $parent_cat ) :
				$attachtment_post_parent_link = '<li>' . get_category_parents( $parent_cat[0], true, '' ) . '</li>' . $attachment_parent_link;
			elseif ( ! in_array( get_post_type( $post->post_parent ), array( 'post', 'page', 'attachment', 'revision', 'nav_menu_item' ) ) ) :
				$attachtment_post_parent_link = $attachment_post_type_parent_link;
			else :
				$attachtment_post_parent_link = null;
			endif;
			echo $attachtment_post_parent_link . $current_before . get_the_title() . $current_after;
		endif;

		if ( get_query_var( 'paged' ) > '1' ) :
			echo $current_before . sprintf( __( 'Page %s', 't_em' ), get_query_var( 'paged' ) ) . $current_after;
		endif;
?>
			</lo><!-- .breadcrumb -->
		</div><!-- #you-are-here -->
<?php
	endif;
}
endif; // function t_em_breadcrumb()
add_action( 't_em_action_content_before', 't_em_breadcrumb', 5 );

if ( ! function_exists( 't_em_javascript_required' ) ) :
/**
 * Pluggable Function: Javascript required. This function is attached to the t_em_action_top() action hook
 */
function t_em_javascript_required(){
?>
<!--[if lte IE 8 ]>
<noscript><strong><?php _e( 'JavaScript is required for this website to be displayed correctly.<br /> Please enable JavaScript before continuing...', 't_em' ); ?></strong></noscript>
<![endif]-->
<?php
}
endif; // function t_em_javascript_required()
add_action( 't_em_action_top', 't_em_javascript_required' );

if ( ! function_exists( 't_em_heading_site_title' ) ) :
/**
 * Pluggable Function: Heading Site Title.
 * This function is attached to the t_em_action_header_inside_left() action hook.
 */
function t_em_heading_site_title(){
?>
	<hgroup>
		<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'h2'; ?>
		<<?php echo $heading_tag; ?> id="site-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</<?php echo $heading_tag; ?>>
		<h3 id="site-description"><?php bloginfo( 'description' ); ?></h3>
	</hgroup>
<?php
}
endif; // function t_em_heading_site_title()
add_action( 't_em_action_header_inside_left', 't_em_heading_site_title' );

if ( ! function_exists( 't_em_top_menu' ) ) :
/**
 * Pluggable Function: Top menu.
 * This function is attached to the t_em_action_header_before() action hook
 */
function t_em_top_menu(){
if ( has_nav_menu( 'top-menu' ) ) :
?>
	<div id="top-menu" role="navigation">
		<div class="wrapper container">
			<nav class="navbar">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-top-menu">
						<span class="sr-only"><?php _e( 'Toggle Navigation', 't_em' ) ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-brand visible-xs-block"><?php _e( 'Site Navigation', 't_em' ) ?></div>
				</div><!-- .navbar-header -->
				<?php wp_nav_menu( array(
							/**
							 * Filter the menu depth
							 *
							 * @param int How many levels of the hierarchy are to be included where 0 means all. -1 displays links at any depth and arranges them in a single, flat list.
							 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
							 * @since Twenty'em 1.0
							 */
							'theme_location'	=> 'top-menu',
							'container_id'		=> 'site-top-menu',
							'container_class'	=> 'collapse navbar-collapse navbar-right',
							'menu_class'		=> 'nav navbar-nav menu',
							'depth'				=> apply_filters( 't_em_filter_top_menu_depth', 0 ),
						)
					);
				?>
			</nav>
		</div>
	</div>
<?php
endif;
}
endif; // function t_em_top_menu()
add_action( 't_em_action_header_before', 't_em_top_menu' );

if ( ! function_exists( 't_em_navigation_menu' ) ) :
/**
 * Pluggable Function: Navigation Menu.
 * This function is attached to the t_em_action_header_after action hook
 */
function t_em_navigation_menu(){
if ( has_nav_menu( 'navigation-menu' ) ) : ?>
	<div id="site-navigation" role="navigation">
		<div class="wrapper container">
			<nav class="navbar">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navigation-menu">
						<span class="sr-only"><?php _e( 'Toggle Navigation', 't_em' ) ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-brand visible-xs-block"><?php _e( 'Site Navigation', 't_em' ) ?></div>
				</div><!-- .navbar-header -->
				<?php wp_nav_menu( array(
							/**
							 * Filter the menu depth
							 *
							 * @param int How many levels of the hierarchy are to be included where 0 means all. -1 displays links at any depth and arranges them in a single, flat list.
							 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
							 * @since Twenty'em 1.0
							 */
							'theme_location'	=> 'navigation-menu',
							'container_id'		=> 'site-navigation-menu',
							'container_class'	=> 'collapse navbar-collapse',
							'menu_class'		=> 'nav navbar-nav menu',
							'depth'				=> apply_filters( 't_em_filter_navigation_menu_depth', 0 ),
						)
					);
				?>
			</nav>
		</div>
	</div>
<?php
endif;
}
endif; // function t_em_navigation_menu()
add_action( 't_em_action_header_after', 't_em_navigation_menu' );

if ( ! function_exists( 't_em_footer_menu' ) ) :
/**
 * Pluggable Function: The Footer Menu, if it's active by the user we display it, else, we get nothing
 * This function is attached to the t_em_action_site_info_right() action hook
 */
function t_em_footer_menu(){
if ( has_nav_menu( 'footer-menu' ) ) :
	wp_nav_menu( array(
			/**
			 * Filter the menu depth
			 *
			 * @param int How many levels of the hierarchy are to be included where 0 means all. -1 displays links at any depth and arranges them in a single, flat list.
			 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
			 * @since Twenty'em 1.0
			 */
			'theme_location'	=> 'footer-menu',
			'container'			=> 'nav',
			'container_id'		=> 'footer-menu',
			'container_class'	=> '',
			'menu_class'		=> 'list-inline text-right menu',
			'depth'				=> apply_filters( 't_em_filter_footer_menu_depth', 1 ),
		)
	);
endif;
}
endif; // function t_em_footer_menu()
add_action( 't_em_action_site_info_right', 't_em_footer_menu', 15 );

if ( ! function_exists( 't_em_single_navigation' ) ) :
/**
 * Pluggable Function: Single post navigation.
 * This function is attached to the t_em_action_post_after action hook.
 */
function t_em_single_navigation(){
	if ( is_single() ) :
?>
	<nav id="single-navigation" class="navi" role="navigation">
		<ul>
			<li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav icomoon-double-angle-left icomoon"></span> %title' ); ?></li>
			<li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav icomoon-double-angle-right icomoon"></span>' ); ?></li>
		</ul>
	</nav><!-- #nav-above -->
<?php
	endif;
}
endif; // function t_em_single_navigation()
add_action( 't_em_action_post_after', 't_em_single_navigation', 5 );

if ( ! function_exists( 't_em_comments_pagination' ) ) :
/**
 * Pluggable Function: Comments navigation.
 * This function is attached to the t_em_action_comments_list_before and t_em_action_comments_list_after action hooks
 */
function t_em_comments_pagination(){
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
	<nav id="comments-navigation" class="navi" role="navigation">
		<ul>
			<li class="previous"><?php previous_comments_link( __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Older Comments', 't_em' ) ); ?></li>
			<li class="next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ) ); ?></li>
		</ul>
	</nav>
<?php
endif;
}
endif; // function t_em_comments_pagination()
add_action( 't_em_action_comments_list_before', 't_em_comments_pagination' );
add_action( 't_em_action_comments_list_after', 't_em_comments_pagination' );

if ( ! function_exists( 't_em_copy_right' ) ) :
/**
 * Pluggable Function: Copy Right.
 * This function is attached to the t_em_action_site_info action hook.
 */
function t_em_copy_right(){
?>
	<div id="copyright">
		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
	</div><!-- #copyright -->
<?php
}
endif; // function t_em_copy_right()
add_action( 't_em_action_site_info_left', 't_em_copy_right' );

/**
 * Display WordPress.org and Twenty'em.com link at bottom of the page. This function is attached to
 * the t_em_action_site_info action hook.
 */
function t_em_dot_com_link(){
	global $t_em, $t_em_theme_data;
	if ( '1' == $t_em['t_em_link'] ) :
?>
	<div id="twenty-em-credit">
<?php
	printf( __( 'Proudly powered by: <a href="%1$s" title="%2$s">%3$s</a> and <a href="%4$s" title="%5$s">%6$s</a>. Theme Name: <a href="%7$s" title="Version %8$s">%9$s</a> by: %10$s', 't_em' ),
		'http://wordpress.org/',
		'State-of-the-art semantic personal publishing platform.',
		'WordPress',
		T_EM_SITE,
		'Theming is Prose',
		T_EM_FRAMEWORK_NAME,
		$t_em_theme_data['ThemeURI'],
		$t_em_theme_data['Version'],
		$t_em_theme_data['Name'],
		$t_em_theme_data['Author']
	);
?>
	</div>
<?php
	endif;
}
add_action( 't_em_action_site_info_bottom', 't_em_dot_com_link' );

/**
 * Render some Theme and Framework Data as meta description.
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_metadata(){
	global $t_em_theme_data;
	printf( __( '<!-- This site uses %1$s WordPress theme/framework v%2$s %3$s - %4$s -->', 't_em' ),
				T_EM_FRAMEWORK_NAME,
				T_EM_FRAMEWORK_VERSION,
				T_EM_FRAMEWORK_VERSION_STATUS,
				T_EM_SITE ); echo "\n";
	echo '<meta name="framework-name" content="' . T_EM_FRAMEWORK_NAME . '">' . "\n";
	echo '<meta name="framework-version" content="' . T_EM_FRAMEWORK_VERSION . ' ' . T_EM_FRAMEWORK_VERSION_STATUS . '">' . "\n";
	echo '<meta name="theme-name" content="' . $t_em_theme_data['Name'] . '">' . "\n";
	echo '<meta name="theme-version" content="' . $t_em_theme_data['Version'] . '">' . "\n";
	echo '<meta name="theme-uri" content="' . $t_em_theme_data['ThemeURI'] . '">' . "\n";
	echo '<meta name="theme-author" content="' . strip_tags( $t_em_theme_data['Author'] ) . '">' . "\n";
	echo '<meta name="theme-description" content="' . $t_em_theme_data['Description'] . '">' . "\n";
	echo '<meta name="theme-tags" content="' . $t_em_theme_data['Tags'] . '">' . "\n";
	printf( __( '<!-- / %1$s WordPress theme/framework -->', 't_em' ), T_EM_FRAMEWORK_NAME ); echo "\n";
}
add_action( 'wp_head', 't_em_theme_metadata' );

/**
 * Webmasters Tools and Tracking Codes
 */
function t_em_stats_header_tracker(){
	global $t_em;
	// Google Engine ID
	if ( $t_em['google_id'] )
		echo '<meta name="google-site-verification" content="' . $t_em['google_id'] . '" />' . "\n";
	// Bing Engine ID
	if ( $t_em['bing_id'] )
		echo '<meta name="msvalidate.01" content="' . $t_em['bing_id'] . '" />' . "\n";
	// Pinterest Engine ID
	if ( $t_em['pinterest_id'] )
		echo '<meta name="p:domain_verify" content="' . $t_em['pinterest_id'] . '" />' . "\n";
	// Header Stats Tracker
	if ( $t_em['stats_tracker_header_tag'] )
		echo '<script type="text/javascript">' . $t_em['stats_tracker_header_tag'] . '</script>' . "\n";
}
add_action( 'wp_head', 't_em_stats_header_tracker' );

function t_em_stats_body_tracker(){
	global $t_em;
	// Body Stats Tracker
	if ( $t_em['stats_tracker_body_tag'] )
		echo '<script type="text/javascript">' . $t_em['stats_tracker_body_tag'] . '</script>' . "\n";
}
add_action( 'wp_footer', 't_em_stats_body_tracker' );

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
