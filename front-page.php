<?php
/**
 * Is the query for the front page of the site?
 * This is for what is displayed at your site's main URL.
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_on_front'.
 * If you set a static page for the front page of your site, this file will be returned when viewing
 * that page.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>
			<section id="main-content" class="<?php echo t_em_add_bootstrap_class('main-content'); ?>">
				<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
<?php if ( 'wp-front-page' == $t_em['front_page_set'] ) :
					t_em_hook_content_before();
					t_em_hook_wp_front_page();
					t_em_hook_content_after(); ?>
				</section><!-- #content -->
				<?php get_sidebar(); ?>
			</section><!-- #main-content -->
			<?php get_sidebar( 'alt' ); ?>
<?php elseif ( 'widgets-front-page' == $t_em['front_page_set'] ) :
					t_em_hook_custom_front_page_before();
					t_em_hook_custom_front_page();
					t_em_hook_custom_front_page_after(); ?>
				</section><!-- #content -->
			</section><!-- #main-content -->
<?php endif; ?>

<?php get_footer(); ?>
