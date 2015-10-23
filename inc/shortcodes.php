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
	global $t_em;
	if ( wp_script_is( 'quicktags' ) && $t_em['shortcode_buttoms'] ) :
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_button', 'button', '[button link="" style="default" size="" new_window="false"]', '[/button]', '', '', 122 );
		QTags.addButton( 'sc_btn-group', 'btn-group', '[btn-group size="" justify="false"]', '[/btn-group]', '', '', 123 );
		QTags.addButton( 'sc_alert', 'alert', '[alert style="" close="false"]', '[/alert]', '', '', 124 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" float=""]', '[/quote]', '', '', 125 );
		QTags.addButton( 'sc_icon', 'icon', '[icon class="" align="" size=""]', '', '', '', 126 );
		QTags.addButton( 'sc_columns', 'columns', '[columns cols="2"]', '[/columns]', '', '', 127 );
		QTags.addButton( 'sc_panel', 'panel', '[panel heading="" footer="" style="default"]', '[/panel]', '', '', 128 );
		QTags.addButton( 'sc_label', 'label', '[label style="default"]', '[/label]', '', '', 129 );
		QTags.addButton( 'sc_lead', 'lead', '[lead]', '[/lead]', '', '', 130 );
		QTags.addButton( 'sc_well', 'well', '[well]', '[/well]', '', '', 131 );
	</script>
<?php
	endif;
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );

/**
 * Shortcode [button]
 * Enclosing. Permits others shortcodes.
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
	extract( shortcode_atts( array(
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
 * Shortcode [btn-group]
 * Enclosing. Permits others shortcodes
 * Behavior: [btn-group size="" justify="false"][/btn-group].
 * Used to group buttons created with [button] shortcode
 * Options:
 * 0. size. Optional. Default value "empty". Possibles values "lg", "sm", "xs", "custom_class"
 * 1. justify. Optional. Default value "false". Possibles values "false", "true"
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_btn_group( $atts, $content = null ){
	extract( shortcode_atts( array(
			'size'		=> '',
			'justify'	=> 'false',
		), $atts ) );
	$size = ( $size ) ? 'btn-group-'. esc_attr( $size ) : null;
	$justify = ( $justify == 'true' ) ? 'btn-group-justified' : null;
	return '<div class="btn-group '. $size .' '. $justify .'" role="group" aria-label="'. __( 'Button group', 't_em' ) .'">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'btn-group', 't_em_shortcode_btn_group' );

/**
 * Shortcode [alert]
 * Enclosing. Permits others shortcodes.
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
	extract( shortcode_atts( array(
			'style' => '',
			'close' => 'false',
		), $atts ) );
	$close_button = ( esc_attr( $close ) == 'true' ) ? '<button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>' : null;
	$style = ( esc_attr( $style ) != '' ) ? esc_attr( $style ) : null;
	if ( $close ) :
		$scrip_alert = t_em_register_bootstrap_plugin( 'alert.js', false );
		add_action( 'wp_enqueue_scripts', "$scrip_alert" );
	endif;
	return '<div class="alert alert-'. esc_attr( $style ) .'">' . $close_button . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'alert', 't_em_shortcode_alert' );

/**
 * Shortcode [quote]
 * Enclosing. Permits others shortcodes.
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
	extract( shortcode_atts( array(
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
 * Behavior [icon class="" align="" size=""]
 * Options:
 * 0. icon_class. Required. Default value "empty". Possibles values "icomoon-$icon_name". Display a
 * IcoMoon icon
 * 1. align. Optional. Default value "empty". Possibles values "left", "right". Icon alignment.
 * 2. size. Optional. Default value "icon-sm". Possibles values "icon-xs", "icon-sm", "icon-md", "icon-lg", "icon-hg". Icon size
 *
 * @link http://codex.wordpress.org/Shortcode_API
 * @link ../fonts/icomoon.html For a full list of icon classes.
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_icomoon_icon( $atts ){
	extract( shortcode_atts( array(
			'class' => '',
			'align' => '',
			'size' => 'icon-sm',
		), $atts ) );
	$class_size = ( ! empty( $size ) ) ? esc_attr( $size ) : null;
	$class_align = ( ! empty( $align ) ) ? 'pull-'. esc_attr( $align ) : null;

	return '<span class="'. esc_attr( $class ) . ' '. esc_attr( $class_size ) . ' '. esc_attr( $class_align ) .' icomoon"></span>';
}
add_shortcode( 'icon', 't_em_shortcode_icomoon_icon' );

/**
 * Shortcode [columns]
 * Enclosing. Permits others shortcodes.
 * Behavior [columns cols=""][/columns]
 * Options:
 * 0. cols. Optional. Number of columns. Default value "2"
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_columns( $atts, $content = null ){
	extract( shortcode_atts( array(
			'cols' => '2',
		), $atts ) );
	return '<div class="columns cols-'. esc_attr( $cols ) .'"><p>'. do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'columns', 't_em_shortcode_columns' );

/**
 * Shortcode [panel]
 * Enclosing. Permits others shortcodes
 * Behavior [panel heading="" footer="" style=""][/panel]
 * Options:
 * 0. heading. Optional. Default value "empty"
 * 1. footer. Optional. Default value "empty"
 * 2. style. Optional. Default value "default". Possibles values "default", "primary", "success",
 * "info", "warning", "danger", "custom_class"
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_panel( $atts, $content = null ){
	extract( shortcode_atts( array(
			'heading'	=> '',
			'footer'	=> '',
			'style'		=> 'default',
		), $atts ) );
	$panel_heading = ( $heading ) ? '<div class="panel-heading">'. esc_attr( $heading ) .'</div>' : null;
	$panel_footer = ( $footer ) ? '<div class="panel-footer">'. esc_attr( $footer ) .'</div>' : null;
	$panel = '<div class="panel panel-'. esc_attr( $style ) .'">';
	$panel .= 	$panel_heading;
	$panel .= 	'<div class="panel-body"><p>'. do_shortcode( $content ) .'</p></div>';
	$panel .= 	$panel_footer;
	$panel .= '</div>';
	return $panel;
}
add_shortcode( 'panel', 't_em_shortcode_panel' );

/**
 * Shortcode [label]
 * Enclosing. Permits others shortcodes
 * Behavior [label style=""][/label]
 * Options:
 * 0. style. Optional. Default value "default". Possibles values "default", "primary", "success",
 * "info", "warning", "danger", "custom_class"
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_label( $atts, $content = null ){
	extract( shortcode_atts( array(
			'style'	=> 'default',
		), $atts ) );
	return '<span class="label label-'. esc_attr( $style ) .'">'. do_shortcode( $content ) .'</span>';
}
add_shortcode( 'label', 't_em_shortcode_label' );

/**
 * Shortcode [lead]
 * Enclosing. Permits others shortcodes
 * Behavior [lead][/lead]
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_lead( $atts, $content = null ){
	return '<div class="lead"><p>'. do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'lead', 't_em_shortcode_lead' );

/**
 * Shortcode [well]
 * Enclosing. Permits others shortcodes
 * Behavior [well][/well]
 *
 * @link http://codex.wordpress.org/Shortcode_API
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_well( $atts, $content = null ){
	return '<div class="well"><p>'. do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'well', 't_em_shortcode_well' );
?>
