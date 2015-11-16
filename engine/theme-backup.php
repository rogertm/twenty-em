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
/**
 * Generate a backup TXT file with all the theme options data.
 *
 * @uses check_admin_referer() Tests either if the current request carries a valid nonce, or if the
 * current request was referred from an administration screen.
 *
 * @global $wpdb
 *
 * @link http://codex.wordpress.org/Function_Reference/check_admin_referer
 * @link http://codex.wordpress.org/Class_Reference/wpdb
 *
 * @since Twenty'em 1.0
 */
function t_em_backup_export(){
	global 	$wpdb;

	// Check for security
	if ( isset( $_POST['t_em_backup_export'] ) && $_POST['t_em_backup_export'] === 'true' && check_admin_referer( 't_em_backup_export', 't_em_backup_export_nonce_time' ) ) :
		$export_theme_options =	$wpdb->get_var( $wpdb->prepare (" SELECT option_value
																  FROM $wpdb->options
																  WHERE option_name = %s",
																  't_em_theme_options' ) );

		if ( $export_theme_options == '' ) :
			wp_redirect( admin_url( 'admin.php?page=twenty-em-backup&export-error=true' ) );
			exit;
		endif;

		/* Add our water mark. Only files with this water mark will be imported successfully.
		 * We encrypt this var in the output just to impress. :)
		 */
		$water_mark = 'twenty-em-backup-file';

		$output = __( 'WARNING: Do not edit this files. It contains your theme configuration settings', 't_em' ) . "\n";
		$output .= date( 'Y-m-d @ H:i:s' ) . "\n";
		$output .= md5( $water_mark ) . "\n";
		$output .= $export_theme_options;

		// We create the export file
		header( 'Content-Description: File Transfer' );
		header( 'Content-Type: text/plain' );
		header( 'Content-Disposition: attachment; filename="t-em-backup-'. date('Ymd-His') .'.txt"' );
		echo $output;
		exit;
	else:
		wp_redirect( admin_url( 'admin.php?page=twenty-em-backup&export-error=true' ) );
		exit;
	endif;
} // t_em_backup_export()

/**
 * Upload file containing the backup settings
 *
 * @uses check_admin_referer() Tests either if the current request carries a valid nonce, or if the
 * current request was referred from an administration screen.
 *
 * @global $wpdb
 *
 * @link http://codex.wordpress.org/Function_Reference/check_admin_referer
 * @link http://codex.wordpress.org/Class_Reference/wpdb
 *
 * @since Twenty'em 1.0
 */
function t_em_backup_import(){
	global $wpdb;

	// Check for security
	if ( isset( $_POST['t_em_backup_import'] ) && $_POST['t_em_backup_import'] === 'true' && check_admin_referer( 't_em_backup_import', 't_em_backup_import_nonce_time' ) ) :

		// If the import setting has not been sent, we do nothing
		if ( ! isset( $_FILES['import_theme_data'] ) ) { return; }

		// Check if the uploaded file is our file
		if ( is_uploaded_file( $_FILES['import_theme_data']['tmp_name'] ) ) :
			// Read the file and extract its content
			$upload_file = file_get_contents( $_FILES['import_theme_data']['tmp_name'] );

			// Stop! Who's coming?
			$whos_coming = explode( "\n", $upload_file );

			// Check for our water mark and so on...
			if ( $whos_coming[2] != md5( 'twenty-em-backup-file' ) ) :
				wp_redirect( admin_url( 'admin.php?page=twenty-em-backup&error=true' ) );
				exit;
			endif;

			// Searching needles in the stack of straw to clean the dunghill
			$dirty[0] = '/' . $whos_coming[0] . '/'; // WARNING Massage
			$dirty[1] = '/' . $whos_coming[1] . '/'; // Date && Time
			$dirty[2] = '/' . $whos_coming[2] . '/'; // Water Mark
			$clean[0] = null;
			$clean[1] = null;
			$clean[2] = null;
			$clean_export_string = preg_replace( $dirty, $clean, $upload_file );
			$split_export_string = str_replace( "\n\n\n", "", $clean_export_string );

			$wpdb->update(
					$wpdb->options,
					array( 'option_value' => $split_export_string ),
					array( 'option_name' => 't_em_theme_options' )
				);

		$wpdb->flush();

		endif;
	else :
		wp_redirect( admin_url( 'admin.php?page=twenty-em-backup&error=true' ) );
		exit;
	endif;
} // t_em_backup_import()

/**
 * Prints notices massages on the screen, after export or import are performed
 */
function t_em_backup_notice(){
	if ( isset( $_GET['error'] ) && $_GET['error'] == true ) :
		echo '<div id="error-massage" class="error"><p>'. __( 'There was an error importing your data. Please try again', 't_em' ) .'</p></div>';
	elseif ( isset( $_GET['export-error'] ) && $_GET['export-error'] == true ) :
		echo '<div id="error-massage" class="error"><p>'. __( 'There was an error exporting your data. Please try again', 't_em' ) .'</p></div>';
	elseif ( isset( $_GET['import'] ) && $_GET['import'] == true ) :
		echo '<div id="massage" class="updated"><p>' . sprintf( __( 'Settings successfully imported. Back to <a href="%1$s">Theme Options</a> or <a href="%2$s">Visit your site</a>', 't_em' ), admin_url( 'admin.php?page=twenty-em-options' ), home_url() ) . '</p></div>';
	endif;
}

if ( ! isset( $_POST['t_em_backup_import'] ) && isset( $_POST['t_em_backup_export'] ) && $_POST['t_em_backup_export'] == true ) :
	t_em_backup_export();
endif;
if ( ! isset( $_POST['t_em_backup_export'] ) && isset( $_POST['t_em_backup_import'] ) && $_POST['t_em_backup_import'] == true ) :
	t_em_backup_import();
endif;

function t_em_theme_backup(){
?>
	<div class="wrap">
		<h2><?php echo T_EM_FRAMEWORK_NAME . ' ' . __( 'Backup', 't_em' ); ?></h2>
		<section id="export-settings">
			<h3><?php _e( 'Export Settings', 't_em' ); ?></h3>
			<?php t_em_backup_notice(); ?>
			<p><?php printf( __( 'When you click in the button below <strong>%s Framework</strong> will create an TXT file for you to save in your computer.', 't_em' ), T_EM_FRAMEWORK_NAME ); ?></p>
			<p><?php printf( __( 'This file contain all your theme configuration. You can use it to restore your setting in this site or to easily setup another site based on <strong>%s Framework</strong>.', 't_em' ), T_EM_FRAMEWORK_NAME ); ?></p>
			<form action="options.php" method="post">
				<?php wp_nonce_field( 't_em_backup_export', 't_em_backup_export_nonce_time' ); ?>
				<?php submit_button( __( 'Download export file', 't_em' ) ); ?>
				<input type="hidden" name="t_em_backup_export" value="true" />
			</form>
		</section><!-- #export-settings -->

		<section id="import-settings">
			<h3><?php _e( 'Import Settings', 't_em' ); ?></h3>
			<p><?php printf( __( 'If you have your settings in a backup file in your computer, <strong>%s Framework</strong> can import those settings into this site', 't_em' ), T_EM_FRAMEWORK_NAME ); ?></p>
			<form enctype="multipart/form-data" action="<?php echo admin_url( 'admin.php?page=twenty-em-backup&import=true' ); ?>" method="post">
				<?php wp_nonce_field( 't_em_backup_import', 't_em_backup_import_nonce_time' ); ?>
				<label>
					<?php printf( __( 'Upload File: (Maximum Size: %s)', 't_em' ), ini_get( 'post_max_size' ) ); ?><br />
					<input type="file" name="import_theme_data" />
				</label>
				<?php submit_button( __( 'Upload file and import', 't_em' ) ); ?>
				<input type="hidden" name="t_em_backup_import" value="true" />
			</form>
		</section><!-- #import-settings -->
	</div>
<?php
}
?>
