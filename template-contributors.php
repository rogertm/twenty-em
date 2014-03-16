<?php
/**
 * Template Name: Contributors
 *
 * A custom page template to display a list of all contributors.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-contributors.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-contributors.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
				<?php t_em_content_before(); ?>

				<?php t_em_template_content() ?>

				<section id="contributors">
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
					<div class="pull-left media-object contributor-avatar">
						<?php echo get_avatar( $contributor ); ?>
					</div>
					<div class="media-body">
						<h4 class="media-heading contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor ); ?></h4>
						<p class="contributor-bio"><?php echo get_the_author_meta( 'description', $contributor ) ?></p>
					<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor ) ); ?>">
						<span class="icomoon"></span>
						<?php printf( _n( '%d Article', '%d Articles', $post_count, 't_em' ), $post_count ); ?>
					</a>
					</div>
				</div>
<?php
				endforeach;
				?>

				</section><!-- #contributors -->
				<?php t_em_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
