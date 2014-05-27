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
	printf( _n( 'One response to: %2$s', '%1$s responses to: %2$s', get_comments_number(), 't_em' ),
	number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
	?></h2>
<?php
	global $t_em;
	if ( '1' == $t_em['separate_comments_pings_tracks'] ) :

		if ( ! empty($comments_by_type['comment']) ) :
?>
			<div id="comment-count" class="lead"><?php echo count( $wp_query->comments_by_type['comment'] ); ?> <?php _e('Comments', 't_em'); ?></div>
			<?php t_em_hook_comments_list_before(); ?>
			<ul class="commentlist media-list">
				<?php wp_list_comments( array( 'callback' => 't_em_comment' ) ); ?>
			</ul>
			<?php t_em_hook_comments_list_after(); ?>
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
			<div id="pingback" class="lead">
				<?php echo count( $wp_query->comments_by_type['pingback'] ); ?>
				<?php _e( 'Pingbacks', 't_em' ); ?>
				<span> | </span>
				<?php echo count( $wp_query->comments_by_type['trackback'] ); ?>
				<?php _e( 'Trackbacks', 't_em' ); ?>
			</div>
			<ul class="commentlist media-list">
				<?php wp_list_comments( array( 'callback' => 't_em_comment_pingback_trackback' ) ); ?>
			</ul>
<?php
		else : // If there are no responds type pingback
?>
			<div id="pingback" class="lead"><?php _e('0 Pinkbacks <span> | </span> 0 Trackbacks', 't_em'); ?></div>
<?php
		endif; // !empty($comments_by_type['pings'])

	else : // ( '0' == $t_em['separate_comments_pings_tracks'] ) :

		t_em_hook_comments_list_before();
?>
		<ul class="commentlist media-list">
		<?php wp_list_comments( array( 'callback' => 't_em_comment_all' ) ); ?>
		</ul>
<?php

		t_em_hook_comments_list_after();

	endif; // '1' == $t_em['separate_comments_pings_tracks']

	if ( ! comments_open() ) :
?>
		<div id="comments-closed"><?php _e('Comments are closed', 't_em'); ?></div>
<?php
	endif;

else : // If there are no responds
?>
	<h2 id="comments-title"><?php _e('No responds to: ', 't_em'); ?><span ><?php the_title(); ?></span></h2>
<?php
endif; // have_comments()
?>
<?php
comment_form();
?>
</section><!-- #comments -->
