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
function t_em_search_engines_id_options( $engines_options = '' ){
	$engines_options = array(
		'google_id'		=> array(
			'label'		=> __( 'Google Webmaster Tools', 't_em' ),
			'name'		=> 'google_id',
		),
		'bing_id'		=> array(
			'label'		=> __( 'Bing Webmaster Center', 't_em' ),
			'name'		=> 'bing_id',
		),
		'pinterest_id'	=> array(
			'label'		=> __( 'Pinterest Site Verification', 't_em' ),
			'name'		=> 'pinterest_id',
		),
	);

	return apply_filters( 't_em_admin_filter_search_engines_options', $engines_options );
}

/**
 * Return an array of Site Statistics Tracker for Webmaster Tools  admin panel
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_stats_tracker_options( $tracker_options = '' ){
	$tracker_options = array(
		'stats_tracker_header_tag'	=> array(
			'label'		=> __( 'Site Statistics Tracker (into <code>&lt;header&gt;</code> ...<code>&lt;/header&gt;</code> tags)', 't_em' ),
			'name'		=> 'stats_tracker_header_tag',
		),
		'stats_tracker_body_tag'	=> array(
			'label'		=> __( 'Site Statistics Tracker (Before close <code>&lt;/body&gt;</code> tag)', 't_em' ),
			'name'		=> 'stats_tracker_body_tag',
		),
	);

	return apply_filters( 't_em_admin_filter_stats_tracker_options', $tracker_options );
}

/**
 * Render both functions in admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_field_webmaster_tools_set(){
	global $t_em;
?>
	<div id="webmaster-tools-options">
		<?php do_action( 't_em_admin_action_webmaster_tools_options_before' ); ?>
		<div class="sub-extend option-group">
			<header><?php _e( 'Trackers ID numbers', 't_em' ); ?></header>
			<p class="alert alert-critical"><?php echo sprintf( __( '<strong>NOTE</strong>: Just the ID number, the <code>%1$s</code> tag is not needed', 't_em' ), '&lt;meta /&gt;' ); ?></p>
<?php
		foreach ( t_em_search_engines_id_options() as $search_engine ) :
?>
			<div class="layout text-option search-engine">
				<label>
					<span><?php echo $search_engine['label']; ?></span>
					<input class="headline regular-text" type="text" name="t_em_theme_options[<?php echo $search_engine['name']; ?>]" value="<?php echo esc_attr( $t_em[$search_engine['name']] ) ?>" />
				</label>
			</div>
<?php
		endforeach;
?>
		</div>

		<div class="sub-extend option-group">
			<header><?php _e( 'Trackers Statistics Codes', 't_em' ); ?></header>
			<p class="alert alert-critical"><?php echo sprintf( __( '<strong>NOTE</strong>: Just the code, the <code>%1$s</code> and <code>%2$s</code> tags are not needed', 't_em' ), '&lt;script type="text/javascript"&gt', '&lt;/script&gt' ); ?></p>
<?php
	foreach ( t_em_stats_tracker_options() as $stat_tracker ) :
?>
			<div class="layout textarea-option stat-tracker option-single">
				<label>
					<span><?php echo $stat_tracker['label']; ?></span>
					<p><textarea name="t_em_theme_options[<?php echo html_entity_decode( $stat_tracker['name'] ); ?>]" class="large-text" cols="50" rows="10"><?php echo esc_attr( $t_em[$stat_tracker['name']] ) ?></textarea></p>
				</label>
			</div>
<?php
		endforeach;
?>
		</div>
		<?php do_action( 't_em_admin_action_webmaster_tools_options_after' ); ?>
	</div><!-- #webmaster-tools-options -->
<?php
}
?>
