<?php
/**
 * Twenty'em Header theme options.
 *
 * @file			header-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/header-options.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Return an array of Header Options for Twenty'em admin panel.
 * This function manage what is displayed in our theme header. Possibles options are:
 * 0. Nothing (no-header-image)
 * 1. Header image (header-image) defined in t_em_support_custom_header_image() function in
 * /inc/functions.php
 * 2. Slider (slider) displaying featured posts of such category
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_header_options(){
	$header_options = array (
		'no-header-image' => array (
			'value' => 'no-header-image',
			'label' => __( 'No header image', 't_em' ),
			'extend' => '',
		),
		'header-image' => array (
			'value' => 'header-image',
			'label' => __( 'Header image', 't_em' ),
			'extend' => t_em_header_image_callback(),
		),
		'slider' => array (
			'value' => 'slider',
			'label' => __( 'Slider', 't_em' ),
			'extend' => t_em_slider_callback(),
		),
		'static-header' => array (
			'value' => 'static-header',
			'label' => __( 'Static Header', 't_em' ),
			'extend' => t_em_static_header_callback(),
		),
	);

	return apply_filters( 't_em_header_options', $header_options );
}

/**
 * Extend setting for Header Image Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @global $t_em See t_em_restore_from_scratch() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
 */
function t_em_header_image_callback(){
	global $t_em;
	$extend_header = '';
	$extend_header .= '<p>'. sprintf( __( 'To manage your header image options <a href="%1$s" target="_blank">Click here</a>.', 't_em' ), admin_url( 'themes.php?page=custom-header' ) ) .'</p>';
	if ( get_header_image() ) :
		$checked_option = checked( $t_em['header_featured_image'], '1', false );
		$extend_header .= '<figure><img src="'.get_header_image().'" width="500"></figure>';
		$extend_header .= '<label class="description">';
		$extend_header .=	 __( 'Display featured image in single posts and pages? ', 't_em' );
		$extend_header .=	'<input type="checkbox" name="t_em_theme_options[header_featured_image]" value="1" '. $checked_option .' />';
		$extend_header .= '</label>';
	else :
		$extend_header .= '<p>'. __( 'Oops! No image choosen yet', 't_em' ) .'</p>';
	endif;

	return apply_filters( 't_em_header_image_callback', $extend_header );
}

/**
 * Extend setting for Header Slider Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @global $t_em See t_em_restore_from_scratch() function in /inc/theme-options.php file
 * @global $slider_layout Return an array with our slider's layout options.
 * @global $list_categories Havana, we have a list of categories... Should I say more?
 *
 * @since Twenty'em 0.1
 */
function t_em_slider_callback(){
	global	$t_em,
			$slider_layout,
			$slider_script,
			$nivo_effect,
			$list_categories;

	$slider_layout = array (
		'slider-text-center' => array (
			'value' => 'slider-text-center',
			'label' => __( 'Slider text on center', 't_em' ),
			'title' => T_EM_INC_DIR_IMG_URL . '/slider-text-center.png',
		),
		'slider-text-left' => array (
			'value' => 'slider-text-left',
			'label' => __( 'Slider text on left', 't_em' ),
			'title' => T_EM_INC_DIR_IMG_URL . '/slider-text-left.png',
		),
		'slider-text-right' => array (
			'value' => 'slider-text-right',
			'label' => __( 'Slider text on right', 't_em' ),
			'title' => T_EM_INC_DIR_IMG_URL . '/slider-text-right.png',
		),
	);

	$slider_script = array (
		'slider-bootstrap-carousel' => array (
			'value' => 'slider-bootstrap-carousel',
			'label' => __( 'Bootstrap Carousel', 't_em' ),
		),
		'slider-nivo-slider' => array (
			'value' => 'slider-nivo-slider',
			'label' => __( 'Nivo Slider', 't_em' ),
		),
	);

	/**
	 * Twenty'em uses Nivo SLider jQuery Plugin by default, and we create our own style. If you want
	 * add your own style, just add a new key like this:
	 * 'style-your-style'	=> array (
	 * 		'value'	=> 'your-style',
	 * 		'label'	=> __( 'My own Style', 't_em' ),
	 * ),
	 * Do not forget to save all your stuff in /css/nivo-slider/themes/your-style/your-style.css
	 */
	$slider_style = array (
		'style-t-em'	=> array (
			'value'	=> 't-em',
			'label'	=> __( 'Twenty&#8217;em', 't_em' ),
		),
		'style-default'	=> array (
			'value'	=> 'default',
			'label'	=> __( 'Nivo Default', 't_em' ),
		),
		'style-dark'	=> array (
			'value'	=> 'dark',
			'label'	=> __( 'Nivo Dark', 't_em' ),
		),
		'style-light'	=> array (
			'value'	=> 'light',
			'label'	=> __( 'Nivo Light', 't_em' ),
		),
		'style-bar'	=> array (
			'value'	=> 'bar',
			'label'	=> __( 'Nivo Bar', 't_em' ),
		),
	);

	$extend_slider = '';

	// Show Slider only at home page?
	$checked_option = checked( $t_em['slider_home_only'], '1', false );
	$extend_slider .= '<label class="description">';
	$extend_slider .= 	__( 'Show Slider only at home page?', 't_em' );
	$extend_slider .= 	'<input type="checkbox" name="t_em_theme_options[slider_home_only]" value="1" '. $checked_option .' />';
	$extend_slider .= '</label>';

	// Display images options
	$extend_slider .= '<div class="image-radio-option-group sub-extend">';
	foreach ( $slider_layout as $layout ) :
		$checked_option = checked( $t_em['slider_text'], $layout['value'], false );
		$extend_slider .=	'<div class="layout image-radio-option slider-layout">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<input type="radio" name="t_em_theme_options[slider_text]" class="sub-radio-option" value="'.esc_attr($layout['value']).'" '. $checked_option .' />';
		$extend_slider .=			'<span><img src="'.$layout['title'].'" /><p>'.$layout['label'].'</p></span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div>';

	$extend_slider .= '<p>' . __( '<strong>Note:</strong> The alignment options above only works with <strong>Twenty&#8217;em Style</strong> in <strong>Nivo Slider</strong> script.', 't_em' ) . '</p>';

	// Slider Script
	$extend_slider .= '<div id="slider-scripts-options">';
	$extend_slider .= '<div class="text-radio-option-group sub-extend">';
	$extend_slider .= '<p>'. __( 'Select your slider script', 't_em' ) .'</p>';
	foreach ( $slider_script as $script ) :
		$checked_option = checked( $t_em['slider_script'], $script['value'], false );
		$extend_slider .=	'<div class="layout text-radio-option slider-script">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<input type="radio" name="t_em_theme_options[slider_script]" class="sub-radio-option slider-script-option" value="'. esc_attr( $script['value'] ) .'" '. $checked_option .' />';
		$extend_slider .=			'<span>'. $script['label'] .'</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div>';

		// Bootstrap Carousel Options
		$selected_script = ( $t_em['slider_script'] == 'slider-bootstrap-carousel' ) ? 'selected-option' : '';
		$extend_slider .= '<div id="slider-bootstrap-carousel" class="sub-extend layout text-option slider-script-extend '. $selected_script .'">';
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .= 		'<p>' . sprintf( __( 'The amount of time, in milliseconds, to delay between automatically cycling an item. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE, T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE, T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE ) . '</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<span>'. __( 'Interval value', 't_em' ) .'</span>';
		$extend_slider .=			'<input type="number" name="t_em_theme_options[bootstrap_carousel_interval]" value="'. $t_em['bootstrap_carousel_interval'] .'">';
		$extend_slider .=			'<span class="unit">mls</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
		$checked_option = checked( $t_em['bootstrap_carousel_pause'], '1', false );
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .=		'<p>' . __( 'Pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave.', 't_em' ) . '</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			__( 'Pause it?', 't_em' );
		$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[bootstrap_carousel_pause]" value="1" '. $checked_option .'>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
		$extend_slider .= '</div><!-- .sub-extend -->';

		// Nivo Slider Options
		$selected_script = ( $t_em['slider_script'] == 'slider-nivo-slider' ) ? 'selected-option' : '';
		$extend_slider .= '<div id="slider-nivo-slider" class="slider-script-extend text-option '. $selected_script .'">';
		$extend_slider .= 	'<div class="sub-extend">';
		$extend_slider .= 	'<p>' . __( 'Select your slider style.', 't_em' ) . '</p>';
		foreach ($slider_style as $style) :
			$checked_option = checked( $t_em['nivo_style'], $style['value'], false );
			$extend_slider .=	'<div class="layout radio-option">';
			$extend_slider .=		'<label class="description">';
			$extend_slider .=		'<input type="radio" name="t_em_theme_options[nivo_style]" class="sub-radio-option" value="'.esc_attr( $style['value'] ).'" '. $checked_option .' />';
			$extend_slider .=		'<span>'. $style['label'] .'</span>';
			$extend_slider .=		'</label>';
			$extend_slider .=	'</div>';
		endforeach;
		$extend_slider .= 	'</div><!-- .sub-extend -->';
		$nivo_effect = array ( 'random', 'sliceDownRight', 'sliceDownLeft', 'sliceUpRight', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'fold', 'fade', 'boxRandom', 'boxRain', 'boxRainReverse', 'boxRainGrow', 'boxRainGrowReverse' );
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .=		'<p>'. __( 'Select your slider effect', 't_em' ) .'</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<span>' . __( 'Effect', 't_em' ) . '</span>';
		$extend_slider .=			'<select name="t_em_theme_options[nivo_effect]">';
		foreach ( $nivo_effect as $effect ) :
			$selected_option = selected( $t_em['nivo_effect'], $effect, false );
			$extend_slider .=		'<option value="'. $effect .'" '. $selected_option .'>'. $effect .'</option>';
		endforeach;
		$extend_slider .=			'</select>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div><!-- .sub-extend -->';
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .= 		'<p>' . sprintf( __( 'The amount of time, in milliseconds, of the animation speed. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_NIVO_ANIM_SPEED_DEFAULT_VALUE, T_EM_NIVO_ANIM_SPEED_MAX_VALUE, T_EM_NIVO_ANIM_SPEED_MIN_VALUE ) . '</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<span>'. __( 'Animation speed', 't_em' ) .'</span>';
		$extend_slider .=			'<input type="number" name="t_em_theme_options[nivo_anim_speed]" value="'. $t_em['nivo_anim_speed'] .'">';
		$extend_slider .=			'<span class="unit">mls</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div><!-- .sub-extend -->';
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .= 		'<p>' . sprintf( __( 'The amount of time, in milliseconds, to delay between automatically cycling an item. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_NIVO_PAUSE_TIME_DEFAULT_VALUE, T_EM_NIVO_PAUSE_TIME_MAX_VALUE, T_EM_NIVO_PAUSE_TIME_MIN_VALUE ) . '</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<span>'. __( 'Pause Time', 't_em' ) .'</span>';
		$extend_slider .=			'<input type="number" name="t_em_theme_options[nivo_pause_time]" value="'. $t_em['nivo_pause_time'] .'">';
		$extend_slider .=			'<span class="unit">mls</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div><!-- .sub-extend -->';
		$extend_slider .=	'<div class="sub-extend">';
		$extend_slider .=		'<p>'. __( 'Control Options', 't_em' ) .'</p>';
		$extend_slider .=		'<p>'. __( '<strong>Note:</strong> "Manual Advance" will disable the "Pause Time" option', 't_em' ) .'</p>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			__( 'Pause on Hover', 't_em' );
		$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[nivo_pause_on_hover]" value="1" '. checked( $t_em['nivo_pause_on_hover'], '1', false ) .'>';
		$extend_slider .=		'</label>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			__( 'Direction Nav', 't_em' );
		$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[nivo_direction_nav]" value="1" '. checked( $t_em['nivo_direction_nav'], '1', false ) .'>';
		$extend_slider .=		'</label>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			__( 'Control Nav', 't_em' );
		$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[nivo_control_nav]" value="1" '. checked( $t_em['nivo_control_nav'], '1', false ) .'>';
		$extend_slider .=		'</label>';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			__( 'Manual Advance', 't_em' );
		$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[nivo_manual_advance]" value="1" '. checked( $t_em['nivo_manual_advance'], '1', false ) .'>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div><!-- .sub-extend -->';
		$extend_slider .= '</div><!-- #slider-nivo-slider .slider-script-extend -->';
	$extend_slider .= '</div><!-- #slider-scripts-options -->';

	// Define Height of the Slider Carousel
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>'. sprintf( __( 'By default slider width is the same than layout width. Here you may enter the value you wish to be your slider height. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_SLIDER_DEFAULT_HEIGHT, T_EM_SLIDER_MAX_HEIGHT, T_EM_SLIDER_MIN_HEIGHT ).'</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label class="description"><span>'. __( 'Slider Height', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[slider_height]" value="'.esc_attr( $t_em['slider_height'] ).'" /><span class="unit">px</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Display a select list of categories
	$list_categories = get_categories();
	$extend_slider .= '<div class="sub-extend text-option">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<span>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</span>';
	$extend_slider .= 		'<select name="t_em_theme_options[slider_category]">';
	foreach ( $list_categories as $slider_category ) :
		$selected_option = selected( $t_em['slider_category'], $slider_category->term_id, false );
		$extend_slider .= 	'<option value="'.$slider_category->term_id.'" '.$selected_option.'>'.$slider_category->name.'</option>';
	endforeach;
	$extend_slider .= 		'</select>';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	// How many slides to show?
	$extend_slider .= '<div class="sub-extend text-option">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<span>'. sprintf( __( 'Introduce the number of slides you want to show. Default value will be <strong>%1$s</strong>, set at your <a href="%2$s" target="_blank">Reading Settings</a> posts per page option', 't_em' ),
		get_option( 'posts_per_page' ),
		admin_url( 'options-reading.php' ) ) .'</span>';
	$extend_slider .= 		'<input type="number"  name="t_em_theme_options[slider_number]" value="'. esc_attr( $t_em['slider_number'] ) .'" />';
	$extend_slider .=	'</label>';
	$extend_slider .= '</div>';

	return $extend_slider;
}

/**
 * Extend setting for Header Slider Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 */
function t_em_static_header_callback(){
	global $t_em,
			$static_header_layout;

	$static_header_layout = array (
		'static-header-text-right' => array (
			'value' => 'static-header-text-right',
			'label' => __( 'Static header text on right', 't_em' ),
			'title' => T_EM_INC_DIR_IMG_URL . '/slider-text-right.png',
		),
		'static-header-text-left' => array (
			'value' => 'static-header-text-left',
			'label' => __( 'Static header text on left', 't_em' ),
			'title' => T_EM_INC_DIR_IMG_URL . '/slider-text-left.png',
		),
	);

	$extend_static_header = '';

	// Show Static Header only at home page?
	$checked_option = checked( $t_em['static_header_home_only'], '1', false );
	$extend_static_header .= '<label class="description">';
	$extend_static_header .= 	__( 'Show Static Header only at home page?', 't_em' );
	$extend_static_header .= 	'<input type="checkbox" name="t_em_theme_options[static_header_home_only]" value="1" '. $checked_option .' />';
	$extend_static_header .= '</label>';

	$extend_static_header .= '<div class="image-radio-option-group">';
	foreach ( $static_header_layout as $static_header ) :
		$checked_option = checked( $t_em['static_header_text'], $static_header['value'], false );
		$extend_static_header .=	'<div class="layout image-radio-option static-header-layout">';
		$extend_static_header .=		'<label class="description">';
		$extend_static_header .=			'<input type="radio" name="t_em_theme_options[static_header_text]" class="sub-radio-option" value="'.esc_attr($static_header['value']).'" '. $checked_option .' />';
		$extend_static_header .=			'<span><img src="'.$static_header['title'].'" /><p>'.$static_header['label'].'</p></span>';
		$extend_static_header .=		'</label>';
		$extend_static_header .=	'</div>';
	endforeach;
	$extend_static_header .= '</div>';

	$extend_static_header .= '<div class="sub-layout text-option static-header">';
	$extend_static_header .=	'<label><span>'. __( 'Headline', 't_em' ) .'</span>';
	$extend_static_header .=		'<input type="text" class="regular-text headline" name="t_em_theme_options[static_header_headline]" value="' . $t_em['static_header_headline'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .= 	'<label><span>' . sprintf( __( '<a href="%1$s" target="_blank">Image URL</a>', 't_em' ), admin_url( 'upload.php' ) ) . '</span>';
	$extend_static_header .= 		'<input type="url" class="regular-text" name="t_em_theme_options[static_header_img_src]" value="' . $t_em['static_header_img_src'] . '" />';
	$extend_static_header .= 	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Content', 't_em' ) . '</span>';
	$extend_static_header .=		'<textarea name="t_em_theme_options[static_header_content]" cols="50" rows="5">' . $t_em['static_header_content'] . '</textarea>';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Primary button text', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_primary_button_text]" value="' . $t_em['static_header_primary_button_text'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Primary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_DOCS_URL . '/icomoon.html' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_primary_button_icon_class]" value="' . $t_em['static_header_primary_button_icon_class'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Primary button link', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="url" class="regular-text" name="t_em_theme_options[static_header_primary_button_link]" value="' . $t_em['static_header_primary_button_link'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Secondary button text', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_secondary_button_text]" value="' . $t_em['static_header_secondary_button_text'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Secondary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_DOCS_URL . '/icomoon.html' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_secondary_button_icon_class]" value="' . $t_em['static_header_secondary_button_icon_class'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Secondary button link', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="url" class="regular-text" name="t_em_theme_options[static_header_secondary_button_link]" value="' . $t_em['static_header_secondary_button_link'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .= '</div>';

	return $extend_static_header;
}

/**
 * Render the Header setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em See t_em_restore_from_scratch() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_header_set(){
	global $t_em;
?>
	<div id="header-options">
<?php
	foreach ( t_em_header_options() as $header ) :
?>
		<div class="layout radio-option header">
			<label class="description">
				<input type="radio" name="t_em_theme_options[header_set]" class="head-radio-option" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $t_em['header_set'], $header['value'] ); ?> />
				<span><?php echo $header['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	/* If our 'extend' key brings something, then we display our callback function.
	 * Header Image or Slider, that's the question.
	 */
	foreach ( t_em_header_options() as $sub_header ) :
		if ( $sub_header['extend'] != '' ) :
			$selected_option = ( $t_em['header_set'] == $sub_header['value'] ) ? 'selected-option' : '';
?>
		<div id="<?php echo $sub_header['value']; ?>" class="sub-layout header-extend <?php echo $selected_option; ?>">
			<?php echo $sub_header['extend']; ?>
		</div>
<?php
		endif;
	endforeach;
?>
	</div><!-- #header-options -->
<?php
}
?>
