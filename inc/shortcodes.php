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
		QTags.addButton( 'sc_success', 'success', '[success close="false"]', '[/success]', '', '', 121 );
		QTags.addButton( 'sc_info', 'info', '[info close="false"]', '[/info]', '', '', 122 );
		QTags.addButton( 'sc_warning', 'warning', '[warning close="false"]', '[/warning]', '', '', 123 );
		QTags.addButton( 'sc_error', 'error', '[error close="false"]', '[/error]', '', '', 124 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" float=""]', '[/quote]', '', '', 125 );
		QTags.addButton( 'sc_icon', 'icon', '[icon class="" align="" size="default"]', '', '', '', 126 );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );

/**
 * Shortcode [success]
 * Enclosing
 * Behavior: [success close="false"][/success]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_success( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-success alert-block',
			'span_icon' => '<span class="icon-thumbs-up font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'success', 't_em_shortcode_alert_success' );

/**
 * Shortcode [warning]
 * Enclosing
 * Behavior: [warning close="false"][/warning]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_warning( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-warning alert-block',
			'span_icon' => '<span class="icon-warning font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'warning', 't_em_shortcode_alert_warning' );

/**
 * Shortcode [help]
 * Enclosing. Permit other shortcodes.
 * Behavior: [help close="false"][/help]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_help( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-help font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'help', 't_em_shortcode_alert_help' );

/**
 * Shortcode [info]
 * Enclosing. Permit other shortcodes.
 * Behavior: [info close="false"][/info]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_info( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-info-2 font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'info', 't_em_shortcode_alert_info' );

/**
 * Shortcode [error]
 * Enclosing. Permit other shortcodes.
 * Behavior: [error close="false"][/error]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_error( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-danger font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'error', 't_em_shortcode_alert_error' );

/**
 * Shortcode [bug]
 * Enclosing. Permit other shortcodes.
 * Behavior: [bug close="false"][/bug]
 * Options:
 * 0. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert_bug( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-bug font-icon"></span>',
			'close' => 'false',
		), $atts ) );
	$close_button = (  esc_attr( $close ) == 'true' ) ? '<a href="#" class="close" data-dismiss="alert">&times;</a>' : '';
	return '<div class="'. esc_attr( $class ) .'">' . $close_button . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'bug', 't_em_shortcode_alert_bug' );

/**
 * Shortcode [quote]
 * Enclosing. Permit other shortcodes.
 * Behavior: [quote text_align="" float=""][/quote]
 * Options:
 * 0. text_align. Optional. Default value "empty". Possibles values "left", "right". Text alignment
 * 1. float. Optional. Default value "empty". Possibles values "left", "right". Blockquote tag
 * floating.
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_quote( $atts, $content = null ){
	extract( shortcode_atts( array (
			'text_align' => '',
			'float' => '',
		), $atts ) );
	if ( esc_attr( $text_align ) == 'left' ) :
		$class_align = 'text-left';
	elseif ( esc_attr( $text_align )  == 'right') :
		$class_align = 'text-right';
	else :
		$class_align = '';
	endif;

	if ( esc_attr( $float ) == 'left' ) :
		$class_float = 'pull-left span6';
	elseif ( esc_attr( $float ) == 'right' ) :
		$class_float = 'pull-right span6';
	else :
		$class_float = '';
	endif;

	return '<blockquote class="'. esc_attr( $class_align ) .' '. esc_attr( $class_float ) .'"><p>'. do_shortcode( $content ) .'</p></blockquote>';
}
add_shortcode( 'quote', 't_em_shortcode_quote' );

/**
 * Shortcode [icon]
 * Self-closing
 * Behavior [icon class="" align="" size="default"]
 * Options:
 * 0. icon_class. Required. Default value "empty". Possibles values "icon-$icon_name". Display a
 * IcoMoon icon
 * 1. align. Optional. Default value "empty". Possibles values "left", "right". Icon alignment.
 * 2. size. Optional. Default value "default". Possibles values "default", "medium", "large",
 * "xlarge", "xxlarge", "xxxlarge". Icon size
 *
 * @link http://codex.wordpress.org/Shortcode_API
 * @link ../docs/icomoon.html For a full list of icon classes.
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_icomoon_icon( $atts ){
	extract( shortcode_atts( array (
			'class' => '',
			'align' => '',
			'size' => 'default',
		), $atts ) );
	$class_size = ( ! empty( $size ) ) ? 'icon-'. esc_attr( $size ) : '';
	$class_align = ( ! empty( $align ) ) ? 'pull-'. esc_attr( $align ) : '';

	return '<span class="'. esc_attr( $class ) . ' '. esc_attr( $class_size ) . ' '. esc_attr( $class_align ) .' font-icon"></span>';
}
add_shortcode( 'icon', 't_em_shortcode_icomoon_icon' );
?>
