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
 * Twenty'em Front Page theme options.
 */

/**
 * Return an array of Front Page Options for Twenty'em admin panel.
 * This function manage what is displayed in our front page. Possibles options are:
 * 0. Just another WordPress archive or static page.
 * 1. Text Widgets areas.
 *
 * @return array
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_options(){
	$front_page_options = array(
		/**
		 * Filter the callback function
		 *
		 * @param bool If false, the option will not be enable. Default true
		 * @since Twenty'em 1.0
		 */
		'wp-front-page' => array(
			'value'			=> 'wp-front-page',
			'label'			=> __( 'Just another WordPress front page', 't_em' ),
			'callback'		=> ( apply_filters( 't_em_admin_filter_front_page_options_wp_front_page', true ) ) ? t_em_front_page_jawpfp_callback() : null,
		),
		'widgets-front-page' => array(
			'value'			=> 'widgets-front-page',
			'label'			=> __( 'Text Widgets', 't_em' ),
			'callback'		=> ( apply_filters( 't_em_admin_filter_front_page_options_widgets_from_page', true ) ) ? t_em_front_page_witgets_callback() : null,
		),
	);

	/**
	 * Filter the Front Page Options Set
	 *
	 * @param array An array of new options in the Front Page Options Set.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'label', and 'callback' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_front_page_options', $front_page_options );
}

/**
 * Extend setting for Just another WordPress front page Option in Twenty'em admin panel
 * Reference via t_em_front_page_options()
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_jawpfp_callback(){
	$show_on_front = '';
	if ( 'posts' == get_option( 'show_on_front' ) ) :
		$show_on_front .= sprintf( __( 'Displaying: Your latests "<strong>%1$s posts</strong>"', 't_em' ),
						  get_option( 'posts_per_page' ) );
	elseif ( 'page' == get_option( 'show_on_front' ) ) :
		$front_page_data = get_page( get_option( 'page_on_front' ) );
		$posts_page_data = get_page( get_option( 'page_for_posts' ) );
		$show_on_front .= sprintf( __( 'Displaying: Static Page "<strong>%1$s</strong>". Page for Posts "<strong>%2$s</strong>"', 't_em' ),
						  $front_page_data->post_title,
						  $posts_page_data->post_title );
	endif;

	$extend_jawpfp = '';
	$extend_jawpfp .= '<p class="alert alert-info">' . sprintf( __( 'To manage this options you should go to your <a href="%1$s" target="_blank">Reading Settings</a>', 't_em' ),
							  admin_url( 'options-reading.php' ) );
	$extend_jawpfp .= '</p>';
	$extend_jawpfp .= '<p>'. $show_on_front . '</p>';

	/**
	 * Filter the Just another WordPress front page Option output
	 * @param string $extend_jawpfp HTML output
	 *
	 * @since Twenty'em 1.2.2
	 */
	return apply_filters( 't_em_admin_filter_jawpfp_output', $extend_jawpfp );
}

/**
 * Return an array of Front Page Text Widgets Options for Twenty'em admin panel.
 *
 * @return array
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_widgets_options( $front_page_widgets = '' ){
	$front_page_widgets = array(
		'text_widget_one' => array(
			'name'			=> 'text_widget_one',
			'label'			=> __( 'First home page text area', 't_em' ),
		),
		'text_widget_two' => array(
			'name'			=> 'text_widget_two',
			'label'			=> __( 'Second home page text area', 't_em' ),
		),
		'text_widget_three' => array(
			'name'			=> 'text_widget_three',
			'label'			=> __( 'Third home page text area', 't_em' ),
		),
		'text_widget_four' => array(
			'name'			=> 'text_widget_four',
			'label'			=> __( 'Fourth home page text area', 't_em' ),
		),
	);

	/**
	 * Filter the front page witgets in Front Page Options Set
	 *
	 * @param array An array of new options.
	 * 				Keyed by a string id. The ids point to arrays containing 'name' and 'label' keys.
	 * @since Twenty'em 1.0
	 */
	return apply_filters( 't_em_admin_filter_front_page_widgets_options', $front_page_widgets );
}

/**
 * Array of Front Page Text Widgets Templates
 * @return 	array
 *
 * @since Twenty'em 1.2
 */
function t_em_front_page_witgets_templates(){
	$witgets_templates = array(
		'template-jumbotron'	=> array(
			'value'		=> 'template-jumbotron',
			'label'		=> __( 'Jumbotron', 't_em' ),
			'thumbnail'	=> T_EM_ENGINE_DIR_IMG_URL . '/template-jumbotron.png',
		),
		'template-features'	=> array(
			'value'		=> 'template-features',
			'label'		=> __( 'Features', 't_em' ),
			'thumbnail'	=> T_EM_ENGINE_DIR_IMG_URL . '/template-features.png',
		),
	);

	/**
	 * Filter the Front Page Witdgets Template Set
	 *
	 * @param array An array of new options in the Front Page Templates Set.
	 * 				Keyed by a string id. The ids point to arrays containing 'value', 'label', and 'thumbnail' keys.
	 * @since Twenty'em 1.2
	 */
	return apply_filters( 't_em_admin_filter_front_page_witgets_templates', $witgets_templates );
}

/**
 * Extend setting for Front Page Text Widgets in Twenty'em admin panel
 * Reference via t_em_front_page_options()
 *
 * @since Twenty'em 1.0
 */
function t_em_front_page_witgets_callback(){
	$extend_front_page = '';
	$extend_front_page .= '<div class="row">';
	$i = 0;
	foreach ( t_em_front_page_widgets_options() as $widget ) :
		if ( 0 == $i % 2 ) :
			$extend_front_page .= '</div>';
			$extend_front_page .= '<div class="row">';
		endif;
		$extend_front_page .= '<div id="' . $widget['name'] . '" class="sub-extend option-group">';
		$extend_front_page .= 	'<div class="layout text-option front-page">';
		$extend_front_page .= 		'<header>' . $widget['label'] . '</header>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Headline', 't_em' ) .'</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text headline" name="t_em_theme_options[headline_' . $widget['name'] . ']" value="' . esc_textarea( t_em( 'headline_'.$widget['name'] ) ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . sprintf( __( 'Headline <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[headline_icon_class_' . $widget['name'] . ']" value="' . t_em( 'headline_icon_class_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Content', 't_em' ) .'</span>';
		$extend_front_page .= 			'<textarea name="t_em_theme_options[content_' . $widget['name'] . ']" class="large-text" cols="50" rows="10">' . esc_textarea( t_em( 'content_'.$widget['name'] ) ) . '</textarea>';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . sprintf( __( '<a href="%1$s" target="_blank">Thumbnail URL</a>', 't_em' ), admin_url( 'upload.php' ) ) . '</span>';
		$extend_front_page .= 			'<input type="url" id="t-em-text-widget-image-url-' . $widget['name'] . '" class="regular-text media-url" name="t_em_theme_options[thumbnail_src_' . $widget['name'] . ']" value="' . t_em( 'thumbnail_src_'.$widget['name'] ) . '" />';
		$extend_front_page .=			'<a href="#" id="t-em-button-text-widget-image-' . $widget['name'] . '" class="button media-selector">'. __( 'Upload Image', 't_em' ) .'</a>';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Primary button text', 't_em' ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[primary_button_text_' . $widget['name'] . ']" value="' . t_em( 'primary_button_text_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . sprintf( __( 'Primary button <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[primary_button_icon_class_' . $widget['name'] . ']" value="' . t_em( 'primary_button_icon_class_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Primary button link', 't_em' ) . '</span>';
		$extend_front_page .= 			'<input type="url" class="regular-text" name="t_em_theme_options[primary_button_link_' . $widget['name'] . ']" value="' . t_em( 'primary_button_link_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Secondary button text', 't_em' ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[secondary_button_text_' . $widget['name'] . ']" value="' . t_em( 'secondary_button_text_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . sprintf( __( 'Secondary button <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) . '</span>';
		$extend_front_page .= 			'<input type="text" class="regular-text" name="t_em_theme_options[secondary_button_icon_class_' . $widget['name'] . ']" value="' . t_em( 'secondary_button_icon_class_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 		'<p><label><span>' . __( 'Secondary button link', 't_em' ) . '</span>';
		$extend_front_page .= 			'<input type="url" class="regular-text" name="t_em_theme_options[secondary_button_link_' . $widget['name'] . ']" value="' . t_em( 'secondary_button_link_'.$widget['name'] ) . '" />';
		$extend_front_page .= 		'</label></p>';
		$extend_front_page .= 	'</div>';
		$extend_front_page .= '</div>';
		$i++;
	endforeach;
	$extend_front_page .= '</div>';

	/**
	 * Filter the Front Page Widgets Option output
	 * @param string $extend_front_page HTML output
	 *
	 * @since Twenty'em 1.2.2
	 */
	return apply_filters( 't_em_admin_filter_front_page_widgets_output', $extend_front_page );
}

/**
 * Render the Templates for Front Page Witgets
 *
 * @since Twenty'em 1.2
 */
function t_em_front_page_widtgets_templates_callback(){
?>
	<div class="row">
	<div class="sub-exctend option-group">
		<header><?php _e( 'Front Page Template', 't_em' ); ?></header>
		<div class="image-radio-option-group">
<?php
	$templates = t_em_front_page_witgets_templates();
	foreach ( $templates as $template ) :
		$active_option = ( t_em( 'text_widget_template' ) == $template['value'] ) ? 'radio-image radio-image-active' : 'radio-image';
?>
			<div class="layout image-radio-option theme-front-page <?php echo $active_option ?>">
				<label class="description" style="width:225px;">
					<input type="radio" class="input-image-radio-option" name="t_em_theme_options[text_widget_template]" value="<?php echo $template['value'] ?>" <?php echo checked( t_em( 'text_widget_template' ), $template['value'] ) ?>>
					<span>
						<img src="<?php echo $template['thumbnail'] ?>" width="200" height="150">
						<p><?php echo $template['label'] ?></p>
					</span>
				</label>
			</div>
<?php endforeach; ?>
		</div>
	</div>
	</div>
<?php
}
add_action( 't_em_admin_action_from_page_option_widgets-front-page_after', 't_em_front_page_widtgets_templates_callback' );

/**
 * Render the Front Page Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /engine/theme-options.php.
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_field_front_page_options_set(){
	// Check for a new default value if any option is set to false
	$front_page_value = array();
	foreach ( t_em_front_page_options() as $front_page ) :
		if ( $front_page['callback'] ) :
			array_push( $front_page_value, $front_page['value'] );
		endif;
	endforeach;
	$default_checked = ( count( $front_page_value ) > 0 && ! in_array( t_em( 'front_page_set' ), $front_page_value ) ) ? $front_page_value[0] : null;
?>
	<div id="front-page-options" class="tabs">
		<?php do_action( 't_em_admin_action_from_page_options_before' ); ?>
		<?php if ( count( $front_page_value ) == 0 ) : ?>
				<p class="alert alert-critical"><?php _e( '<strong>Oops!</strong> No options available for this setting...', 't_em' ); ?></p>
		<?php else : ?>
					<ul>
<?php
				foreach ( t_em_front_page_options() as $front_page ) :
					if ( $front_page['callback'] ) :
						$active_option = ( t_em( 'front_page_set' ) == $front_page['value'] ) ? 'ui-tabs-active' : '';
						$checked = ( $default_checked == $front_page['value'] )
										? $checked = 'checked="checked"'
										: checked( t_em( 'front_page_set' ), $front_page['value'], false );
?>
					<li class="<?php echo $active_option ?>">
						<a href="#<?php echo $front_page['value']; ?>" class="tab-heading">
							<input type="radio" name="t_em_theme_options[front_page_set]" class="head-radio-option" value="<?php echo esc_attr( $front_page['value'] ); ?>" <?php echo $checked; ?> />
							<?php echo $front_page['label']; ?>
						</a>
					</li>
<?php
					endif;
				endforeach;
?>
					</ul>
<?php
				foreach ( t_em_front_page_options() as $sub_front_page ) :
					if ( $sub_front_page['callback'] ) :
					$selected_option = ( t_em( 'front_page_set' ) == $sub_front_page['value'] ) ? 'selected-option' : '';
?>
					<div id="<?php echo $sub_front_page['value'] ?>" class="sub-layout front-page-extend">
						<?php do_action( "t_em_admin_action_from_page_option_{$sub_front_page['value']}_before" ); ?>
						<?php echo $sub_front_page['callback']; ?>
						<?php do_action( "t_em_admin_action_from_page_option_{$sub_front_page['value']}_after" ); ?>
					</div>
<?php
					endif;
				endforeach;
			endif; ?>
		<?php do_action( 't_em_admin_action_from_page_options_after' ); ?>
	</div><!-- #front-page-options -->
<?php
}

/**
 * Load custom template for Custom Front Page (Text Widgets) option in admin panel
 *
 * @since Twenty'em 1.0
 */
function t_em_load_custom_front_page( $home_template = '' ){
	if ( 'wp-front-page' != t_em( 'front_page_set' ) ) :
		$home_template = locate_template( 'custom-front-page.php' );
	endif;
	return $home_template;
}
add_action( 'home_template', 't_em_load_custom_front_page' );
?>
