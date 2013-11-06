<?php
/**
 * Is the query for the blog homepage?
 * This is the page which shows the time based blog content of your site.
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_for_posts'.
 * If you set a static page for the front page of your site, this file will be returned only on the
 * page you set as the "Posts page".
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_breadcrumb(); ?>

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

			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
