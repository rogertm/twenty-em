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
		QTags.addButton( 'sc_info', 'info', '[info]', '[/info]', '', '', 122 );
		QTags.addButton( 'sc_warning', 'warning', '[warning]', '[/warning]', '', '', 123 );
		QTags.addButton( 'sc_error', 'error', '[error]', '[/error]', '', '', 124 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" float=""]', '[/quote]', '', '', 125 );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );

function t_em_shortcode_alert_close_button( $atts ){
	return '<a href="#" class="close" data-dismiss="alert">&times;</a>';
}
add_shortcode( 'close', 't_em_shortcode_alert_close_button' );

function t_em_shortcode_alert_success( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-success alert-block',
			'span_icon' => '<span class="icon-thumbs-up font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'success', 't_em_shortcode_alert_success' );

function t_em_shortcode_alert_warning( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-warning alert-block',
			'span_icon' => '<span class="icon-warning font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'warning', 't_em_shortcode_alert_warning' );

function t_em_shortcode_alert_help( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-help font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'help', 't_em_shortcode_alert_help' );

function t_em_shortcode_alert_info( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-info-2 font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'info', 't_em_shortcode_alert_info' );

function t_em_shortcode_alert_error( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-danger font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'error', 't_em_shortcode_alert_error' );

function t_em_shortcode_alert_bug( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-bug font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'bug', 't_em_shortcode_alert_bug' );

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


	return '<blockquote class="'. esc_attr( $class_align ) .' '. esc_attr( $class_float ) .'"><p>'. $content .'</p></blockquote>';
}
add_shortcode( 'quote', 't_em_shortcode_quote' );
?>
