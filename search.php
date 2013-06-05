<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

	<section id="content" role="main" class="span8">

<?php if ( have_posts() ) : ?>
		<header>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 't_em' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>
<?php
// Run the loop for the search to output the results.
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
<?php get_footer(); ?>
