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
 * @since 			Twenty'em 1.0
 */

/**
 * If Custom Front Page option is active in the admin panel, this file is loaded before home.php
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>
			<section id="main-content" <?php t_em_add_bootstrap_class( 'main-content' ); ?>>
				<section id="content" role="main" <?php t_em_add_bootstrap_class( 'content' ); ?>>
				<?php t_em_action_custom_front_page_before(); ?>
				<?php t_em_front_page_widgets(); ?>
				<?php t_em_action_custom_front_page_after(); ?>
				</section><!-- #content -->
			</section><!-- #main-content -->
<?php get_footer(); ?>
