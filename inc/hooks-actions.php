<?php
/**
 * Twenty'em Actions hooks.
 *
 * @file			hooks-actions.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/hooks-actions.php
 * @link			http://codex.wordpress.org/Plugin_API/Hooks
 * @since			Twenty'em 1.0
 */
?>
<?php
if ( ! function_exists( 't_em_hook_action_header_options_set' ) ) :
	function t_em_hook_action_header_options_set(){
		add_action( 't_em_header_inside', 't_em_header_options_set', 9 );
	}
endif;

if ( ! function_exists( 't_em_hook_action_single_post_thumbnail' ) ) :
	function t_em_hook_action_single_post_thumbnail(){
		add_action( 't_em_post_inside_before', 't_em_single_post_thumbnail' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_custom_template_content' ) ) :
	function t_em_hook_action_custom_template_content(){
		add_action( 't_em_template_content', 't_em_custom_template_content' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_user_social_network' ) ) :
	function t_em_hook_action_user_social_network(){
		add_action( 't_em_site_info', 't_em_hook_user_social_network', 11 );
	}
endif;

if ( ! function_exists( 't_em_hook_action_single_related_posts' ) ) :
	function t_em_hook_action_single_related_posts(){
		add_action( 't_em_post_after', 't_em_single_related_posts' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_breadcrumb' ) ) :
	function t_em_hook_action_breadcrumb(){
		add_action( 't_em_content_before', 't_em_breadcrumb' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_javascript_required' ) ) :
	function t_em_hook_action_javascript_required(){
		add_action( 't_em_top', 't_em_javascript_required' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_top_menu' ) ) :
	function t_em_hook_action_top_menu(){
		add_action( 't_em_header_before', 't_em_top_menu' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_navigation_menu' ) ) :
	function t_em_hook_action_navigation_menu(){
		add_action( 't_em_header_inside', 't_em_navigation_menu' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_single_nav_above' ) ) :
	function t_em_hook_action_single_nav_above(){
		add_action( 't_em_post_before', 't_em_single_nav_above' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_single_nav_below' ) ) :
	function t_em_hook_action_single_nav_below(){
		add_action( 't_em_post_after', 't_em_single_nav_below', 9 );
	}
endif;

if ( ! function_exists( 't_em_hook_action_footer_menu' ) ) :
	function t_em_hook_action_footer_menu(){
		add_action( 't_em_site_info', 't_em_footer_menu', 12 );
	}
endif;

if ( ! function_exists( 't_em_hook_action_copy_right' ) ) :
	function t_em_hook_action_copy_right(){
		add_action( 't_em_site_info', 't_em_copy_right' );
	}
endif;

if ( ! function_exists( 't_em_hook_action_dot_com_link' ) ) :
	function t_em_hook_action_dot_com_link(){
		add_action( 't_em_site_info', 't_em_dot_com_link', 13 );
	}
endif;

/**
 * Register all theme action hooks
 */
function t_em_register_action_hooks(){
	t_em_hook_action_header_options_set();
	t_em_hook_action_single_post_thumbnail();
	t_em_hook_action_custom_template_content();
	t_em_hook_action_user_social_network();
	t_em_hook_action_single_related_posts();
	t_em_hook_action_breadcrumb();
	t_em_hook_action_javascript_required();
	t_em_hook_action_top_menu();
	t_em_hook_action_navigation_menu();
	t_em_hook_action_single_nav_above();
	t_em_hook_action_single_nav_below();
	t_em_hook_action_footer_menu();
	t_em_hook_action_copy_right();
	t_em_hook_action_dot_com_link();
}
add_action( 'after_setup_theme', 't_em_register_action_hooks' );
?>
