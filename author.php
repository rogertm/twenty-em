<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<section id="main-content" class="row-fluid">
		<section id="content" role="main" class="span8">

<?php
	/* Queue the first post, that way we know who the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop properly with a call to rewind_posts().
	 */
	if ( have_posts() ) :
		the_post();
?>
		<header>
			<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 't_em' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
		</header>
		<?php t_em_author_meta(); ?>

<?php
	/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	// Run the loop for the author archive page to output the authors posts.
	t_em_page_navi( 'nav-above' );
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
