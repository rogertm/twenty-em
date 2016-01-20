<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			http://twenty-em.com/
 * @since 			Twenty'em 1.0
 */

/**
 * Template Name: Collapsible Content
 *
 * The template for displaying all child pages of the current page in accordion style.
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
				<?php t_em_action_content_before(); ?>
				<div id="collapsible-<?php echo get_the_ID(); ?>" class="custom-template custom-template-collapsible-content" role="tablist">
<?php
	// Display all child pages of the current page.
	$args = array(
		'sort_column'	=> 'menu_order',
		'sort_order'	=> 'ASC',
		'child_of'		=> $post->ID,
	);
	$child_pages = get_pages( $args );
?>
					<div id="accordion-box" class="panel-group">
<?php
	foreach ( $child_pages as $page ) :
		$content = $page->post_content;
		// Check for empty pages
		if ( ! $content ) continue;
			$content = apply_filters( 'the_content', $content );
?>
						<article id="post-<?php echo $page->ID ?>" class="panel panel-default">
							<header class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapse-<?php echo $page->ID ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-box">
										<?php echo $page->post_title; ?><span class="icomoon-arrow-down icomoon pull-right"></span>
									</a>
								</h4>
							</header>
							<div id="collapse-<?php echo $page->ID ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<?php echo $content; ?>
								</div><!-- .accordion-inner -->
								<footer class="entry-utility">
									<?php edit_post_link( __( 'Edit', 't_em' ), '<span class="icomoon-edit icomoon"></span><span class="edit-link">', '</span>', $page->ID ); ?>
								</footer>
							</div><!-- #collapse-## .entry-content -->
						</article><!-- .panel panel-default -->
<?php
	endforeach;
?>
					</div><!-- #accordion-box .panel-group -->
				</div><!-- #collapsible-## -->
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
