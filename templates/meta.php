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


if ( ! function_exists( 't_em_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty'em 1.0
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
 * @since Twenty'em 1.0
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
 * @since Twenty'em 1.0
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
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @since Twenty'em 1.0
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
 * @since Twenty'em 1.0
 */
function t_em_posted_in(){
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 't_em' ) );
	if ( $categories_list ) :
		echo '<div class="entry-categories small d-inline mr-3"><span class="icomoon-folder-open text-muted"></span> <span class="categories-links">'. $categories_list .'</span></div>';
	endif;

	// Translators: used between list items, there is a space after the comma.
	$tags_list = get_the_tag_list( '', __( ', ', 't_em' ) );
	if ( $tags_list ) :
		echo '<div class="entry-tags small d-inline mr-3"><span class="icomoon-price-tags text-muted"></span> <span class="tags-links">'. $tags_list .'</span></div>';
	endif;
}
endif; // function t_em_posted_in()
add_action( 't_em_action_entry_meta_footer', 't_em_posted_in' );

if ( ! function_exists( 't_em_post_shortlink' ) ) :
/**
 * Pluggable Function: Prints HTML width post short link
 *
 * @since Twenty'em 1.2
 */
function t_em_post_shortlink(){
	$post_shortlink = sprintf( '<div class="entry-permalink small d-inline mr-3"><span class="icomoon-link text-muted"></span> <span class="post-link"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span></div>',
					wp_get_shortlink(),
					sprintf( __( 'Short link to: %1$s', 't_em' ), the_title_attribute( 'echo=0' ) ),
					__( 'Short link', 't_em' )
				);
	echo $post_shortlink;
}
endif; // function t_em_post_shortlink()
add_action( 't_em_action_entry_meta_footer', 't_em_post_shortlink' );

if ( ! function_exists( 't_em_comments_link' ) ) :
/**
 * Pluggable Function: Prints HTML with leave comment link
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.1.2 	Checks if current post type supports comments
 */
function t_em_comments_link(){
	$post_type = get_post_type( get_the_ID() );
	if ( ! post_type_supports( $post_type, 'comments' ) )
		return;
?>
	<div class="entry-comments small d-inline mr-3">
	<span class="icomoon-chat text-muted"></span> <span class="comment-link">
	<?php comments_popup_link( __( 'Leave a comment', 't_em' ), __( '1 Comment', 't_em' ), __( '% Comments', 't_em' ) ); ?>
	</span></div>
<?php
}
endif; // function t_em_comments_link()
add_action( 't_em_action_entry_meta_footer', 't_em_comments_link' );

if ( ! function_exists( 't_em_edit_post_link' ) ) :
/**
 * Pluggable Function: Prints HTML with edit post link
 *
 * @since Twenty'em 1.0
 */
function t_em_edit_post_link(){
	edit_post_link( __( 'Edit', 't_em' ), '<div class="entry-edit small d-inline mr-3"><span class="icomoon-pencil text-muted"></span> <span class="edit-link">', '</span></div>' );
}
endif; // function t_em_edit_post_link()
add_action( 't_em_action_entry_meta_footer', 't_em_edit_post_link' );

if ( ! function_exists( 't_em_post_date' ) ) :
/**
 * Pluggable Function: Prints HTML with post date link
 *
 * @since Twenty'em 1.0
 */
function t_em_post_date(){
	$post_date = sprintf( '<div class="entry-date small d-inline mr-3"><span class="icomoon-calendar text-muted"></span> <span class="post-date">
		<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span></div>',
					esc_url( get_permalink() ),
					esc_attr( sprintf( __( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ) ),
					esc_attr( get_the_date( 'c' ) ),
					get_the_date()
				);
	echo $post_date;
}
endif; // function t_em_post_date()
add_action( 't_em_action_entry_meta_header', 't_em_post_date' );

if ( ! function_exists( 't_em_post_author' ) ) :
/**
 * Pluggable Function: Prints HTML with author posts link
 *
 * @since Twenty'em 1.0
 */
function t_em_post_author(){
	global $post;
	$author_id = $post->post_author;
	$post_author = sprintf( '<div class="entry-author small d-inline mr-3"><span class="icomoon-user text-muted"></span> <span class="post-author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span></div>',
				esc_url( get_author_posts_url( $author_id ) ),
				esc_attr( sprintf( __( 'View all post by %s', 't_em' ), get_the_author_meta( 'display_name', $author_id ) ) ),
				get_the_author_meta( 'display_name', $author_id )
			);
	echo $post_author;
}
endif; // function t_em_post_author()
add_action( 't_em_action_entry_meta_header', 't_em_post_author' );

if ( ! function_exists( 't_em_author_meta' ) ) :
/**
 * Pluggable Function: If a user has filled out their description, show a bio on their entries.
 *
 * @since Twenty'em 1.0
 */
function t_em_author_meta(){
	if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
	<div id="author-info-<?php echo get_the_author_meta( 'user_login' ); ?>" class="author-info author-archive media">
		<div class="d-flex mr-3"><?php echo get_avatar( get_the_author_meta( 'ID' ), '', '', get_the_author() ); ?></div>
		<div id="author-description" class="media-body">
			<h4 class="media-heading"><?php printf( esc_attr__( 'About %s', 't_em' ), get_the_author() ); ?></h4>
			<?php the_author_meta( 'description' ); ?>
			<?php if ( is_single() ) : ?>
			<div id="author-link">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php printf( __( 'View all posts by %s <span class="icomoon-arrow-right2"></span>', 't_em' ), get_the_author() ); ?>
				</a>
			</div><!-- #author-link	-->
		<?php endif; ?>
		</div><!-- #author-description -->
	</div><!-- .author-info -->
<?php
	endif;
}
endif; // function t_em_author_meta()

/**
 * Display Author meta in single post.
 * This function is attached to the t_em_action_post_inside_after action hook
 *
 * @since Twenty'em 1.0
 */
function t_em_single_author_meta(){
	if ( is_single() ) return t_em_author_meta();
}
add_action( 't_em_action_post_inside_after', 't_em_single_author_meta' );

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
?>
