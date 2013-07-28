<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<div class="row-fluid">
		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_breadcrumb(); ?>

		<header>
			<h1 class="page-title"><?php
				printf( __( 'Tag Archives: %s', 't_em' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			?></h1>
		</header>

<?php
// Run the loop for the tag archive to output the posts
		t_em_page_navi( 'nav-above' );
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
		t_em_page_navi( 'nav-below' );
		else :
			get_template_part( 'content', 'none' );
		endif;
?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>
	</div><!-- .row-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
