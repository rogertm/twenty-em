<?php
/**
 * Twenty'em theme options.
 *
 * @file			theme-update.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/theme-webmaster-tools.php
 * @link			N/A
 * @since			Version 1.0
 */
?>
<?php
/**
 * Register Webmaster Tools Options Setting
 */
add_action( 'admin_init', 't_em_register_webmaster_tools_options_init' );
function t_em_register_webmaster_tools_options_init(){
	// Register Setting
	register_setting( 't_em_webmaster_tools', 't_em_webmaster_tools_options', 't_em_webmaster_tools_validate' );

	// Register setting file group
	add_settings_section( 'general', '', '__return_false', 'theme-webmaster-tools' );

	// Register individual settings fields
	add_settings_field( 't_em_search_engines_id',	__( 'Search Engines ID', 't_em' ),			't_em_settings_engine_id',		'theme-webmaster-tools',	'general' );
	add_settings_field( 't_em_stats_tracker',		__( 'Site Statistics Tracker', 't_em' ),	't_em_settings_stats_tracker',	'theme-webmaster-tools',	'general' );
}

/**
 * Return an array of search engines options for Twenty'em
 */
function t_em_search_engines_id_options(){
	$engines_options = array (
		'google-id'	=> array(
			'label'	=> __( 'Google ID number', 't_em' ),
			'name'	=> 'google-id',
		),
		'yahoo-id'	=> array(
			'label'	=> __( 'Yahoo! ID number', 't_em' ),
			'name'	=> 'yahoo-id',
		),
		'bing-id'	=> array(
			'label'	=> __( 'Bing ID number', 't_em' ),
			'name'	=> 'bing-id',
		),
	);

	return apply_filters( 't_em_search_engines_options', $engines_options );
}

/**
 * Return an array of stats tracker options for Twenty'em
 */
function t_em_stats_tracker_options(){
	$tracker_options = array (
		// One tracker is enough, Google Yeah!
		'stats-tracker'	=> array (
			'label'		=> __( 'Site Statistics Tracker', 't_em' ),
			'name'	=> 'stats-tracker',
		),
	);

	return apply_filters( 't_em_stats_tracker_options', $tracker_options );
}

/**
 * Return the default stats and engines id options for Twenty'em
 */
function t_em_webmaster_tools_default_options(){
	$default_web_tools_options = array (
		'google-id'			=> '',
		'yahoo-id'			=> '',
		'bing-id'			=> '',
		'stats-tracker'		=> '',
	);

	return apply_filters( 't_em_engine_stats_default_options', $default_web_tools_options );
}

/**
 * Return the dev options array for Twenty'em
 */
function t_em_get_webmaster_tools_options(){
	return get_option( 't_em_webmaster_tools_options', t_em_webmaster_tools_default_options() );
}

/**
 * Render the Search Engines ID setting fields
 */
function t_em_settings_engine_id(){
	$options_web_tools = t_em_get_webmaster_tools_options();
?>
	<div id="search-engine-id-options">
<?php
	foreach ( t_em_search_engines_id_options() as $search_engine ) :
?>
		<div class="layout text-option search-engine">
			<label>
				<span><?php echo $search_engine['label']; ?></span>
				<input type="text" name="t_em_webmaster_tools_options[<?php echo $search_engine['name']; ?>]" value="<?php echo esc_attr( $options_web_tools[$search_engine['name']] ) ?>" />
			</label>
		</div>
<?php
	endforeach;
?>
	</div>
<?php
}

/**
 * Render the Stats Tracker for Twenty'em
 */
function t_em_settings_stats_tracker(){
	$options_web_tools = t_em_get_webmaster_tools_options();
?>
	<div id="stats-tracker-options">
<?php
	foreach ( t_em_stats_tracker_options() as $stat_tracker ) :
?>
		<div class="layout textarea-option stat-tracker">
			<label>
				<span><?php echo $stat_tracker['label']; ?></span>
				<textarea name="t_em_webmaster_tools_options[<?php echo $stat_tracker['name']; ?>]" class="large-text" cols="50" rows="10"><?php echo esc_attr( $options_web_tools[$stat_tracker['name']] ) ?></textarea>
			</label>
		</div>
<?php
	endforeach;
?>
	</div>
<?php
}

function t_em_theme_webmaster_tools(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Webmaster Tools', 't_em' ) ?></h2>
		<?php settings_errors(); ?>

		<form id="t-em-setting" method="post" action="options.php">
			<?php
				settings_fields( 't_em_webmaster_tools' );
				do_settings_sections( 'theme-webmaster-tools' );
				submit_button();
			?>
		</form>
	</div><!-- .wrap -->
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function t_em_webmaster_tools_validate( $input ){
	// Validate all text options
	foreach ( array (
		'google-id',
		'yahoo-id',
		'bing-id',
	) as $text ) :
		$input[$text] = wp_filter_post_kses( $input[$text] );
	endforeach;

	// Validate all textarea options
	foreach ( array (
		'stats-tracker',
	) as $textarea ) :
		$input[$textarea] = wp_kses_stripslashes( $input[$textarea] );
	endforeach;

	return $input;
}

/**
 * Put all these codes on the head section
 */
add_action( 'wp_head', 't_em_google_engine_id' );
function t_em_google_engine_id(){
	$options_web_tools = t_em_get_webmaster_tools_options();
	if ( $options_web_tools['google-id'] )
		echo '<meta name="google-site-verification" content="'. $options_web_tools['google-id'] .'" />'."\n";
}

add_action( 'wp_head', 't_em_yahoo_engine_id' );
function t_em_yahoo_engine_id(){
	$options_web_tools = t_em_get_webmaster_tools_options();
	if ( $options_web_tools['yahoo-id'] )
		echo '<meta name="y_key" content="'. $options_web_tools['yahoo-id'] .'" />'."\n";
}

add_action( 'wp_head', 't_em_bing_engine_id' );
function t_em_bing_engine_id(){
	$options_web_tools = t_em_get_webmaster_tools_options();
	if ( $options_web_tools['bing-id'] )
		echo '<meta name="msvalidate.01" content="'. $options_web_tools['bing-id'] .'" />'."\n";
}

add_action( 'wp_head', 't_em_stats_tracker' );
function t_em_stats_tracker(){
	$options_web_tools = t_em_get_webmaster_tools_options();
	if ( $options_web_tools['stats-tracker'] )
		echo $options_web_tools['stats-tracker']."\n";
}
?>
