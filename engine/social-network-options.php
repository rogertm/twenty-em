<?php
/**
 * Twenty'em Social Network theme options.
 *
 * @file			social-network-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/social-network-options.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Return an array of Social Network Options for Twenty'em admin panel.
 * This function manage several social network options which you may use to display your profiles
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_social_network_options( $socialnetwork_options = '' ){
	$socialnetwork_options = array(
		'twitter_set' => array(
			'value' => '',
			'name' => 'twitter_set',
			'label' => __( 'Twitter URL', 't_em' ),
			'item' => __( 'Twitter', 't_em' ),
			'class' => 'icomoon-twitter',
		),
		'facebook_set' => array(
			'value' => '',
			'name' => 'facebook_set',
			'label' => __( 'Facebook URL', 't_em' ),
			'item' => __( 'Facebook', 't_em' ),
			'class' => 'icomoon-facebook',
		),
		'googleplus_set' => array(
			'value' => '',
			'name' => 'googleplus_set',
			'label' => __( 'Google + URL', 't_em' ),
			'item' => __( 'Google +', 't_em' ),
			'class' => 'icomoon-google-plus',
		),
		'delicious_set' => array(
			'value' => '',
			'name' => 'delicious_set',
			'label' => __( 'Delicious URL', 't_em' ),
			'item' => __( 'Delicious', 't_em' ),
			'class' => 'icomoon-delicious',
		),
		'linkedin_set' => array(
			'value' => '',
			'name' => 'linkedin_set',
			'label' => __( 'Linked In URL', 't_em' ),
			'item' => __( 'Linked In', 't_em' ),
			'class' => 'icomoon-linkedin',
		),
		'github_set' => array(
			'value' => '',
			'name' => 'github_set',
			'label' => __( 'Github URL', 't_em' ),
			'item' => __( 'Github', 't_em' ),
			'class' => 'icomoon-github',
		),
		'wordpress_set' => array(
			'value' => '',
			'name' => 'wordpress_set',
			'label' => __( 'WordPress URL', 't_em' ),
			'item' => __( 'WordPress', 't_em' ),
			'class' => 'icomoon-wordpress',
		),
		'youtube_set' => array(
			'value' => '',
			'name' => 'youtube_set',
			'label' => __( 'YouTube URL', 't_em' ),
			'item' => __( 'YouTube', 't_em' ),
			'class' => 'icomoon-youtube',
		),
		'flickr_set' => array(
			'value' => '',
			'name' => 'flickr_set',
			'label' => __( 'Flickr URL', 't_em' ),
			'item' => __( 'Flickr', 't_em' ),
			'class' => 'icomoon-flickr',
		),
		'tumblr_set' => array(
			'value' => '',
			'name' => 'tumblr_set',
			'label' => __( 'Tumblr URL', 't_em' ),
			'item' => __( 'Tumblr', 't_em' ),
			'class' => 'icomoon-tumblr',
		),
		'instagram_set' => array(
			'value' => '',
			'name' => 'instagram_set',
			'label' => __( 'Instagram URL', 't_em' ),
			'item' => __( 'Instagram', 't_em' ),
			'class' => 'icomoon-instagram',
		),
		'vimeo_set' => array(
			'value' => '',
			'name' => 'vimeo_set',
			'label' => __( 'Vimeo URL', 't_em' ),
			'item' => __( 'Vimeo', 't_em' ),
			'class' => 'icomoon-vimeo',
		),
		'reddit_set' => array(
			'value' => '',
			'name' => 'reddit_set',
			'label' => __( 'Reddit URL', 't_em' ),
			'item' => __( 'Reddit', 't_em' ),
			'class' => 'icomoon-reddit',
		),
		'picassa_set' => array(
			'value' => '',
			'name' => 'picassa_set',
			'label' => __( 'Picassa URL', 't_em' ),
			'item' => __( 'Picassa', 't_em' ),
			'class' => 'icomoon-picassa',
		),
		'lastfm_set' => array(
			'value' => '',
			'name' => 'lastfm_set',
			'label' => __( 'Lastfm URL', 't_em' ),
			'item' => __( 'Lastfm', 't_em' ),
			'class' => 'icomoon-lastfm',
		),
		'stumbleupon_set' => array(
			'value' => '',
			'name' => 'stumbleupon_set',
			'label' => __( 'Stumbleupon URL', 't_em' ),
			'item' => __( 'Stumbleupon', 't_em' ),
			'class' => 'icomoon-stumbleupon',
		),
		'pinterest_set' => array(
			'value' => '',
			'name' => 'pinterest_set',
			'label' => __( 'Pinterest URL', 't_em' ),
			'item' => __( 'Pinterest', 't_em' ),
			'class' => 'icomoon-pinterest',
		),
		'deviantart_set' => array(
			'value' => '',
			'name' => 'deviantart_set',
			'label' => __( 'Deviantart URL', 't_em' ),
			'item' => __( 'Deviantart', 't_em' ),
			'class' => 'icomoon-deviantart',
		),
		'myspace_set' => array(
			'value' => '',
			'name' => 'myspace_set',
			'label' => __( 'My Space URL', 't_em' ),
			'item' => __( 'My Space', 't_em' ),
			'class' => 'icomoon-myspace',
		),
		'xing_set' => array(
			'value' => '',
			'name' => 'xing_set',
			'label' => __( 'Xing URL', 't_em' ),
			'item' => __( 'Xing', 't_em' ),
			'class' => 'icomoon-xing',
		),
		'soundcloud_set' => array(
			'value' => '',
			'name' => 'soundcloud_set',
			'label' => __( 'Soundcloud URL', 't_em' ),
			'item' => __( 'Soundcloud', 't_em' ),
			'class' => 'icomoon-soundcloud',
		),
		'steam_set' => array(
			'value' => '',
			'name' => 'steam_set',
			'label' => __( 'Steam URL', 't_em' ),
			'item' => __( 'Steam', 't_em' ),
			'class' => 'icomoon-steam',
		),
		'dribbble_set' => array(
			'value' => '',
			'name' => 'dribbble_set',
			'label' => __( 'Dribbble URL', 't_em' ),
			'item' => __( 'Dribbble', 't_em' ),
			'class' => 'icomoon-dribbble',
		),
		'forrst_set' => array(
			'value' => '',
			'name' => 'forrst_set',
			'label' => __( 'Sorrst URL', 't_em' ),
			'item' => __( 'Sorrst', 't_em' ),
			'class' => 'icomoon-forrst',
		),
		'feed_set' => array(
			'value' => '',
			'name' => 'feed_set',
			'label' => __( 'RSS Feed URL', 't_em' ),
			'item' => __( 'RSS Feed', 't_em' ),
			'class' => 'icomoon-feed',
		),
	);

	return apply_filters( 't_em_filter_social_network_options', $socialnetwork_options );
}

/**
 * Render the Socialnetwork setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_socialnetwork_set(){
	global $t_em;
?>
	<div id="social-network-options">
		<?php do_action( 't_em_admin_action_social_network_options_before' ); ?>
		<div class="sub-extend option-group">
			<header><?php _e( 'Social Links', 't_em' ); ?></header>
<?php
	foreach ( t_em_social_network_options() as $social ) :
?>
		<div id="social-network-options" class="layout text-option social option-single">
			<label>
				<span><?php echo $social['label'];?></span>
				<input type="url" class="regular-text" name="t_em_theme_options[<?php echo $social['name']; ?>]" value="<?php echo esc_url( $t_em[$social['name']] ); ?>" />
			</label>
		</div>
<?php
		endforeach;
?>
		</div>
		<?php do_action( 't_em_admin_action_social_network_options_after' ); ?>
	</div><!-- #social-network-options -->
<?php
}
?>
