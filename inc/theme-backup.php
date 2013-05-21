<?php
/**
 * Twenty'em Backup theme options.
 *
 * @file			theme-backup.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/theme-backup.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
function t_em_backup_export(){

}

if ( isset( $_POST['t-em-backup-export'] ) && $_POST['t-em-backup-export'] == true ) :
	global $wpdb;

	// Check for security
	check_admin_referer( 't-em-backup-export' );

	$export_data = array ( 'all-setting', 'theme-options', 'toolsbox-options', 'webmastertools-options' );

	// Check for invalid exports
	if ( ! in_array( strip_tags( $_POST['export-data'] ), $export_data ) ) { return; }

	$export_type = esc_attr( strip_tags( $_POST['export-data'] ) );

	$export_theme_options			= $wpdb->get_var( "SELECT option_value FROM $wpdb->options
													   WHERE option_name = 't_em_theme_options'" );
	$export_toolsbox_options		= $wpdb->get_var( "SELECT option_value FROM $wpdb->options
													   WHERE option_name = 't_em_tools_box_options'" );
	$export_webmastertools_options	= $wpdb->get_var( "SELECT option_value FROM $wpdb->options
													   WHERE option_name = 't_em_webmaster_tools_options'" );
	$export_all_setting				= $export_theme_options . "\n" .
									  $export_toolsbox_options . "\n" .
									  $export_webmastertools_options;

	switch ( $export_type ) :
		case 'all-setting':
			$exported_data = $export_all_setting;
			break;
		case 'theme-options':
			$exported_data = $export_theme_options;
			break;
		case 'toolsbox-options':
			$exported_data = $export_toolsbox_options;
			break;
		case 'webmastertools-options':
			$exported_data = $export_webmastertools_options;
			break;
		default:
			$exported_data = $export_all_setting;
			break;
	endswitch;

	// We create the export file
	header( 'Content-Description: File Transfer' );
	header( 'Content-Type: text/plain' );
	header( 'Content-Disposition: attachment; filename="t-em-backup-'. $export_type .'-'. date('Ymd-His') .'.txt"' );
	echo $exported_data;
	exit();
endif;

function t_em_theme_backup(){
?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php echo wp_get_theme() . ' ' . __( 'Backup', 't_em' ); ?></h2>
		<h3><?php _e( 'Export', 't_em' ); ?></h3>
		<p><?php _e( 'When you click in the button below <strong>Twenty&#8217;em Framework</strong> will create an TXT file for you to save in your computer.', 't_em' ); ?></p>
		<p><?php _e( 'This file contain all your theme configuration. You can use it to restore your setting in this site or to easily setup another site based on <strong>Twenty&#8217;em Framework</strong>.', 't_em' ); ?></p>
		<form action="<?php echo admin_url( 'admin.php?page=theme-backup' ); ?>" method="post" id="export-theme-data">
			<?php wp_nonce_field( 't-em-backup-export' ); ?>
			<p><label>
				<input type="radio" name="export-data" value="all-setting" checked="checked" />
				<?php _e( 'All Settings', 't_em' ); ?>
				<?php _e( '<span class="description">This will contain all of the options listed below.</span>', 't_em' ); ?>
			</label></p>
			<p><label>
				<input type="radio" name="export-data" value="theme-options" />
				<?php _e( 'Theme Options', 't_em' ); ?>
			</label></p>
			<p><label>
				<input type="radio" name="export-data" value="toolsbox-options" />
				<?php _e( 'Tools Box Options', 't_em' ); ?>
			</label></p>
			<p><label>
				<input type="radio" name="export-data" value="webmastertools-options" />
				<?php _e( 'Webmaster Tools Options', 't_em' ); ?>
			</label></p>
			<?php submit_button( __( 'Download export file', 't_em' ) ); ?>
			<input type="hidden" name="t-em-backup-export" value="true" />
		</form>
	</div>
<?php
}
?>
