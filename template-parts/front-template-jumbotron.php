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
 * @since 			Twenty'em 1.2
 */

/**
 * Display Jumbotron template for Front Page text widgets
 */

global $t_em;
foreach ( t_em_front_page_widgets_options() as $widget ) :
	if ( ! empty( $t_em['headline_'.$widget['name'].''] ) || ! empty( $t_em['content_'.$widget['name'].''] ) ) :
	$widget_icon_class	= ( $t_em['headline_icon_class_'.$widget['name'].''] ) ?
		'<span class="'. $t_em['headline_icon_class_'.$widget['name'].''] .' icomoon"></span>' : '';

	$widget_thumbnail_url	= ( $t_em['thumbnail_src_'.$widget['name'].''] ) ?
		'<img src="'. $t_em['thumbnail_src_'.$widget['name'].''] .'" alt="'. sanitize_text_field( $t_em['headline_'.$widget['name']] ).'" />' : '';

	$h_tag = ( $widget['name'] == 'text_widget_one' ) ? 'h1' : 'h3';

	$widget_headline	= ( $t_em['headline_'.$widget['name'].''] ) ?
		'<header><'. $h_tag .'>'. $widget_icon_class . $t_em['headline_'.$widget['name'].''] .'</'. $h_tag .'></header>' : '';

	$widget_content		= ( $t_em['content_'.$widget['name'].''] ) ?
		'<div>'. t_em_wrap_paragraph( do_shortcode( $t_em['content_'.$widget['name'].''] ) ) .'</div>' : '';

	$primary_link_text			= ( $t_em['primary_button_text_'.$widget['name']] ) ? $t_em['primary_button_text_'.$widget['name']] : null;
	$primary_link_icon_class	= ( $t_em['primary_button_icon_class_'.$widget['name']] ) ? $t_em['primary_button_icon_class_'.$widget['name']] : null;
	$primary_button_link 		= ( $t_em['primary_button_link_'.$widget['name']] ) ? $t_em['primary_button_link_'.$widget['name']] : null;
	$secondary_link_text		= ( $t_em['secondary_button_text_'.$widget['name']] ) ? $t_em['secondary_button_text_'.$widget['name']] : null;
	$secondary_link_icon_class	= ( $t_em['secondary_button_icon_class_'.$widget['name']] ) ? $t_em['secondary_button_icon_class_'.$widget['name']] : null;
	$secondary_button_link 		= ( $t_em['secondary_button_link_'.$widget['name']] ) ? $t_em['secondary_button_link_'.$widget['name']] : null;

	if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
			$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
				'<a href="'. $primary_button_link .'" class="btn btn-primary">
				<span class="'.$primary_link_icon_class.' icomoon"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

			$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
				'<a href="'. $secondary_button_link .'" class="btn btn-secondary">
				<span class="'.$secondary_link_icon_class.' icomoon"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

		$widget_footer = '<footer>'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
	else :
		$widget_footer = null;
	endif;

	$section = ( $widget['name'] == 'text_widget_one' ) ? 'primary-featured-widget-area' : 'secondary-featured-widget-area';
	$jumbo = ( $widget['name'] == 'text_widget_one' ) ? 'jumbotron' : null;
?>
	<div <?php t_em_add_bootstrap_class( $section ); ?>>
		<div id="front-page-widget-<?php echo str_replace( 'text_widget_', '', $widget['name'] ) ?>" class="front-page-widget widgets-template-jumbotron <?php echo $jumbo ?>">
			<?php echo $widget_thumbnail_url; ?>
			<div class="front-page-widget-caption">
			<?php	echo $widget_headline;
					echo $widget_content;
					echo $widget_footer; ?>
			</div>
		</div>
	</div>
<?php
	endif;
endforeach;
?>
