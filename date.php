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

<div id="main" class="wrapper container-fluid">
	<div class="row-fluid">
		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_breadcrumb(); ?>

<?php
	/* Queue the first post, that way we know what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop properly with a call to rewind_posts().
	 */
	if ( have_posts() ) :
		the_post();
?>
			<header>
				<h1 class="page-title">
				<?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: <span>%s</span>', 't_em' ), get_the_date() );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: <span>%s</span>', 't_em' ), get_the_date('F Y') );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: <span>%s</span>', 't_em' ), get_the_date('Y') );
				else :
					_e( 'Blog Archives', 't_em' );
				endif;
				?>
				</h1>
			</header>
<?php
	/* Since we called the_post() above, we need to rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	// Run the loop for the archives page to output the posts.
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
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>
	</div><!-- .row-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
