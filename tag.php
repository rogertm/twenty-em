<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
                <header>
    				<h1 class="page-title"><?php
    					printf( __( 'Tag Archives: %s', 't_em' ), '<span>' . single_tag_title( '', false ) . '</span>' );
    				?></h1>
                </header>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
