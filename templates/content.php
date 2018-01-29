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


if ( ! function_exists( 't_em_javascript_required' ) ) :
/**
 * Pluggable Function: Javascript required. This function is attached to the t_em_action_top() action hook
 */
function t_em_javascript_required(){
?>
<!--[if lte IE 8 ]>
<noscript><?php _e( 'JavaScript is required for this website to be displayed correctly.<br /> Please enable JavaScript before continuing...', 't_em' ); ?></noscript>
<![endif]-->
<?php
}
endif; // function t_em_javascript_required()
add_action( 't_em_action_top', 't_em_javascript_required' );

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
			<h1 class="entry-title author"><?php printf( __( 'Author Archives: %s', 't_em' ), '<small class="vcard">' . get_the_author() . '</small>' ); ?></h1>
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
			<h1 class="entry-title">
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
			<h1 class="entry-title">
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
			<h1 class="entry-title">
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
				<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 't_em' ), '<small>' . get_search_query() . '</small>' ); ?></h1>
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

if ( ! function_exists( 't_em_custom_template_content' ) ) :
/**
 * Pluggable Function: Display Page title and content for custom pages templates.
 * This function is attached to the t_em_action_content_before action hook.
 *
 * @since Twenty'em 1.0
 */
function t_em_custom_template_content(){
	if ( is_page_template() && is_page() && get_post_meta( get_the_ID(), '_wp_page_template', true ) != 'page-templates/template-one-column.php' ) :
	$template_data = get_page( get_the_ID() );
?>
	<div id="featured-header-template-<?php the_ID(); ?>" <?php post_class( 'featured-header featured-header-template custom-template-content' ); ?>>
		<header>
			<h1 class="entry-title"><?php echo apply_filters( 'the_title', $template_data->post_title ); ?></h1>
		</header>
<?php if ( $template_data->post_content ) : ?>
		<div class="entry-content"><?php echo apply_filters( 'the_content', $template_data->post_content ); ?></div>
<?php endif; ?>
		<footer class="entry-meta entry-meta-footer mb-3">
			<?php t_em_edit_post_link(); ?>
		</footer>
	</div><!-- .featured-header -->
<?php
	endif;
}
endif; // function t_em_custom_template_content()
add_action( 't_em_action_content_before', 't_em_custom_template_content', 15 );

if ( ! function_exists( 't_em_single_post_thumbnail' ) ) :
/**
 * Pluggable Function: Display featured post thumbnail on top of a single post if it is set by the
 * user in "General Options" in the admin options page. This function is attached to the
 * t_em_action_post_inside_before() action hook.
 *
 * @since Twenty'em 1.0
 */
function t_em_single_post_thumbnail(){
	if ( is_page_template( 'page-templates/template-blog-excerpt.php' ) )
		return;
	global $t_em, $post;
	if ( $t_em['single_featured_img']
		&& ( is_singular() && has_post_thumbnail() )
		|| ( $t_em['archive_set'] == 'the-content'
			&& ( is_home() || is_front_page() || is_archive() )
		)
		|| ( is_page_template( 'page-templates/template-blog-content.php' ) )
	) :
		$open_link	= ( ! is_single() ) ? '<a href="'. get_permalink( $post->ID ) .'">' : null;
		$close_link	= ( ! is_single() ) ? '</a>' : null;
		$attr = array(
			'class'	=> 'featured-post-thumbnail',
			'alt'	=> $post->post_title,
		);
		echo $open_link . get_the_post_thumbnail( $post->ID, 'full', $attr ) . $close_link;
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
 * @since Twenty'em 1.0
 */
function t_em_post_archive_set(){
	global $t_em;

	t_em_action_post_content_before();
	if ( 'the-excerpt' == $t_em['archive_set'] ) :
?>
			<div class="entry-summary">
				<?php t_em_featured_post_thumbnail( $t_em['excerpt_thumbnail_width'], $t_em['excerpt_thumbnail_height'], true ); ?>
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
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Support for custom post types
 */
function t_em_single_related_posts(){
	global $t_em;
	if ( is_single() && $t_em['single_related_posts'] ) :
		global $post;
		$post_id = $post->ID;
		$taxonomies = get_taxonomies( array( 'public' => true ), 'object' );
		$post_type = get_post_type( $post_id );
		$labels = get_post_type_object( $post_type );
		$taxonomy = array();

		foreach ( $taxonomies as $key => $value ) :
			if ( in_array( $post_type, $value->object_type ) ) :
				array_push( $taxonomy, $key );
			endif;
		endforeach;

		/**
		 * Filter the amount of related post to display
		 *
		 * @param int Number of posts to display
		 * @since Twenty'em 1.0
		 */
		$limit = apply_filters( 't_em_filter_single_limit_related_posts', 9 );

		$query_args = array(
			'post_type'			=> $post_type,
			'posts_per_page'	=> $limit,
			'post__not_in'		=> array( $post_id ),
			'post_status'		=> 'publish',
			'tax_query'			=> array(
				'relation'		=> 'OR',
			),
		);
		foreach ( $taxonomy as $tax ) :
			$terms = get_the_terms( $post_id, $tax );
			if ( ! $terms ) continue;
			$terms_ids = array();
			foreach ( $terms as $term ) :
				array_push( $terms_ids, $term->term_id );
			endforeach;
			$key = array(
				'taxonomy'	=> $tax,
				'field'		=> 'id',
				'terms'		=> $terms_ids,
			);
			array_push( $query_args['tax_query'], $key );
		endforeach;

		/**
		 * Filter the related post query arguments
		 * @param array 	Query arguments
		 *
		 * @since Twenty'em 1.2
		 */
		$all_posts = apply_filters( 't_em_filter_single_related_post_query', get_posts( $query_args ) );
?>
		<section id="related-posts">
<?php 	if ( ! empty( $all_posts ) ) : ?>
			<h3 class="related-posts-title"><?php printf( _x( 'Similar %s', 'similar custom post type label', 't_em' ), $labels->labels->name ); ?></h3>
			<ul class="related-posts-list">
		<?php foreach( $all_posts as $post ) : setup_postdata( $post );
			$related_post = '<a href="'. get_permalink() .'">'. get_the_title() .'</a>';
			/**
			 * Filter the related post html output
			 *
			 * @param string HTML output
			 * @since Twenty'em 1.0
			 */
		?>
				<li><?php echo apply_filters( 't_em_filter_single_related_posts_output', $related_post ); ?></li>
		<?php endforeach; wp_reset_query(); ?>
			</ul>
<?php 	else : ?>
			<h3 class="no-related-posts-title"><?php printf( _x( 'No Similar %s', 'no similar custom post type label', 't_em' ), $labels->labels->name ); ?></h3>
<?php 	endif; ?>
		</section>
<?php
	endif;
}
endif; // function t_em_single_related_posts()
add_action( 't_em_action_post_after', 't_em_single_related_posts' );

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
		$current_before = '<li class="breadcrumb-item active">';
		$current_after = '</li>';
		$home_link = '<li class="breadcrumb-item"><a href="'. home_url() .'">'. $home_name .'</a></li>';
		$year_link = ( is_year() || is_month() || is_day() ) ? '<li class="breadcrumb-item"><a href="'. get_year_link( get_the_time( 'Y' ) ) .'">'. get_the_time( 'Y' ) .'</a></li>' : null;
		$month_link = ( is_year() || is_month() || is_day() ) ? '<li class="breadcrumb-item"><a href="'. get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) .'">'. get_the_time( 'F' ) .'</a></li>' : null;
		$post_type_obj = ( is_single() ) ? get_post_type_object( $post->post_type ) : null;
		$parent_post_type_obj = ( is_single() ) ? get_post_type_object( get_post_type( $post->post_parent ) ) : null;
		$post_type_archive_link = ( is_single() && empty( $post_type_obj->hierarchical ) ) ? '<li class="breadcrumb-item"><a href="'. get_post_type_archive_link( $post->post_type ) .'">'. $post_type_obj->label .'</a></li>' : null;
		$attachment_parent_link = ( is_attachment() ) ? '<li class="breadcrumb-item"><a href="'. get_permalink( $post->post_parent ) .'">'. get_the_title( $post->post_parent ) .'</a></li>' : null;
		$attachment_post_type_parent_link = ( is_attachment() && ! is_page() ) ? '<li class="breadcrumb-item"><a href="'. get_post_type_archive_link( get_post_type( $post->post_parent ) ) .'">'. $parent_post_type_obj->label .'</a></li><li class="breadcrumb-item"><a href="'. get_permalink( $post->post_parent ) .'">'. get_the_title( $post->post_parent ) .'</a></li>' : null;
?>
		<div id="you-are-here">
			<lo class="breadcrumb">
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
					echo '<li class="breadcrumb-item"><a href="'. get_category_link( $cat ) .'">' . get_cat_name( $cat ) . '</a></li>';
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
					$breadcrumb_page[] = '<li class="breadcrumb-item"><a href="'. get_permalink( $parent_page->ID ) .'">'. get_the_title( $parent_page->ID ) .'</a></li>';
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
					echo '<li class="breadcrumb-item"><a href="'. get_category_link( $cat->term_id ) .'">'. $cat->cat_name .'</a></li>';
				endforeach;
				echo $current_before . get_the_title() . $current_after;
			elseif ( ! in_array( $post->post_type, array( 'post', 'page', 'attachment', 'revision', 'nav_menu_item' ) ) ) :
				if ( is_post_type_hierarchical( get_post_type() ) ) :
					echo '<li class="breadcrumb-item"><a href="'. get_post_type_archive_link( get_post_type() ) .'">'. $post_type_obj->label .'</a></li>';
					$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
					foreach ( $ancestors as $ancestor ) :
						echo '<li class="breadcrumb-item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>';
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
				$attachtment_post_parent_link = '<li class="breadcrumb-item">' . get_category_parents( $parent_cat[0], true, '' ) . '</li>' . $attachment_parent_link;
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

if ( ! function_exists( 't_em_loop' ) ) :
/**
 * Pluggable Function: The Twenty'em Loop
 *
 * @since Twenty'em 1.0
 */
function t_em_loop(){
	global $t_em;
	if ( $t_em['archive_set'] == 'the-excerpt' ) :
		$content = ( $t_em['archive_in_columns'] == 1 && $t_em['excerpt_set'] != 'thumbnail-center' ) ? 'excerpt' : 'columns';
	elseif ( $t_em['archive_set'] == 'the-content' ) :
		$content = 'full';
	else :
		$content = 'none';
	endif;

	$cols = ( $t_em['archive_in_columns'] > 1 || $t_em['excerpt_set'] == 'thumbnail-center' ) ? true : null;

	if ( have_posts() ) :
		if ( $cols ) :
			echo '<div class="row">';
			$i = 0;
		endif;

		while ( have_posts() ) :
			the_post();
			if ( $cols && 0 == $i % $t_em['archive_in_columns'] ) :
				echo '</div>';
				echo '<div class="row">';
			endif;
			get_template_part( '/template-parts/content', $content );
			if ( $cols ) :
				$i++;
			endif;
		endwhile;

		if ( $cols ) :
			echo '</div>';
		endif;
	else :
		get_template_part( '/template-parts/content', 'none' );
	endif;
}
endif; // function t_em_loop()

?>
