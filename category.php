<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<section id="main-content" class="row-fluid">
		<section id="content" role="main" class="span8">

		<header>
			<h1 class="page-title"><?php
				printf( __( 'Category Archives: %s', 't_em' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?></h1>
		</header>
		<?php
			$category_description = category_description();
			if ( ! empty( $category_description ) ) :
				echo '<div id="category-description" class="archive-meta well">' . $category_description . '</div>';
			endif;

		// Run the loop for the category page to output the posts.
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
	</section><!-- #main-content .rwo-fluid -->
	<?php get_sidebar( 'alt' ); ?>
</div><!-- #main -->

<?php get_footer(); ?>
