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
<?php
if ( 'wp-front-page' == $t_em_theme_options['front_page_set'] ) :
?>
			<section id="main-content" class="<?php echo t_em_add_bootstrap_class('main-content'); ?>">
				<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
				<?php t_em_content_before(); ?>
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
?>
			<div class="row">
		<?php
		if ( have_posts() ) :
			$i = 0;
			while ( have_posts() ) : the_post();
				if ( 0 == $i % $t_em_theme_options['archive_in_columns'] ) :
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
	endif;
?>
					<?php t_em_content_after(); ?>
				</section><!-- #content -->
				<?php get_sidebar(); // We display the sidebar just in an ordinary WordPress front page ?>
			</section><!-- #main-content -->
			<?php get_sidebar( 'alt' ); ?>
<?php
elseif ( 'widgets-front-page' == $t_em_theme_options['front_page_set'] ) :
?>
			<section id="main-content" class="row">
				<section id="content" role="main" class="col-md-12">
					<?php t_em_front_page_widgets_before(); ?>
					<section id="featured-widget-area" class="text-center">
						<?php t_em_front_page_widgets( 'one', 'btn btn-large btn-primary', 'h2' ); ?>
						<div class="row">
							<?php t_em_front_page_widgets( 'two', 'btn' ); ?>
							<?php t_em_front_page_widgets( 'three', 'btn' ); ?>
							<?php t_em_front_page_widgets( 'four', 'btn' ); ?>
						</div>
					</section><!-- #featured-widget-area -->
					<?php t_em_front_page_widgets_after(); ?>
				</section><!-- #content -->
			</section><!-- #main-content-->
<?php endif; ?>

<?php get_footer(); ?>
