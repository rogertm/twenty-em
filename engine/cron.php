<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.0.1
 */

/**
 * Twenty'em Cron Jobs
 */

/**
 * Check if Maintenance Mode is active and if it is out of time also.
 * If automatically return is active, go for it.
 */

function t_em_admin_action_schedule_maintenance_mode_event(){
	wp_schedule_event( time(), 'daily', 't_em_admin_action_schedule_maintenance_mode_event' );
}
add_action( 'wp', 't_em_admin_action_schedule_maintenance_mode_event' );

function t_em_maintenance_mode_do_auto_reactive(){
	global $t_em;
	if ( $t_em['maintenance_mode'] == 1 && $t_em['maintenance_mode_reactive'] == 1 && $t_em['maintenance_mode_timer'] != '' ) :
		$end_date = new DateTime( $t_em['maintenance_mode_timer'] );
		$today = new DateTime( date( 'Y-m-d' ) );
		if ( $end_date <= $today ) :
			$maintenance_mode_off = array(
										'maintenance_mode'			=> 0,
										'maintenance_mode_reactive'	=> 0,
									);
			$update_options = array_replace( $t_em, $maintenance_mode_off );
			update_option( 't_em_theme_options', $update_options );
		endif;
	endif;
}
add_action( 't_em_admin_action_schedule_maintenance_mode_event', 't_em_maintenance_mode_do_auto_reactive' );
?>
