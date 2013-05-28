<?php
/**
 * Twenty'em shortcodes.
 *
 * @file			shortcodes.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/shortcodes.php
 * @link			http://codex.wordpress.org/Shortcode_API
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Include additional buttons in the Text (HTML) mode of the WordPress editor
 *
 * @link http://codex.wordpress.org/Quicktags_API
 *
 * @since Twenty'em 1.0
 */
function t_em_quickttags_buttons(){
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_success', 'success', '[success]', '[/success]', '', '', 121 );
		QTags.addButton( 'sc_warning', 'warning', '[warning]', '[/warning]', '', '', 122 );
		QTags.addButton( 'sc_important', 'important', '[important]', '[/important]', '', '', 123 );
		QTags.addButton( 'sc_info', 'info', '[info]', '[/info]', '', '', 124 );
		QTags.addButton( 'sc_inverse', 'inverse', '[inverse]', '[/inverse]', '', '', 125 );
		QTags.addButton( 'sc_download', 'download', '[download src=""]', '[/download]', '', '', 126 );
		QTags.addButton( 'sc_demo', 'demo', '[demo href=""]', '[/demo]', '', '', 127 );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );
?>
