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
function t_em_archive_options(){
	$archive_options = array (
		'the-content' => array (
			'value' => 'the-content',
			'label' => __( 'Display the content', 't_em' ),
			'extend' => '',
		),
		'the-excerpt' => array (
			'value' => 'the-excerpt',
			'label' => __( 'Display the excerpt', 't_em' ),
			'extend' => t_em_excerpt_callback(),
		),
	);

	return apply_filters( 't_em_archive_options', $archive_options );
}

/**
 * Extend setting for Archive Option in Twenty'em admin panel.
 * Referenced via t_em_archive_options() in /inc/archive-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 * @global $excerpt_options Returns an array of our archive excerpt options.
 *
 * @since Twenty'em 0.1
 */
function t_em_excerpt_callback(){
	global	$t_em_theme_options,
			$excerpt_options,
			$archive_in_columns,
			$archive_pagination;

	$excerpt_options = array (
		'thumbnail-left' => array(
			'value' => 'thumbnail-left',
			'label' => __( 'Thumbnail on left', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG_URL . '/thumbnail-left.png',
		),
		'thumbnail-right' => array(
			'value' => 'thumbnail-right',
			'label' => __( 'Thumbnail on right', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG_URL . '/thumbnail-right.png',
		),
		'thumbnail-center' => array(
			'value' => 'thumbnail-center',
			'label' => __( 'Thumbnail on center', 't_em' ),
			'thumbnail' => T_EM_INC_DIR_IMG_URL . '/thumbnail-center.png',
		),
	);

	$archive_in_columns = array (
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

	$archive_pagination = array (
		'prev-next'	=> array(
			'value'	=> 'prev-next',
			'label'	=> __( 'Previous - Next post link', 't_em' ),
		),
		'page-navi'	=> array(
			'value'	=> 'page-navi',
			'label'	=> __( 'Navigated link ( e.g.: « Prev 1 … 3 4 5 6 7 … 9 Next » )', 't_em' ),
		),
	);

	$extend_excerpt = '';
	$extend_excerpt .= '<div class="layout text-option excerpt-length">';
	$extend_excerpt .=		'<label>';
	$extend_excerpt .=			'<p>'. sprintf( __( 'The amount of words displayed in the excerpt. If empty, the default value will be <code>%1$s</code> words.', 't_em' ), '55' ) .'</p>';
	$extend_excerpt .=			'<input type="number" name="t_em_theme_options[excerpt_length]" value="'.$t_em_theme_options['excerpt_length'].'" />';
	$extend_excerpt .=		'</label>';
	$extend_excerpt .= '</div>';

	$extend_excerpt .= '<div class="image-radio-option-group">';
	foreach ( $excerpt_options as $excerpt ) :
		$checked_option = checked( $t_em_theme_options['excerpt_set'], $excerpt['value'], false );
		$extend_excerpt .=	'<div class="layout image-radio-option theme-excerpt">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[excerpt_set]" value="'.esc_attr( $excerpt['value'] ).'" '.$checked_option.' />';
		$extend_excerpt .=			'<span><img src="'.esc_url( $excerpt['thumbnail'] ).'" alt="" /><p>'.$excerpt['label'].'</p></span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div>';

	$extend_excerpt .= '<div class="sub-extend">';
	$thumb = t_em_thumbnail_sizes( 'excerpt' );
	$extend_excerpt .= '<p>'. sprintf( __( 'Set thumbnail <strong>width</strong> and <strong>height</strong> in pixels. If empty, will be used the default thumbnail sizes (<code>%2$s</code> x <code>%3$s</code>) set at your <a href="%1$s" target="_blank">Media Settings</a> options.', 't_em' ),
		admin_url( 'options-media.php' ),
		get_option( 'thumbnail_size_w' ),
		get_option( 'thumbnail_size_h' ) ) .'</p>';
	foreach ( $thumb as $thumbnail ) :
		$extend_excerpt .= 		'<div class="layout text-option thumbnail">';
		$extend_excerpt .=			'<label><span>'. $thumbnail['label'] .'</span>';
		$extend_excerpt .=				'<input type="number" name="t_em_theme_options['.$thumbnail['name'].']" value="'.esc_attr( $t_em_theme_options[$thumbnail['name']] ).'" /><span class="unit">px</span>';
		$extend_excerpt .=			'</label>';
		$extend_excerpt .=		'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	$extend_excerpt .= '<div class="sub-extend layout text-radio-option-group">';
	$extend_excerpt .=	'<p>'. __( 'Break Loop in columns (It may affect the thumbnail size)', 't_em' ) .'</p>';
	foreach ( $archive_in_columns as $columns ) :
		$checked_option = checked( $t_em_theme_options['archive_in_columns'], $columns['value'], false );
		$extend_excerpt .=	'<div class="layout text-radio-option-group archive-in-columns">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[archive_in_columns]" value="'. esc_attr( $columns['value'] ) .'" '. $checked_option .'>';
		$extend_excerpt .=			'<span>'. $columns['label'] .'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	$extend_excerpt .= '<div class="sub-extend layout text-radio-option-group">';
	$extend_excerpt .=	'<p>'. __( 'Archive Pagination', 't_em' ) .'</p>';
	foreach ( $archive_pagination as $pagination ) :
		$checked_option = checked( $t_em_theme_options['archive_pagination'], $pagination['value'], false );
		$extend_excerpt .=	'<div class="layout text-radio-option-group archive-in-columns">';
		$extend_excerpt .=		'<label class="description">';
		$extend_excerpt .=			'<input type="radio" name="t_em_theme_options[archive_pagination]" value="'. esc_attr( $pagination['value'] ) .'" '. $checked_option .'>';
		$extend_excerpt .=			'<span>'. $pagination['label'] .'</span>';
		$extend_excerpt .=		'</label>';
		$extend_excerpt .=	'</div>';
	endforeach;
	$extend_excerpt .= '</div><!-- .sub-extend -->';

	return $extend_excerpt;
}

/**
 * Render the Archive setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /inc/theme-options.php.
 *
 * @global $t_em_theme_options See t_em_set_globals() function in /inc/theme-options.php file.
 *
 * @since Twenty'em 0.1
 */
function t_em_settings_field_archive_set(){
	global $t_em_theme_options;
?>
	<div id="archive-options">
<?php
	foreach ( t_em_archive_options() as $archive ) :
?>
		<div class="layout radio-option archive">
			<label class="description">
				<input type="radio" class="head-radio-option" name="t_em_theme_options[archive_set]" value="<?php echo esc_attr( $archive['value'] ); ?>" <?php checked( $t_em_theme_options['archive_set'], $archive['value'] ); ?> />
				<span><?php echo $archive['label']; ?></span>
			</label>
		</div>
<?php
	endforeach;

	/* If our 'extend' key brings something, then we display our callback function.
	 * Let's go for the_excerpt().
	 */
	foreach ( t_em_archive_options() as $sub_archive ) :
		if ( $sub_archive['extend'] != '' ) :
		$selected_option = ( $t_em_theme_options['archive_set'] == $sub_archive['value'] ) ? 'selected-option' : '';
?>
		<div id="<?php echo $sub_archive['value'] ?>" class="sub-layout archive-extend <?php echo $selected_option; ?>">
			<?php echo $sub_archive['extend']; ?>
		</div>
<?php
		endif;
	endforeach;
?>
	</div><!-- #archive-options -->
<?php
}
?>
