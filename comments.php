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
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0
 */

/**
 * The template for displaying Comments.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) :
	return;
endif;
?>
<section id="comments">
<?php if ( have_comments() ) : ?>
		<h2 id="comments-title"><?php
		printf( _nx( 'One response to: %2$s', '%1$s responses to: %2$s', get_comments_number(), 'comments title', 't_em' ),
			number_format_i18n( get_comments_number() ), '<small>' . get_the_title() . '</small>' );
		?></h2>
<?php 	if ( t_em( 'separate_comments_pings_tracks' ) ) :

			if ( ! empty( $comments_by_type['comment'] ) ) : ?>
				<div id="comment-count" class="lead mb-1"><?php printf( _n( '1 Comment', '%1$s Comments', count( $wp_query->comments_by_type['comment'] ), 't_em' ), count( $wp_query->comments_by_type['comment'] ) ) ?></div>
				<?php t_em_action_comments_list_before(); ?>
				<ol class="commentlist list-unstyled">
					<?php wp_list_comments( array( 'style' => 'ol', 'type' => 'comment', 'callback' => 't_em_comment' ) ); ?>
				</ol>
				<?php t_em_action_comments_list_after(); ?>
<?php 		else : // If there are no responds type comments ?>
				<div id="comment-count" class="lead mb-1"><?php _e('No Comments', 't_em'); ?></div>
<?php 		endif; // !empty($comments_by_type['comment']) ?>
				<div id="pingback" class="lead mb-1">
<?php 			$pingback = count( $wp_query->comments_by_type['pingback'] );
				$trackback = count( $wp_query->comments_by_type['trackback'] );
				printf( __( '%1$d Pingbacks | %2$d Trackbacks', 't_em' ), $pingback, $trackback ); ?>
				</div>
				<?php if ( $pingback + $trackback > 0 ) : ?>
				<ol class="commentlist list-unstyled">
				<?php wp_list_comments( array( 'style' => 'ol', 'type' => 'pings', 'callback' => 't_em_comment_pingback_trackback' ) ); ?>
				</ol>
				<?php endif; ?>
<?php 	else : // ( '0' == t_em( 'separate_comments_pings_tracks' ) ) :

			t_em_action_comments_list_before(); ?>
			<ol class="commentlist list-unstyled">
			<?php wp_list_comments( array( 'style' => 'ol', 'callback' => 't_em_comment_all' ) ); ?>
			</ol>
<?php 		t_em_action_comments_list_after();

		endif; // '1' == t_em( 'separate_comments_pings_tracks' )

		if ( ! comments_open() ) : ?>
			<div id="comments-closed" class="lead mb-1"><?php _e('Comments are closed', 't_em'); ?></div>
<?php
		endif;
	else : // If there are no responds ?>
		<h2 id="comments-title"><?php printf( __('No responds to: <small>%s</small>', 't_em'), get_the_title() ); ?></h2>
<?php
	endif; // have_comments()
?>
<?php
comment_form();
?>
</section><!-- #comments -->
