<?php
/**
 * Template Name: Ephemera Content (full post)
 *
 * A custom page template to display post formats full post.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-ephemera-content.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-ephemera-content.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_action_content_before(); ?>
			<?php
			// Query for the Custom Loop
			$args = array(
					'tax_query' => array(
						array(
							'operator'	=> 'IN',
							'taxonomy'	=> 'post_format',
							'field'		=> 'slug',
							'terms'		=> array(	'post-format-aside',
													'post-format-audio',
													'post-format-chat',
													'post-format-gallery',
													'post-format-image',
													'post-format-link',
													'post-format-quote',
													'post-format-status',
													'post-format-video')
						)
					),
					'posts_per_page' => get_option( 'posts_per_page' ),
					'paged' => get_query_var( 'paged' )
				);

			// Start the Custom Loop
			$wp_query = new WP_Query( $args );

			if ( have_posts() ) :

				while ( have_posts() ) : the_post();
			?>
			<?php t_em_action_post_before(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php t_em_action_post_inside_before(); ?>
				<header class="entry-header">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<span class="entry-meta">
						<?php t_em_posted_on(); ?>
					</span><!-- .entry-meta -->
				</header>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 't_em' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<footer class="entry-utility">
					<?php t_em_posted_in() ?>
					<?php t_em_comments_link(); ?>
					<?php t_em_edit_post_link(); ?>
				</footer><!-- .entry-utility -->
				<?php t_em_action_post_inside_after(); ?>
			</article>
			<?php t_em_action_post_after(); ?>
			<?php
				endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif;
			?>
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
