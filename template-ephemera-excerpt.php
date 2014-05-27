<?php
/**
 * Template Name: Ephemera (summary)
 *
 * A custom page template to display post formats summary.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @file			template-ephemera-excerpt.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012 - 2013 Twenty'em
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/template-ephemera-excerpt.php
 * @link			http://codex.wordpress.org/Pages#Page_Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

		<section id="main-content" class="<?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">
			<?php t_em_hook_content_before(); ?>

<?php
// Query for the Custom Loop
$limit = '30';
$args = array (
		'tax_query' => array (
			array (
				'operator'	=> 'IN',
				'taxonomy'	=> 'post_format',
				'field'		=> 'slug',
				'terms'		=> array (	'post-format-aside',
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
		'posts_per_page' => $limit,
		'paged' => get_query_var( 'paged' )
	);

// Start the Custom Loop
$wp_query = new WP_Query( $args );

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		$icon_format = get_post_format();
		switch ( $icon_format ) :
			case 'aside':
				$icon = 'icomoon-circle';
				$format = __( 'Aside', 't_em' );
				break;
			case 'audio':
				$icon = 'icomoon-volume-high';
				$format = __( 'Audio', 't_em' );
				break;
			case 'chat':
				$icon = 'icomoon-chat';
				$format = __( 'Chat', 't_em' );
				break;
			case 'gallery':
				$icon = 'icomoon-pictures';
				$format = __( 'Gallery', 't_em' );
				break;
			case 'image':
				$icon = 'icomoon-picture';
				$format = __( 'Image', 't_em' );
				break;
			case 'link':
				$icon = 'icomoon-link';
				$format = __( 'Link', 't_em' );
				break;
			case 'quote':
				$icon = 'icomoon-quote-left';
				$format = __( 'Quote', 't_em' );
				break;
			case 'status':
				$icon = 'icomoon-smiley';
				$format = __( 'Status', 't_em' );
				break;
			case 'video':
				$icon = 'icomoon-facetime-video';
				$format = __( 'Video', 't_em' );
				break;
		endswitch;
?>
					<article id="post-<?php the_ID(); ?>">
						<p id="post-<?php the_ID(); ?>" class="lead">
							<span class="<?php echo $icon; ?> icomoon" title="<?php echo $format; ?>"></span>&nbsp;<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</p><!-- #post-## -->
					</article>
<?php
	endwhile;
	else :
		get_template_part( 'content', 'none' );
	endif;
?>
				<?php t_em_hook_content_after(); ?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>

<?php get_footer(); ?>
