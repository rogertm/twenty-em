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
		QTags.addButton( 'sc_button', 'button', '[button link="" style="default" size="" new_window="false"]', '[/button]', '', '', 122 );
		QTags.addButton( 'sc_alert', 'alert', '[alert style="" close="false"]', '[/alert]', '', '', 122 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" float=""]', '[/quote]', '', '', 123 );
		QTags.addButton( 'sc_icon', 'icon', '[icon class="" align="" size="default"]', '', '', '', 124 );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );

/**
 * Shortcode [button]
 * Enclosing. Permit other shortcodes.
 * Behavior: [button link="" style="default" size=""]Button Text[/button]
 * Options:
 * 0. link. Required. Default value "empty". Possibles value: button link (e.g http://twenty-em.com/)
 * 1. style. Optional. Default value "default". Possibles values: "default", "primary", "success",
 * "info", "warning", "danger", "link", "custom_class"
 * 2. new_window. Optional, Default value "false". Possibles values "false", "true". (open link in new window)
 * 3. size. Optional. Default value "empty". Possibles values: "btn-lg", "btn-sm", "btn-xs", "custom_class"
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_button( $atts, $content = null ){
	extract( shortcode_atts( array (
			'link'			=> '',
			'style'			=> 'default',
			'new_window'	=> 'false',
			'size'			=> '',
		), $atts ) );
	$link		= ( esc_url( $link ) ) ? esc_url( $link ) : null;
	$style		= ( esc_attr( $style ) ) ? esc_attr( $style ) : null;
	$new_window	= ( esc_attr( $new_window ) == 'true' ) ? '_blank' : null;
	$size		= ( esc_attr( $size ) ) ? esc_attr( $size ) : null;
	return '<a href="'. esc_url( $link ) .'" class="btn btn-'. $style .' '. $size .'" target="'. esc_attr( $new_window ) .'">'. do_shortcode( $content ) .'</a>';
}
add_shortcode( 'button', 't_em_shortcode_button' );

/**
 * Shortcode [alert]
 * Enclosing. Permit other shortcodes.
 * Behavior: [alert style="" close="false"][/alert]
 * Options:
 * 0. style. Optional (but recommended). Default value "empty". Possibles values "success", "info",
 * "warning", "danger", "custom_class"
 * 1. close. Optional. Default value "false" Display a close button
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_alert( $atts, $content = null ){
	extract( shortcode_atts( array (
			'style' => '',
			'close' => 'false',
		), $atts ) );
	$close_button = ( esc_attr( $close ) == 'true' ) ? '<button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>' : null;
	$style = ( esc_attr( $style ) != '' ) ? esc_attr( $style ) : null;
	if ( $close ) :
		add_action( 't_em_action_foot', 't_em_shortcode_alert_bs_script' );
	endif;
	return '<div class="alert alert-'. esc_attr( $style ) .'">' . $close_button . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'alert', 't_em_shortcode_alert' );

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
		$class_float = 'pull-left col-md-6';
	elseif ( esc_attr( $float ) == 'right' ) :
		$class_float = 'pull-right col-md-6';
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
 * 0. icon_class. Required. Default value "empty". Possibles values "icomoon-$icon_name". Display a
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
	$class_size = ( ! empty( $size ) ) ? 'icon-'. esc_attr( $size ) : null;
	$class_align = ( ! empty( $align ) ) ? 'pull-'. esc_attr( $align ) : null;

	return '<span class="'. esc_attr( $class ) . ' '. esc_attr( $class_size ) . ' '. esc_attr( $class_align ) .' icomoon"></span>';
}
add_shortcode( 'icon', 't_em_shortcode_icomoon_icon' );
?>
