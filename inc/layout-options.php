<?php
/**
 * Twenty'em Layout theme options.
 *
 * @file			layout-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/layout-options.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Return an array of Layout Options for Twenty'em admin panel.
 * This function manage how is displayed our theme layout. Possibles options are:
 * 0. Sidebar on right (sidebar-right).
 * 1. Sidebar on left (sidebar-left).
 * 2. One column, no sidebar (content).
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_options(){
	$layout_options = array (
		'sidebar-right' => array(
			'value' => 'sidebar-right',
			'label' => __( 'Sidebar on right', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/sidebar-right.png',
		),
		'sidebar-left' => array(
			'value' => 'sidebar-left',
			'label' => __( 'Sidebar on left', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/sidebar-left.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG . '/one-column.png',
		),
	);

	return apply_filters( 't_em_layout_options', $layout_options );
}

/**
 * Display a text box into Layout Options panel where you may enter your theme width.
 * Referenced via t_em_settings_field_layout_set().
 *
 * @return string HTML Text box form.
 *
 * @since Twenty'em 0.1
 */
function t_em_layout_width(){
	global $t_em_theme_options;

	$layout_width = '';
	$layout_width .= '<div class="sub-extend">';
	$layout_width .= 	'<div class="layout text-option layout-width">';
	$layout_width .= 		'<label>';
	$layout_width .= 		'<span>'. __( 'Enter the value you wish to be your theme width. If empty, the value will be <strong>960px</strong>.', 't_em' ) .'</span>';
	$layout_width .= 			'<input type="number" name="t_em_theme_options[layout-width]" value="'.$t_em_theme_options['layout-width'].'" /><span class="unit">px</span>';
	$layout_width .= 		'</label>';
	$layout_width .= 	'</div>';
	$layout_width .= '</div>';

	return $layout_width;
}

/**
 * Render the Layout setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @uses t_em_layout_width() Display a text box into Layout Options panel where you may enter
 * your theme width.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_layout_set(){
	global $t_em_theme_options;
?>
<div class="image-radio-option-group">
<?php
	foreach ( t_em_layout_options() as $layout ) :
?>
	<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="t_em_theme_options[layout-set]" value="<?php echo esc_attr( $layout['value'] ) ?>" <?php checked( $t_em_theme_options['layout-set'], $layout['value'] ); ?> />
			<span><img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" /><?php echo $layout['label']; ?></span>
		</label>
	</div>
<?php
	endforeach;
?>
</div>
<?php
	echo t_em_layout_width();
}
?>
