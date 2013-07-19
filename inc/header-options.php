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
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 *
 * @since Twenty'em 0.1
 */
function t_em_header_image_callback(){
	global $t_em_theme_options;
	$extend_header = '';
	$extend_header .= '<p>'. sprintf( __( 'To manage your header image options <a href="%1$s" target="_blank">Click here</a>.', 't_em' ), admin_url( 'themes.php?page=custom-header' ) ) .'</p>';
	if ( get_header_image() ) :
		$checked_option = checked( $t_em_theme_options['header-featured-image'], '1', false );
		$extend_header .= '<figure><img src="'.get_header_image().'" width="500"></figure>';
		$extend_header .= '<label class="description">';
		$extend_header .=	 __( 'Display featured image in single posts and pages? ', 't_em' );
		$extend_header .=	'<input type="checkbox" name="t_em_theme_options[header-featured-image]" value="1" '. $checked_option .' />';
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
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file
 * @global $slider_layout Return an array with our slider's layout options.
 * @global $list_categories Havana, we have a list of categories... Should I say more?
 *
 * @since Twenty'em 0.1
 */
function t_em_slider_callback(){
	global	$t_em_theme_options,
			$slider_layout,
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
	$checked_option = checked( $t_em_theme_options['slider-home-only'], '1', false );
	$extend_slider .= '<label class="description">';
	$extend_slider .= 	__( 'Show Slider only at home page?', 't_em' );
	$extend_slider .= 	'<input type="checkbox" name="t_em_theme_options[slider-home-only]" value="1" '. $checked_option .' />';
	$extend_slider .= '</label>';

	// Display images options
	$extend_slider .= '<div class="image-radio-option-group">';
	foreach ( $slider_layout as $slider ) :
		$checked_option = checked( $t_em_theme_options['slider-text'], $slider['value'], false );
		$extend_slider .=	'<div class="layout image-radio-option slider-layout">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=			'<input type="radio" name="t_em_theme_options[slider-text]" class="sub-radio-option" value="'.esc_attr($slider['value']).'" '. $checked_option .' />';
		$extend_slider .=			'<span><img src="'.$slider['title'].'" /><p>'.$slider['label'].'</p></span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div>';

	// Slider Style
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>' . __( 'Select your slider style.', 't_em' ) . '</p>';
	$extend_slider .= '<p>' . __( '<strong>Important:</strong> The options above only works with Twenty&#8217;em Style.', 't_em' ) . '</p>';
	foreach ($slider_style as $style) :
		$checked_option = checked( $t_em_theme_options['nivo-style'], $style['value'], false );
		$extend_slider .=	'<div class="layout radio-option">';
		$extend_slider .=		'<label class="description">';
		$extend_slider .=		'<input type="radio" name="t_em_theme_options[nivo-style]" class="sub-radio-option" value="'.esc_attr( $style['value'] ).'" '. $checked_option .' />';
		$extend_slider .=		'<span>'. $style['label'] .'</span>';
		$extend_slider .=		'</label>';
		$extend_slider .=	'</div>';
	endforeach;
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Define Height of Nivo Slider
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>'. sprintf( __( 'By default slider width is the same than layout width. Here you may enter the value you wish to be your slider height. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_SLIDER_DEFAULT_HEIGHT, T_EM_SLIDER_MAX_HEIGHT, T_EM_SLIDER_MIN_HEIGHT ).'</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label class="description"><span>'. __( 'Slider Height', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[slider-height]" value="'.esc_attr( $t_em_theme_options['slider-height'] ).'" /><span class="unit">px</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Display a select list of categories
	$list_categories = get_categories();
	$extend_slider .= '<div class="sub-extend text-option">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<span>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</span>';
	$extend_slider .= 		'<select name="t_em_theme_options[slider-category]">';
	foreach ( $list_categories as $slider_category ) :
		$selected_option = selected( $t_em_theme_options['slider-category'], $slider_category->term_id, false );
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
	$extend_slider .= 		'<input type="number"  name="t_em_theme_options[slider-number]" value="'. esc_attr( $t_em_theme_options['slider-number'] ) .'" />';
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
	global $t_em_theme_options,
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
	$checked_option = checked( $t_em_theme_options['static-header-home-only'], '1', false );
	$extend_static_header .= '<label class="description">';
	$extend_static_header .= 	__( 'Show Static Header only at home page?', 't_em' );
	$extend_static_header .= 	'<input type="checkbox" name="t_em_theme_options[static-header-home-only]" value="1" '. $checked_option .' />';
	$extend_static_header .= '</label>';

	$extend_static_header .= '<div class="image-radio-option-group">';
	foreach ( $static_header_layout as $static_header ) :
		$checked_option = checked( $t_em_theme_options['static-header-text'], $static_header['value'], false );
		$extend_static_header .=	'<div class="layout image-radio-option static-header-layout">';
		$extend_static_header .=		'<label class="description">';
		$extend_static_header .=			'<input type="radio" name="t_em_theme_options[static-header-text]" class="sub-radio-option" value="'.esc_attr($static_header['value']).'" '. $checked_option .' />';
		$extend_static_header .=			'<span><img src="'.$static_header['title'].'" /><p>'.$static_header['label'].'</p></span>';
		$extend_static_header .=		'</label>';
		$extend_static_header .=	'</div>';
	endforeach;
	$extend_static_header .= '</div>';

	$extend_static_header .= '<div class="sub-layout text-option static-header">';
	$extend_static_header .=	'<label><span>'. __( 'Headline', 't_em' ) .'</span>';
	$extend_static_header .=		'<input type="text" class="regular-text headline" name="t_em_theme_options[static-header-headline]" value="' . $t_em_theme_options['static-header-headline'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .= 	'<label><span>' . sprintf( __( '<a href="%1$s" target="_blank">Image URL</a>', 't_em' ), admin_url( 'upload.php' ) ) . '</span>';
	$extend_static_header .= 		'<input type="url" class="regular-text" name="t_em_theme_options[static-header-img-src]" value="' . $t_em_theme_options['static-header-img-src'] . '" />';
	$extend_static_header .= 	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Content', 't_em' ) . '</span>';
	$extend_static_header .=		'<textarea name="t_em_theme_options[static-header-content]" cols="50" rows="5">' . $t_em_theme_options['static-header-content'] . '</textarea>';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Primary button text', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static-header-primary-button-text]" value="' . $t_em_theme_options['static-header-primary-button-text'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Primary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_DOCS_URL . '/icomoon.html' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static-header-primary-button-icon-class]" value="' . $t_em_theme_options['static-header-primary-button-icon-class'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Primary button link', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="url" class="regular-text" name="t_em_theme_options[static-header-primary-button-link]" value="' . $t_em_theme_options['static-header-primary-button-link'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Secondary button text', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static-header-secondary-button-text]" value="' . $t_em_theme_options['static-header-secondary-button-text'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Secondary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_DOCS_URL . '/icomoon.html' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static-header-secondary-button-icon-class]" value="' . $t_em_theme_options['static-header-secondary-button-icon-class'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Secondary button link', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="url" class="regular-text" name="t_em_theme_options[static-header-secondary-button-link]" value="' . $t_em_theme_options['static-header-secondary-button-link'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .= '</div>';

	return $extend_static_header;
}

/**
 * Render the Header setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_header_set(){
	global $t_em_theme_options;
?>
	<div id="header-options">
<?php
	foreach ( t_em_header_options() as $header ) :
?>
		<div class="layout radio-option header">
			<label class="description">
				<input type="radio" name="t_em_theme_options[header-set]" class="head-radio-option" value="<?php echo esc_attr( $header['value'] ); ?>" <?php checked( $t_em_theme_options['header-set'], $header['value'] ); ?> />
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
			$selected_option = ( $t_em_theme_options['header-set'] == $sub_header['value'] ) ? 'selected-option' : '';
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
