<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

			<?php t_em_page_navi( 'nav-above' ); ?>
				<div class="row-fluid">
			<?php
			if ( have_posts() ) :
				$i = 0;
				while ( have_posts() ) : the_post();
					if ( 0 == $i % $t_em_theme_options['archive_in_columns'] ) :
						echo '</div>';
						echo '<div class="row-fluid">';
					endif;
					get_template_part( 'content', get_post_format() );
					$i++;
				endwhile;
			?>
				</div><!-- .row-fluid -->
			<?php
				t_em_page_navi( 'nav-below' );
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
