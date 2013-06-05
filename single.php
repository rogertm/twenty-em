<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */

get_header(); ?>

	<div id="content" role="main" class="span8">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<nav id="nav-above" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . __( '&laquo;', 'Previous post link', 't_em' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . __( '&raquo;', 'Next post link', 't_em' ) . '</span>' ); ?></div>
		</nav><!-- #nav-above -->

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php t_em_single_post_thumbnail(); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<span class="entry-meta">
					<?php t_em_posted_on(); ?>
				</span><!-- .entry-meta -->
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 't_em' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<?php t_em_author_meta(); ?>

			<footer class="entry-utility">
				<?php t_em_posted_in(); ?>
				<?php t_em_edit_post_link(); ?>
			</footer><!-- .entry-utility -->
		</article><!-- #post-## -->

		<nav id="nav-below" class="navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 't_em' ) . '</span> %title' ); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 't_em' ) . '</span>' ); ?></div>
		</nav><!-- #nav-below -->

		<?php echo t_em_single_related_posts() ?>

		<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
