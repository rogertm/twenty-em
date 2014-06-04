<?php
/**
 * Twenty'em Hooks definitions.
 *
 * @file			hooks.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/hooks.php
 * @link			http://codex.wordpress.org/Plugin_API/Hooks
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Fire the t_em_hook_head action, just before </head> tag.
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_head(){
	do_action( 't_em_hook_head' );
}

/**
 * Fire the t_em_hook_top action, just after opening <body> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_top(){
	do_action( 't_em_hook_top' );
}

/**
 * Fire the t_em_hook_header_before action, just after opening <header id="header"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_header_before(){
	do_action( 't_em_hook_header_before' );
}

/**
 * Fire the t_em_hook_header_inside_before action, just after opening <div id="branding"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_header_inside_before(){
	do_action( 't_em_hook_header_inside_before' );
}

/**
 * Fire the t_em_hook_header_inside action, just after opening <div id="branding"><div class="branding-inner">
 * tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_header_inside(){
	do_action( 't_em_hook_header_inside' );
}

/**
 * Fire the t_em_hook_header_inside_after action, just before closing </section><!-- #masthead --> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_header_inside_after(){
	do_action( 't_em_hook_header_inside_after' );
}

/**
 * Fire the t_em_hook_header_after action, just after closing </header><!-- #header --> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_header_after(){
	do_action( 't_em_hook_header_after' );
}

/**
 * Fire the t_em_hook_main_before action, just after opening <div id="main"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0
 */
function t_em_hook_main_before(){
	do_action( 't_em_hook_main_before' );
}

/**
 * Fire the t_em_hook_main_after action, just before closing </div><!-- #main .container --> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_main_after(){
	do_action( 't_em_hook_main_after' );
}

/**
 * Fire the t_em_hook_wp_front_page action, between t_em_hook_content_before and
 * t_em_hook_content_after action hook.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_wp_front_page(){
	do_action( 't_em_hook_wp_front_page' );
}

/**
 * Fire the t_em_hook_custom_front_page action, between t_em_hook_custom_front_page_before and
 * t_em_hook_custom_front_page_after action hook.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_custom_front_page(){
	do_action( 't_em_hook_custom_front_page' );
}

/**
 * Fire the t_em_hook_custom_front_page_inside_before action just after opening the
 * <section id="featured-widget-area"> tag
 *
 * @file functions.php via t_em_display_front_page_widgets() function
 * @since Twenty'em 1.0
 */
function t_em_hook_custom_front_page_inside_before(){
	do_action( 't_em_hook_custom_front_page_inside_before' );
}

/**
 * Fire the t_em_hook_custom_front_page_inside_after action just before closing the
 * </section><!-- #featured-widget-area --> tag
 *
 * @file functions.php via t_em_display_front_page_widgets() function
 * @since Twenty'em 1.0
 */
function t_em_hook_custom_front_page_inside_after(){
	do_action( 't_em_hook_custom_front_page_inside_after' );
}

/**
 * Fire the t_em_hook_content_before action, just after opening <section id="content"> tag
 *
 * @files archive.php, attachment.php, author.php, category.php, date.php, front-page.php
 * home.php, index.php, pahe.php, search.php, single.php, tag.php, taxonomy.php,
 * taqxonomy-$taxonomy-$term.php, template-$template_name.php
 * @since Twenty'em 1.0
 */
function t_em_hook_content_before(){
	do_action( 't_em_hook_content_before' );
}

/**
 * Fire the t_em_hook_content_after action, just before closing </section><!-- #content --> tag
 *
 * @files archive.php, attachment.php, author.php, category.php, date.php, front-page.php
 * home.php, index.php, pahe.php, search.php, single.php, tag.php, taxonomy.php,
 * taqxonomy-$taxonomy-$term.php, template-$template_name.php
 * @since Twenty'em 1.0
 */
function t_em_hook_content_after(){
	do_action( 't_em_hook_content_after' );
}


/**
 * Fire the t_em_hook_front_page_widgets_before, just after opening <section id="content"> tag.
 * Requires Text Widgets Option to be enable if Front Page Options in the Twenty'em admin panel.
 * $t_em['front_page_set'] == 'widgets-front-page'.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_front_page_widgets_before(){
	do_action( 't_em_hook_front_page_widgets_before' );
}

/**
 * Fire the t_em_hook_front_page_widgets_after, just before closing </section><!-- #content --> tag.
 * Requires Text Widgets Option to be enable if Front Page Options in the Twenty'em admin panel.
 * $t_em['front_page_set'] == 'widgets-front-page'.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_front_page_widgets_after(){
	do_action( 't_em_hook_front_page_widgets_after' );
}

/**
 * Fire the t_em_hook_custom_front_page_before, just after opening <section id="featured-widget-area"> tag.
 * Requires Text Widgets Option to be enable if Front Page Options in the Twenty'em admin panel.
 * $t_em['front_page_set'] == 'widgets-front-page'.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_custom_front_page_before(){
	do_action( 't_em_hook_custom_front_page_before' );
}

/**
 * Fire the t_em_hook_custom_front_page_after, just before closing <section> <!-- #featured-widget-area --> tag.
 * Requires Text Widgets Option to be enable if Front Page Options in the Twenty'em admin panel.
 * $t_em['front_page_set'] == 'widgets-front-page'.
 *
 * @file front-page.php
 * @since Twenty'em 1.0
 */
function t_em_hook_custom_front_page_after(){
	do_action( 't_em_hook_custom_front_page_after' );
}

/**
 * Fire the t_em_hook_post_before action, just before opening <article id="post-##"> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_before(){
	do_action( 't_em_hook_post_before' );
}

/**
 * Fire the t_em_hook_post_after action, just after closing </article><!-- #post-## --> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_after(){
	do_action( 't_em_hook_post_after' );
}

/**
 * Fire the t_em_hook_post_inside_before action, just after opening <article id="post-##"> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_inside_before(){
	do_action( 't_em_hook_post_inside_before' );
}

/**
 * Fire the t_em_hook_post_inside_after action, just before closing </article><!-- #post-## --> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_inside_after(){
	do_action( 't_em_hook_post_inside_after' );
}

/**
 * Fire the t_em_hook_post_content_before action, just before opening <div class="entry-content"> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_content_before(){
	do_action( 't_em_hook_post_content_before' );
}

/**
 * Fire the t_em_hook_post_content_after action, just after closing </div><!-- .entry-content --> tag
 *
 * @file single.php
 * @since Twenty'em 1.0
 */
function t_em_hook_post_content_after(){
	do_action( 't_em_hook_post_content_after' );
}

/**
 * Fire the t_em_hook_comments_list_before action, just before opening <ul class="commentlist media-list"> tag
 *
 * @file comments.php
 * @since Twenty'em 1.0
 */
function t_em_hook_comments_list_before(){
	do_action( 't_em_hook_comments_list_before' );
}

/**
 * Fire the t_em_hook_comments_list_after action, just after closing </ul> <!-- .commentlist .media-list --> tag
 *
 * @file comments.php
 * @since Twenty'em 1.0
 */
function t_em_hook_comments_list_after(){
	do_action( 't_em_hook_comments_list_after' );
}

/**
 * Fire the t_em_hook_sidebar_before action, just after opening the <section id="sidebar"> tag
 *
 * @file sidebar.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_before(){
	do_action( 't_em_hook_sidebar_before' );
}

/**
 * Fire the t_em_hook_sidebar_after action, just before closing the </section><!-- #sidebar --> tag
 *
 * @file sidebar.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_after(){
	do_action( 't_em_hook_sidebar_after' );
}

/**
 * Fire the t_em_hook_sidebar_alt_before action, just after opening the <section id="sidebar"> tag
 *
 * @file sidebar-alt.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_alt_before(){
	do_action( 't_em_hook_sidebar_alt_before' );
}

/**
 * Fire the t_em_hook_sidebar_alt_after action, just before closing the </section><!-- #sidebar --> tag
 *
 * @file sidebar-alt.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_alt_after(){
	do_action( 't_em_hook_sidebar_alt_after' );
}

/**
 * Fire the t_em_hook_sidebar_footer_before action, just after opening the <section id="footer-widget-area">
 * tag
 *
 * @file sidebar-footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_footer_before(){
	do_action( 't_em_hook_sidebar_footer_before' );
}

/**
 * Fire the t_em_hook_sidebar_footer_after action, just after opening the <section id="footer-widget-area">
 * tag
 *
 * @file sidebar-footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_sidebar_footer_after(){
	do_action( 't_em_hook_sidebar_footer_after' );
}

/**
 * Fire the t_em_hook_site_info_before action, just after opening the <div id="site-info-before"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_site_info_before(){
	do_action( 't_em_hook_site_info_before' );
}

/**
 * Fire the t_em_hook_site_info_after action, just after opening the <div id="site-info-after"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_site_info_after(){
	do_action( 't_em_hook_site_info_after' );
}

/**
 * Fire the t_em_hook_site_info_left action, just after opening the <div id="site-info-left"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_site_info_left(){
	do_action( 't_em_hook_site_info_left' );
}

/**
 * Fire the t_em_hook_site_info_right action, just after opening the <div id="site-info-right"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_site_info_right(){
	do_action( 't_em_hook_site_info_right' );
}

/**
 * Fire the t_em_hook_footer_before action, just after opening the <footer id="footer"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_footer_before(){
	do_action( 't_em_hook_footer_before' );
}

/**
 * Fire the t_em_hook_footer_after action, just after closing the </footer><!-- #footer --> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_footer_after(){
	do_action( 't_em_hook_footer_after' );
}

/**
 * Fire the t_em_hook_foot action, just before closing the </body> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0
 */
function t_em_hook_foot(){
	do_action( 't_em_hook_foot' );
}
?>
