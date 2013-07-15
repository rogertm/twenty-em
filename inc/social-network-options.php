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
function t_em_social_network_options(){
	$socialnetwork_options = array (
		'twitter-set' => array (
			'value' => '',
			'name' => 'twitter-set',
			'label' => __( 'Twitter URL', 't_em' ),
			'item' => __( 'Twitter', 't_em' ),
			'class' => 'icon-twitter',
		),
		'facebook-set' => array (
			'value' => '',
			'name' => 'facebook-set',
			'label' => __( 'Facebook URL', 't_em' ),
			'item' => __( 'Facebook', 't_em' ),
			'class' => 'icon-facebook',
		),
		'googleplus-set' => array (
			'value' => '',
			'name' => 'googleplus-set',
			'label' => __( 'Google + URL', 't_em' ),
			'item' => __( 'Google +', 't_em' ),
			'class' => 'icon-google-plus',
		),
		'delicious-set' => array (
			'value' => '',
			'name' => 'delicious-set',
			'label' => __( 'Delicious URL', 't_em' ),
			'item' => __( 'Delicious', 't_em' ),
			'class' => 'icon-delicious',
		),
		'linkedin-set' => array (
			'value' => '',
			'name' => 'linkedin-set',
			'label' => __( 'Linked In URL', 't_em' ),
			'item' => __( 'Linked In', 't_em' ),
			'class' => 'icon-linkedin',
		),
		'github-set' => array (
			'value' => '',
			'name' => 'github-set',
			'label' => __( 'Github URL', 't_em' ),
			'item' => __( 'Github', 't_em' ),
			'class' => 'icon-github',
		),
		'wordpress-set' => array (
			'value' => '',
			'name' => 'wordpress-set',
			'label' => __( 'WordPress URL', 't_em' ),
			'item' => __( 'WordPress', 't_em' ),
			'class' => 'icon-wordpress',
		),
		'youtube-set' => array (
			'value' => '',
			'name' => 'youtube-set',
			'label' => __( 'YouTube URL', 't_em' ),
			'item' => __( 'YouTube', 't_em' ),
			'class' => 'icon-youtube',
		),
		'flickr-set' => array (
			'value' => '',
			'name' => 'flickr-set',
			'label' => __( 'Flickr URL', 't_em' ),
			'item' => __( 'Flickr', 't_em' ),
			'class' => 'icon-flickr',
		),
		'instagram-set' => array (
			'value' => '',
			'name' => 'instagram-set',
			'label' => __( 'Instagram URL', 't_em' ),
			'item' => __( 'Instagram', 't_em' ),
			'class' => 'icon-instagram',
		),
		'vimeo-set' => array (
			'value' => '',
			'name' => 'vimeo-set',
			'label' => __( 'Vimeo URL', 't_em' ),
			'item' => __( 'Vimeo', 't_em' ),
			'class' => 'icon-vimeo',
		),
		'reddit-set' => array (
			'value' => '',
			'name' => 'reddit-set',
			'label' => __( 'Reddit URL', 't_em' ),
			'item' => __( 'Reddit', 't_em' ),
			'class' => 'icon-reddit',
		),
		'picassa-set' => array (
			'value' => '',
			'name' => 'picassa-set',
			'label' => __( 'Picassa URL', 't_em' ),
			'item' => __( 'Picassa', 't_em' ),
			'class' => 'icon-picassa',
		),
		'lastfm-set' => array (
			'value' => '',
			'name' => 'lastfm-set',
			'label' => __( 'Lastfm URL', 't_em' ),
			'item' => __( 'Lastfm', 't_em' ),
			'class' => 'icon-lastfm',
		),
		'stumbleupon-set' => array (
			'value' => '',
			'name' => 'stumbleupon-set',
			'label' => __( 'Stumbleupon URL', 't_em' ),
			'item' => __( 'Stumbleupon', 't_em' ),
			'class' => 'icon-stumbleupon',
		),
		'pinterest-set' => array (
			'value' => '',
			'name' => 'pinterest-set',
			'label' => __( 'Pinterest URL', 't_em' ),
			'item' => __( 'Pinterest', 't_em' ),
			'class' => 'icon-pinterest',
		),
		'deviantart-set' => array (
			'value' => '',
			'name' => 'deviantart-set',
			'label' => __( 'Deviantart URL', 't_em' ),
			'item' => __( 'Deviantart', 't_em' ),
			'class' => 'icon-deviantart',
		),
		'myspace-set' => array (
			'value' => '',
			'name' => 'myspace-set',
			'label' => __( 'My Space URL', 't_em' ),
			'item' => __( 'My Space', 't_em' ),
			'class' => 'icon-myspace',
		),
		'xing-set' => array (
			'value' => '',
			'name' => 'xing-set',
			'label' => __( 'Xing URL', 't_em' ),
			'item' => __( 'Xing', 't_em' ),
			'class' => 'icon-xing',
		),
		'soundcloud-set' => array (
			'value' => '',
			'name' => 'soundcloud-set',
			'label' => __( 'Soundcloud URL', 't_em' ),
			'item' => __( 'Soundcloud', 't_em' ),
			'class' => 'icon-soundcloud',
		),
		'steam-set' => array (
			'value' => '',
			'name' => 'steam-set',
			'label' => __( 'Steam URL', 't_em' ),
			'item' => __( 'Steam', 't_em' ),
			'class' => 'icon-steam',
		),
		'dribbble-set' => array (
			'value' => '',
			'name' => 'dribbble-set',
			'label' => __( 'Dribbble URL', 't_em' ),
			'item' => __( 'Dribbble', 't_em' ),
			'class' => 'icon-dribbble',
		),
		'forrst-set' => array (
			'value' => '',
			'name' => 'forrst-set',
			'label' => __( 'Sorrst URL', 't_em' ),
			'item' => __( 'Sorrst', 't_em' ),
			'class' => 'icon-forrst',
		),
		'feed-set' => array (
			'value' => '',
			'name' => 'feed-set',
			'label' => __( 'Feed or RSS URL', 't_em' ),
			'item' => __( 'Feed / RSS', 't_em' ),
			'class' => 'icon-feed',
		),
	);

	return apply_filters( 't_em_social_network_options', $socialnetwork_options );
}

/**
 * Render the Socialnetwork setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_socialnetwork_set(){
	global $t_em_theme_options;
	foreach ( t_em_social_network_options() as $social ) :
?>
	<div id="social-network-options" class="layout text-option social">
		<label>
			<span><?php echo $social['label'];?></span>
			<input type="url" class="regular-text" name="t_em_theme_options[<?php echo $social['name']; ?>]" value="<?php echo esc_url( $t_em_theme_options[$social['name']] ); ?>" />
		</label>
	</div>
<?php
	endforeach;
}
?>
