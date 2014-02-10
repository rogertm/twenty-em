<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to t_em_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?>
<section id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword lead"><?php _e( 'This post is password protected. Enter the password to view any comments.', 't_em' ); ?></p>
</section><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<?php
if ( have_comments() ) :
?>
	<h2 id="comments-title"><?php
	printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 't_em' ),
	number_format_i18n( get_comments_number() ), '<span class="small">' . get_the_title() . '</span>' );
	?></h2>
<?php
	global $t_em_theme_options;
	if ( '1' == $t_em_theme_options['separate_comments_pings_tracks'] ) :

		if ( ! empty($comments_by_type['comment']) ) :
?>
			<h4 id="comment-count"><?php echo count( $wp_query->comments_by_type['comment'] ); ?> <?php _e('Comments', 't_em'); ?></h4>
			<ul class="commentlist media-list">
				<?php wp_list_comments( array( 'callback' => 't_em_comment' ) ); ?>
			</ul>
<?php
		else : // If there are no responds type comments
?>
			<h4 id="comment"><?php _e('No Comments', 't_em'); ?></h4>
<?php
		endif; // !empty($comments_by_type['comment'])
?>
<?php
		if ( ! empty($comments_by_type['pings']) ) :
?>
			<h4 id="pingback">
				<?php echo count( $wp_query->comments_by_type['pingback'] ); ?>
				<?php _e( 'Pingbacks', 't_em' ); ?>
				<span> | </span>
				<?php echo count( $wp_query->comments_by_type['trackback'] ); ?>
				<?php _e( 'Trackbacks', 't_em' ); ?>
			</h4>
			<ul class="commentlist media-list">
				<?php wp_list_comments( array( 'callback' => 't_em_comment_pingback_trackback' ) ); ?>
			</ul>
<?php
		else : // If there are no responds type pingback
?>
			<h4 id="pingback"><?php _e('0 Pinkbacks <span> | </span> 0 Trackbacks', 't_em'); ?></h4>
<?php
		endif; // !empty($comments_by_type['pings'])

	else : // ( '0' == $t_em_theme_options['separate_comments_pings_tracks'] ) :
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
		<nav id="comment-nav-above" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments <span class="meta-nav">&laquo;</span>', 't_em' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( '<span class="meta-nav">&raquo;</span> Newer Comments', 't_em' ) ); ?></div>
		</nav>
<?php
		endif;
?>
		<ul class="commentlist media-list">
		<?php wp_list_comments( array( 'callback' => 't_em_comment_all' ) ); ?>
		</ul>
<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments <span class="meta-nav">&laquo;</span>', 't_em' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( '<span class="meta-nav">&raquo;</span> Newer Comments', 't_em' ) ); ?></div>
		</nav>
<?php
		endif;
	endif; // '1' == $t_em_theme_options['separate_comments_pings_tracks']

	if ( ! comments_open() ) :
?>
		<h4 id="comments-closed"><?php _e('Comments are closed', 't_em'); ?></h4>
<?php
	endif;

else : // If there are no responds
?>
	<h2 id="comments-title"><?php _e('No responds to ', 't_em'); ?><span class="small"><?php the_title(); ?></span></h2>
<?php
endif; // have_comments()
?>
<?php
comment_form();
?>
</section><!-- #comments -->
