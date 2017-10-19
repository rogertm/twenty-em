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
 * @since 			Twenty'em 1.0
 */

/**
 * Twenty'em shortcodes.
 *
 * @link http://codex.wordpress.org/Shortcode_API
 */

/**
 * Include additional buttons in the Text (HTML) mode of the WordPress editor
 *
 * @since Twenty'em 1.0
 */
function t_em_quicktags_buttons(){
	global $t_em;
	if ( wp_script_is( 'quicktags' ) && $t_em['shortcode_buttoms'] ) :
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_button', 'button', '[button link="" style="primary" size="" new_window="false"]', '[/button]', '', '', 122 );
		QTags.addButton( 'sc_btn-group', 'btn-group', '[btn-group size="" vertical="false"]', '[/btn-group]', '', '', 123 );
		QTags.addButton( 'sc_alert', 'alert', '[alert style="primary" heading="" close="false"]', '[/alert]', '', '', 124 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" cite=""]', '[/quote]', '', '', 125 );
		QTags.addButton( 'sc_icon', 'icon', '[icon class=""]', '', '', '', 126 );
		QTags.addButton( 'sc_columns', 'columns', '[columns cols="2"]', '[/columns]', '', '', 127 );
		QTags.addButton( 'sc_card', 'card', '[card header="" title="" footer="" style="" img="" img_overlay="false"]', '[/card]', '', '', 128 );
		QTags.addButton( 'sc_card-group', 'card-group', '[card-group style="group"]', '[/card-group]', '', '', 129 );
		QTags.addButton( 'sc_lead', 'lead', '[lead]', '[/lead]', '', '', 130 );
		QTags.addButton( 'sc_badge', 'badge', '[badge style="secondary"]', '[/badge]', '', '', 131 );
		QTags.addButton( 'sc_collapse-item', 'collapse-item', '[collapse-item title="" active="false"]', '[/collapse-item]', '', '', 132 );
		QTags.addButton( 'sc_collapse', 'collapse', '[collapse]', '[/collapse]', '', '', 133 );
		QTags.addButton( 'sc_tab-item', 'tab-item', '[tab-item title="" active="false"]', '[/tab-item]', '', '', 134 );
		QTags.addButton( 'sc_tab', 'tabs', '[tabs type="tabs" class=""]', '[/tabs]', '', '', 135 );
	</script>
<?php
	endif;
}
add_action( 'admin_print_footer_scripts', 't_em_quicktags_buttons' );

/**
 * Shortcode [button]
 * Enclosing. Permits others shortcodes.
 * Behavior: [button link="" style="default" size=""]Button Text[/button]
 * Options:
 * 0. link.			Required. Default value "empty". Possibles value: button link (e.g https://themingisprose.com/twenty-em)
 * 1. style. 		Optional. Default value "primary".
 * 2. new_window.	Optional, Default value "false". Possibles values "false", "true". (open link in new window)
 * 3. size. 		Optional. Default value "empty". Possibles values: "lg", "sm"
 *
 * @see https://getbootstrap.com/docs/4.0/components/buttons/
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_button( $atts, $content = null ){
	extract( shortcode_atts( array(
			'link'			=> '',
			'style'			=> 'primary',
			'new_window'	=> 'false',
			'size'			=> '',
		), $atts ) );
	$link		= ( $link ) ? esc_url( $link ) : null;
	$style		= ( $style ) ? 'btn-'. esc_attr( $style ) : 'btn-primary';
	$new_window	= ( $new_window == 'true' ) ? 'target="_blank"' : null;
	$size		= ( $size ) ? 'btn-'. esc_attr( $size ) : null;
	return '<a href="'. esc_url( $link ) .'" class="btn '. $style .' '. $size .'" '. $new_window .'>'. do_shortcode( $content ) .'</a>';
}
add_shortcode( 'button', 't_em_shortcode_button' );

/**
 * Shortcode [btn-group]
 * Enclosing. Permits others shortcodes
 * Behavior: [btn-group size=""][/btn-group].
 * Used to group buttons created with [button] shortcode
 * Options:
 * 0. size. 		Optional. Default value "empty". Possibles values "lg", "sm"
 *
 * @see https://getbootstrap.com/docs/4.0/components/button-group/
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Removed "justify" parameter
 * @since Twenty'em 1.2.1	Added "vertical" parameter
 */
function t_em_shortcode_btn_group( $atts, $content = null ){
	extract( shortcode_atts( array(
			'size'		=> '',
			'vertical'	=> 'false',
		), $atts ) );
	$size = ( esc_attr( $size ) ) ? 'btn-group-'. esc_attr( $size ) : null;
	$vertical = ( esc_attr( $vertical ) == 'true' ) ? 'btn-group-vertical' : null;
	return '<div class="btn-group '. $size .' '. $vertical .'" role="group" aria-label="'. __( 'Button group', 't_em' ) .'">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'btn-group', 't_em_shortcode_btn_group' );

/**
 * Shortcode [alert]
 * Enclosing. Permits others shortcodes.
 * Behavior: [alert style="primary" heading="" close="false"][/alert]
 * Options:
 * 0. style. 		Optional. (but recommended). Default value "primary".
 * 1. heading. 		Optional. Alert Heading
 * 2. close. 		Optional. Default value "false". Display a close button
 *
 * @see https://getbootstrap.com/docs/4.0/components/alerts/
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Added "heading" parameter
 */
function t_em_shortcode_alert( $atts, $content = null ){
	extract( shortcode_atts( array(
			'style' => 'primary',
			'heading' => '',
			'close' => 'false',
		), $atts ) );
	$close_button = ( esc_attr( $close ) == 'true' ) ? '<button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>' : null;
	$style = ( esc_attr( $style ) != '' ) ? esc_attr( $style ) : 'primary';
	$heading = ( esc_attr( $heading ) != '' ) ? '<h4 class="alert-heading">'. esc_attr( $heading ).'</h4>' : null;
	if ( $close ) :
		t_em_register_bootstrap_plugin( 'alert' );
	endif;
	return '<div class="alert alert-'. esc_attr( $style ) .'">' . $close_button . $heading . '<p class="mb-0">' . do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'alert', 't_em_shortcode_alert' );

/**
 * Shortcode [quote]
 * Enclosing. Permits others shortcodes.
 * Behavior: [quote text_align="" cite=""][/quote]
 * Options:
 * 0. text_align. 	Optional. Default value "empty". Possibles values "left", "right", "center". Text alignment
 * 1. cite. 		Optional. Cite's source
 *
 * @see https://getbootstrap.com/docs/4.0/content/typography/#blockquotes
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Added "cite" attribute
 * @since Twenty'em 1.2		Removed "float" attribute
 */
function t_em_shortcode_quote( $atts, $content = null ){
	extract( shortcode_atts( array(
			'text_align' => '',
			'cite' => '',
		), $atts ) );
	$text_align = ( $text_align ) ? 'text-'. esc_attr( $text_align ) : null;
	$cite = ( $cite ) ? '<footer class="blockquote-footer">'. esc_attr( $cite ) .'</footer>' : null;

	return '<blockquote class="blockquote '. esc_attr( $text_align ) .'"><p>'. do_shortcode( $content ) .'</p>'. $cite .'</blockquote>';
}
add_shortcode( 'quote', 't_em_shortcode_quote' );

/**
 * Shortcode [icon]
 * Self-closing
 * Behavior [icon class="" align="" size=""]
 * Options:
 * 0. icon_class. Required. Default value "empty". Possibles values "icomoon-$icon_name". Display a
 * IcoMoon icon
 *
 * @link https://themingisprose.com/twenty-em/icomoon-demo For a full list of icon classes.
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_icomoon_icon( $atts ){
	extract( shortcode_atts( array(
			'class' => '',
		), $atts ) );
	$class_size = ( ! empty( $size ) ) ? esc_attr( $size ) : null;
	$class_align = ( ! empty( $align ) ) ? 'pull-'. esc_attr( $align ) : null;

	return '<span class="'. esc_attr( $class ) .'"></span>';
}
add_shortcode( 'icon', 't_em_shortcode_icomoon_icon' );

/**
 * Shortcode [columns]
 * Enclosing. Permits others shortcodes.
 * Behavior [columns cols=""][/columns]
 * Options:
 * 0. cols. Optional. Number of columns. Default value "2". Possibles values: "2", "3", "4".
 *
 * @since Twenty'em 1.0
 * @since Twenty'em 1.2		Limits columns count to 4
 */
function t_em_shortcode_columns( $atts, $content = null ){
	extract( shortcode_atts( array(
			'cols' => '2',
		), $atts ) );
	$cols = ( $cols && $cols <= 4 && $cols > 1 ) ? esc_attr( $cols ) : 2;
	return '<div class="columns columns-'. $cols .'"><p>'. do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'columns', 't_em_shortcode_columns' );

/**
 * Shortcode [lead]
 * Enclosing. Permits others shortcodes
 * Behavior [lead][/lead]
 *
 * @since Twenty'em 1.0
 */
function t_em_shortcode_lead( $atts, $content = null ){
	return '<div class="lead"><p>'. do_shortcode( $content ) .'</p></div>';
}
add_shortcode( 'lead', 't_em_shortcode_lead' );

/**
 * Shorcode [card]
 * Enclosing. Permits others shortcodes
 * Behavior [card header="" title="" footer="" style="" img="" img_overlay="false"][/card]
 * Options:
 * 0. header.		Optional. Default value "empty"
 * 1. title.		Optional. Default value "empty"
 * 2. footer.		Optional. Default value "empty"
 * 3. style.		Optional. Default value "empty"
 * 4. img.			Optional. Image url. Default value "empty"
 * 5. img_overlay.	Optional. Image url. Default value "empty"
 *
 * @see https://getbootstrap.com/docs/4.0/components/card/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_card( $atts, $content = null ){
	extract( shortcode_atts( array(
			'header'		=> '',
			'title'			=> '',
			'footer'		=> '',
			'style'			=> '',
			'img'			=> '',
			'img_overlay'	=> 'false',
		), $atts ) );
	$header = ( $header ) ? '<div class="card-header">'. esc_attr( $header ) .'</div>' : null;
	$title	= ( $title ) ? '<h4 class="card-title">'. esc_attr( $title ) .'</h4>' : null;
	$footer = ( $footer ) ? '<div class="card-footer">'. esc_attr( $footer ) .'</div>' : null;
	$style	= ( $style ) ? esc_attr( $style ) : null;
	$img	= ( $img ) ? '<img src="'. esc_url( $img ) .'" class="car-img-top">' : null;
	$body 	= ( $img_overlay == 'true' ) ? 'card-img-overlay' : 'card-body';

	$card = '<div class="card '. $style .'">';
	$card .=	$header;
	$card .=	$img;
	$card .= 	'<div class="'. $body .'">';
	$card .=		$title;
	$card .=		'<p>'. do_shortcode( $content ) .'</p>';
	$card .= 	'</div>';
	$card .=	$footer;
	$card .= '</div>';
	return $card;
}
add_shortcode( 'card', 't_em_shortcode_card' );

/**
 * Shortcode [card-group]
 * Enclosing. Permits others shortcodes
 * Behavior [card-group style="group"][/card-group]
 * Options:
 * 0. style.	Optional. Default value "group"
 *
 * @see https://getbootstrap.com/docs/4.0/components/card/#card-groups
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_card_group( $atts, $content = null ){
	extract( shortcode_atts( array(
			'style'	=> 'group',
		), $atts ) );
	$group_style = ( $style != '' ) ? esc_attr( $style ) : 'group';
	return '<div class="card-'. $group_style .'">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'card-group', 't_em_shortcode_card_group' );

/**
 * Shortcode [badge]
 * Enclosing. Permits others shortcodes
 * Behavior [badge style="secondary"][/badge]
 * Options:
 * 0. style. 	Optional. Default value "secondary".
 *
 * @see https://getbootstrap.com/docs/4.0/components/badge/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_badge( $atts, $content = null ){
	extract( shortcode_atts( array(
			'style'	=> 'secondary',
		), $atts ) );
	$style = ( $style != '' ) ? esc_attr( $style ) : 'secondary';
	return '<span class="badge badge-'. $style .'">'. do_shortcode( $content ) .'</span>';
}
add_shortcode( 'badge', 't_em_shortcode_badge' );

/**
 * Shortcode [collapse-item].
 * Enclosing. Permits others shortcodes
 * Behavior [collapse-item title=""][/collapse-item]
 * Options:
 * 0. title.	Required. Item title. Default value "empty".
 * 1. active 	Optional. If the item is active on load. Default "false"
 *
 * @see https://getbootstrap.com/docs/4.0/components/collapse/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_collapse_item( $atts, $content = null ){
	if ( isset( $GLOBALS['collapse_item_count'] ) ) :
		$GLOBALS['collapse_item_count']++;
	else :
		$GLOBALS['collapse_item_count'] = 0;
	endif;

	extract( shortcode_atts( array(
			'title'	=> '',
			'active' => 'false',
		), $atts ) );
	$title 		= ( $title ) ? esc_attr( $title ) : null;
	$item_id	= ( $title ) ? sanitize_title( $title ) .'-'. $GLOBALS['collapse_item_count']  : null;
	$active 	= ( $active == 'true' ) ? 'show' : null;
	$expanded 	= ( $active ) ? 'true' : 'false';

	$item = '<div class="collapsible-item">';
	$item .= 	'<a class="collapsible-title lead" href="#'. $item_id .'" data-toggle="collapse" data-parent="#collapse-'. $GLOBALS['collapse_count'] .'" aria-expanded="'. $expanded .'" aria-controls="'. $item_id .'">';
	$item .=		$title;
	$item .=	'</a>';
	$item .=	'<div id="'. $item_id .'" class="collapsible-text collapse '. $active .'" role="tabpanel">';
	$item .= 		'<p>'. do_shortcode( $content ) .'</p>';
	$item .= 	'</div>';
	$item .= '</div>';
	return $item;
}
add_shortcode( 'collapse-item', 't_em_shortcode_collapse_item' );

/**
 * Shorcode [collapse]
 * Enclosing. Permits others shortcodes
 * Behavior [collapse][/collapse]
 *
 * @see https://getbootstrap.com/docs/4.0/components/collapse/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_collapse( $atts, $content = null ){
	if ( isset( $GLOBALS['collapse_count'] ) ) :
		$GLOBALS['collapse_count']++;
	else :
		$GLOBALS['collapse_count'] = 0;
	endif;

	t_em_register_bootstrap_plugin( 'collapse' );
	return '<div id="collapse-'. $GLOBALS['collapse_count'] .'" class="collapsible" data-children=".collapsible-item">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'collapse', 't_em_shortcode_collapse' );

/**
 * Shortcode [tab-item]
 * Part of the code in this shortcode is inspired in "Bootstrap 3 Shortcodes": https://github.com/MWDelaney/bootstrap-shortcodes
 * Enclosing. Permits others shortcodes
 * Behavior [tab-item title="" active="false"][/tab-item]
 * Options:
 * 0. title 	Required. Tab title. Default value "empty"
 * 1. class 	Optional. Default value "empty"
 *
 * @see https://getbootstrap.com/docs/4.0/components/navs/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_tab_item( $atts, $content = null ){
	extract( shortcode_atts( array(
			'title' => '',
			'active' => 'false',
		), $atts ) );
	$title = ( $title ) ? esc_attr( $title ) : null;
	$item_id = ( $title ) ? sanitize_title( $title ) .'-'. $GLOBALS['tabs_count'] : null;

	if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
			$atts['active'] = true;
	}
	$GLOBALS['tabs_default_count']++;

	$item_active = ( $atts['active'] == 'true' ) ? 'active' : null;
	$item = '<div id="'. $item_id .'" class="tab-pane fade '. $item_active .'" role="tabpanel">';
	$item .=	'<p>'. do_shortcode( $content ) .'</p>';
	$item .= '</div>';
	return $item;
}
add_shortcode( 'tab-item', 't_em_shortcode_tab_item' );

/**
 * Shortcode [tabs]
 * Part of the code in this shortcode is inspired in "Bootstrap 3 Shortcodes": https://github.com/MWDelaney/bootstrap-shortcodes
 * Enclosing. Permits others shortcodes
 * Behavior [tabs type="" class=""][/tabs]
 * Options:
 * 0. type 		Optional. Default value "empty"
 * 1. class 	Optional. Default value "empty"
 *
 * @see https://getbootstrap.com/docs/4.0/components/navs/
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_tabs( $atts, $content = null ){
	extract( shortcode_atts( array(
			'type' => 'tabs',
			'class' => '',
		), $atts ) );
	$type = ( $type ) ? 'nav-'. esc_attr( $type ) : 'nav-tabs';
	$class = ( $class ) ? esc_attr( $class ) : null;
	$items_map = t_em_shortcode_attr_map( $content );

	if ( isset( $GLOBALS['tabs_count'] ) ) :
		$GLOBALS['tabs_count']++;
	else :
		$GLOBALS['tabs_count'] = 0;
	endif;

	$GLOBALS['tabs_default_count'] = 0;

	// Get the tabs items
	if ( $items_map ) :
		$tabs = array();
		$GLOBALS['tabs_default_active'] = true;

		foreach ( $items_map as $item ) :
			if ( $item['tab-item']['active'] == 'true' ) :
				$GLOBALS['tabs_default_active'] = false;
			endif;
		endforeach;
		$i = 0;
		foreach ( $items_map as $item ) :
			if ( $item['tab-item']['active'] == 'true' ) :
				$GLOBALS['tabs_default_active'] = false;
			endif;
			$item_id = sanitize_title( $item['tab-item']['title'] ) .'-'. $GLOBALS['tabs_count'];
			$item_class = 'nav-item';
			$active = ( $item['tab-item']['active'] == 'true' || ( $GLOBALS['tabs_default_active'] == true && $i == 0 ) ) ? 'active' : null;
			$tabs[] = '<li class="'. $item_class .'"><a href="#'. $item_id .'" class="nav-link '. $active .'" data-toggle="pill">'. $item['tab-item']['title'] .'</a></li>';
			$i++;
		endforeach;
	endif;

	t_em_register_bootstrap_plugin( 'tab' );

	$output = '<div class="tabbable my-3">';
	$output .= 	'<ul class="nav '. $type .' '. $class .' mb-2" role="tablist">'. implode( '', $tabs ) .'</ul>';
	$output .= 	'<div class="tab-content">'. do_shortcode( $content ) .'</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode( 'tabs', 't_em_shortcode_tabs' );

/**
 * Helper function. Create attributes map
 * @param $content string 	String containing a shortcode, usually post content.
 * @return array 			Array containing shortcode map
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_attr_map( $content ){
	$res = array();
	$output = array();
	$regex = get_shortcode_regex();
	preg_match_all( '~'.$regex.'~', $content, $matches );

	foreach( $matches[2] as $key => $value ) :
		$parsed = shortcode_parse_atts( $matches[3][$key] );
		$parsed = is_array( $parsed ) ? $parsed : array();
		$res[$value] = $parsed;
		$output[] = $res;
	endforeach;
	return $output;
}

/**
 * Helper function. Remove extra line breaks around shortcodes
 *
 * @since Twenty'em 1.2
 */
function t_em_shortcode_cleanup( $content ){
	$tags = array(
		']<br />'	=> ']',
		']<br>'		=> ']',
	);
	$content = strtr( $content, $tags );
	return $content;
}
add_filter( 'the_content', 't_em_shortcode_cleanup' );
?>
