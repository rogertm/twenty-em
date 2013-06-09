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
 * @link			http://codex.wordpress.org/Templates
 * @since			Twenty'em 1.0
 */

get_header(); ?>

<div id="main" class="wrapper container-fluid">
	<div class="row-fluid">
		<section id="main-content" class="row-fluid <?php echo t_em_add_bootstrap_class( 'main-content' ); ?>">
			<section id="content" role="main" class="<?php echo t_em_add_bootstrap_class('content'); ?>">

				<article id="post-<?php the_ID(); ?>">
<?php
if ( have_posts() ) :
	$template_data = get_page( get_the_ID() );
?>
					<header>
						<h1 class="entry-title"><?php echo $template_data->post_title; ?></h1>
					</header>
<?php
	while ( have_posts() ) : the_post(); ?>
					<div class="entry-content"><?php the_content(); ?></div>
<?php
	endwhile;
?>
				</article>
<?php
// Query for the Custom Loop
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
			'posts_per_page' => '30',
			'paged' => get_query_var( 'paged' )
		);

	$wp_query = new WP_Query( $args );

	t_em_page_navi( 'nav-above' );

// Start the Custom Loop

	while ( have_posts() ) : the_post();

		$icon_format = get_post_format();
		switch ( $icon_format ) :
			case 'aside':
				$icon = 'icon-circle';
				$format = __( 'Aside', 't_em' );
				break;
			case 'audio':
				$icon = 'icon-volume-high';
				$format = __( 'Audio', 't_em' );
				break;
			case 'chat':
				$icon = 'icon-chat';
				$format = __( 'Chat', 't_em' );
				break;
			case 'gallery':
				$icon = 'icon-pictures';
				$format = __( 'Gallery', 't_em' );
				break;
			case 'image':
				$icon = 'icon-picture';
				$format = __( 'Image', 't_em' );
				break;
			case 'link':
				$icon = 'icon-link';
				$format = __( 'Link', 't_em' );
				break;
			case 'quote':
				$icon = 'icon-quote-left';
				$format = __( 'Quote', 't_em' );
				break;
			case 'status':
				$icon = 'icon-smiley';
				$format = __( 'Status', 't_em' );
				break;
			case 'video':
				$icon = 'icon-facetime-video';
				$format = __( 'Video', 't_em' );
				break;
		endswitch;
?>
					<article id="post-<?php the_ID(); ?>">
						<p id="post-<?php the_ID(); ?>" class="lead">
							<span class="<?php echo $icon; ?> font-icon" title="<?php echo $format; ?>"></span>&nbsp;<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 't_em' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</p><!-- #post-## -->
					</article>
<?php
	endwhile;
	t_em_page_navi( 'nav-below' );
	else :
		get_template_part( 'content', 'none' );
	endif;
	wp_reset_query();
?>
			</section><!-- #content -->
			<?php get_sidebar(); ?>
		</section><!-- #main-content -->
		<?php get_sidebar( 'alt' ); ?>
	</div><!-- .row-fluid -->
</div><!-- #main -->

<?php get_footer(); ?>
