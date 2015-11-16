<?php
/**
 * Twenty'em Generals theme options.
 *
 * @file			generals-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/generals-options.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Return an array of General Options for Twenty'em admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_general_options( $general_options = '' ){
	$general_options = array(
		't_em_link'				=> array(
			'name'			=> 't_em_link',
			'label'			=> sprintf( __( 'Show <strong><a href="%1$s" target="_blank">%2$s</a></strong> and <strong><a href="http://wordpress.org/" target="_blank">WordPress.org</a></strong> home page link at the bottom of your site', 't_em' ), T_EM_SITE .'/?page-request=home&amp;ver='.T_EM_FRAMEWORK_VERSION, T_EM_FRAMEWORK_NAME ),
			'sublabel'		=> '',
		),
		'single_featured_img'	=> array(
			'name'			=> 'single_featured_img',
			'label'			=> __( 'Show featured image on top of the post when a single post is displayed', 't_em' ),
			'sublabel'		=> '',
		),
		'single_related_posts'	=> array(
			'name'			=> 'single_related_posts',
			'label'			=> __( 'When a single post is displayed, show related posts', 't_em' ),
			'sublabel'		=> '',
		),
		'breadcrumb_path'		=> array(
			'name'			=> 'breadcrumb_path',
			'label'			=> __( 'Display a breadcrumb path', 't_em' ),
			'sublabel'		=> '',
		),
		'separate_comments_pings_tracks'	=> array(
			'name'			=> 'separate_comments_pings_tracks',
			'label'			=> __( 'Separate comments from pingbacks and trackbacks', 't_em' ),
			'sublabel'		=> sprintf( __( 'For a best performances of this option, please deactivate your <a href="%1$s">comments pagination</a>.', 't_em' ), admin_url( 'options-discussion.php#page_comments' ) ),
		),
		'single_page_comments'	=> array(
			'name'			=> 'single_page_comments',
			'label'			=> __( 'Enable comments in single pages', 't_em' ),
			'sublabel'		=> sprintf( __( 'If true, be sure to <a href="%1$s">allow people to post comments on new articles</a>.', 't_em' ), admin_url( 'options-discussion.php#default_comment_status' ) ),
		),
		'shortcode_buttoms'		=> array(
			'name'			=> 'shortcode_buttoms',
			'label'			=> __( 'Enable shortcodes buttons', 't_em' ),
			'sublabel'		=> __( 'Shortcodes are always enables, but you can hide or show the buttons in the posts or pages editor', 't_em' ),
		),
	);

	return apply_filters( 't_em_admin_filter_general_options', $general_options );
}

/**
 * Extend setting for General Options in Twenty'em admin panel.
 *
 * @return string
 *
 * @since Twenty'em 1.0
 */
function t_em_general_options_favicon(){
	global $t_em;
?>
	<div class="sub-layout text-option general">
		<label class="description single-option">
			<span>
				<?php echo sprintf( __( '<a href="%1$s" target="_blank">Favicon URL</a>', 't_em' ), admin_url( 'upload.php' ) ); ?>
			<?php if ( '' != $t_em['favicon_url'] ) : ?>
					<p><?php _e( 'Current favicon:', 't_em' ) ?>&nbsp;<img src="<?php echo $t_em['favicon_url'] ?>" width="16" height="16" /></p>
			<?php endif; ?>
			</span>
			<input type="url" class="regular-text" name="t_em_theme_options[favicon_url]" value="<?php echo $t_em['favicon_url'] ?>" />
		</label>
	</div>
<?php
}
add_action( 't_em_admin_action_general_options_after', 't_em_general_options_favicon' );

/**
 * Render the General Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_general_options_set(){
	global $t_em;
?>
	<div id="general-options">
<?php
	do_action( 't_em_admin_action_general_options_before' );
	foreach( t_em_general_options() as $general ) :
?>
		<div class="layout checkbox-option general">
			<label class="description single-option">
				<?php $checked_option = checked( $t_em[$general['name']], '1', false ); ?>
				<p><input type="checkbox" name="t_em_theme_options[<?php echo $general['name'] ?>]" value="1" <?php echo $checked_option; ?> >
				<?php echo $general['label']; ?></p>
				<p class="description"><?php echo $general['sublabel'] ?></p>
			</label>
		</div>
<?php
	endforeach;
	do_action( 't_em_admin_action_general_options_after' );
?>
	</div><!-- #general-options -->
<?php
}
?>
