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
function t_em_general_options(){
	$general_options = array (
		't-em-link'				=> array (
			'name'			=> 't-em-link',
			'label'			=> sprintf( __( 'Show <strong><a href="%1$s" target="_blank">Twenty&#8217;em.com</a></strong> and <strong><a href="http://wordpress.org/" target="_blank">WordPress.org</a></strong> home page link at the bottom of your site?', 't_em' ), 'http://twenty-em.com' ),
		),
		'single-featured-img'	=> array (
			'name'			=> 'single-featured-img',
			'label'			=> __( 'When a single post is displayed, show featured image on top of the post?', 't_em' ),
		),
		'single-related-posts'	=> array (
			'name'			=> 'single-related-posts',
			'label'			=> __( 'When a single post is displayed, show related posts?', 't_em' ),
		),
		'breadcrumb-path'		=> array (
			'name'			=> 'breadcrumb-path',
			'label'			=> __( 'Display a breadcrumb path?', 't_em' ),
		),
	);

	return apply_filters( 't_em_general_options', $general_options );
}

/**
 * Render the General Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_general_options_set(){
	global $t_em_theme_options;
?>
	<div id="general-options">
<?php
	foreach( t_em_general_options() as $general ) :
?>
		<div class="layout checkbox-option general">
			<label class="description single-option">
				<span><?php echo $general['label']; ?></span>
				<?php $checked_option = checked( $t_em_theme_options[$general['name']], '1', false ); ?>
				<input type="checkbox" name="t_em_theme_options[<?php echo $general['name'] ?>]" value="1" <?php echo $checked_option; ?> >
			</label>
		</div>
<?php
	endforeach;
?>
	</div><!-- #general-options -->
<?php
}
?>
