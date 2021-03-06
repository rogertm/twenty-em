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
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0
 */

/**
 * Template Name: Blog Content (full posts)
 *
 * A custom page template to display a blog content full posts.
 */

get_header(); ?>

		<section id="main-content" <?php t_em_breakpoint( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_breakpoint( 'content' ); ?>>
				<?php do_action( 't_em_action_content_before' ); ?>
				<?php
				// Query for Custom Loop
				/**
				 * Filter this custom query
				 *
				 * @param array Arguments for WP_Query
				 * @since Twenty'em 1.4.0
				 */
				$args = apply_filters( 't_em_filter_template_blog_content_query_args', array(
					'post_type'			=> 'post',
					'posts_per_page'	=> get_option( 'posts_per_page' ),
					'paged'				=> get_query_var( 'paged' )
				) );
				$the_query = new WP_Query ( $args );

				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
						<?php do_action( 't_em_action_post_before' ); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php do_action( 't_em_action_post_inside_before' ); ?>
							<header>
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								<div class="entry-meta entry-meta-header mb-3">
									<?php do_action( 't_em_action_entry_meta_header' ) ?>
								</div><!-- .entry-meta -->
							</header>

							<div class="entry-content">
								<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?>
							</div><!-- .entry-content -->

							<footer class="entry-meta entry-meta-footer mb-3">
								<?php do_action( 't_em_action_entry_meta_footer' ); ?>
							</footer><!-- .entry-meta .entry-meta-footer -->
							<?php do_action( 't_em_action_post_inside_after' ); ?>
						</article><!-- #post-## -->
						<?php do_action( 't_em_action_post_after' ); ?>
				<?php
					endwhile;
				else :
					get_template_part( '/template-parts/content', 'none' );
				endif;
				wp_reset_postdata();
				t_em_page_navi( $the_query );
				?>
				<?php do_action( 't_em_action_content_after' ); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
			<?php get_sidebar( 'alt' ); ?>
		</section><!-- #main-content -->

<?php get_footer(); ?>
