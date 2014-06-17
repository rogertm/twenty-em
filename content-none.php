<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?>

<header>
	<h1 class="page-header"><?php _e( 'Nothing Found', 't_em' ); ?></h1>
</header>

<article id="post-0" class="post no-results not-found">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<div class="entry-content">
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 't_em' ), admin_url( 'post-new.php' ) ); ?></p>
		</div>

	<?php elseif ( is_search() ) : ?>

		<div class="entry-content">
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 't_em' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php else : ?>

		<div class="entry-content">
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 't_em' ); ?></p>
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>
</article><!-- #post-o -->
