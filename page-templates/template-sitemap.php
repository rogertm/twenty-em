<?php
/**
 * Template Name: Site Map
 *
 * A custom page template to display site map.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-sitemap.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-sitemap.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_action_content_before(); ?>

				<div id="sitemap-<?php echo get_the_ID(); ?>" class="custom-template custom-template-sitemap">


					<?php
					/** Displaying pages list
					 * @link http://codex.wordpress.org/Function_Reference/wp_list_pages
					 */
					?>
					<h3 id="sitemap-pages"><?php _e( 'Pages', 't_em' ); ?></h3>
					<ul><?php wp_list_pages( array( 'title_li' => '', 'sort_column' => 'menu_order' ) ) ?></ul>

					<?php
					/** Displaying a list of categories
					 * @link http://codex.wordpress.org/Template_Tags/wp_list_categories
					 */
					?>
					<h3 id="sitemap-categories"><?php _e( 'Categories', 't_em' ); ?></h3>
					<ul><?php wp_list_categories( array ( 'title_li' => '', 'show_count' => '1' ) ); ?></ul>

					<?php
					/** Displaying posts per category
					 * @link http://codex.wordpress.org/Function_Reference/get_categories
					 */
					?>
					<h3 id="sitemap-posts-per-categories"><?php _e( 'Posts per categories', 't_em' ); ?></h3>
					<?php
					$cats = get_categories();
					foreach ( $cats as $cat ) :
					?>
					<h4><?php echo $cat->cat_name ?></h4>
					<?php
						$posts_per_cat = get_posts( array( 'category' => $cat->cat_ID ) );
						foreach ( $posts_per_cat as $post ) : setup_postdata( $post );
					 ?>
						<ul>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
								<small> - <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></small>
							</li>
						</ul>
					<?php
						endforeach; wp_reset_postdata();
					endforeach;
					?>
				</div><!-- #sitemap-## -->
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
