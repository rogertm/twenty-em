<?php
/**
 * Twenty'em Archive theme options.
 *
 * @file			archive-options.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/archive-options.php
 * @link			N/A
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Return an array of Archive Options for Twenty'em admin panel.
 * This function manage what and how is displayed in our theme archive. Possibles options are:
 * 0. Display the whole posts content (the-content).
 * 1. Display the posts excerpt (the-excerpt), here we call t_em_excerpt_callback() function which
 * display several sub-options.
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_archive_options( $archive_options = '' ){
	$archive_options = array(
		'the-content' => array(
			'value' => 'the-content',
			'label' => __( 'Display the content', 't_em' ),
			'callback' => apply_filters( 't_em_admin_filter_archive_options_the_content', true ) ? __( '<p>The whole content of each post</p>', 't_em' ) : null,
		),
		'the-excerpt' => array(
			'value' => 'the-excerpt',
			'label' => __( 'Display the excerpt', 't_em' ),
			'callback' => apply_filters( 't_em_admin_filter_archive_options_the_excerpt', true ) ? t_em_excerpt_callback() : null,
		),
	);

	return apply_filters( 't_em_admin_filter_archive_options', $archive_options );
}

/**
 * Returns an array of our archive excerpt options.
 */
function t_em_excerpt_options( $excerpt_options = '' ){
	$excerpt_options = array(
		'thumbnail-left' => array(
			'value' => 'thumbnail-left',
			'label' => __( 'Thumbnail on left', 't_em' ),
			'thumbnail' => T_EM_ENGINE_DIR_IMG_URL . '/thumbnail-left.png',
		),
		'thumbnail-right' => array(
			'value' => 'thumbnail-right',
			'label' => __( 'Thumbnail on right', 't_em' ),
			'thumbnail' => T_EM_ENGINE_DIR_IMG_URL . '/thumbnail-right.png',
		),
		'thumbnail-center' => array(
			'value' => 'thumbnail-center',
			'label' => __( 'Thumbnail on center', 't_em' ),
			'thumbnail' => T_EM_ENGINE_DIR_IMG_URL . '/thumbnail-center.png',
		),
	);

	return apply_filters( 't_em_admin_filter_excerpt_options', $excerpt_options );
}

/**
 * Returns an array of our archive columns options.
 */
function t_em_archive_in_columns( $archive_in_columns = '' ){
	global $t_em;
	$archive_in_columns = array(
		'1'	=> array(
			'value'	=> 1,
			'label'	=> __( 'One column', 't_em' ),
		),
		'2'	=> array(
			'value'	=> 2,
			'label'	=> __( 'Two columns', 't_em' ),
		),
		'3'	=> array(
			'value'	=> 3,
			'label'	=> __( 'Three columns', 't_em' ),
		),
	);

	return apply_filters( 't_em_admin_filter_archive_in_columns', $archive_in_columns );
}

/**
 * Render Width and Height text boxes for thumbnails in forms
 *
 * @param string $contex Require In which form ($contex) you want to use this function.
 * Example: You have a new slider plugin, and you want set Width and Height for yours thumbnail in
 * slideshow. So, you may call this function like this: $thumb = t_em_thumbnail_sizes( 'slideshow' );
 * See t_em_excerpt_callback() in /inc/archive-options.php file
 *
 * @return array
 *
 * @since Twenty'em 0.1
 */
function t_em_thumbnail_sizes( $contex ){
	$thumbnail_sizes = array(
		'excerpt_thumbnail_width' => array(
			'value' => '',
			'name' => $contex . '_thumbnail_width',
			'label' => __( 'Width', 't_em' ),
		),
		'excerpt_thumbnail_height' => array(
			'value' => '',
			'name' => $contex . '_thumbnail_height',
			'label' => __( 'Height', 't_em' ),
		),
	);

	return $thumbnail_sizes;
}

/**
 * Extend setting for Archive Option in Twenty'em admin panel.
 * Referenced via t_em_archive_options() in /inc/archive-options.php.
 *
 * @global $t_em.
 *
 * @since Twenty'em 0.1
 */
function t_em_excerpt_callback(){
	global $t_em;

	$extend_excerpt = '';
	$extend_excerpt .= '<div class="sub-extend option-group">';
	$extend_excerpt .= 		'<header>'. __( 'Excerpt Length' ) .'</header>';
	$extend_excerpt .= 		'<div class="layout text-option excerpt-length">';
	$extend_excerpt .=				'<label>';
	$extend_excerpt .=					'<p>'. sprintf( __( 'The amount of words displayed in the excerpt. If empty, the default value will be <code>%1$s</code> words.', 't_em' ), '55' ) .'</p>';
	$extend_excerpt .=					'<input type="number" name="t_em_theme_options[excerpt_length]" value="'.$t_em['excerpt_length'].'" />';
	$extend_excerpt .=				'</label>';
	$extend_excerpt .= 		'</div>';
	$extend_excerpt .= '</div>';

	$extend_excerpt .= '<div class="sub-extend option-group">';
	$extend_excerpt .= 		'<header>'. __( 'Thumbnail Alignment', 't_em' ) .'</header>';
	$extend_excerpt .= 		'<div class="image-radio-option-group">';
	foreach ( t_em_excerpt_options() as $excerpt ) :
		$active_option = ( $t_em['excerpt_set'] == $excerpt['value'] ) ? 'radio-image radio-image-active' : 'radio-image';
		$extend_excerpt .=	'<div class="layout image-radio-option theme-excerpt '. $active_option .'">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input class="input-image-radio-option" type="radio" name="t_em_theme_options[excerpt_set]" value="'.esc_attr( $excerpt['value'] ).'" '. checked( $t_em['excerpt_set'], $excerpt['value'], false ) .' />';
		$extend_excerpt .=			'<span><img src="'.esc_url( $excerpt['thumbnail'] ).'" alt="" /><p>'.$excerpt['label'].'</p></span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= 		'</div>';
	$extend_excerpt .= '</div>';

	$extend_excerpt .= '<div class="sub-extend option-group">';
	$thumb = t_em_thumbnail_sizes( 'excerpt' );
	$extend_excerpt .= 		'<header>'. __( 'Thumbnail Dimensions', 't_em' ) .'</header>';
	$extend_excerpt .= 		'<p>'. sprintf( __( 'Set thumbnail <strong>width</strong> and <strong>height</strong> in pixels. If empty, will be used the default thumbnail sizes (<code>%2$s</code> x <code>%3$s</code>) set at your <a href="%1$s" target="_blank">Media Settings</a> options.', 't_em' ),
		admin_url( 'options-media.php' ),
		get_option( 'thumbnail_size_w' ),
		get_option( 'thumbnail_size_h' ) ) .'</p>';
	foreach ( $thumb as $thumbnail ) :
		$extend_excerpt .= 		'<div class="layout text-option thumbnail option-single">';
		$extend_excerpt .=			'<label><span>'. $thumbnail['label'] .'</span>';
		$extend_excerpt .=				'<input type="number" name="t_em_theme_options['.$thumbnail['name'].']" value="'.esc_attr( $t_em[$thumbnail['name']] ).'" /><span class="unit">px</span>';
		$extend_excerpt .=			'</label>';
		$extend_excerpt .=		'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	$extend_excerpt .= '<div class="sub-extend layout text-radio-option-group option-group">';
	$extend_excerpt .= 		'<header>'. __( 'Columns', 't_em' ) .'</header>';
	$extend_excerpt .=		'<p>'. __( 'Break Loop in columns (It may affect the thumbnail size)', 't_em' ) .'</p>';
	foreach ( t_em_archive_in_columns() as $columns ) :
		$checked_option = checked( $t_em['archive_in_columns'], $columns['value'], false );
		$extend_excerpt .=	'<div class="layout text-radio-option-group archive-in-columns option-single">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[archive_in_columns]" value="'. esc_attr( $columns['value'] ) .'" '. $checked_option .'>';
		$extend_excerpt .=			'<span>'. $columns['label'] .'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	return $extend_excerpt;
}

/**
 * Archive Pagination Options
 */
function t_em_archive_pagination_options( $archive_pagination = '' ){
	$archive_pagination = array(
		'prev-next'	=> array(
			'value'	=> 'prev-next',
			'label'	=> __( 'Display <code>Newer</code> and <code>Older</code> posts links', 't_em' ),
		),
		'page-navi'	=> array(
			'value'	=> 'page-navi',
			'label'	=> __( 'Display a paginated list of links <code>&laquo; Newer 1 &hellip; 3 4 5 6 7 &hellip; 9 Older &raquo;</code>', 't_em' ),
		),
	);

	return apply_filters( 't_em_admin_filter_archive_pagination_options', $archive_pagination );
}

/**
 * Extend setting for Archive Pagination Option in Twenty'em admin panel.
 * Referenced via t_em_archive_options() in /inc/archive-options.php.
 *
 * @global $t_em.
 * @global $archive_pagination Returns a string value for pagination.
 *
 * @since Twenty'em 1.0
 */
function t_em_settings_archive_pagination(){
	global $t_em;

	$extend_excerpt = '';
	$extend_excerpt .= '<div class="sub-extend layout text-radio-option-group option-group">';
	$extend_excerpt .=	'<header>'. __( 'Archive Pagination', 't_em' ) .'</header>';
	foreach ( t_em_archive_pagination_options() as $pagination ) :
		$checked_option = checked( $t_em['archive_pagination_set'], $pagination['value'], false );
		$extend_excerpt .=	'<div class="layout text-radio-option-group archive-pagination option-single">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[archive_pagination_set]" value="'. esc_attr( $pagination['value'] ) .'" '. $checked_option .'>';
		$extend_excerpt .=			'<span>'. $pagination['label'] .'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	echo $extend_excerpt;
}
add_action( 't_em_admin_action_archive_options_after', 't_em_settings_archive_pagination' );

/**
 * Render the Archive setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_archive_set(){
	global $t_em;

	// Check for a new default value if any option is set to false
	$archive_value = array();
	foreach ( t_em_archive_options() as $archive ) :
		if ( $archive['callback'] ) :
			array_push( $archive_value, $archive['value'] );
		endif;
	endforeach;
	$default_checked = ( count( $archive_value ) > 0 && ! in_array( $t_em['archive_set'], $archive_value ) ) ? $archive_value[0] : null;
?>
	<div id="archive-options" class="tabs">
		<?php do_action( 't_em_admin_action_archive_options_before' ); ?>
		<?php if ( count( $archive_value ) == 0 ) : ?>
				<p class="alert alert-critical"><?php _e( '<strong>Oops!</strong> No options available for this setting...', 't_em' ); ?></p>
		<?php else : ?>
					<ul>
<?php
				foreach ( t_em_archive_options() as $archive ) :
					if ( $archive['callback'] ) :
						$active_option = ( $t_em['archive_set'] == $archive['value'] ) ? 'ui-tabs-active' : '';
						$checked = ( $default_checked == $archive['value'] )
										? $checked = 'checked="checked"'
										: checked( $t_em['archive_set'], $archive['value'], false );
?>
					<li class="<?php echo $active_option ?>">
						<a href="#<?php echo $archive['value'] ?>" class="tab-heading">
							<input type="radio" class="head-radio-option" name="t_em_theme_options[archive_set]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php echo $checked; ?> />
							<?php echo $archive['label']; ?>
						</a>
					</li>
<?php
					endif;
				endforeach;
?>
					</ul>
<?php
				/* If our 'callback' key brings something, then we display our callback function.
				 * Let's go for the_excerpt().
				 */
				foreach ( t_em_archive_options() as $sub_archive ) :
					if ( $sub_archive['callback'] != '' ) :
					$selected_option = ( $t_em['archive_set'] == $sub_archive['value'] ) ? 'selected-option' : '';
?>
					<div id="<?php echo $sub_archive['value'] ?>" class="sub-layout archive-extend <?php echo $selected_option; ?>">
						<?php do_action( 't_em_admin_action_archive_option_'.$sub_archive['value'].'_before' ); ?>
						<?php echo $sub_archive['callback']; ?>
						<?php do_action( 't_em_admin_action_archive_option_'.$sub_archive['value'].'_after' ); ?>
					</div>
<?php
					endif;
				endforeach;
			endif; ?>
		<?php do_action( 't_em_admin_action_archive_options_after' ); ?>
	</div><!-- #archive-options -->
<?php
}
?>