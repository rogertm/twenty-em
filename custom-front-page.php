<?php
/**
 * If Custom Front Page option is active in the admin panel, this file is loaded before home.php
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 1.0
 */

get_header(); ?>
			<section id="main-content" class="<?php echo t_em_add_bootstrap_class('main-content'); ?>">
				<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
				<?php t_em_front_page_widgets(); ?>
				</section><!-- #content -->
			</section><!-- #main-content -->
<?php get_footer(); ?>
