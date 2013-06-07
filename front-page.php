<?php
/**
 * Is the query for the front page of the site?
 * This is for what is displayed at your site's main URL.
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_on_front'.
 * If you set a static page for the front page of your site, this file will be returned when viewing
 * that page.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @since Twenty'em 0.1
 */

get_header(); ?>

	<div id="main" class="wrapper container-fluid">
		<div class="row-fluid">
<?php
if ( 'wp-front-page' == $t_em_theme_options['front-page-set'] ) :
?>
			<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
				<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
<?php
	// If our front page is a static page, we load it
	$front_page = get_option( 'show_on_front' ) ;
	if ( 'page' == $front_page ) :

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
						<?php if ( is_front_page() ) : ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php else : ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php endif; ?>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
							<?php t_em_edit_post_link(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-## -->
<?php
			endwhile;
		endif; // have_posts()
	// Else, we display a list of post
	else :
		if ( have_posts() ) :
			t_em_page_navi( 'nav-above' );
			// Start the Loop
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			t_em_page_navi( 'nav-below' );
		else :
			get_template_part( 'content', 'none' );
		endif;
	endif;
?>
				</section><!-- #content -->
				<?php get_sidebar(); // We display the sidebar just in an ordinary WordPress front page ?>
			</section><!-- #main-content -->
			<?php get_sidebar( 'alt' ); ?>
<?php
elseif ( 'widgets-front-page' == $t_em_theme_options['front-page-set'] ) :
?>
			<section id="main-content">
				<section id="content" role="main" class="span12">
					<section id="featured-widget-area">
						<?php t_em_front_page_widgets( 'one', 'btn btn-large btn-primary', 'h2' ); ?>
						<div class="row-fluid">
							<?php t_em_front_page_widgets( 'two', 'btn' ); ?>
							<?php t_em_front_page_widgets( 'three', 'btn' ); ?>
							<?php t_em_front_page_widgets( 'four', 'btn' ); ?>
						</div>
					</section><!-- #featured-widget-area -->
				</section><!-- #content -->
			</section><!-- #main-content-->
<?php endif; ?>
		</div><!-- .row-fluid -->
	</div><!-- #main .container-fluid -->

<?php get_footer(); ?>
