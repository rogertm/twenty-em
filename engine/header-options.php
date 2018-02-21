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
 * Twenty'em Header theme options.
 */

/**
 * Return an array of Header Options for Twenty'em admin panel.
 * This function manage what is displayed in our theme header. Possibles options are:
 * 0. Nothing (no-header)
 * 1. Header image (header-image) defined in t_em_support_custom_header_image() function in
 * /inc/functions.php
 * 2. Slider (slider) displaying featured posts of such category
 * 3. Static Header (static-header) displaying a custom header
 *
 * @return array
 *
 * @since Twenty'em 1.0
 */
function t_em_header_options( $header_options = '' ){
	$header_options = array(
		/**
		 * Filter the callback function
		 *
		 * @param bool If false, the option will not be enable. Default true
		 * @since Twenty'em 1.0
		 */
		'no-header' => array(
			'value' => 'no-header',
			'label' => __( 'No header', 't_em' ),
			'callback' => ( apply_filters( 't_em_admin_filter_header_options_no_header_image', true ) ) ? __( '<p>No header, nothing to show.</p>', 't_em' ) : null,
		),
		'header-image' => array(
			'value' => 'header-image',
			'label' => __( 'Header image', 't_em' ),
			'callback' => ( apply_filters( 't_em_admin_filter_header_options_header_image', true ) ) ? t_em_header_image_callback() : null,
		),
		'slider' => array(
			'value' => 'slider',
			'label' => __( 'Slider', 't_em' ),
			'callback' => ( apply_filters( 't_em_admin_filter_header_options_slider', true ) ) ? t_em_slider_callback() : null,
		),
		'static-header' => array(
			'value' => 'static-header',
			'label' => __( 'Static Header', 't_em' ),
			'callback' => ( apply_filters( 't_em_admin_filter_header_options_static_header', true ) ) ? t_em_static_header_callback() : null,
		),
	);

	/**
	 * Filter the Header Options Set
	 *
	 * @param array An array of new options in the Header Options Set.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'label', and 'callback' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_header_options', $header_options );
}

/**
 * Extend setting for Header Image Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @since Twenty'em 1.0
 */
function t_em_header_image_callback(){
	$extend_header = '';
	$extend_header .= '<p class="alert alert-info">'. sprintf( __( 'You can manage your header image option in the <a href="%1$s">Theme Customizer</a> screen.', 't_em' ), admin_url( 'customize.php?autofocus[control]=header_image' ) ) .'</p>';
	if ( get_header_image() ) :
		$extend_header .= '<div class="sub-extend option-group">';
		$extend_header .= 	'<figure><img src="'.get_header_image().'" width="500"></figure>';
		$extend_header .= 	'<header>'. __( 'Options', 't_em' ). '</header>';
		$extend_header .= 	'<div class="sub-extend option-single">';
		$extend_header .= 		'<label class="description">';
		$extend_header .= 			'<p>';
		$checked_option = checked( t_em( 'header_featured_image_home_only' ), '1', false );
		$extend_header .=				'<input type="checkbox" name="t_em_theme_options[header_featured_image_home_only]" value="1" '. $checked_option .' />';
		$extend_header .=				__( 'Show header image only at home page ', 't_em' );
		$extend_header .= 			'</p>';
		$extend_header .= 			'<p class="description">'. __( 'This unable the option below', 't_em' ) .'</p>';
		$extend_header .= 		'</label>';
		$extend_header .= 	'</div>';
		$extend_header .= 	'<div class="sub-extend option-single">';
		$extend_header .= 		'<label class="description">';
		$extend_header .= 			'<p>';
		$checked_option = checked( t_em( 'header_featured_image' ), '1', false );
		$extend_header .=				'<input type="checkbox" name="t_em_theme_options[header_featured_image]" value="1" '. $checked_option .' />';
		$extend_header .=				__( 'Display featured image in single posts and pages ', 't_em' );
		$extend_header .= 			'</p>';
		$extend_header .= 		'</label>';
		$extend_header .= 	'</div>';
		$extend_header .= '</div>';
	else :
		$extend_header .= '<p>'. __( 'Oops! No image chosen yet', 't_em' ) .'</p>';
	endif;

	/**
	 * Filter the Header Image Option output
	 * @param string $extend_header HTML output
	 *
	 * @since Twenty'em 1.2.2
	 */
	return apply_filters( 't_em_admin_filter_header_image_output', $extend_header );
}

/**
 * Returns an array of category objects
 *
 * Hook this returned filter to display in your slider options some different taxonomies
 */
function t_em_slider_list_taxonomies( $slider_category = '' ){
	$slider_category = get_categories();
	/**
	 * Filter the Slider Taxonomy
	 *
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_slider_list_taxonomies', $slider_category );
}

/**
 * Extend setting for Header Slider Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 *
 * @since Twenty'em 1.0
 */
function t_em_slider_callback(){
	global	$t_em;

	$extend_slider = '';

	// Show Slider only at home page?
	$checked_option = checked( t_em( 'slider_home_only' ), '1', false );
	$extend_slider .= '<div class="sub-extend option-group">';
	$extend_slider .= 	'<header>'. __( 'Options', 't_em' ). '</header>';
	$extend_slider .= 	'<p>';
	$extend_slider .= 		'<label class="description">';
	$extend_slider .= 			'<input type="checkbox" name="t_em_theme_options[slider_home_only]" value="1" '. $checked_option .' />';
	$extend_slider .= 			__( 'Show Slider only at home page', 't_em' );
	$extend_slider .= 		'</label>';
	$extend_slider .= 	'</p>';
	$extend_slider .= '</div>';

	// Bootstrap Carousel Options
	$extend_slider .= '<div id="slider-bootstrap-carousel" class="sub-extend option-group">';
	$extend_slider .= 	'<header>'. __( 'Attributes', 't_em' ). '</header>';
	$extend_slider .=	'<div class="sub-extend option-single">';
	$extend_slider .= 		'<p>' . sprintf( __( 'The amount of time, in milliseconds, to delay between automatically cycling an item. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_DEFAULT_VALUE, T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE, T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE ) . '</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label class="description">';
	$extend_slider .=				'<span>'. __( 'Interval value', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[bootstrap_carousel_interval]" value="'. t_em( 'bootstrap_carousel_interval' ) .'" max="'. T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MAX_VALUE .'" min="'. T_EM_BOOTSTRAP_CAROUSEL_INTERVAL_MIN_VALUE .'">';
	$extend_slider .=				'<span class="unit">mls</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .=	'</div>';
	$checked_option = checked( t_em( 'bootstrap_carousel_pause' ), '1', false );
	$extend_slider .=	'<div class="sub-extend option-single">';
	$extend_slider .=		'<p>';
	$extend_slider .=			'<label class="description">';
	$extend_slider .=				'<input type="checkbox" name="t_em_theme_options[bootstrap_carousel_pause]" value="1" '. $checked_option .'>';
	$extend_slider .=				__( 'Pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave.', 't_em' );
	$extend_slider .=			'</label>';
	$extend_slider .=		'</p>';
	$extend_slider .=	'</div>';
	$checked_option = checked( t_em( 'bootstrap_carousel_wrap' ), '1', false );
	$extend_slider .=	'<div class="sub-extend option-single">';
	$extend_slider .=		'<p>';
	$extend_slider .=			'<label class="description">';
	$extend_slider .=				'<input type="checkbox" name="t_em_theme_options[bootstrap_carousel_wrap]" value="1" '. $checked_option .'>';
	$extend_slider .=				__( 'Whether the carousel should cycle continuously or have hard stops.', 't_em' );
	$extend_slider .=			'</label>';
	$extend_slider .=		'</p>';
	$extend_slider .=	'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	// Define Height of the Slider Carousel
	$extend_slider .= '<div class="sub-extend option-group">';
	$extend_slider .= 	'<header>'. __( 'Slider Height', 't_em' ). '</header>';
	$extend_slider .= 	'<p>'. sprintf( __( 'By default slider width is the same than layout width. Here you may enter the value you wish to be your slider height. Options: default: <code>%1$s</code>; max: <code>%2$s</code>; min: <code>%3$s</code>', 't_em' ), T_EM_SLIDER_DEFAULT_HEIGHT, T_EM_SLIDER_MAX_HEIGHT, T_EM_SLIDER_MIN_HEIGHT ).'</p>';
	$extend_slider .= 		'<div class="layout text-option thumbnail">';
	$extend_slider .=			'<label class="description"><span>'. __( 'Slider Height', 't_em' ) .'</span>';
	$extend_slider .=				'<input type="number" name="t_em_theme_options[slider_height]" value="'.esc_attr( t_em( 'slider_height' ) ).'" max="'. T_EM_SLIDER_MAX_HEIGHT .'" min="'. T_EM_SLIDER_MIN_HEIGHT .'" /><span class="unit">px</span>';
	$extend_slider .=			'</label>';
	$extend_slider .=		'</div>';
	$extend_slider .= '</div><!-- .sub-extend -->';

	$extend_slider .= '<div class="sub-extend option-group">';
	$extend_slider .= 	'<header>'. __( 'Category', 't_em' ). '</header>';
	$extend_slider .= 	'<div class="layout text-option thumbnail">';
	$extend_slider .=		'<label class="description">';
	$extend_slider .= 			'<span>'. __( 'Select the category you want to be displayed in the slider section', 't_em' ) .'</span>';
	$extend_slider .= 			'<select name="t_em_theme_options[slider_category]">';
	foreach ( t_em_slider_list_taxonomies() as $slider_category ) :
		$selected_option = selected( ( t_em( 'slider_category' ) ) ? t_em( 'slider_category' ) : get_option( 'default_category' ), $slider_category->term_id, false );
		$extend_slider .= 	'<option value="'.$slider_category->term_id.'" '.$selected_option.'>'.$slider_category->name.'</option>';
	endforeach;
	$extend_slider .= 			'</select>';
	$extend_slider .=		'</label>';
	$extend_slider .= 	'</div>';
	$extend_slider .= '</div>';

	// How many slides to show?
	$extend_slider .= '<div class="sub-extend option-group">';
	$extend_slider .= 	'<header>'. __( 'Slides', 't_em' ). '</header>';
	$extend_slider .= 	'<div class="layout text-option thumbnail">';
	$extend_slider .=		'<label class="description">';
	$extend_slider .= 			'<span>'. sprintf( __( 'Introduce the number of slides you want to show. Default value will be <strong>%1$s</strong>, set at your <a href="%2$s" target="_blank">Reading Settings</a> posts per page option', 't_em' ),
		get_option( 'posts_per_page' ),
		admin_url( 'options-reading.php' ) ) .'</span>';
	$extend_slider .= 			'<input type="number"  name="t_em_theme_options[slider_number]" value="'. esc_attr( t_em( 'slider_number' ) ) .'" />';
	$extend_slider .=		'</label>';
	$extend_slider .= 	'</div>';
	$extend_slider .= '</div>';

	/**
	 * Filter the Carousel Option output
	 * @param string $extend_slider HTML output
	 *
	 * @since Twenty'em 1.2.2
	 */
	return apply_filters( 't_em_admin_filter_slider_output', $extend_slider );
}

/**
 * Returns an array with our static header layout options.
 */
function t_em_static_header_layout_options( $static_header_layout = '' ){
	$static_header_layout = array(
		'static-header-text-right' => array(
			'value' => 'static-header-text-right',
			'label' => __( 'Static header text on right', 't_em' ),
			'thumbnail' => T_EM_ENGINE_DIR_IMG_URL . '/slider-text-right.png',
		),
		'static-header-text-left' => array(
			'value' => 'static-header-text-left',
			'label' => __( 'Static header text on left', 't_em' ),
			'thumbnail' => T_EM_ENGINE_DIR_IMG_URL . '/slider-text-left.png',
		),
	);

	/**
	 * Filter the Static Header options in Header Options Set
	 *
	 * @param array An array of new options in Static Header Options.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'label', and 'thumbnail' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_static_header_layout_options', $static_header_layout );
}

/**
 * Extend setting for Static Header Option in Twenty'em admin panel.
 * Referenced via t_em_header_options().
 */
function t_em_static_header_callback(){
	$extend_static_header = '';

	// Show Static Header only at home page?
	$checked_option = checked( t_em( 'static_header_home_only' ), '1', false );
	$extend_static_header .= '<div class="sub-extend option-group">';
	$extend_static_header .= 	'<header>'. __( 'Options', 't_em' ) .'</header>';
	$extend_static_header .= 	'<p>';
	$extend_static_header .= 		'<label class="description">';
	$extend_static_header .= 			'<input type="checkbox" name="t_em_theme_options[static_header_home_only]" value="1" '. $checked_option .' />';
	$extend_static_header .= 			__( 'Show Static Header only at home page?', 't_em' );
	$extend_static_header .= 		'</label>';
	$extend_static_header .= 	'</p>';
	$extend_static_header .= '</div>';

	$extend_static_header .= '<div class="sub-extend option-group">';
	$extend_static_header .= 	'<header>'. __( 'Image and Text Alignment', 't_em' ) .'</header>';
	$extend_static_header .= 	'<div class="image-radio-option-group">';
	foreach ( t_em_static_header_layout_options() as $static_header ) :
		$active_option = ( t_em( 'static_header_text' ) == $static_header['value'] ) ? 'radio-image radio-image-active' : 'radio-image';
		$extend_static_header .=	'<div class="layout image-radio-option static-header-layout '. $active_option .'">';
		$extend_static_header .=		'<label class="description">';
		$extend_static_header .=			'<input class="input-image-radio-option sub-radio-option" type="radio" name="t_em_theme_options[static_header_text]" value="'.esc_attr($static_header['value']).'" '. checked( t_em( 'static_header_text' ), $static_header['value'], false ) .' />';
		$extend_static_header .=			'<span><img src="'.$static_header['thumbnail'].'" class="" /><p>'.$static_header['label'].'</p></span>';
		$extend_static_header .=		'</label>';
		$extend_static_header .=	'</div>';
	endforeach;
	$extend_static_header .= 	'</div>';
	$extend_static_header .= '</div>';

	$extend_static_header .= '<div class="sub-extend option-group">';
	$extend_static_header .= 	'<header>'. __( 'Headline, Content and More...', 't_em' ) .'</header>';
	$extend_static_header .= 	'<div class="sub-layout text-option static-header">';
	$extend_static_header .=		'<label><span>'. __( 'Headline', 't_em' ) .'</span>';
	$extend_static_header .=			'<input type="text" class="regular-text headline" name="t_em_theme_options[static_header_headline]" value="' . esc_textarea( t_em( 'static_header_headline' ) ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .= 		'<label><span>' . sprintf( __( '<a href="%1$s" target="_blank">Image URL</a>', 't_em' ), admin_url( 'upload.php' ) ) . '</span>';
	$extend_static_header .= 			'<input type="url" id="t-em-static-header-image-url" class="regular-text media-url" name="t_em_theme_options[static_header_img_src]" value="' . t_em( 'static_header_img_src' ) . '" />';
	$extend_static_header .=			'<a href="#" id="t-em-button-static-header-image" class="button media-selector">'. __( 'Upload Image', 't_em' ) .'</a>';
	$extend_static_header .= 		'</label>';
	$extend_static_header .=		'<label><span>' . __( 'Content', 't_em' ) . '</span>';
	$extend_static_header .=			'<textarea class="large-text" name="t_em_theme_options[static_header_content]" cols="50" rows="5">' . esc_textarea( t_em( 'static_header_content' ) ) . '</textarea>';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . __( 'Primary button text', 't_em' ) . '</span>';
	$extend_static_header .=			'<input type="text" class="regular-text" name="t_em_theme_options[static_header_primary_button_text]" value="' . t_em( 'static_header_primary_button_text' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . sprintf( __( 'Primary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
	$extend_static_header .=			'<input type="text" class="regular-text" name="t_em_theme_options[static_header_primary_button_icon_class]" value="' . t_em( 'static_header_primary_button_icon_class' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . __( 'Primary button link', 't_em' ) . '</span>';
	$extend_static_header .=			'<input type="url" class="regular-text" name="t_em_theme_options[static_header_primary_button_link]" value="' . t_em( 'static_header_primary_button_link' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . __( 'Secondary button text', 't_em' ) . '</span>';
	$extend_static_header .=			'<input type="text" class="regular-text" name="t_em_theme_options[static_header_secondary_button_text]" value="' . t_em( 'static_header_secondary_button_text' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . sprintf( __( 'Secondary button <a href="%1$s" target="_blank">icon class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
	$extend_static_header .=			'<input type="text" class="regular-text" name="t_em_theme_options[static_header_secondary_button_icon_class]" value="' . t_em( 'static_header_secondary_button_icon_class' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .=		'<label><span>' . __( 'Secondary button link', 't_em' ) . '</span>';
	$extend_static_header .=			'<input type="url" class="regular-text" name="t_em_theme_options[static_header_secondary_button_link]" value="' . t_em( 'static_header_secondary_button_link' ) . '">';
	$extend_static_header .=		'</label>';
	$extend_static_header .= 	'</div>';
	$extend_static_header .= '</div>';

	/**
	 * Filter the Static Header Option output
	 * @param string $extend_static_header HTML output
	 *
	 * @since Twenty'em 1.2.2
	 */
	return apply_filters( 't_em_admin_filter_static_header_output', $extend_static_header );
}

/**
 * Render the Header setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /engine/theme-options.php.
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_field_header_set(){
	// If any option is set to false, check the first available option from t_em_header_options()
	$header_value = array();
	foreach ( t_em_header_options() as $header ) :
		if ( $header['callback'] ) :
			array_push( $header_value, $header['value'] );
		endif;
	endforeach;
	$default_checked = ( count( $header_value ) > 0 && ! in_array( t_em( 'header_set' ), $header_value ) ) ? $header_value[0] : null;
?>
	<div id="header-options" class="tabs">
		<?php do_action( 't_em_admin_action_header_options_before' ); ?>
		<?php if ( count( $header_value ) == 0 ) : ?>
				<p class="alert alert-critical"><?php _e( '<strong>Oops!</strong> No options available for this setting...', 't_em' ); ?></p>
		<?php else : ?>
					<ul>
<?php
				foreach ( t_em_header_options() as $header ) :
					if ( $header['callback'] ) :
						$active_option = ( t_em( 'header_set' ) == $header['value'] ) ? 'ui-tabs-active' : '';
						$checked = ( $default_checked == $header['value'] )
										? $checked = 'checked="checked"'
										: checked( t_em( 'header_set' ), $header['value'], false );
?>
					<li class="<?php echo $active_option ?>">
						<a href="#<?php echo $header['value'] ?>" class="tab-heading">
							<input type="radio" name="t_em_theme_options[header_set]" class="head-radio-option" value="<?php echo esc_attr( $header['value'] ); ?>" <?php echo $checked; ?> />
							<?php echo $header['label']; ?>
						</a>
					</li>
<?php
					endif;
				endforeach;
?>
					</ul>
<?php

				/* If our 'callback' key brings something, then we display our callback function.
				 * Header Image or Slider, that's the question.
				 */
				foreach ( t_em_header_options() as $sub_header ) :
					if ( $sub_header['callback'] ) :
?>
					<div id="<?php echo $sub_header['value']; ?>" class="sub-layout header-extend">
						<?php do_action( "t_em_admin_action_header_option_{$sub_header['value']}_before" ); ?>
						<?php echo $sub_header['callback']; ?>
						<?php do_action( "t_em_admin_action_header_option_{$sub_header['value']}_after" ); ?>
					</div>
<?php
					endif;
				endforeach;
			endif; ?>
		<?php do_action( 't_em_admin_action_header_options_after' ); ?>
	</div><!-- #header-options -->
<?php
}
?>
