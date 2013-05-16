<?php
/**
 * Twenty'em Tools Box theme options.
 *
 * @file			theme-tools-box.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/theme-tools-box.php
 * @link			http://codex.wordpress.org/Settings_API
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Register the form setting for our t_em_tools_box_options array.
 * This function is attached to the admin_menu() action hook.
 *
 * @uses register_setting() Register a setting and its sanitization callback.
 * @uses add_settings_section() This are groups of settings you see on Twenty'em settings pages with
 * a shared heading.
 * @uses add_settings_field() Register a settings field to a settings page and section.
 *
 * @link http://codex.wordpress.org/Settings_API
 *
 * @since Twenty'em 0.1
 */
function t_em_register_tools_box_options_init(){
	// Register setting
	register_setting( 't_em_tools_box', 't_em_tools_box_options', 't_em_tools_box_options_validate' );

	// Register setting file group
	add_settings_section( 'general', '', '__return_false', 'theme-tools-box' );

	// Register individual settings fields
	add_settings_field( 't_em_tools_box_frameworks',	__( 'Tools Box', 't_em' ),	't_em_settings_tools_box_frameworks',	'theme-tools-box',	'general' );
}
add_action( 'admin_init', 't_em_register_tools_box_options_init' );

/**
 * Return the default options values for Twenty'em Tools Box after the theme is loaded for first
 * time.
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_tools_box_default_options(){
	$default_tools_box_options = array (
		'golden-grid-system'	=> '',
	);

	return apply_filters( 't_em_tools_box_default_options', $default_tools_box_options );
}

/**
 * Return an array of Tools Box for Twenty'em admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_tools_box_frameworks_options(){
	global $t_em_theme_data;
	$frameworks_options = array (
		'golden-grid-system' => array (
			'name'			=> 'golden-grid-system',
			'url'			=> 'http://goldengridsystem.com/',
			'label'			=> __( 'Golden Grid System', 't_em' ),
			'sublabel'		=> __( 'A folding grid for responsive design.', 't_em' ),
			'description'	=> __( 'If active, a folding grid will be displayed (right top of your home page), whish helps you to organize your desing and make it responsive.', 't_em' ),
		),
	);

	return apply_filters( 't_em_tools_box_frameworks_options', $frameworks_options );
}

/**
 * Return the whole configuration for Tools Box stored in the data base.
 * Referenced via t_em_set_globals() in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_get_tools_box_options(){
	return get_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
}

/**
 * Render the Tools Box Options setting field in admin panel.
 * Referenced via t_em_register_tools_box_options_init(), add_settings_field() callback.
 *
 * @global $t_em_tools_box_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_tools_box_frameworks(){
	global $t_em_tools_box_options;
?>
	<div id="framework-options">
<?php
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
?>
		<p><?php printf( __( '<strong>%1$s</strong> provides some Tools to make your work easier.', 't_em' ), $theme_name ) ?></p>
<?php
	foreach ( t_em_tools_box_frameworks_options() as $framework ) :
?>
		<div class="layout checbox-option framework">
			<h3><a href="<?php echo $framework['url'] ?>" target="_blank"><?php echo $framework['label']; ?></a></h3>
			<p><?php echo $framework['sublabel']; ?></p>
			<p><?php echo $framework['description']; ?></p>
			<label class="description">
				<span><?php printf( __( 'Enable %s?', 't_em' ), $framework['label'] ); ?></span>
				<?php $checked_option = checked( $t_em_tools_box_options[$framework['name']], '1', false ); ?>
				<input type="checkbox" name="t_em_tools_box_options[<?php echo $framework['name']; ?>]" value="1" <?php echo $checked_option; ?> />
			</label>
		</div>
<?php
	endforeach;
?>
	</div>
<?php
}

/**
 * Finally a Tools Box Page is displayed.
 * Referenced via t_em_theme_options_admin_page(), add_menu_page() callback
 *
 * @uses settings_fields() Output nonce, action, and option_page fields for a settings page.
 * @uses do_settings_sections() Prints out all settings sections added to /inc/theme-options.php.
 *
 * @link http://codex.wordpress.org/Settings_API
 * @link http://codex.wordpress.org/Administration_Menus
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_tools_box_options(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Tools Box', 't_em' ) ?></h2>
		<?php settings_errors(); ?>

		<form id="t-em-setting" method="post" action="options.php">
			<?php
				settings_fields( 't_em_tools_box' );
				do_settings_sections( 'theme-tools-box' );
				submit_button();
			?>
		</form>
	</div><!-- .wrap -->
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 * Referenced via t_em_register_tools_box_options_init(), register_setting() callback.
 *
 * @since Twenty'em 0.1
 */
function t_em_tools_box_options_validate( $input ){
	// All the checkbox are either 0 or 1
	foreach ( array(
		'golden-grid-system',
	) as $checkbox ) :
		if ( !isset( $input[$checkbox] ) )
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	endforeach;

	return $input;
}
?>
