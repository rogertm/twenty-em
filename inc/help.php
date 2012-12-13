<?php
/**
 * Twenty'em contextual help screens.
 *
 * @file			help.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/help.php
 * @link			N/A
 * @since			Version 1.0
 */
?>
<?php
/**
 * Add contextual help to theme options screen
 */
function t_em_theme_options_help(){
	global $t_em_theme_data;
	$help = '<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/framework" title="Twenty\'em Framework" target="_blank">Twenty\'em Framework</a></strong> provide customization options that are grouped together on this Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, <strong>%s</strong>, provides the following Theme Options:', 't_em' ), $t_em_theme_data['Name'] ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>General Options</strong>: One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Header Options</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Archive Options</strong>: Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Layout Options</strong>: Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Social Network Options</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty\'em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}

/**
 * Add contextual help to developers options screen
 */
function t_em_dev_options_help(){
	global $t_em_theme_data;
	$help = '<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/framework" title="Twenty\'em Framework" target="_blank">Twenty\'em Framework</a></strong> provides somes Javascript and CSS Frameworks or Tools to make your work easier. Some of them are <strong>loaded by default</strong>, so, it is recommended to leave them as they are. Your current theme, <strong>%s</strong>, provides the following tools:', 't_em' ), $t_em_theme_data['Name'] ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>LESS (loaded by default)</strong>: One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Modernizr (loaded by default)</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>HTML5 Shiv (loaded by default)</strong>: Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Golden Grid System</strong>: Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>jQuery Cycle Lite Plugin</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>jQuery Easing Plugin</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty\'em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}
?>
