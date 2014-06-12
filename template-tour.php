<?php
/**
 * Template Name: Tour
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

		<section id="main-content" class="col-md-12">
			<section id="content" role="main" class="col-md-12">
				<?php t_em_hook_content_before(); ?>
<?php
	// Display all child pages of current page.
	$args = array (
		'sort_column'	=> 'menu_order',
		'sort_order'	=> 'ASC',
		'child_of'		=> $post->ID,
	);
	$child_pages = get_pages( $args );
?>
				<div id="tourable" class="tabbable tabs-left">
					<ul id="tourable-list" class="nav nav-tabs">
<?php
	foreach ( $child_pages as $page ) :
		$content = $page->post_content;
		// Check for empty pages
		if ( ! $content ) continue;
			$content = apply_filters( 'the_content', $content );
?>
						<li><a href="#tab-<?php echo $page->ID; ?>" data-toggle="tab">
							<h4><?php echo $page->post_title; ?></h4>
						</a></li>
<?php
	endforeach;
?>
					</ul>
					<div id="tourable-content" class="tab-content">
<?php
	foreach ( $child_pages as $page ) :
		$content = $page->post_content;
		// Check for empty pages
		if ( ! $content ) continue;
			$content = apply_filters( 'the_content', $content );
?>
						<article id="tab-<?php echo $page->ID ?>" class="tab-pane">
							<div class="entry-content">
								<?php echo $content; ?>
							</div>
							<footer class="entry-utility">
								<?php edit_post_link( __( 'Edit', 't_em' ), '<span class="icomoon-edit icomoon"></span><span class="edit-link">', '</span>', $page->ID ); ?>
							</footer>
						</article>
<?php
	endforeach;
?>
					</div><!-- .tab-content -->
				</div><!-- .tabbable .tabs-left -->

				<?php t_em_hook_content_after(); ?>
			</section><!-- #content -->
		</section>

<?php get_footer(); ?>
