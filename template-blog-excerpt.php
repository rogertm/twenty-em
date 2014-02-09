<?php
/**
 * Template Name: Blog Excerpt (summary)
 *
 * A custom page template to display a blog excerpt summary.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-blog-excerpt.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-blog-excerpt.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

			<?php t_em_template_content() ?>

			<?php
			// Query for Custom Loop
			$args = array ( 'post_type' => 'post',
							'posts_per_page' => get_option( 'posts_per_page' ),
							'paged' => get_query_var( 'paged' )
					);
			$wp_query = new WP_Query ( $args );
			?>
			<?php if ( have_posts() ) : ?>
				<div class="row">
			<?php
				$i = 0;
				while ( have_posts() ) : the_post();
					if ( 0 == $i % $t_em_theme_options['archive_in_columns'] ) :
						echo '</div>';
						echo '<div class="row">';
					endif;
					get_template_part( 'content', get_post_format() );
					$i++;
				endwhile;
			?>
				</div><!-- .row -->
			<?php
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>

				<?php t_em_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
