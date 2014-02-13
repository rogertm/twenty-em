<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

			<?php if ( have_posts() ) : ?>
				<header>
					<h1 class="page-header"><?php printf( __( 'Search Results for: %s', 't_em' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
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
