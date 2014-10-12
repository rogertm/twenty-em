<?php
/**
 * WARNING: Do not edit this lines.
 * Load the theme engine files
 */
require_once( get_template_directory() . '/inc/constants.php' );
require_once( get_template_directory() . '/inc/theme-options.php' );

/** That's all. Start editing here. Happy Theming! */

?>
<?php
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
 * custom background, custom header and JetPack Infinite Scroll.
 * All this functions are treat as pluggable, so they can be override in Child Themes.
 *
 * @link http://codex.wordpress.org/Theme_Features Visit for full documentation about Theme Features
 *
 * @return void
 *
 * @since Twenty'em 0.1
 */
function t_em_setup(){

	// Adds support featured image (pluggable function).
	t_em_support_post_thumbnails();

	// Adds RSS feed links to <head> for posts and comments (pluggable function).
	t_em_support_automatic_feed_links();

	// Adds support for variety of post formats.
	t_em_support_post_formats();

	// This theme styles the visual editor with editor-style.css to match the theme style (pluggable function).
	t_em_support_add_editor_style();

	// Adds support for custom background (pluggable function).
	t_em_support_custom_background();

	// Adds support for custom header text (pluggable function).
	t_em_support_custom_header();

	// Adds support for custom header image (pluggable function).
	t_em_support_custom_header_image();

	// This theme also support JetPack Infinite Scroll (pluggable function).
	t_em_support_jp_infinite_scroll();

	// This theme uses navigation menus in three locations (pluggable function).
	t_em_register_nav_menus();

	/* Make Twenty'em available for translation.
	 * Translations can be added to the lang/ directory.
	 * If you're building a theme based on Twenty'em, use a find and replace to change 't_em'
	 * to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 't_em', T_EM_THEME_DIR_LANG_PATH );
	$locale = get_locale();
	$locale_file = T_EM_THEME_DIR_LANG_PATH . "/$locale.php";
	if ( is_readable( $locale_file ) ) :
		require_once( $locale_file );
	endif;

}
add_action( 'after_setup_theme', 't_em_setup' );

if ( ! function_exists( 't_em_support_post_thumbnails' ) ) :
/**
 * Pluggable Function: Adds theme support for post thumbnails
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 1.0
 */
function t_em_support_post_thumbnails(){
	add_theme_support( 'post-thumbnails' );
}
endif; // function t_em_support_post_thumbnails()

if ( ! function_exists( 't_em_support_automatic_feed_links' ) ) :
/**
 * Pluggable Function: Adds RSS feed links to <head> for posts and comments.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 1.0
 */
function t_em_support_automatic_feed_links(){
	add_theme_support( 'automatic-feed-links' );
}
endif; // function t_em_support_automatic_feed_links()

if ( ! function_exists( 't_em_support_post_formats' ) ) :
/**
 * Pluggable Function: Adds support for variety of post formats.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 1.0
 */
function t_em_support_post_formats(){
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'audio' ) );
}
endif; // function t_em_support_post_formats()

if ( ! function_exists( 't_em_support_add_editor_style' ) ) :
/**
 * Pluggable Function: This theme styles the visual editor with editor-style.css to match the theme
 * style.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 1.0
 */
function t_em_support_add_editor_style(){
	add_editor_style( 'css/editor-style.css' );
}
endif; // function t_em_support_add_editor_style()

if ( ! function_exists( 't_em_support_custom_background' ) ) :
/**
 * Pluggable Function: Adds theme support for custom background.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_background(){
	$args = array ( 'default-color' => 'fff' );
	add_theme_support( 'custom-background', $args );
}
endif; // function t_em_support_custom_background()

if ( ! function_exists( 't_em_support_custom_header' ) ) :
/**
 * Pluggable Function: Adds theme support for custom header image
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_header(){
	$custom_header_support = array (
		'default-text-color'		=> '333',
		'width'						=> apply_filters( 't_em_header_image_width', T_EM_HEADER_IMAGE_WIDTH ),
		'height'					=> apply_filters( 't_em_header_image_height', T_EM_HEADER_IMAGE_HEIGHT ),
		'flex-width'				=> true,
		'flex-height'				=> true,
		'random-default'			=> true,
		'uploads'					=> true,
		'wp-head-callback'			=> 't_em_header_style',
		'admin-head-callback'		=> 't_em_admin_header_style',
		'admin-preview-callback'	=> 't_em_admin_header_image',
	);
	add_theme_support( 'custom-header', $custom_header_support );
}
endif; // function t_em_support_custom_header()

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
		font-size: 64px;
		margin-bottom: 10px;
		margin-top: 20px;
		font-weight: 500;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		font-size: 24px;
		font-style: italic;
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

if ( ! function_exists( 't_em_support_custom_header_image' ) ) :
/**
 * Pluggable Function:  Default custom headers packaged with the theme.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_header_image(){
	register_default_headers( array(
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
		'grass'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/grass.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/grass-thumbnail.png',
			'description'	=> _x( 'Grass', 'header image description', 't_em' ),
		),
		'lime'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/lime.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/lime-thumbnail.png',
			'description'	=> _x( 'Lime', 'header image description', 't_em' ),
		),
		'ocean'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/ocean.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/ocean-thumbnail.png',
			'description'	=> _x( 'Ocean', 'header image description', 't_em' ),
		),
		'purple'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG_URL . '/headers/purple.png',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG_URL . '/headers/purple-thumbnail.png',
			'description'	=> _x( 'Purple', 'header image description', 't_em' ),
		),
	) );
}
endif; // function t_em_support_custom_header_image()

if ( ! function_exists( 't_em_register_nav_menus' ) ) :
/**
 * Pluggable Function: This theme uses navigation menus in three locations. Woew!
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 1.0
 */
function t_em_register_nav_menus(){
	register_nav_menus ( array (
		'top-menu'			=> __('Top Menu', 't_em'),
		'navigation-menu'	=> __('Navigation Menu', 't_em'),
		'footer-menu'		=> __('Footer Menu', 't_em'),
		)
	);
}
endif; // function t_em_register_nav_menus()

if ( ! function_exists( 't_em_support_jp_infinite_scroll' ) ) :
/**
 * Pluggable Function: Adds theme support for JetPack Infinite Scroll
 *
 * @link http://jetpack.me/support/infinite-scroll/
 *
 * @since Twenty'em 0.1
 */
function t_em_support_jp_infinite_scroll(){
	$jp_infinite_scroll = array(
		'container'			=> 'content',
		'footer'			=> 'footer',
		'type'				=> 'click',
		'footer_widgets'	=> true,
	);
	add_theme_support( 'infinite-scroll', $jp_infinite_scroll );
}
endif; // function t_em_support_jp_infinite_scroll()

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
	$content_width = 640;
endif;

if ( ! function_exists( 't_em_favicon' ) ) :
/**
 * Pluggable Function: Add favicon to our site, admin dashboard included
 * this function is attached to t_em_action_head() and admin_head() action hooks
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
add_action( 't_em_action_head', 't_em_favicon' );
add_action( 'admin_head', 't_em_favicon' );

if ( ! function_exists( 't_em_site_title' ) ) :
/**
 * Pluggable Function: Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string Filtered title.
 *
 * @since Twenty'em 0.1
 */
function t_em_site_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 't_em' ), max( $paged, $page ) );

	return $title;
}
endif; // function t_em_site_title()
add_filter( 'wp_title', 't_em_site_title', 10, 2 );

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
	return ' &hellip;' . t_em_continue_reading_link();
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
			array ('three-column-content-left', 'three-column-content-right', 'three-column-content-middle' )
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
			array ( 'two-footer-widget', 'three-footer-widget', 'four-footer-widget' )
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
			array ( 'three-footer-widget', 'four-footer-widget' )
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
			array ( 'four-footer-widget' )
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

if ( ! function_exists( 't_em_get_avatar' ) ) :
/**
 * Pluggable Function: Retrieve the custom avatar for a user if is enable custom avatar option in
 * 'General Options' in admin panel and provided in the WordPress profile page. If not the default
 * avatar from gravatar.com will be displayed.
 *
 * @param int $user_id Required User ID
 * @param int|string|object Required $id_or_email A user ID,  email address, or comment object
 * @param int $size Size of the avatar image
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternative text to use in image tag. Defaults to blank
 *
 * @return string <img> tag for the user's avatar
 *
 * @since Twenty'em 1.0
 */
function t_em_get_avatar( $id_or_email, $size = '96', $default = '', $alt = false ){
	global $t_em;
	if ( '1' == $t_em['custom_avatar'] ) :
		if ( is_numeric( $id_or_email ) ) :
			$user = get_user_by( 'id', $id_or_email );
		else :
			$user = get_user_by( 'email', $id_or_email );
		endif;
		$custom_avatar_url = get_user_meta( $user->ID, 'custom_avatar_url', true );

		if ( $custom_avatar_url ) :
?>
		<img src="<?php echo $custom_avatar_url ?>" class="avatar" alt="<?php echo $alt; ?>" width="<?php echo $size; ?>" height="<?php echo $size; ?>">
<?php
		else :
			echo get_avatar( $id_or_email, $size, $default = '', $alt );
		endif;
	else :
		echo get_avatar( $id_or_email, $size, $default = '', $alt );
	endif;
}
endif; // function t_em_get_avatar()

if ( ! function_exists( 't_em_author_meta' ) ) :
/**
 * Pluggable Function: If a user has filled out their description, show a bio on their entries.
 *
 * @since Twenty'em 1.0
 */
function t_em_author_meta(){
	if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
	<div id="author-info-<?php echo get_the_author_meta( 'user_login' ); ?>" class="author-info author-archive media">
		<?php echo t_em_get_avatar( get_the_author_meta( 'ID' ), '', '', get_the_author() ); ?>
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
			<h1 class="page-header author"><?php printf( __( 'Author Archives: %s', 't_em' ), "<span><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
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
	endif;
	if ( ! empty( $term_description ) ) :
		echo '<div id="term-description-'. $term_id->term_id .'" class="archive-meta term-description">' . $term_description . '</div>';
	endif;
}
endif; // function t_em_term_description()

if ( ! function_exists( 't_em_header_archive_category' ) ) :
/**
 * Pluggable Function: Display Category header tag and description in category archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_category(){
	if ( is_category() ) :
		/* Queue the first post, that way we know if category is not empty
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) : the_post();
		$category_id = get_term_by( 'name', single_tag_title( '', false ), 'category' ); ?>
	<div id="featured-header-category-<?php echo $category_id->term_id; ?>" class="featured-header featured-header-category">
		<header>
			<h1 class="page-header">
				<?php printf( __( 'Category Archives: %s', 't_em' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			</h1>
		</header>
<?php 	t_em_term_description();
		/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */ ?>
	</div><!-- .featured-header -->
<?php
		rewind_posts(); endif;
	endif;
}
endif; // function t_em_header_archive_category()
add_action( 't_em_action_content_before', 't_em_header_archive_category', 15 );

if ( ! function_exists( 't_em_header_archive_tag' ) ) :
/**
 * Pluggable Function: Display Tag header tag and description in tag archives.
 * This function is attached to the t_em_action_content_before action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_header_archive_tag(){
	if ( is_tag() ) :
		/* Queue the first post, that way we know if category is not empty
		 * We reset this later so we can run the loop properly with a call to rewind_posts().
		 */
		if ( have_posts() ) : the_post();
		$tag_id = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' ); ?>
	<div id="featured-header-tag-<?php echo $tag_id->term_id ?>" class="featured-header featured-header-tag">
		<header>
			<h1 class="page-header">
				<?php printf( __( 'Tag Archives: %s', 't_em' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
			</h1>
		</header>
<?php 	t_em_term_description();
		/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */ ?>
	</div><!-- .featured-header -->
<?php
		rewind_posts(); endif;
	endif;
}
endif; // function t_em_header_archive_tag()
add_action( 't_em_action_content_before', 't_em_header_archive_tag', 15 );

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
				<?php printf( __( 'Archives for: %1$s', 't_em' ), '<span>' . $post_type_name . '</span>' ); ?>
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
				$date_archive = sprintf( __( 'Daily Archives: <span>%s</span>', 't_em' ), get_the_date() );
				$archive_id = 'daily';
			elseif ( is_month() ) :
				$date_archive = sprintf( __( 'Monthly Archives: <span>%s</span>', 't_em' ), get_the_date('F Y') );
				$archive_id = 'monthly';
			elseif ( is_year() ) :
				$date_archive = sprintf( __( 'Yearly Archives: <span>%s</span>', 't_em' ), get_the_date('Y') );
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
				<h1 class="page-header"><?php printf( __( 'Search Results for: %s', 't_em' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
			<div class="pull-left media-object"><?php echo get_avatar( $comment, '', '', get_comment_author() ); ?></div>
			<div class="media-body">
				<header class="comment-header media-heading">
					<div class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%1$s <span class="says">says:</span></cite>', 't_em' ), get_comment_author_link() ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 't_em' ); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 't_em' ), get_comment_date(),  get_comment_time() ); ?></a> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
					</div><!-- .comment-meta .commentmetadata -->
				</header><!-- comment-heading -->
				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .media-body -->
		</div><!-- #comment-## .comment-wrap -->
	</li>
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
function t_em_comment_pingback_trackback( $comment ) {
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
		<div class="comment-body"><?php comment_text(); ?></div></li>
	<?php
			break;
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php _e( 'Trackback:', 't_em' ); ?> <?php comment_author_link(); ?> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
		<div class="comment-body"><?php comment_text(); ?></div></li>
	<?php
			break;
		default :
		global $post;
	?>
	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="pull-left media-object"><?php echo get_avatar( $comment, '', '', get_comment_author() ); ?></div>
			<div class="media-body">
				<header class="comment-header media-heading">
					<div class="comment-author vcard">
						<?php printf( __( '<cite class="fn">%1$s</cite> <span class="says">says:</span>', 't_em' ), get_comment_author_link() ); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 't_em' ); ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 't_em' ), get_comment_date(),  get_comment_time() ); ?></a> <small><?php edit_comment_link( __('Edit', 't_em'), '<span class="icomoon-edit icomoon"></span>' ); ?></small>
					</div><!-- .comment-meta .commentmetadata -->
				</header><!-- comment-heading -->
				<div class="comment-body"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- .media-body -->
		</div><!-- #comment-## .comment-wrap -->
	</li>
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
	<nav id="site-navigation" class="site-pagination navi">
		<ul>
			<li class="previous"><?php next_posts_link( __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Older posts', 't_em' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ) ); ?></li>
		</ul>
	</nav>
<?php
		elseif ( 'page-navi' == $t_em['archive_pagination_set'] ) :
?>
	<nav id="site-navigation" class="site-pagination pagi">
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
				'base'		=> $pagenum_link,
				'format'	=> $format,
				'total'		=> $wp_query->max_num_pages,
				'current'	=> $paged,
				'end_size'	=> 1,
				'mid_size'	=> 2,
				'type'		=> 'list',
				'add_args'	=> array_map( 'urlencode', $query_args ),
				'prev_text'	=> __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Newer posts', 't_em' ),
				'next_text'	=> __( 'Older posts <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ),
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
 * Customize theme comments fields with HTML5 form elements. Adds support for
 * placeholder, required, type="email" and type="url".
 *
 * @since Twenty'em 0.1
 */
function t_em_comment_form_fields() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ( $req ? " aria-required='true' " : "" );
	$fields =  array(
		'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 't_em' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
					'<input id="author" class="input-xlarge" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder = "'. __( 'What can we call you?', 't_em' ) .'"' . ( $req ? ' required' : '' ) . '/></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 't_em' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
					'<input id="email" class="input-xlarge" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="'. __( 'How can we reach you?', 't_em' ) .'"' . ( $req ? ' required' : '' ) . ' /></p>',
		'url'	 => '<p class="comment-form-url"><label for="url">' . __( 'Website', 't_em' ) . '</label>' .
					'<input id="url" class="input-xlarge" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'. __( 'Have you got a website?', 't_em' ) .'" /><p>'
	);
	return $fields;
}
add_filter('comment_form_default_fields', 't_em_comment_form_fields');

/**
 * Customize theme comments textarea with HTML5 form elements. Adds support for placeholder
 * and aria required.
 *
 * @since Twenty'em 0.1
 */
function t_em_comment_form_textarea() {
	$comment_area = '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 't_em' ) . '</label>' .
					'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="'. __( 'What&#8217;s on your mind?', 't_em' ) .'"></textarea>';
	return $comment_area;
}
add_filter('comment_form_field_comment', 't_em_comment_form_textarea');

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return string HTML content describing embedded figure
 *
 * @since Twenty'em 0.1
 **/
function t_em_img_caption_shortcode($val, $attr, $content = null) {
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $val;

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
	. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid
	. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
add_filter('img_caption_shortcode', 't_em_img_caption_shortcode', 10, 3);

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
				<img alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo esc_attr__( get_the_title( $post_id ) ); ?>"/>
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
					<img alt="<?php echo get_the_title( $post_id ); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo esc_attr__( get_the_title( $post_id ) ); ?>"/>
					<figcaption><?php echo get_the_title( $post_id ); ?></figcaption>
				</figure>
			<?php
			echo $close_link;
		endif;
	endif;
}
endif; // function t_em_featured_post_thumbnail()

if ( ! function_exists( 't_em_header_options_set' ) ) :
/**
 * Pluggable Function: Display header set depending of the activated "Header Options" in admin theme
 * option page. This function is attached to the t_em_action_header_after action hook.
 *
 * @global $t_em
 *
 * @uses t_em_header_image()
 * @uses t_em_slider_bootstrap_carousel()
 * @uses t_em_slider_nivo_slider()
 * @uses t_em_static_header()
 *
 * @since Twenty'em 0.1
 */
function t_em_header_options_set(){
	global $t_em;

	if ( 'no-header-image' == $t_em['header_set'] ) :
		return;
	elseif ( 'header-image' == $t_em['header_set'] ) :
		t_em_header_image();
	elseif ( ( 'slider' == $t_em['header_set'] )
		&& ( ( '1' == $t_em['slider_home_only'] && is_home() )
		|| ( '0' == $t_em['slider_home_only'] ) ) ) :
			if ( 'slider-bootstrap-carousel' == $t_em['slider_script'] ) :
				t_em_slider_bootstrap_carousel( t_em_slider_query_args() );
			elseif ( 'slider-nivo-slider' == $t_em['slider_script'] ) :
				t_em_slider_nivo_slider( t_em_slider_query_args() );
			endif;
	elseif ( ( 'static-header' == $t_em['header_set'] )
		&& ( ( '1' == $t_em['static_header_home_only'] && is_home() )
		|| ( '0' == $t_em['static_header_home_only'] ) ) ) :
			t_em_static_header();
	endif;
}
endif; // function t_em_header_options_set()
add_action( 't_em_action_header_after', 't_em_header_options_set', 5 );

if ( ! function_exists( 't_em_header_image' ) ) :
/**
 * Pluggable Function: Display header image if it's set by the user in 'Header Options' admin panel
 */
function t_em_header_image(){
	global $post, $t_em;
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
}
endif; // function t_em_header_image()

if ( ! function_exists( 't_em_slider_bootstrap_carousel' ) ) :
/**
 * Pluggable Function: Display Bootstrap carousel of featured posts if it's set by the user in
 * 'Header Options > Slider' admin panel
 *
 * @param $args array Query arguments
 */
function t_em_slider_bootstrap_carousel( $args ){
	global	$post, $t_em;
	$slider_posts = get_posts( $args );
	$slider_wrap = ( $t_em['bootstrap_carousel_wrap'] == '1' ) ? 'false' : 'true';
	$slider_pause = ( $t_em['bootstrap_carousel_pause'] == '1' ) ? 'hover' : 'null';
?>
	<section id="header-carousel">
		<div id="slider-carousel" data-ride="carousel" data-wrap="<?php echo $slider_wrap; ?>" data-pause="<?php echo $slider_pause; ?>" data-interval="<?php echo $t_em['bootstrap_carousel_interval'] ?>" class="wrapper container carousel slide <?php echo $t_em['slider_text'] ?>">
<?php 	if ( $slider_posts ) : ?>
<?php 		$tp = count( $slider_posts ) ?>
			<ol class="carousel-indicators">
		<?php $s = 0; while ( $s < $tp ) : ?>
				<li data-target="#slider-carousel" data-slide-to="<?php echo $s ?>"></li>
		<?php $s++; endwhile; ?>
			</ol><!-- .carousel-indicators -->
			<div class="carousel-inner">
<?php 		foreach ( $slider_posts as $post ) : setup_postdata( $post );
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
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$t_em['layout_width'].'&amp;h='.$t_em['slider_height'].'&amp;src='. $image_src ?>" />
					</a>
					<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="carousel-caption">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a>
						</h3>
						<div class="entry-summary hidden-xs hidden-sm"><?php echo get_the_excerpt(); ?></div>
					</div>
				</div><!-- .item -->
<?php 		endforeach; wp_reset_postdata(); ?>
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
}
endif; // function t_em_slider_bootstrap_carousel()

if ( ! function_exists( 't_em_slider_nivo_slider' ) ) :
/**
 * Pluggable Function: Display Nivo Slider carousel of featured posts if it's set by the user in
 * 'Header Options > Slider' admin panel
 *
 * @param $args array Query arguments
 */
function t_em_slider_nivo_slider( $args ){
	global $post, $t_em;
	$slider_posts = get_posts( $args );
?>
	<section id="header-carousel">
		<div id="nivo-slider" class="wrapper container">
			<div class="slider-wrapper theme-<?php echo $t_em['nivo_style']; ?> wrapper row">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
<?php		foreach ( $slider_posts as $post ) : setup_postdata( $post );
				// Display the thumbnails
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
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR_URL .'/timthumb.php?zc=1&amp;w='.$t_em['layout_width'].'&amp;h='.$t_em['slider_height'].'&amp;src='. $image_src ?>" title="#<?php echo $post->post_name ?>-<?php echo $post->ID; ?>"/>
					</a>
<?php		endforeach; wp_reset_postdata(); ?>
				</div><!-- #slider .nivoSlider -->
<?php		foreach ( $slider_posts as $post ) : setup_postdata( $post ); ?>
				<div id="<?php echo $post->post_name ?>-<?php echo $post->ID; ?>" class="nivo-html-caption nivo-post">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a>
					</h2>
					<div class="entry-summary hidden-xs hidden-sm"><?php echo get_the_excerpt(); ?></div>
				</div>
<?php		endforeach; wp_reset_postdata(); ?>
			</div><!-- .slider-wrapper .theme-$theme -->
		</div><!-- #nivo-slider -->
	</section>
<?php
}
endif; // function t_em_slider_nivo_slider()

if ( ! function_exists( 't_em_static_header' ) ) :
/**
 * Pluggable Function: Display Static Header if it's set by the user in
 * 'Header Options > Static Header' admin panel
 */
function t_em_static_header(){
	global $t_em;
?>
	<section id="static-header" role="info">
		<div id="static-header-inner" class="wrapper container">
<?php if ( ! empty ( $t_em['static_header_img_src'] ) ) : ?>
		<div id="static-header-image" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
			<figure>
				<img src="<?php echo esc_url( $t_em['static_header_img_src'] ); ?>"
					alt="<?php echo $t_em['static_header_headline']; ?>"
					title="<?php echo $t_em['static_header_headline']; ?>">
			</figure>
		</div><!-- #static-header-image -->
<?php endif; ?>

<?php if ( $t_em['static_header_headline']
		|| $t_em['static_header_content']
		|| ( $t_em['static_header_primary_button_text'] && $t_em['static_header_primary_button_link'] )
		|| ( $t_em['static_header_secondary_button_text'] && $t_em['static_header_secondary_button_link'] )
	) : ?>
		<div id="static-header-text" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
<?php if ( $t_em['static_header_headline'] ) : ?>
			<header><h2><?php echo $t_em['static_header_headline']; ?></h2></header>
<?php endif; ?>
<?php if ( $t_em['static_header_content'] ) : ?>
			<div class="static-header-content"><?php echo t_em_wrap_paragraph( html_entity_decode( $t_em['static_header_content'] ) ); ?></div>
<?php endif; ?>
			<footer class="actions">
<?php if ( ( $t_em['static_header_primary_button_text'] && $t_em['static_header_primary_button_link'] ) ) : ?>
				<a href="<?php echo esc_url( $t_em['static_header_primary_button_link'] ); ?>"
					title="<?php echo esc_attr( $t_em['static_header_primary_button_text'] ); ?>"
					class="btn primary-button">
						<span class="<?php echo esc_attr( $t_em['static_header_primary_button_icon_class'] ) ?> icomoon"></span>
						<span class="button-text"><?php echo esc_attr( $t_em['static_header_primary_button_text'] ); ?></span>
					</a>
<?php endif; ?>
<?php if ( ( $t_em['static_header_secondary_button_text'] && $t_em['static_header_secondary_button_link'] ) ) : ?>
				<a href="<?php echo esc_url( $t_em['static_header_secondary_button_link'] ); ?>"
					title="<?php echo esc_attr( $t_em['static_header_secondary_button_text'] ); ?>"
					class="btn secondary-button">
						<span class="<?php echo esc_attr( $t_em['static_header_secondary_button_icon_class'] ) ?> icomoon"></span>
						<span class="button-text"><?php echo esc_attr( $t_em['static_header_secondary_button_text'] ); ?></span>
					</a>
<?php endif; ?>
			</footer><!-- .actions -->
		</div><!-- #static-header-text -->
<?php endif; ?>
		</div>
	</section><!-- #static-header .container -->
<?php
}
endif; // function t_em_static_header()

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
	$single_featured_img = $t_em['single_featured_img'];
	if ( is_single() && '1' == $single_featured_img && has_post_thumbnail() ) :
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
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
<?php
	endif;
	t_em_action_post_content_after();
}
endif; // function t_em_post_archive_set()

if ( ! function_exists( 't_em_post_format' ) ) :
/**
 * Pluggable Function: Display the post format of each post
 * This function is attached to the t_em_action_post_inside_before() action hook.
 *
 * @since Twenty'em 1.0
 */
function t_em_post_format(){
	$post_format = get_post_format();
	switch ( $post_format ) :
		case 'aside' :
			$format = __( 'Aside', 't_em' );
			$icomoon_class = 'icomoon-circle';
			break;
		case 'audio' :
			$format = __( 'Audio', 't_em' );
			$icomoon_class = 'icomoon-volume-high';
			break;
		case 'chat' :
			$format = __( 'Chat', 't_em' );
			$icomoon_class = 'icomoon-chat';
			break;
		case 'gallery' :
			$format = __( 'Gallery', 't_em' );
			$icomoon_class = 'icomoon-pictures';
			break;
		case 'image' :
			$format = __( 'Image', 't_em' );
			$icomoon_class = 'icomoon-picture';
			break;
		case 'link' :
			$format = __( 'Link', 't_em' );
			$icomoon_class = 'icomoon-link';
			break;
		case 'quote' :
			$format = __( 'Quote', 't_em' );
			$icomoon_class = 'icomoon-quote-left';
			break;
		case 'status' :
			$format = __( 'Status', 't_em' );
			$icomoon_class = 'icomoon-smiley';
			break;
		case 'video' :
			$format = __( 'Video', 't_em' );
			$icomoon_class = 'icomoon-facetime-video';
			break;
	endswitch;
	if ( $post_format ) :
		echo '<div class="entry-format"><span class="'. $icomoon_class .' icomoon"></span><span class="post-format">'. $format .'</span></div>';
	elseif ( is_sticky() ) :
		echo '<div class="entry-format"><span class="icomoon-pin icomoon"></span><span class="post-format">'. __( 'Featured', 't_em' ) .'</span></div>';
	endif;
}
endif; // function t_em_post_format()
add_action( 't_em_action_post_inside_before', 't_em_post_format' );

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
 * in /inc/theme-options.php file.
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
		$output_items .= '<li id="'.$social_network['name'].'" class="social-icon '. $li_classes .'"><a href="'. $t_em[$social_network['name']] .'" class="'. $social_network['class'] .' icomoon" title="'. $t_em[$social_network['name']] .'"><span>'.$social_network['item'].'</span></a></li>';
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

		$limit = 9;
		$post_category_terms = array();
		$post_tag_terms = array();

		if ( $category_terms ) :
			foreach ( $category_terms as $cat_term ) :
				array_push($post_category_terms, $cat_term->term_id);
			endforeach;
		endif;
		if ( $tag_terms ) :
			foreach ( $tag_terms as $tag_term ) :
				array_push($post_tag_terms, $tag_term->term_id);
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
		<section id="related-posts">
<?php 	if ( ! empty( $all_posts ) ) : ?>
			<h3 class="related-posts-title"><?php _e( 'Related Posts', 't_em' ); ?></h3>
			<ul class="related-posts-list">
		<?php foreach( $all_posts as $post ) : setup_postdata( $post ); ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endforeach; wp_reset_query(); ?>
			</ul>
<?php 	else : ?>
			<h3 class="related-posts-title"><?php _e( 'No Related Posts', 't_em' ); ?></h3>
<?php 	endif; ?>
		</section>
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
 * @global $t_em
 *
 * @uses t_em_front_page_widgets_options()
 *
 * @return string HTML div boxes
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_widgets(){
	global $t_em;
	foreach ( t_em_front_page_widgets_options() as $widget ) :
		if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
		$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
			'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' icomoon"></span>' : '';

		$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
			'<img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. $t_em['headline_'.$widget['name'].''] .'" />' : '';

		$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
			'<header>'. $widget_icon_class . $t_em['headline_'.$widget['name'].''] .'</header>' : '';

		$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
			'<div>'. t_em_wrap_paragraph( html_entity_decode( $t_em['content_'.$widget['name'].''] ) ) .'</div>' : '';

		$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
		$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
		$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
		$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
		$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
		$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

		if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
				$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
					'<a href="'. $primary_button_link .'" class="btn primary-button" title="'. $primary_link_text .'">
					<span class="'.$primary_link_icon_class.' icomoon"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

				$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
					'<a href="'. $secondary_button_link .'" class="btn secondary-button" title="'. $secondary_link_text .'">
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
}
endif; // function t_em_front_page_widgets()

/**
 * Show Featured Text Widgets in front page if it's is set by the user in "Front Page Options" in
 * admin panel. This function is attached to the t_em_action_custom_front_page action hook.
 */
function t_em_display_front_page_widgets(){
	global $t_em;
	if ( 'widgets-front-page' == $t_em['front_page_set'] ) : ?>
	<section id="featured-widget-area" class="row">
		<?php t_em_action_custom_front_page_inside_before(); ?>
		<?php t_em_front_page_widgets(); ?>
		<?php t_em_action_custom_front_page_inside_after(); ?>
	</section><!-- #featured-widget-area -->
<?php
	endif;
}
add_action( 't_em_action_custom_front_page', 't_em_display_front_page_widgets' );

if ( ! function_exists( 't_em_jawp_front_page' ) ) :
/**
 * Pluggable Function: Show Just Another WordPress Front Page if it's is set by the user in
 * "Front Page Options" in admin panel.
 * This function is attached to the t_em_action_wp_front_page action hook.
 */
function t_em_jawp_front_page(){
	global $t_em;
	if ( 'wp-front-page' == $t_em['front_page_set'] ) :
		// If our front page is a static page, we load it
		$front_page = get_option( 'show_on_front' ) ;
		if ( 'page' == $front_page ) :
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<h2 class="page-header"><?php the_title(); ?></h2>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
						<?php t_em_edit_post_link(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
<?php 			endwhile;
			endif;
		// Else, we display a list of post
		else :
			t_em_loop();
		endif;
	endif;
}
endif; // function t_em_jawp_front_page()
add_action( 't_em_action_wp_front_page', 't_em_jawp_front_page' );

if ( ! function_exists( 't_em_breadcrumb' ) ) :
/**
 * Pluggable Function: Show breadcrumb path if it's enable by the user in 'General Options' in admin panel.
 * This function is attached to the t_em_action_content_before() action hook.
 *
 * @global $t_em
 *
 * @return string HTML div boxes
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
			echo $current_before . get_search_query() . $current_after;
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
				// echo '<li>' . get_category_parents( $post_cat[0], true, '' ) . '</li>' . $current_before . get_the_title() . $current_after;
			elseif ( ! in_array( $post->post_type, array( 'post', 'page', 'attachment', 'revision', 'nav_menu_item' ) ) ) :
				if ( is_post_type_hierarchical( get_post_type() ) ) :
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
			echo $current_before . __( 'Page ', 't_em' ) .  get_query_var( 'paged' ) . $current_after;
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
					<div class="navbar-brand visible-xs"><?php _e( 'Site Navigation', 't_em' ) ?></div>
				</div><!-- .navbar-header -->
				<?php wp_nav_menu( array(
					'theme_location'	=> 'top-menu',
					'container_id'		=> 'site-top-menu',
					'container_class'	=> 'collapse navbar-collapse navbar-right',
					'menu_class'		=> 'nav navbar-nav menu',
					'depth'				=> 0 ) );
				?>
			</nav>
		</div>
	</div>
<?php
	add_action( 't_em_action_foot', 't_em_navbar_js_script' );
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
					<div class="navbar-brand visible-xs"><?php _e( 'Site Navigation', 't_em' ) ?></div>
				</div><!-- .navbar-header -->
				<?php wp_nav_menu( array(
					'theme_location'	=> 'navigation-menu',
					'container_id'		=> 'site-navigation-menu',
					'container_class'	=> 'collapse navbar-collapse',
					'menu_class'		=> 'nav navbar-nav menu',
					'depth'				=> 0 ) );
				?>
			</nav>
		</div>
	</div>
<?php
	add_action( 't_em_action_foot', 't_em_navbar_js_script' );
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
		'theme_location'	=> 'footer-menu',
		'container'			=> 'nav',
		'container_id'		=> 'footer-menu',
		'container_class'	=> '',
		'menu_class'		=> 'list-inline text-right menu',
		'depth'				=> 1, ) );
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
	<nav id="single-navigation" class="single-pagination navi" role="navigation">
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
	<nav id="comments-navigation" class="comments-pagination navi" role="navigation">
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
		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
	</div><!-- #copyright -->
<?php
}
endif; // function t_em_copy_right()
add_action( 't_em_action_site_info_left', 't_em_copy_right' );

/**
 * Display Twenty'em.com link at bottom of the page. This function is attached to the t_em_action_site_info
 * action hook.
 */
function t_em_dot_com_link(){
global $t_em, $t_em_theme_data;
$hidden_class = ( '0' == $t_em['t_em_link'] ) ? 'hidden' : null;
?>
	<div id="twenty-em-credit" class="<?php echo $hidden_class ?>">
		<?php _e( 'Proudly powered by: ', 't_em' ); ?>
		<a href="<?php esc_url( _e('http://wordpress.org/', 't_em') ); ?>"
			title="<?php esc_attr_e('Semantic Personal Publishing Platform', 't_em'); ?>" rel="generator">
			<?php _e('WordPress', 't_em'); ?></a>
		<?php _e( 'and', 't_em' ); ?>
		<a href="<?php esc_url( _e( 'http://twenty-em.com/', 't_em' ) ) ?>"
			title="<?php esc_attr_e( 'Theming is Prose', 't_em' ); ?>" rel="generator">
			<?php esc_attr_e( __( 'Twenty&#8217;em', 't_em' ) ) ?></a>.
		<?php _e( 'Theme name: ', 't_em' ); ?><a href="<?php echo $t_em_theme_data['ThemeURI']; ?>" title="<?php printf( __( 'Version: %s', 't_em' ), $t_em_theme_data['Version'] ); ?>"><?php echo $t_em_theme_data['Name']; ?></a>
		<?php _e( 'by: ', 't_em' ); ?><?php echo $t_em_theme_data['Author']; ?>
	</div>
<?php
}
add_action( 't_em_action_site_info_after', 't_em_dot_com_link' );
?>
