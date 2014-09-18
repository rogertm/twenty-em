<?php
/**
 * Template Name: Archive
 *
 * A custom page template to display site archive.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-archive.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-archive.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_action_content_before(); ?>

				<div id="archive-<?php echo get_the_ID(); ?>" class="custom-template custom-template-archive">
<?php
/**
 * Start the archive page. Displays the latest $limit posts, list of categories, monthly
 * archive and a tag cloud.
 */

// Displaying the latest $limit posts
$limit = '30';
$args = array ( 'post_type' => 'post',
				'showposts' => $limit,
		);
?>
					<h3 id="archive-latest-posts"><?php echo sprintf( __( 'The latest %1$s posts', 't_em' ), $limit ); ?></h3>
<?php
$wp_query = new WP_Query ( $args );

if ( have_posts() ) :
?>
					<ul>
<?php while ( have_posts() ) : the_post(); ?>
						<li id="post-<?php the_ID() ?>">
							<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							<small> - <?php echo get_the_date(); ?>
								    - <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></small>
						</li>
<?php endwhile; ?>
					</ul>
<?php endif; wp_reset_query(); ?>

					<?php
					/** Displaying a list of categories
					 * @link http://codex.wordpress.org/Template_Tags/wp_list_categories
					 */
					?>
					<h3 id="archive-categories"><?php _e( 'Categories', 't_em' ); ?></h3>
					<ul><?php wp_list_categories( array ( 'title_li' => '', 'show_count' => '1' ) ); ?></ul>

					<?php
					/** Displaying the monthly archive
					 * @link http://codex.wordpress.org/Function_Reference/wp_get_archives
					 */
					?>
					<h3 id="archive-monthly-archive"><?php _e( 'Monthly Archives', 't_em' ) ?></h3>
					<ul><?php wp_get_archives( array ( 'show_post_count' => true ) ); ?></ul>

					<?php
					/** And now, the Tag Cloud!
					 * @link http://codex.wordpress.org/Function_Reference/wp_tag_cloud
					 */
					?>
					<h3 id="archive-tag-cloud"><?php _e( 'Tag Cloud', 't_em' ); ?></h3>
					<div><?php wp_tag_cloud( array ( 'number' => '0' ) ); ?></div>

				</div><!-- #archive-## -->
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
