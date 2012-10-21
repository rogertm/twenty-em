<?php
/**
 * Twenty'em theme options.
 *
 * @file			theme-options-dev.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/theme-options-dev.php
 * @link			http://codex.wordpress.org/Administration_Menus
 * @since			Version 1.0
 */
?>
<?php
/**
 * Register Dev Options Setting
 */
add_action( 'admin_init', 't_em_register_dev_options_init' );
function t_em_register_dev_options_init(){
	// Register setting
	register_setting( 't_em_dev', 't_em_dev_options'/*, 't_em_dev_options_validate'*/ );

	// Register setting file group
	add_settings_section( 'general', '', '__return_false', 'theme-options-dev' );

	// Register individual settings fields
	add_settings_field( 't_em_dev_frameworks',	__( 'Javascript and CSS Frameworks', 't_em' ),	't_em_settings_dev_frameworks',	'theme-options-dev',	'general' );
}

/**
 * Return an array of frameworks options for Twenty'em
 */
function t_em_dev_frameworks_options(){
	$frameworks_options = array (
		'golden-grid-system' => array (
			'name'			=> 'golden-grid-system',
			'url'			=> 'http://goldengridsystem.com/',
			'label'			=> __( 'Golden Grid System', 't_em' ),
			'sublabel'		=> __( 'A folding grid for responsive design.', 't_em' ),
			'description'	=> __( 'If active, a folding grid will be displayed (right top of your home page), whish helps you to organize your desing and make it responsive.', 't_em' ),
		),
		'jquery-cycle-lite' => array (
			'name'			=> 'jquery-cycle-lite',
			'url'			=> 'http://malsup.com/jquery/cycle/lite/',
			'label'			=> __( 'jQuery Cycle Lite Plugin', 't_em' ),
			'sublabel'		=> __( 'The <strong>jQuery Cycle Lite Plugin</strong> is a lighter version of the <a href="http://jquery.malsup.com/" target="_blank">Cycle Plugin</a>. The Lite version is optimized for file size and includes only a fade transition.', 't_em' ),
			'description'	=> sprintf( __( 'By default <strong>%s</strong> use <strong>jQuery Cycle Full Version</strong> for the slider section. If you enable jQuery Cycle Lite, full version will be disable.', 't_em' ), wp_get_theme() ),
		),
	);

	return apply_filters( 't_em_dev_frameworks_options', $frameworks_options );
}

/**
 * Return the default dev options for Twenty'em
 */
function t_em_dev_default_options(){
	$default_dev_options = array (
		'golden-grid-system'	=> '',
		'jquery-cycle-lite'		=> '',
	);

	return apply_filters( 't_em_dev_default_options', $default_dev_options );
}

/**
 * Return the dev options array for Twenty'em
 */
function t_em_get_dev_options(){
	return get_option( 't_em_dev_options', t_em_dev_default_options() );
}

/**
 * Render the frameworks setting fields
 */
function t_em_settings_dev_frameworks(){
	$options_dev = t_em_get_dev_options();
?>
	<div id="framework-options">
<?php
	$theme_data = wp_get_theme();
	$theme_name = $theme_data->display('Name');
	$count_frameworks = count( t_em_dev_frameworks_options() );
	if ( $count_frameworks == '1' ) :
		$all_frameworks = __( 'a', 't_em' );
	elseif ( $count_frameworks == '2' ) :
		$all_frameworks = __( 'two', 't_em' );
	else :
		$all_frameworks = __( 'a few', 't_em' );
	endif;
?>
		<p><?php printf( __( '<strong>%1$s</strong> provides %2$s Javascript and CSS Framework to make your work easier.', 't_em' ), $theme_name, $all_frameworks ) ?></p>
<?php
	foreach ( t_em_dev_frameworks_options() as $framework ) :
?>
		<div class="layout checbox-option framework">
			<p><strong><a href="<?php echo $framework['url'] ?>" target="_blank"><?php echo $framework['label']; ?></a></strong></p>
			<p><?php echo $framework['sublabel']; ?></p>
			<p><?php echo $framework['description']; ?></p>
			<label class="description">
				<span><?php printf( __( 'Enable %s?', 't_em' ), $framework['label'] ); ?></span>
				<?php
				if ( $options_dev != '' ) :
					$checked = ( array_key_exists( $framework['name'], $options_dev ) && $options_dev[$framework['name']] == 'yes' ) ? 'checked="checked"' : '';
				else :
					$checked = '';
				endif;
				?>
				<?php ?>
				<input type="checkbox" name="t_em_dev_options[<?php echo $framework['name']; ?>]" value="yes" <?php echo $checked; ?> />
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
function t_em_theme_options_dev(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Developers Zone', 't_em' ) ?></h2>
		<?php settings_errors(); ?>

		<form id="t-em-dev" method="post" action="options.php">
			<?php
				settings_fields( 't_em_dev' );
				do_settings_sections( 'theme-options-dev' );
				submit_button();
			?>
		</form>
	</div><!-- .wrap -->
<?php
}
?>
