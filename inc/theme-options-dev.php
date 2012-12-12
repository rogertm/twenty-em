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
 * @link			http://codex.wordpress.org/Settings_API
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
	register_setting( 't_em_dev', 't_em_dev_options', 't_em_dev_options_validate' );

	// Register setting file group
	add_settings_section( 'general', '', '__return_false', 'theme-options-dev' );

	// Register individual settings fields
	add_settings_field( 't_em_dev_frameworks',	__( 'Javascript and CSS Frameworks or Tools', 't_em' ),	't_em_settings_dev_frameworks',	'theme-options-dev',	'general' );
}

/**
 * Return an array of frameworks options for Twenty'em
 */
function t_em_dev_frameworks_options(){
	$frameworks_options = array (
		'less-css'			=> array (
			'name'			=> 'less-css',
			'url'			=> 'http://lesscss.org/',
			'label'			=> __( 'LESS', 't_em' ),
			'sublabel'		=> __( 'The dynamic stylesheet language.', 't_em' ),
			'description'	=> sprintf( __( 'By default <strong>%s</strong> use <a href="http://lesscss.org/">LESS dynamic stylesheet language</a>. LESS extends CSS with dynamic behavior such as variables, mixins, operations and functions. LESS runs on both the client-side (Chrome, Safari, Firefox) and server-side, with Node.js and Rhino.', 't_em' ), wp_get_theme() ),
		),
		'modernizr'			=> array (
			'name'			=> 'modernizr',
			'url'			=> 'http://www.modernizr.com/',
			'label'			=> __( 'Modernizr', 't_em' ),
			'sublabel'		=> __( '', 't_em' ),
			'description'	=> __( 'Modernizr is a small JavaScript library that detects the availability of native implementations for next-generation web technologies, i.e. features that stem from the HTML5 and CSS3 specifications', 't_em' ),
		),
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
		'jquery-easing'		=> array (
			'name'			=> 'jquery-easing',
			'url'			=> 'http://gsgd.co.uk/sandbox/jquery/easing/',
			'label'			=> __( 'jQuery Easing Plugin', 't_em' ),
			'sublabel'			=> sprintf( __( 'A jQuery plugin from <a href="%s" target="_blank">GSGD</a> to give advanced easing options.', 't_em' ), 'http://gsgd.co.uk/' ),
			'description'	=> __( 'Some description', 't_em' ),
		),
	);

	return apply_filters( 't_em_dev_frameworks_options', $frameworks_options );
}

/**
 * Return the default dev options for Twenty'em
 */
function t_em_dev_default_options(){
	$default_dev_options = array (
		'less-css'				=> '1',
		'modernizr'				=> '1',
		'golden-grid-system'	=> '',
		'jquery-cycle-lite'		=> '',
		'jquery-easing'			=> '',
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
		<p><?php printf( __( '<strong>%1$s</strong> provides %2$s Javascript and CSS Frameworks or Tools to make your work easier.', 't_em' ), $theme_name, $all_frameworks ) ?></p>
<?php
	foreach ( t_em_dev_frameworks_options() as $framework ) :
?>
		<div class="layout checbox-option framework">
			<h3><a href="<?php echo $framework['url'] ?>" target="_blank"><?php echo $framework['label']; ?></a></h3>
			<p><?php echo $framework['sublabel']; ?></p>
			<p><?php echo $framework['description']; ?></p>
			<label class="description">
				<span><?php printf( __( 'Enable %s?', 't_em' ), $framework['label'] ); ?></span>
				<?php $checked_option = checked( $options_dev[$framework['name']], '1', false ); ?>
				<input type="checkbox" name="t_em_dev_options[<?php echo $framework['name']; ?>]" value="1" <?php echo $checked_option; ?> />
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

		<form id="t-em-setting" method="post" action="options.php">
			<?php
				settings_fields( 't_em_dev' );
				do_settings_sections( 'theme-options-dev' );
				submit_button();
			?>
		</form>
	</div><!-- .wrap -->
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function t_em_dev_options_validate( $input ){
	// All the checkbox are either 0 or 1
	foreach ( array(
		'less-css',
		'modernizr',
		'golden-grid-system',
		'jquery-cycle-lite',
		'jquery-easing',
	) as $checkbox ) :
		if ( !isset( $input[$checkbox] ) )
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	endforeach;

	return $input;
}
?>
