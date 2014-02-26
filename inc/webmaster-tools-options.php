<?php
/**
 * Twenty'em Webmaster Tools theme options.
 *
 * @file			webmaster-tools-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/webmaster-tools-options.php
 * @link			N/A
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Return an array of Search Engines ID for Webmaster Tools  admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_search_engines_id_options(){
	$engines_options = array (
		'google_id'	=> array(
			'label'	=> __( 'Google ID number', 't_em' ),
			'name'	=> 'google_id',
		),
		'bing_id'	=> array(
			'label'	=> __( 'Bing ID number', 't_em' ),
			'name'	=> 'bing_id',
		),
	);

	return apply_filters( 't_em_search_engines_options', $engines_options );
}

/**
 * Return an array of Site Statistics Tracker for Webmaster Tools  admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_stats_tracker_options(){
	$tracker_options = array (
		'stats_tracker_header_tag'	=> array (
			'label'		=> __( 'Site Statistics Tracker (into <code>&lt;header&gt;</code> ...<code>&lt;/header&gt;</code> tags)', 't_em' ),
			'name'		=> 'stats_tracker_header_tag',
		),
		'stats_tracker_body_tag'	=> array (
			'label'		=> __( 'Site Statistics Tracker (Before close <code>&lt;/body&gt;</code> tag)', 't_em' ),
			'name'		=> 'stats_tracker_body_tag',
		),
	);

	return apply_filters( 't_em_stats_tracker_options', $tracker_options );
}

/**
 * Render the Search Engine ID Options setting field in admin panel.
 * Referenced via t_em_register_webmaster_tools_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_webmaster_tools_options See t_em_restore_from_scratch() function in /inc/theme-options.php
 * file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_engine_id(){
	global $t_em;
?>
		<p><strong><?php _e( 'Trackers ID numbers', 't_em' ); ?></strong></p>
		<p><?php echo sprintf( __( '<strong>NOTE</strong>: Just the ID number, the <code>%1$s</code> tag is not needed', 't_em' ), '&lt;meta /&gt;' ); ?></p>
<?php
	foreach ( t_em_search_engines_id_options() as $search_engine ) :
?>
		<div class="layout text-option search-engine">
			<label>
				<span><?php echo $search_engine['label']; ?></span>
				<input type="text" name="t_em_theme_options[<?php echo $search_engine['name']; ?>]" value="<?php echo esc_attr( $t_em[$search_engine['name']] ) ?>" />
			</label>
		</div>
<?php
	endforeach;
}

/**
 * Render the Site Statistics Tracker Options setting field in admin panel.
 * Referenced via t_em_register_webmaster_tools_options_init(), add_settings_field() callback.
 *
 * @global $t_em_webmaster_tools_options See t_em_restore_from_scratch() function in /inc/theme-options.php
 * file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_stats_tracker(){
	global $t_em;
?>
		<p><strong><?php _e( 'Trackers Statistics Codes', 't_em' ); ?></strong></p>
		<p><?php echo sprintf( __( '<strong>NOTE</strong>: Just the code, the <code>%1$s</code> and <code>%2$s</code> tags are not needed', 't_em' ), '&lt;script type="text/javascript"&gt', '&lt;/script&gt' ); ?></p>

<?php
	foreach ( t_em_stats_tracker_options() as $stat_tracker ) :
?>
		<div class="layout textarea-option stat-tracker">
			<label>
				<span><?php echo $stat_tracker['label']; ?></span>
				<textarea name="t_em_theme_options[<?php echo html_entity_decode( $stat_tracker['name'] ); ?>]" class="large-text" cols="50" rows="10"><?php echo esc_attr( $t_em[$stat_tracker['name']] ) ?></textarea>
			</label>
		</div>
<?php
	endforeach;
}

/**
 * Render both functions in admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_field_webmaster_tools_set(){
?>
	<div id="search-engine-id-tracker">
<?php
	t_em_settings_engine_id();
	t_em_settings_stats_tracker();
?>
	</div>
<?php
}


function t_em_stats_header_tracker(){
	global $t_em;

	// Google Engine ID
	if ( $t_em['google_id'] )
		echo '<meta name="google-site-verification" content="' . html_entity_decode( $t_em['google_id'] ) . '" />' . "\n";

	// Bing Engine ID
	if ( $t_em['bing_id'] )
		echo '<meta name="msvalidate.01" content="' . html_entity_decode( $t_em['bing_id'] ) . '" />' . "\n";

	// Header Stats Tracker
	if ( $t_em['stats_tracker_header_tag'] )
		echo '<script type="text/javascript">' . html_entity_decode( $t_em['stats_tracker_header_tag'] ) . '</script>' . "\n";
}
add_action( 'wp_head', 't_em_stats_header_tracker' );

function t_em_stats_body_tracker(){
	global $t_em;

	// Body Stats Tracker
	if ( $t_em['stats_tracker_body_tag'] )
		echo '<script type="text/javascript">' . html_entity_decode( $t_em['stats_tracker_body_tag'] ) . '</script>' . "\n";
}
add_action( 'wp_footer', 't_em_stats_body_tracker' );
?>
