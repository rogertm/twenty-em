<?php
/**
 * Template Name: Collapsible Content
 *
 * The template for displaying all child pages of the current page in accordion style.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_content_before(); ?>

				<div id="accordion-box" class="accordion">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php t_em_page_before(); ?>

					<div class="accordion-group">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header>
								<h1 class="entry-title accordion-heading"><a href="#collapse-<?php the_ID(); ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-box"><?php the_title(); ?><span class="icon-arrow-down font-icon pull-right"></span></a></h1>
							</header>

							<div id="collapse-<?php the_ID(); ?>" class="entry-content accordion-body collapse in">
								<div class="accordion-inner">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
								</div><!-- .accordion-inner -->
								<footer class="entry-utility">
									<?php t_em_edit_post_link(); ?>
								</footer>
							</div><!-- #collapse-## .entry-content -->
						</article><!-- #post-## -->
					</div><!-- .accordion-group -->
<?php
	// Display all child pages of the current page.
	$args = array (
		'sort_column'	=> 'menu_order',
		'sort_order'	=> 'ASC',
		'child_of'		=> $post->ID,
	);
	$child_pages = get_pages( $args );
	foreach ( $child_pages as $page ) :
		$content = $page->post_content;
		// Check for empty pages
		if ( ! $content ) continue;
		$content = apply_filters( 'the_content', $content );
?>
					<div class="accordion-group">
						<article id="post-<?php echo $page->ID ?>" <?php post_class(); ?>>
							<header>
								<h2 class="entry-title accordion-heading"><a href="#collapse-<?php echo $page->ID ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-box"><?php echo $page->post_title; ?><span class="icon-arrow-down font-icon pull-right"></span></a></h2>
							</header>
							<div id="collapse-<?php echo $page->ID ?>" class="entry-content accordion-body collapse">
								<div class="accordion-inner">
									<?php echo $content; ?>
								</div><!-- .accordion-inner -->
								<footer class="entry-utility">
									<?php edit_post_link( __( 'Edit', 't_em' ), '<span class="icon-edit font-icon"></span><span class="edit-link">', '</span>', $page->ID ); ?>
								</footer>
							</div><!-- #collapse-## .entry-content -->
						</article><!-- #post-## -->
					</div><!-- .accordion-group -->
<?php
	endforeach;
?>

					<?php t_em_page_after() ?>
<?php endwhile; ?>
				</div><!-- #accordion-box .accordion -->
				<?php t_em_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>
<?php
	// Register and enqueue bootstrap-collapse.js plugin
	global $t_em_theme_data;
	wp_register_script( 'bootstrap-transition', T_EM_THEME_DIR_JS_URL.'/bootstrap/bootstrap-transition.js', array( 'jquery' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'bootstrap-transition' );
	wp_register_script( 'bootstrap-collapse', T_EM_THEME_DIR_JS_URL . '/bootstrap/bootstrap-collapse.js', array( 'jquery', 'bootstrap-transition' ), $t_em_theme_data['Version'], false );
	wp_enqueue_script( 'bootstrap-collapse' );
?>

<?php get_footer(); ?>
