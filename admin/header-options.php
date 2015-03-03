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
 * 3. Static Header (static-header) displaying a custom header
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_header_options(){
	$header_options = array(
		'no-header-image' => array(
			'value' => 'no-header-image',
			'label' => __( 'No header image', 't_em' ),
			'extend' => '',
		),
		'header-image' => array(
			'value' => 'header-image',
			'label' => __( 'Header image', 't_em' ),
			'extend' => t_em_header_image_callback(),
		),
		'slider' => array(
			'value' => 'slider',
			'label' => __( 'Slider', 't_em' ),
			'extend' => t_em_slider_callback(),
		),
		'static-header' => array(
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
 * @global $t_em
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
		$extend_header .=	 __( 'Display featured image in single posts and pages ', 't_em' );
		$extend_header .=	'<input type="checkbox" name="t_em_theme_options[header_featured_image]" value="1" '. $checked_option .' />';
		$extend_header .= '</label>';
	else :
		$extend_header .= '<p>'. __( 'Oops! No image choosen yet', 't_em' ) .'</p>';
	endif;

	return apply_filters( 't_em_header_image_callback', $extend_header );
}

/**
 * Returns an array of category objects
 *
 * Hook this returned filter to display in your slider options some different taxonomies
 */
function t_em_slider_list_taxonomies(){
	return apply_filters( 't_em_slider_list_taxonomies', get_categories() );
}

/**
 * Extend setting for Header Slider Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @global $t_em
 *
 * @since Twenty'em 0.1
 */
function t_em_slider_callback(){
	global	$t_em;

	$extend_slider = '';

	// Show Slider only at home page?
	$checked_option = checked( $t_em['slider_home_only'], '1', false );
	$extend_slider .= '<label class="description">';
	$extend_slider .= 	__( 'Show Slider only at home page?', 't_em' );
	$extend_slider .= 	'<input type="checkbox" name="t_em_theme_options[slider_home_only]" value="1" '. $checked_option .' />';
	$extend_slider .= '</label>';

	// Bootstrap Carousel Options
	$extend_slider .= '<div id="slider-bootstrap-carousel" class="sub-extend layout text-option slider-script-extend">';
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
	$extend_slider .=			__( 'Pause', 't_em' );
	$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[bootstrap_carousel_pause]" value="1" '. $checked_option .'>';
	$extend_slider .=		'</label>';
	$extend_slider .=	'</div>';
	$checked_option = checked( $t_em['bootstrap_carousel_wrap'], '1', false );
	$extend_slider .=	'<div class="sub-extend">';
	$extend_slider .=		'<p>' . __( 'Whether the carousel should cycle continuously or have hard stops.', 't_em' ) . '</p>';
	$extend_slider .=		'<label class="description">';
	$extend_slider .=			__( 'Wrap', 't_em' );
	$extend_slider .=			'<input type="checkbox" name="t_em_theme_options[bootstrap_carousel_wrap]" value="1" '. $checked_option .'>';
	$extend_slider .=		'</label>';
	$extend_slider .=	'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Define Height of the Slider Carousel
	$extend_slider .= '<div class="sub-extend">';
	$extend_slider .= '<p>'. sprintf( __( 'By default slider width is the same than layout width. Here you may enter the value you wish to be your slider height. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_SLIDER_DEFAULT_HEIGHT, T_EM_SLIDER_MAX_HEIGHT, T_EM_SLIDER_MIN_HEIGHT ).'</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label class="description"><span>'. __( 'Slider Height', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[slider_height]" value="'.esc_attr( $t_em['slider_height'] ).'" /><span class="unit">px</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	$extend_slider .= '<div class="sub-extend text-option">';
	$extend_slider .=	'<label class="description">';
	$extend_slider .= 		'<span>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</span>';
	$extend_slider .= 		'<select name="t_em_theme_options[slider_category]">';
	foreach ( t_em_slider_list_taxonomies() as $slider_category ) :
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
 * Returns an array with our static header layout options.
 */
function t_em_static_header_layout_options(){
	$static_header_layout = array(
		'static-header-text-right' => array(
			'value' => 'static-header-text-right',
			'label' => __( 'Static header text on right', 't_em' ),
			'title' => T_EM_ADMIN_DIR_IMG_URL . '/slider-text-right.png',
		),
		'static-header-text-left' => array(
			'value' => 'static-header-text-left',
			'label' => __( 'Static header text on left', 't_em' ),
			'title' => T_EM_ADMIN_DIR_IMG_URL . '/slider-text-left.png',
		),
	);

	return apply_filters( 't_em_static_header_layout_options', $static_header_layout );
}

/**
 * Extend setting for Static Header Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 */
function t_em_static_header_callback(){
	global $t_em;

	$extend_static_header = '';

	// Show Static Header only at home page?
	$checked_option = checked( $t_em['static_header_home_only'], '1', false );
	$extend_static_header .= '<label class="description">';
	$extend_static_header .= 	__( 'Show Static Header only at home page?', 't_em' );
	$extend_static_header .= 	'<input type="checkbox" name="t_em_theme_options[static_header_home_only]" value="1" '. $checked_option .' />';
	$extend_static_header .= '</label>';

	$extend_static_header .= '<div class="image-radio-option-group">';
	foreach ( t_em_static_header_layout_options() as $static_header ) :
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
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Primary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_FONTS_URL . '/icomoon.html' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_primary_button_icon_class]" value="' . $t_em['static_header_primary_button_icon_class'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Primary button link', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="url" class="regular-text" name="t_em_theme_options[static_header_primary_button_link]" value="' . $t_em['static_header_primary_button_link'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . __( 'Secondary button text', 't_em' ) . '</span>';
	$extend_static_header .=		'<input type="text" class="regular-text" name="t_em_theme_options[static_header_secondary_button_text]" value="' . $t_em['static_header_secondary_button_text'] . '">';
	$extend_static_header .=	'</label>';
	$extend_static_header .=	'<label><span>' . sprintf( __( 'Secondary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_THEME_DIR_FONTS_URL . '/icomoon.html' ) . '</span>';
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
 * @global $t_em.
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
