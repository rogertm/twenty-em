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
 * Register Dev Options Setting
 */
add_action( 'admin_init', 't_em_register_tools_box_options_init' );
function t_em_register_tools_box_options_init(){
	// Register setting
	register_setting( 't_em_tools_box', 't_em_tools_box_options', 't_em_tools_box_options_validate' );

	// Register setting file group
	add_settings_section( 'general', '', '__return_false', 'theme-tools-box' );

	// Register individual settings fields
	add_settings_field( 't_em_tools_box_frameworks',	__( 'Tools Box', 't_em' ),	't_em_settings_tools_box_frameworks',	'theme-tools-box',	'general' );
}

/**
 * Return an array of frameworks options for Twenty'em
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
		'icomoon'	=> array (
			'name'			=> 'icomoon',
			'url'			=> 'http://icomoon.io',
			'label'			=> __( 'IcoMoon', 't_em' ),
			'sublabel'		=> __( 'Font Simbols for Retina Display.', 't_em' ),
			'description'	=> __( 'If active, you will access to a big set of icons.', 't_em' ),
		)
	);

	return apply_filters( 't_em_tools_box_frameworks_options', $frameworks_options );
}

/**
 * Return the default dev options for Twenty'em
 */
function t_em_tools_box_default_options(){
	$default_tools_box_options = array (
		'golden-grid-system'	=> '',
		'icomoon'				=> '1',
	);

	return apply_filters( 't_em_tools_box_default_options', $default_tools_box_options );
}

/**
 * Return the dev options array for Twenty'em
 */
function t_em_get_tools_box_options(){
	return get_option( 't_em_tools_box_options', t_em_tools_box_default_options() );
}

/**
 * Render the frameworks setting fields
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
 * Display Dev Options Page
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
 */
function t_em_tools_box_options_validate( $input ){
	// All the checkbox are either 0 or 1
	foreach ( array(
		'golden-grid-system',
		'icomoon',
	) as $checkbox ) :
		if ( !isset( $input[$checkbox] ) )
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	endforeach;

	return $input;
}
?>
