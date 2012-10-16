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
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/functions.php
 * @link			http://codex.wordpress.org/Theme_Development#Functions_File
 * @since			Version 1.0
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
 * Register functions directory and sub-directories through constants
 */
define ( 'T_EM_FUNCTIONS_DIR',		get_template_directory_uri().'/inc/' );
define ( 'T_EM_FUNCTIONS_DIR_IMG',	get_template_directory_uri().'/inc/images/' );
define ( 'T_EM_FUNCTIONS_DIR_JS',	get_template_directory_uri().'/inc/js/' );
define ( 'T_EM_FUNCTIONS_DIR_CSS',	get_template_directory_uri().'/inc/css/' );

/**
 * Start up the theme engine
 */
add_action( 'after_setup_theme', 't_em_setup' );
if ( !function_exists( 't_em_setup' ) ) :
	function t_em_setup(){

		global $content_width;
		if ( ! isset( $content_width ) ) :
			$content_width = 640;
		endif;

		/**
		 * Twenty'em theme supports
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support
		 */
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

		/**
		 * Twenty'em is ready for translation
		 */
		load_theme_textdomain( 't_em', TEMPLATEPATH . '/languages' );
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) :
			require_once( $locale_file );
		endif;

		/**
		 * Twenty'em theme uses wp_nav_menu() in three location... Weow!
		 * @link http://codex.wordpress.org/Navigation_Menus
		 */
		register_nav_menus(array(
			'top-menu'		=> __('Top Menu', 't_em'),
			'header-menu'	=> __('Header Menu', 't_em'),
			'footer-menu'	=> __('Footer Menu', 't_em')
			)
		);

		/**
		 * Twenty'em adds callback for custom TinyMCE editor stylesheets. (editor-style.css)
		 * @link http://codex.wordpress.org/Function_Reference/add_editor_style
		 */
		add_editor_style();

	}
endif; // function t_em_setup()

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty'em 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
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
 * Twenty'em shows a home link in wp_page_menu(), wp_nav_menu() fallback
 * @since Twenty'em 1.0
 */
function t_em_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 't_em_page_menu_args' );

/**
 * Twenty'em sets the post excerpt length to 40 characters.
 * @since Twenty'em 1.0
 * @return int
 */
function t_em_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 't_em_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 * @since Twenty'em 1.0
 * @return string "Continue Reading" link
 */
function t_em_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 't_em' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and t_em_continue_reading_link().
 * @since Twenty'em 1.0
 * @return string An ellipsis
 */
function t_em_auto_excerpt_more( $more ) {
	return ' &hellip;' . t_em_continue_reading_link();
}
add_filter( 'excerpt_more', 't_em_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 * @since Twenty'em 1.0
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
 * @since Twenty'em 1.0
 * @uses register_sidebar
 */
function t_em_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 't_em' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 't_em' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 't_em' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 't_em' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 't_em' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 't_em' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 't_em' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running t_em_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 't_em_widgets_init' );

if ( ! function_exists( 't_em_posted_in' ) ) :
	/**
	 * Prints HTML with meta information for the current post (category, tags and permalink).
	 * @since Twenty'em 1.0
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
	 * @since Twenty'em 1.0
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
	 * @since Twenty'em 1.0
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
						<?php echo get_avatar( $comment, 40 ); ?>
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
	 * @since Twenty'em 1.0
	 */
	function t_em_comment_pingback_trackback( $comment ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
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

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 * @since Twenty'em 1.0
 */
function t_em_remove_recent_comments_style(){
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 't_em_remove_recent_comments_style' );

/**
 * Removes the default styles that are packaged with the Gallery shortcode.
 * @since Twenty'em 1.0
 */
function t_em_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) ) :
	add_filter( 'gallery_style', 't_em_remove_gallery_css' );
endif;
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Customise the Twenty'em theme comments fields with HTML5 form elements
 * Adds support for placeholder, required, type="email" and type="url"
 * @since Twenty'em 1.0
 */
function t_em_comments() {
	$req = get_option('require_name_email');
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 't_em' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "What can we call you?"' . ( $req ? ' required' : '' ) . '/></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 't_em' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="How can we reach you?"' . ( $req ? ' required' : '' ) . ' /></p>',
		'url'	 => '<p class="comment-form-url"><label for="url">' . __( 'Website', 't_em' ) . '</label>' .
					'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'
	);
	return $fields;
}
add_filter('comment_form_default_fields', 't_em_comments');

function t_em_commentfield() {
	$commentArea = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="What\'s on your mind?"	></textarea></p>';
	return $commentArea;
}
add_filter('comment_form_field_comment', 't_em_commentfield');

/**
 * Customise the Twenty'em theme caption and wp_caption shortcode with HTML5 elements
 * Adds support for figure and figcaptions
 * @since Twenty'em 1.0
 */
function t_em_img_caption_shortcode($attr, $content = null) {
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $idtag = 'id="' . esc_attr($id) . '" ';
	$align = 'class="' . esc_attr($align) . '" ';

	return '<figure ' . $idtag . $align . 'aria-describedby="figcaption_' . $id . '" style="width: ' . (10 + (int) $width) . 'px">' 
	. do_shortcode( $content ) . '<figcaption id="figcaption_' . $id . '">' . $caption . '</figcaption></figure>';
}
//~ add_shortcode('wp_caption', 't_em_img_caption_shortcode');
//~ add_shortcode('caption', 't_em_img_caption_shortcode');
?>
