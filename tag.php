<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

	<div id="content" role="main" class="span8">
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
	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
