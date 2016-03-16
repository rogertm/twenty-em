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
 * Template Name: Contributors
 *
 * A custom page template to display a list of all contributors.
 */

get_header(); ?>

		<section id="main-content" <?php t_em_add_bootstrap_class( 'main-content' ); ?>>
			<section id="content" role="main" <?php t_em_add_bootstrap_class( 'content' ); ?>>
				<?php t_em_action_content_before(); ?>

				<div id="contributors-<?php echo get_the_ID(); ?>" class="custom-template custom-template-contributors">
				<?php
				$args = array(
						'fields'	=> 'ID',
						'orderby'	=> 'post_count',
						'order'		=> 'DESC',
						'who'		=> 'authors',
					);
				$contributors = get_users( $args );

				foreach( $contributors as $contributor ) :
					$post_count = count_user_posts( $contributor );

					// Jump over users that has not published a post
					if( ! $post_count )
						continue;
?>
				<div id="contributor-<?php echo get_the_author_meta( 'user_login', $contributor ); ?>" class="author-info contributor media">
					<div class="media-left media-object contributor-avatar">
					<?php echo get_avatar( $contributor, '', '', get_the_author_meta( 'display_name', $contributor ) ) ?>
					</div>
					<div class="media-body">
						<h4 class="media-heading contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor ); ?></h4>
						<p class="contributor-bio"><?php echo get_the_author_meta( 'description', $contributor ) ?></p>
						<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor ) ); ?>">
							<span class="icomoon"></span>
							<?php printf( _n( '%d Article', '%d Articles', $post_count, 't_em' ), $post_count ); ?>
						</a>
					<?php
					if ( get_the_author_meta( 'user_url', $contributor ) ) :
					?>
						<a class="contributor-url" href="<?php echo get_the_author_meta( 'user_url', $contributor ); ?>">
							<span class="icomoon"></span>
							<?php _e( 'Visit web site', 't_em' ); ?>
						</a>
					<?php
					endif;
					?>
					</div>
				</div>
<?php
				endforeach;
				?>

				</div><!-- #contributors-## -->
				<?php t_em_action_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
