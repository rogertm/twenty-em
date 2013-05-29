<?php
/**
 * Twenty'em Front Page theme options.
 *
 * @file			front-page-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/front-page-options.php
 * @link			N/A
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Return an array of Front Page Options for Twenty'em admin panel.
 *
 * @return array
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_options(){
	$front_page_options = array (
		'text-widget-one' => array (
			'name'			=> 'text-widget-one',
			'label'			=> __( 'First home page text area', 't_em' ),
			'headline'		=> '',
			'content'		=> '',
			'css-classes'	=> '',
			'icon-src'		=> '',
			'link-url'		=> '',
		),
		'text-widget-two' => array (
			'name'			=> 'text-widget-two',
			'label'			=> __( 'Second home page text area', 't_em' ),
			'headline'		=> '',
			'content'		=> '',
			'css-classes'	=> '',
			'icon-src'		=> '',
			'link-url'		=> '',
		),
		'text-widget-three' => array (
			'name'			=> 'text-widget-three',
			'label'			=> __( 'Third home page text area', 't_em' ),
			'headline'		=> '',
			'content'		=> '',
			'css-classes'	=> '',
			'icon-src'		=> '',
			'link-url'		=> '',
		),
		'text-widget-four' => array (
			'name'			=> 'text-widget-four',
			'label'			=> __( 'Fourth home page text area', 't_em' ),
			'headline'		=> '',
			'content'		=> '',
			'css-classes'	=> '',
			'icon-src'		=> '',
			'link-url'		=> '',
		),
	);

	return apply_filters( 't_em_front_page_options', $front_page_options );
}

/**
 * Render the Front Page Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_field_front_page_options_set(){
	global $t_em_theme_options;
?>
	<div id="front-page-options">
<?php
	foreach ( t_em_front_page_options() as $front_page ) :
?>
		<div id="<?php echo $front_page['name'] ?>" class="layout text-option front-page">
			<p><?php echo $front_page['label']; ?></p>
			<label><span><?php _e( 'Headline', 't_em' ); ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[headline-<?php echo $front_page['name']; ?>]" value="" />
			</label>
			<label><span><?php _e( 'Content', 't_em' ); ?></span>
				<textarea name="t_em_theme_options[content-<?php echo $front_page['name'] ?>]" class="large-text" cols="50" rows="10"></textarea>
			</label>
			<label><span><?php _e( 'CSS Classes', 't_em' ); ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[css-classes-<?php echo $front_page['name']; ?>]" value="" />
			</label>
			<label><span><?php _e( 'Icon URL', 't_em' ); ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[icon-src-<?php echo $front_page['name']; ?>]" value="" />
			</label>
			<label><span><?php _e( 'Link URL', 't_em' ); ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[link-url-<?php echo $front_page['name']; ?>]" value="" />
			</label>
		</div>
<?php
	endforeach;
?>
	</div>
<?php
}
?>
