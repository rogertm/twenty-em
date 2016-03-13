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
 * Template Name: Tabs Content
 *
 * The template for displaying all child pages of the current page in tabs style.
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class( 'content' ); ?>">
				<?php t_em_action_content_before(); ?>
				<div id="tabbable-<?php echo get_the_ID(); ?>" class="custom-template custom-template-tabs" role="tabpanel">
<?php
	// Display all child pages of current page.
	$args = array(
		'sort_column'	=> 'menu_order',
		'sort_order'	=> 'ASC',
		'child_of'		=> $post->ID,
	);
	$child_pages = get_pages( $args );
?>
					<ul id="tabbable-list" class="nav nav-tabs">
<?php
	foreach ( $child_pages as $page ) :
		$content = $page->post_content;
		// Check for empty pages
		if ( ! $content ) continue;
			$content = apply_filters( 'the_content', $content );
?>
						<li><a href="#tab-<?php echo $page->ID; ?>" data-toggle="tab">
							<?php echo $page->post_title; ?>
						</a></li>
<?php
	endforeach;
?>
					</ul>
					<div id="tabbable-content" class="tab-content">
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
				</div><!-- #tabbable-## -->
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>