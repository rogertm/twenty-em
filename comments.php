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
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 't_em' ); ?></p>
			</div><!-- #comments -->
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
	global $wp_query;
?>
	<h3 id="comments-title"><?php
	printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 't_em' ),
	number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
	?></h3>
<?php
	if ( !empty($comments_by_type['comment']) ) :
?>
		<h3 id="comment"><?php echo count( $wp_query->comments_by_type['comment'] ); ?> <?php _e('Comments', 't_em'); ?></h3>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 't_em_comment' ) ); ?>
		</ol>
<?php
	else : // If there are no responds type comments
?>
		<h3 id="comment"><?php _e('No Comments', 't_em'); ?></h3>
<?php
	endif; // !empty($comments_by_type['comment'])
?>
<?php
	if ( !empty($comments_by_type['pings']) ) :
?>
		<h3 id="pingback">
			<?php echo count( $wp_query->comments_by_type['pingback'] ); ?> Pingbacks
			<span> | </span>
			<?php echo count( $wp_query->comments_by_type['trackback'] ); ?> Trackbacks
			</h3>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 't_em_comment_pingback_trackback' ) ); ?>
		</ol>
<?php
	else : // If there are no responds type pingback
?>
		<h3 id="pingback"><?php _e('0 Pinkbacks <span> | </span> 0 Trackbacks', 't_em'); ?></h3>
<?php
	endif; // !empty($comments_by_type['pings'])
?>

<?php
	if ( !comments_open() ) :
?>
		<h3 id="comments-closed"><?php _e('Comments are closed', 't_em'); ?></h3>
<?php
	endif;
?>
<?php
else : // If there are no responds
?>
	<h3 id="comments-title"><?php _e('No responds to ', 't_em'); ?><em><?php the_title(); ?></em></h3>
<?php
endif; // have_comments()
?>
<?php
/** @see http://codex.wordpress.org/Function_Reference/comment_form */
$new_defaults = array ();
comment_form($new_defaults);
?>
</section><!-- #comments -->
