<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

<?php
	/* Queue the first post, that way we know who the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop properly with a call to rewind_posts().
	 */
	if ( have_posts() ) :
		$i = 0;
		the_post();
?>
		<header>
			<h1 class="page-header author"><?php printf( __( 'Author Archives: %s', 't_em' ), "<span><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
		</header>
		<?php t_em_author_meta(); ?>

<?php
	/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();
?>
				<div class="row">
<?php
	while ( have_posts() ) : the_post();
		if ( 0 == $i % $t_em['archive_in_columns'] ) :
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
