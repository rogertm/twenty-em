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
 * @since			Twenty'em 1.0.1
 */
?>
<?php
/**
 * Fire the t_em_head action, just before </head> tag.
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_head(){
	do_action( 't_em_head' );
}

/**
 * Fire the t_em_top action, just after opening <body> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_top(){
	do_action( 't_em_top' );
}

/**
 * Fire the t_em_header_before action, just after opening <header id="header"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_header_before(){
	do_action( 't_em_header_before' );
}

/**
 * Fire the t_em_header_inside_before action, just after opening <div id="branding"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_header_inside_before(){
	do_action( 't_em_header_inside_before' );
}

/**
 * Fire the t_em_header_inside action, just after opening <div id="branding"><div class="wrapper row-fluid">
 * tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_header_inside(){
	do_action( 't_em_header_inside' );
}

/**
 * Fire the t_em_header_inside_after action, just before closing </section><!-- #masthead --> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_header_inside_after(){
	do_action( 't_em_header_inside_after' );
}

/**
 * Fire the t_em_header_after action, just after closing </header><!-- #header --> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_header_after(){
	do_action( 't_em_header_after' );
}

/**
 * Fire the t_em_main_before action, just after opening <div id="main"> tag
 *
 * @file header.php
 * @since Twenty'em 1.0.1
 */
function t_em_main_before(){
	do_action( 't_em_main_before' );
}

/**
 * Fire the t_em_main_after action, just before closing </div><!-- #main .container-fluid --> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_main_after(){
	do_action( 't_em_main_after' );
}

/**
 * Fire the t_em_content_before action, just after opening <section id="content"> tag
 *
 * @files 404.php, archive.php, attachment.php, author.php, category.php, date.php, front-page.php
 * home.php, index.php, pahe.php, search.php, single.php, tag.php, taxonomy.php,
 * taqxonomy-$taxonomy-$term.php, template-$template_name.php
 * @since Twenty'em 1.0.1
 */
function t_em_content_before(){
	do_action( 't_em_content_before' );
}

/**
 * Fire the t_em_content_after action, just before closing </section><!-- #content --> tag
 *
 * @files 404.php, archive.php, attachment.php, author.php, category.php, date.php, front-page.php
 * home.php, index.php, pahe.php, search.php, single.php, tag.php, taxonomy.php,
 * taqxonomy-$taxonomy-$term.php, template-$template_name.php
 * @since Twenty'em 1.0.1
 */
function t_em_content_after(){
	do_action( 't_em_content_after' );
}

/**
 * Fire the t_em_post_before action, just before opening <article id="post-##"> tag
 *
 * @file single.php
 * @since Twenty'em 1.0.1
 */
function t_em_post_before(){
	do_action( 't_em_post_before' );
}

/**
 * Fire the t_em_post_after action, just after closing </article><!-- #post-## --> tag
 *
 * @file single.php
 * @since Twenty'em 1.0.1
 */
function t_em_post_after(){
	do_action( 't_em_post_after' );
}

/**
 * Fire the t_em_post_inside_before action, just after opening <article id="post-##"> tag
 *
 * @file single.php
 * @since Twenty'em 1.0.1
 */
function t_em_post_inside_before(){
	do_action( 't_em_post_inside_before' );
}

/**
 * Fire the t_em_post_inside_after action, just before closing </article><!-- #post-## --> tag
 *
 * @file single.php
 * @since Twenty'em 1.0.1
 */
function t_em_post_inside_after(){
	do_action( 't_em_post_inside_after' );
}

/**
 * Fire the t_em_page_before action, just before opening <article id="post-##"> tag
 *
 * @files page.php, template-one-column.php, template-collapsible-content.php
 * @since Twenty'em 1.0.1
 */
function t_em_page_before(){
	do_action( 't_em_page_before' );
}

/**
 * Fire the t_em_page_after action, just after closing </article><!-- #post-## --> tag
 *
 * @files page.php, template-one-column.php, template-collapsible-content.php
 * @since Twenty'em 1.0.1
 */
function t_em_page_after(){
	do_action( 't_em_page_after' );
}

/**
 * Fire the t_em_page_inside_before action, just after opening <article id="post-##"> tag
 *
 * @files page.php, template-one-column.php
 * @since Twenty'em 1.0.1
 */
function t_em_page_inside_before(){
	do_action( 't_em_page_inside_before' );
}

/**
 * Fire the t_em_page_inside_after action, just before closing </article><!-- #post-## --> tag
 *
 * @files page.php, template-one-column.php
 * @since Twenty'em 1.0.1
 */
function t_em_page_inside_after(){
	do_action( 't_em_page_inside_after' );
}

/**
 * Fire the t_em_template_content action, just before opening <article id="post-##"> tag
 *
 * @files template-$template_name.php
 * @since Twenty'em 1.0.1
 */
function t_em_template_content(){
	do_action( 't_em_template_content' );
}

/**
 * Fire the t_em_sidebar_before action, just after opening the <section id="sidebar"> tag
 *
 * @file sidebar.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_before(){
	do_action( 't_em_sidebar_before' );
}

/**
 * Fire the t_em_sidebar_after action, just before closing the </section><!-- #sidebar --> tag
 *
 * @file sidebar.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_after(){
	do_action( 't_em_sidebar_after' );
}

/**
 * Fire the t_em_sidebar_alt_before action, just after opening the <section id="sidebar"> tag
 *
 * @file sidebar-alt.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_alt_before(){
	do_action( 't_em_sidebar_alt_before' );
}

/**
 * Fire the t_em_sidebar_alt_after action, just before closing the </section><!-- #sidebar --> tag
 *
 * @file sidebar-alt.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_alt_after(){
	do_action( 't_em_sidebar_alt_after' );
}

/**
 * Fire the t_em_sidebar_footer_before action, just after opening the <section id="footer-widget-area">
 * tag
 *
 * @file sidebar-footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_footer_before(){
	do_action( 't_em_sidebar_footer_before' );
}

/**
 * Fire the t_em_sidebar_footer_after action, just after opening the <section id="footer-widget-area">
 * tag
 *
 * @file sidebar-footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_sidebar_footer_after(){
	do_action( 't_em_sidebar_footer_after' );
}

/**
 * Fire the t_em_site_info action, just after opening the <div id="inner-site-info"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_site_info(){
	do_action( 't_em_site_info' );
}

/**
 * Fire the t_em_footer_before action, just after opening the <footer id="footer"> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_footer_before(){
	do_action( 't_em_footer_before' );
}

/**
 * Fire the t_em_footer_after action, just after closing the </footer><!-- #footer --> tag
 *
 * @file footer.php
 * @since Twenty'em 1.0.1
 */
function t_em_footer_after(){
	do_action( 't_em_footer_after' );
}
?>