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
			'name' => 'twitter_set',
			'label' => __( 'Twitter URL', 't_em' ),
			'item' => __( 'Twitter', 't_em' ),
			'class' => 'icomoon-twitter',
			'order' => '10',
		),
		'facebook_set' => array(
			'name' => 'facebook_set',
			'label' => __( 'Facebook URL', 't_em' ),
			'item' => __( 'Facebook', 't_em' ),
			'class' => 'icomoon-facebook',
			'order' => '20',
		),
		'googleplus_set' => array(
			'name' => 'googleplus_set',
			'label' => __( 'Google + URL', 't_em' ),
			'item' => __( 'Google +', 't_em' ),
			'class' => 'icomoon-google-plus',
			'order' => '30',
		),
		'delicious_set' => array(
			'name' => 'delicious_set',
			'label' => __( 'Delicious URL', 't_em' ),
			'item' => __( 'Delicious', 't_em' ),
			'class' => 'icomoon-delicious',
			'order' => '40',
		),
		'linkedin_set' => array(
			'name' => 'linkedin_set',
			'label' => __( 'Linked In URL', 't_em' ),
			'item' => __( 'Linked In', 't_em' ),
			'class' => 'icomoon-linkedin',
			'order' => '50',
		),
		'github_set' => array(
			'name' => 'github_set',
			'label' => __( 'Github URL', 't_em' ),
			'item' => __( 'Github', 't_em' ),
			'class' => 'icomoon-github',
			'order' => '60',
		),
		'wordpress_set' => array(
			'name' => 'wordpress_set',
			'label' => __( 'WordPress URL', 't_em' ),
			'item' => __( 'WordPress', 't_em' ),
			'class' => 'icomoon-wordpress',
			'order' => '70',
		),
		'youtube_set' => array(
			'name' => 'youtube_set',
			'label' => __( 'YouTube URL', 't_em' ),
			'item' => __( 'YouTube', 't_em' ),
			'class' => 'icomoon-youtube',
			'order' => '80',
		),
		'flickr_set' => array(
			'name' => 'flickr_set',
			'label' => __( 'Flickr URL', 't_em' ),
			'item' => __( 'Flickr', 't_em' ),
			'class' => 'icomoon-flickr',
			'order' => '90',
		),
		'tumblr_set' => array(
			'name' => 'tumblr_set',
			'label' => __( 'Tumblr URL', 't_em' ),
			'item' => __( 'Tumblr', 't_em' ),
			'class' => 'icomoon-tumblr',
			'order' => '100',
		),
		'instagram_set' => array(
			'name' => 'instagram_set',
			'label' => __( 'Instagram URL', 't_em' ),
			'item' => __( 'Instagram', 't_em' ),
			'class' => 'icomoon-instagram',
			'order' => '110',
		),
		'vimeo_set' => array(
			'name' => 'vimeo_set',
			'label' => __( 'Vimeo URL', 't_em' ),
			'item' => __( 'Vimeo', 't_em' ),
			'class' => 'icomoon-vimeo',
			'order' => '120',
		),
		'reddit_set' => array(
			'name' => 'reddit_set',
			'label' => __( 'Reddit URL', 't_em' ),
			'item' => __( 'Reddit', 't_em' ),
			'class' => 'icomoon-reddit',
			'order' => '130',
		),
		'picassa_set' => array(
			'name' => 'picassa_set',
			'label' => __( 'Picassa URL', 't_em' ),
			'item' => __( 'Picassa', 't_em' ),
			'class' => 'icomoon-picassa',
			'order' => '140',
		),
		'lastfm_set' => array(
			'name' => 'lastfm_set',
			'label' => __( 'Lastfm URL', 't_em' ),
			'item' => __( 'Lastfm', 't_em' ),
			'class' => 'icomoon-lastfm',
			'order' => '150',
		),
		'stumbleupon_set' => array(
			'name' => 'stumbleupon_set',
			'label' => __( 'Stumbleupon URL', 't_em' ),
			'item' => __( 'Stumbleupon', 't_em' ),
			'class' => 'icomoon-stumbleupon',
			'order' => '160',
		),
		'pinterest_set' => array(
			'name' => 'pinterest_set',
			'label' => __( 'Pinterest URL', 't_em' ),
			'item' => __( 'Pinterest', 't_em' ),
			'class' => 'icomoon-pinterest',
			'order' => '170',
		),
		'deviantart_set' => array(
			'name' => 'deviantart_set',
			'label' => __( 'Deviantart URL', 't_em' ),
			'item' => __( 'Deviantart', 't_em' ),
			'class' => 'icomoon-deviantart',
			'order' => '180',
		),
		'myspace_set' => array(
			'name' => 'myspace_set',
			'label' => __( 'My Space URL', 't_em' ),
			'item' => __( 'My Space', 't_em' ),
			'class' => 'icomoon-myspace',
			'order' => '190',
		),
		'xing_set' => array(
			'name' => 'xing_set',
			'label' => __( 'Xing URL', 't_em' ),
			'item' => __( 'Xing', 't_em' ),
			'class' => 'icomoon-xing',
			'order' => '200',
		),
		'soundcloud_set' => array(
			'name' => 'soundcloud_set',
			'label' => __( 'Soundcloud URL', 't_em' ),
			'item' => __( 'Soundcloud', 't_em' ),
			'class' => 'icomoon-soundcloud',
			'order' => '210',
		),
		'steam_set' => array(
			'name' => 'steam_set',
			'label' => __( 'Steam URL', 't_em' ),
			'item' => __( 'Steam', 't_em' ),
			'class' => 'icomoon-steam',
			'order' => '220',
		),
		'dribbble_set' => array(
			'name' => 'dribbble_set',
			'label' => __( 'Dribbble URL', 't_em' ),
			'item' => __( 'Dribbble', 't_em' ),
			'class' => 'icomoon-dribbble',
			'order' => '230',
		),
		'forrst_set' => array(
			'name' => 'forrst_set',
			'label' => __( 'Sorrst URL', 't_em' ),
			'item' => __( 'Sorrst', 't_em' ),
			'class' => 'icomoon-forrst',
			'order' => '240',
		),
		'feed_set' => array(
			'name' => 'feed_set',
			'label' => __( 'RSS Feed URL', 't_em' ),
			'item' => __( 'RSS Feed', 't_em' ),
			'class' => 'icomoon-feed',
			'order' => '250',
		),
	);

	uasort( $socialnetwork_options, 't_em_sort_by_order' );

	/**
	 * Filter the Social Network Options Set
	 *
	 * @param array An array of new options in the Social Network Options Set.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'name', 'label', 'item', 'class' and 'order' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_social_network_options', $socialnetwork_options );
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
