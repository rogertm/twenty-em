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


if ( ! function_exists( 't_em_top_menu' ) ) :
/**
 * Pluggable Function: Top menu.
 * This function is attached to the t_em_action_header_before() action hook
 */
function t_em_top_menu(){
?>
	<div id="top-menu" role="navigation">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
			<?php do_action( 't_em_action_top_menu_navbar_before' ) ?>
			<?php
				/**
				 * Filter the navbar brand
				 *
				 * @param string $brand HTML containing the navbar brand
				 */
				$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'span';
				$brand = get_custom_logo() . '<'. $heading_tag .' id="site-title"><a href="'. home_url( '/' ) .'" class="navbar-brand" rel="home">'. get_bloginfo( 'name' ) .'</a></'. $heading_tag .'>';
				echo apply_filters( 't_em_filter_top_menu_brand', $brand );
			?>
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#site-top-menu">
					<span class="navbar-toggler-icon"></span>
				</button>
			<?php
				if ( has_nav_menu( 'top-menu' ) ) :
					wp_nav_menu( array(
							/**
							 * Filter the menu depth
							 *
							 * @param int How many levels of the hierarchy are to be included where 0 means all. -1 displays links at any depth and arranges them in a single, flat list.
							 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
							 * @since Twenty'em 1.0
							 */
							'theme_location'	=> 'top-menu',
							'container_id'		=> 'site-top-menu',
							'container_class'	=> 'collapse navbar-collapse',
							'menu_class'		=> 'navbar-nav rm-auto',
							'depth'				=> apply_filters( 't_em_filter_top_menu_depth', 0 ),
						)
					);
				endif;
			?>
			<?php do_action( 't_em_action_top_menu_navbar_after' ) ?>
			</div>
		</nav>
	</div>
<?php
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
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
			<?php do_action( 't_em_action_navigation_menu_navbar_before' ) ?>
			<?php
				/**
				 * Filter the navbar brand
				 *
				 * @param string $brand HTML containing the navbar brand
				 */
				echo apply_filters( 't_em_filter_navigation_menu_brand', $brand = '' );
			?>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#site-navigation-menu" aria-expanded="false">
				<span class="navbar-toggler-icon"></span>
			</button>
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
						'menu_class'		=> 'navbar-nav rm-auto',
						'depth'				=> apply_filters( 't_em_filter_navigation_menu_depth', 0 ),
					)
				);
			?>
			<?php do_action( 't_em_action_navigation_menu_navbar_after' ) ?>
			</div>
		</nav>
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
			'menu_class'		=> 'list-inline text-right',
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

			$args = array(
				'base'					=> $pagenum_link,
				'format'				=> $format,
				'total'					=> $wp_query->max_num_pages,
				'current'				=> $paged,
				'add_args'				=> array_map( 'urlencode', $query_args ),
				'prev_text'				=> __( '<span class="meta-nav icomoon-double-angle-left icomoon"></span> Newer posts', 't_em' ),
				'next_text'				=> __( 'Older posts <span class="meta-nav icomoon-double-angle-right icomoon"></span>', 't_em' ),
				'end_size'				=> 1,
				'mid_size'				=> 2,
				'type'					=> 'list',
				'prev_next'				=> true,
				'add_fragment'			=> null,
				'before_page_number'	=> null,
				'after_page_number'		=> null,
			);

			/**
			 * Filter the paginate link structure
			 *
			 * @param array $args An array of arguments
			 * @link http://codex.wordpress.org/Function_Reference/paginate_links
			 * @since Twenty'em 1.0
			 */
			$links = paginate_links( apply_filters( 't_em_filter_paginate_links', $args ) );
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

	/**
	 * Filter the single link pages structure
	 *
	 * @param array $args Array of arguments
	 *
	 * @since Twenty'em 1.0
	 */
	$content = $content . wp_link_pages( apply_filters( 't_em_filter_single_link_pages', $args ) );
	return $content;
}
endif; // function t_em_single_link_pages()
add_filter( 'the_content', 't_em_single_link_pages' );

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
 * @since Twenty'em 1.0
 */
function t_em_user_social_network( $nav_id = true, $nav_classes = '', $ul_classes = '', $li_classes = '' ){
	global 	$t_em;

	$user_social_network = t_em_social_network_options();
	uasort( $user_social_network, 't_em_sort_by_order' );

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
	t_em_user_social_network( 't-em', '', 'list-inline text-right', 'list-inline-item' );
}
add_action( 't_em_action_site_info_right', 't_em_display_user_social_network' );
?>
