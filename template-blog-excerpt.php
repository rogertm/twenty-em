<?php
/**
 * Template Name: Blog Excerpt (summary)
 *
 * A custom page template to display a blog excerpt summary.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-blog-excerpt.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-blog-excerpt.php
 * @link			http://codex.wordpress.org/Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<div class="row-fluid">
		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">

				<article id="post-<?php the_ID(); ?>">
<?php
if ( have_posts() ) :
	$template_data = get_page( get_the_ID() );
?>
					<header>
						<h1 class="entry-title"><?php echo $template_data->post_title; ?></h1>
					</header>
<?php
	while ( have_posts() ) : the_post(); ?>
					<div class="entry-content"><?php the_content(); ?></div>
<?php
	endwhile;
?>
				</article>
<?php
// Query for Custom Loop
	$args = array ( 'post_type' => 'post',
					'posts_per_page' => get_option( 'posts_per_page' ),
					'paged' => get_query_var( 'paged' )
			);
	$wp_query = new WP_Query ( $args );

	t_em_page_navi( 'nav-above' );

// Start the Custom Loop
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile;

	t_em_page_navi( 'nav-below' );

	else :
		get_template_part( 'content', 'none' );
	endif;
	wp_reset_query();
?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>
	</div><!-- .row-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
