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
 * @filesource		wp-content/themes/twenty-em/inc/functions.php
 * @link			http://codex.wordpress.org/Theme_Development#Functions_File
 * @since			Version 0.1
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
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) :
	$content_width = 750;
endif;

/**
 * Sets up theme defaults and registers the various WordPress features that Twenty'em supports.
 *
 * @uses add_theme_support() To add support for thumbnails, automatic feed links, post formats,
 * custom background, custom header and JetPack Infinite Scroll. Custom background, header text,
 * header image and JP Infinite Scroll are treat as pluggable functions, so they can be override
 * in Child Themes.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses t_em_theme_data() to access the theme data provided in style.css file
 * @uses t_em_set_globals() to access the data stored in the WordPress data base (theme options)
 *
 * @link http://codex.wordpress.org/Theme_Features Visit for full documentation about Theme Features
 *
 * @return void
 *
 * @since Twenty'em 0.1
 */
add_action( 'after_setup_theme', 't_em_setup' );
function t_em_setup(){

	// Adds support featured image (post thumbnails).
	add_theme_support( 'post-thumbnails' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Adds support for variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'audio' ) );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'css/editor-style.css' );

	// Adds support for custom background (pluggable function).
	t_em_support_custom_background();

	// Adds support for custom header text (pluggable function).
	t_em_support_custom_header();

	// Adds support for custom header image (pluggable function).
	t_em_support_custom_header_image();

	// This theme also support JetPack Infinite Scroll (pluggable function).
	t_em_support_jp_infinite_scroll();

	// This theme uses navigation menus in three locations.
	register_nav_menus ( array (
		'top-menu'			=> __('Top Menu', 't_em'),
		'navigation-menu'	=> __('Navigation Menu', 't_em'),
		'footer-menu'		=> __('Footer Menu', 't_em')
		)
	);

	/* Make Twenty'em available for translation.
	 * Translations can be added to the lang/ directory.
	 * If you're building a theme based on Twenty'em, use a find and replace to change 't_em'
	 * to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 't_em', T_EM_THEME_DIR_LANG );
	$locale = get_locale();
	$locale_file = T_EM_THEME_DIR_LANG . "/$locale.php";
	if ( is_readable( $locale_file ) ) :
		require_once( $locale_file );
	endif;

} // t_em_setup()

if ( !function_exists( 't_em_support_custom_background' ) ) :
/**
 * Pluggable Function: Adds theme support for custom background.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_background(){
	$custom_background = array ( 'default-color' => 'f7f7f7' );
	add_theme_support( 'custom-background', $custom_background );
}
endif; // function t_em_support_custom_background()

if ( !function_exists( 't_em_support_custom_header' ) ) :
/**
 * Pluggable Function: Adds theme support for custom header image
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_header(){
	$custom_header_support = array (
		'default-text-color'		=> '757575',
		'default-image'				=> T_EM_THEME_DIR_IMG . '/headers/twenty-em-header.jpg',
		'width'						=> apply_filters( 't_em_header_image_width', 1000 ),
		'height'					=> apply_filters( 't_em_header_image_height', 350 ),
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

if ( !function_exists( 't_em_support_custom_header_image' ) ) :
/**
 * Pluggable Function:  Default custom headers packaged with the theme.
 * Referenced via t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_support_custom_header_image(){
	register_default_headers( array(
		'twenty-em'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/twenty-em-header.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/twenty-em-header-thumbnail.jpg',
			'description'	=> __( 'Twenty&#8217;em... Theming is prose', 't_em' ),
		),
		'canyon'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/canyon.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/canyon-thumbnail.jpg',
			'description'	=> __( 'Canyon', 't_em' ),
		),
		'fire'		=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/fire.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/fire-thumbnail.jpg',
			'description'	=> __( 'Fire', 't_em' ),
		),
		'friends'	=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/friends.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/friends-thumbnail.jpg',
			'description'	=> __( 'Friends', 't_em' ),
		),
		'cityscapes'		=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/cityscapes.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/cityscapes-thumbnail.jpg',
			'description'	=> __( 'Cityscapes', 't_em' ),
		),
		'leaf'				=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/leaf.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/leaf-thumbnail.jpg',
			'description'	=> __( 'Leaf', 't_em' ),
		),
		'road'				=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/road.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/road-thumbnail.jpg',
			'description'	=> __( 'Road', 't_em' ),
		),
		'streets'			=> array(
			'url'			=> T_EM_THEME_DIR_IMG . '/headers/streets.jpg',
			'thumbnail_url'	=> T_EM_THEME_DIR_IMG . '/headers/streets-thumbnail.jpg',
			'description'	=> __( 'Streets', 't_em' ),
		),
	) );
}
endif; // function t_em_support_custom_header_image()

if ( !function_exists('t_em_support_jp_infinite_scroll') ) :
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
endif;

if ( !function_exists( 't_em_header_style' ) ) :
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
function t_em_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
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
endif; // t_em_admin_header_style()

if ( ! function_exists( 't_em_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 * Referenced via add_theme_support('custom-header') in t_em_setup().
 *
 * @since Twenty'em 0.1
 */
function t_em_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php
}
endif; // t_em_admin_header_image()

/**
 * Add favicon to our site, admin dashboard included
 *
 * @since Twenty'em 0.1
 */
function t_em_favicon(){
	echo '<link rel="shortcut icon" href="'. T_EM_THEME_DIR_IMG . '/t-em-favicon.png' .'" />'."\n";
}
add_action( 'wp_head', 't_em_favicon' );
add_action( 'admin_head', 't_em_favicon' );

/**
 * Creates a nicely formatted and more specific title element text
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
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

/**
 * Twenty'em sets the post excerpt length to 40 characters.
 *
 * @since Twenty'em 0.1
 *
 * @return int
 */
function t_em_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 't_em_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty'em 0.1
 *
 * @return string "Continue Reading" link
 */
function t_em_continue_reading_link() {
	return ' <span class="more-link"><a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) . '</a></span>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis
 * and t_em_continue_reading_link().
 *
 * @since Twenty'em 0.1
 *
 * @return string An ellipsis
 */
function t_em_auto_excerpt_more( $more ) {
	return ' &hellip;' . t_em_continue_reading_link();
}
add_filter( 'excerpt_more', 't_em_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
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
add_filter( 'get_the_excerpt', 't_em_custom_excerpt_more' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 * @since Twenty'em 0.1
 * @uses register_sidebar
 */
function t_em_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'First Sidebar Widget Area', 't_em' ),
		'id' => 'first-sidebar',
		'description' => __( 'The sidebar widget area', 't_em' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

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
}
// Register sidebars by running t_em_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 't_em_widgets_init' );

if ( ! function_exists( 't_em_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty'em 0.1
 */
function t_em_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 't_em' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 't_em' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 't_em' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif; // function t_em_posted_in()

if ( ! function_exists( 't_em_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty'em 0.1
 */
function t_em_posted_on() {
		printf( __( 'Posted on %2$s by %3$s', 't_em' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" rel="bookmark"><time datetime="%2$s" pubdate>%3$s</time></a>',
			get_permalink(),
			get_the_date('c'),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 't_em' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif; // function t_em_posted_on()

if ( ! function_exists( 't_em_comment' ) ) :
/**
 * Template for comments.
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
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<header class="comment-header">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'dostrece' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'dostrece' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'dostrece' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'dostrece' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</header><!-- comment-header -->
			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## .comment-wrap -->

	<?php
			break;
	endswitch;
}
endif; // function t_em_comment()

if ( ! function_exists( 't_em_comment_pingback_trackback' ) ) :
/**
 * Template for pingbacks and trackbacks.
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
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" class="post pingback">
		<p><?php _e( 'Pingback:', 'dostrece' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'dostrece'), ' ' ); ?></p>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
			break;
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" class="post pingback">
		<p><?php _e( 'Trackback:', 'dostrece' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'dostrece'), ' ' ); ?></p>
		<div class="comment-body"><?php comment_text(); ?></div>
	<?php
	endswitch;
}
endif; // function t_em_comment_pingback_trackback()

if ( ! function_exists( 't_em_page_navi' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 * If the user uses WP-PageNavi plugin, it is loaded, else we have the default WordPress pagination
 * links.
 *
 * @param string $nav_id Element ID, possible values: 'nav-above' or 'nav-below'. See #nav-above and
 * #nav-below in style.css
 *
 * @link http://www.wordpress.org/extend/plugins/wp-pagenavi/ WP-PageNavi
 *
 * @since Twenty'em 0.1
 */
function t_em_page_navi( $nav_id ){
	global $wp_query;
?>
<nav id="<?php echo $nav_id ?>" class="navigation">
<?php
	if ( ! function_exists( 'wp_pagenavi' ) ) :
		if ( $wp_query->max_num_pages > 1 ) :
?>
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 't_em' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?></div>
<?php
		endif;
	else :
		// We load our favorite pagination plugin
		wp_pagenavi();
	endif;
?>
</nav>
<?php
}
endif; // function t_em_page_navi()

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Twenty'em 0.1
 */
function t_em_remove_recent_comments_style(){
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 't_em_remove_recent_comments_style' );

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
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 't_em' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "'. __( 'What can we call you?', 't_em' ) .'"' . ( $req ? ' required' : '' ) . '/></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 't_em' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'. __( 'How can we reach you?', 't_em' ) .'"' . ( $req ? ' required' : '' ) . ' /></p>',
		'url'	 => '<p class="comment-form-url"><label for="url">' . __( 'Website', 't_em' ) . '</label>' .
					'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'. __( 'Have you got a website?', 't_em' ) .'" /></p>'
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
	$comment_area = '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 't_em' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="'. __( 'What&#8217;s on your mind?', 't_em' ) .'"></textarea></p>';
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

/**
 * Display featured image in posts archives when "Display the Excerpt" option is activated in admin
 * theme option page.
 *
 * @param int $height Require Thumbnail height.
 * @param int $width Require Thumbnail width.
 * @param string $class Optional CSS class.
 * @param boolean $link Optional The image will be linkable or not. Default: true.
 *
 * @global $post
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @return text HTML content describing embedded figure
 *
 * @since Twenty'em 0.1
 */
function t_em_featured_post_thumbnail( $height, $width, $class = null, $link = true ){
	global	$post,
			$t_em_theme_options;

	if ( has_post_thumbnail( $post->ID ) ) :
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		$image_src = $image_url[0];
		if ( $link ) :
		?>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php
		endif;
		?>
			<figure id="post-attachment-<?php the_ID(); ?>" class="<?php echo $class ?>" style="width:<?php echo $width ?>px">
				<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo esc_attr__( the_title_attribute( 'echo=0' ) ); ?>"/>
				<figcaption><?php the_title(); ?></figcaption>
			</figure>
		<?php
		if ( $link ) :
		?>
			</a>
		<?php
		endif;
	else :
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'order' => 'ASC', 'post_mime_type' => 'image', 'numberposts' => 9999 ) );
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_url = wp_get_attachment_image_src( $image->ID, 'full' );
		if ( $total_images >= 1 ) :
			$image_src = $image_url[0];
			if ( $link ) :
			?>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
			<?php
			endif;
			?>
				<figure id="post-attachment-<?php the_ID(); ?>" class="<?php echo $class ?>" style="width:<?php echo $width ?>px">
					<img alt="<?php the_title(); ?>" src="<?php echo T_EM_INC_DIR .'/timthumb.php?zc=1&amp;w='.$width.'&amp;h='.$height.'&amp;src='. $image_src ?>" title="<?php echo esc_attr__( the_title_attribute( 'echo=0' ) ); ?>"/>
					<figcaption><?php the_title(); ?></figcaption>
				</figure>
			<?php
			if ( $link ) :
			?>
				</a>
			<?php
			endif;
		endif;
	endif;
}

/**
 * Display header set depending of the activated "Header Options" in admin theme option page
 *
 * @global $post
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
 */
function t_em_header_options_set(){
	global	$post,
			$t_em_theme_options;

	$header_options = $t_em_theme_options['header-set'];

	if ( 'no-header-image' == $header_options ) :
		return false;
	elseif ( 'header-image' == $header_options ) :
		get_template_part( 'header', 'image' );
	elseif ( 'slider' == $header_options ) :
		get_template_part( 'header', 'nivo-slider' );
	endif;
}

/**
 * Display featured post thumbnail on top of a single post if it is set by the user in
 * "General Options" in the admin options page.
 *
 * @uses has_post_thumbnail() Returns a boolean if a post has a Featured Image
 * @uses the_post_thumbnail() Display the Featured Image for the current post, as set in that
 * post's edit screen.
 *
 * @link http://codex.wordpress.org/Post_Thumbnails
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
 */
function t_em_single_post_thumbnail(){
	global $t_em_theme_options;
	$single_featured_img = $t_em_theme_options['single-featured-img'];
	if ( '1' == $single_featured_img && has_post_thumbnail() ) :
?>
<figure id="featured-image-<?php the_ID() ?>" class="featured-post-thumbnail">
<?php
		the_post_thumbnail();
?>
</figure>
<?php
	endif;
}

/**
 * Display posts archive in excerpt or content form. Set in "Archive Options" in admin
 * theme option page.
 *
 * @uses t_em_featured_post_thumbnail() Display featured image in posts archives.
 * @uses the_excerpt() Displays the excerpt of the current post with the "..." text at the end.
 * @uses the_content() Displays the contents of the current post.
 *
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 * @link http://codex.wordpress.org/Function_Reference/the_content
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
 */
function t_em_post_archive_set(){
	global $t_em_theme_options;

	if ( 'the-excerpt' == $t_em_theme_options['archive-set'] ) :

	// Set thumbnail height and width, if the key value is empty the size is equal to
	// thumbnail_size_h and thumbnail_size_h options respectively
	$thumb_heigth = ( ( '' != $t_em_theme_options['excerpt-thumbnail-height'] ) ? $t_em_theme_options['excerpt-thumbnail-height'] : get_option( 'thumbnail_size_h' ) );
	$thumb_width = ( ( '' != $t_em_theme_options['excerpt-thumbnail-width'] ) ? $t_em_theme_options['excerpt-thumbnail-width'] : get_option( 'thumbnail_size_w' ) );

?>
			<div class="entry-summary">
				<?php t_em_featured_post_thumbnail( $thumb_heigth, $thumb_width, 'featured-post-thumbnail', true ); ?>
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
}


/**
 * Display user social network set in "Social Network Options" in the admin theme options.
 *
 * @uses t_em_social_network_options() See t_em_social_network_options() function
 * in /inc/theme-options.php file.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @return string HTML list of items
 *
 * @since Twenty'em 0.1
 */
function t_em_user_social_network(){
	global $t_em_theme_options;
	$user_social_network = t_em_social_network_options();

	$output_items = '';
	foreach ( $user_social_network as $social_network ) :
		if ( $t_em_theme_options[$social_network['name']] != '' ) :
		$output_items .= '<li id="'.$social_network['name'].'" class="menu-item"><a href="'. $t_em_theme_options[$social_network['name']] .'">'.$social_network['item'].'</a></li>';
		endif;
	endforeach;
	if ( !empty( $output_items ) ) :
		// We are sure to not display empties <nav><ul>...</ul></nav> tags.
		$output = '<ul class="menu">' . $output_items . '</ul>';
		$output = '<nav id="social-network-menu">' . $output . '</nav>';
	else :
		$output = '';
	endif;
	return $output;
}

/**
 * Show related posts to the current single post if it's set by the user in "General Options" in
 * admin theme options page.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @return string HTML list of items
 *
 * @since Twenty'em 0.1
 */
function t_em_single_related_posts() {
	global $t_em_theme_options;
	if ( '1' == $t_em_theme_options['single-related-posts'] ) :
		global $wpdb, $post;

		$now = current_time('mysql', 1);
		$tags = wp_get_post_tags($post->ID);

		$taglist = "'" . $tags[0]->term_id. "'";

		$tagcount = count($tags);
		if ($tagcount > 1) :
			for ($i = 1; $i <= $tagcount; $i++) :
				$taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
			endfor;
		endif;

		$query = "SELECT ID, post_title, post_date, comment_count, count(object_id) as cnt
				  FROM $wpdb->term_taxonomy, $wpdb->term_relationships, $wpdb->posts
				  WHERE taxonomy ='post_tag'
				  AND $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
				  AND object_id = ID
				  AND (term_id IN ($taglist))
				  AND ID != $post->ID
				  AND post_status = 'publish'
				  AND post_date_gmt < '$now'
				  GROUP BY object_id
				  ORDER BY cnt DESC, post_date_gmt DESC
				  LIMIT 9;";

		$related_posts = $wpdb->get_results($query);

		if ( empty( $related_posts ) ) :
			$output = '<h3 id="related-posts-title">'. __( 'No Related Posts', 't_em' ) .'</h3>';
		else :
			$output = '';
			foreach ($related_posts as $related_post ) :
				$output .= '<li>';
				$output .= '<a href="'.get_permalink($related_post->ID).'" id="related-post-'.$related_post->ID.'" title="'.$related_post->post_title.'">';
				$output .= wptexturize($related_post->post_title);
				$output .= '</a>';
				$output .= '</li>';
			endforeach;

			$output = '<ul class="related-posts-list">'.$output.'</ul>';
			$output = '<h3 id="related-posts-title">'. __( 'Related Posts:', 't_em' ) .'</h3>'.$output;
			$output = '<section id="related-posts">'.$output.'</section>';
		endif;
		return $output;
	endif;
}
?>
