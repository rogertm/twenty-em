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
 * Display Featured template for Front Page text widgets
 */
foreach ( t_em_front_page_widgets_options() as $widget ) :
	if ( ! empty( t_em( 'headline_'.$widget['name'] ) ) || ! empty( t_em( 'content_'.$widget['name'] ) ) ) :
	$widget_icon_class	= ( t_em( 'headline_icon_class_'.$widget['name'] ) ) ?
		'<span class="'. t_em( 'headline_icon_class_'.$widget['name'] ) .'"></span> ' : null;

	$widget_thumbnail_url	= ( t_em( 'thumbnail_src_'.$widget['name'] ) ) ?
		'<div class="widget-thumbnail '. t_em_grid( '5' ) .'"><img src="'. t_em( 'thumbnail_src_'.$widget['name'] ) .'" alt="'. sanitize_text_field( t_em( 'headline_'.$widget['name'] ) ) .'"/></div>' : null;

	$widget_headline	= ( t_em( 'headline_'.$widget['name'] ) ) ?
		'<header><h2>'. $widget_icon_class . t_em( 'headline_'.$widget['name'] ) .'</h2></header>' : null;

	$widget_content		= ( t_em( 'content_'.$widget['name'] ) ) ?
		'<div class="front-page-widget-content">'. t_em_wrap_paragraph( do_shortcode( t_em( 'content_'.$widget['name'] ) ) ) .'</div>' : null;

	$primary_link_text			= ( t_em( 'primary_button_text_'.$widget['name'] ) ) ? t_em( 'primary_button_text_'.$widget['name'] ) : null;
	$primary_link_icon_class	= ( t_em( 'primary_button_icon_class_'.$widget['name'] ) ) ? t_em( 'primary_button_icon_class_'.$widget['name'] ) : null;
	$primary_button_link 		= ( t_em( 'primary_button_link_'.$widget['name'] ) ) ? t_em( 'primary_button_link_'.$widget['name'] ) : null;
	$secondary_link_text		= ( t_em( 'secondary_button_text_'.$widget['name'] ) ) ? t_em( 'secondary_button_text_'.$widget['name'] ) : null;
	$secondary_link_icon_class	= ( t_em( 'secondary_button_icon_class_'.$widget['name'] ) ) ? t_em( 'secondary_button_icon_class_'.$widget['name'] ) : null;
	$secondary_button_link 		= ( t_em( 'secondary_button_link_'.$widget['name'] ) ) ? t_em( 'secondary_button_link_'.$widget['name'] ) : null;

	if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
			$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
				'<a href="'. $primary_button_link .'" class="btn btn-primary primary-button">
				<span class="'.$primary_link_icon_class.'"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

			$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
				'<a href="'. $secondary_button_link .'" class="btn btn-secondary secondary-button">
				<span class="'.$secondary_link_icon_class.'"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

		$widget_footer = '<footer>'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
	else :
		$widget_footer = null;
	endif;
?>
	<div id="front-page-widget-<?php echo str_replace( 'text_widget_', '', $widget['name'] ) ?>" class="front-page-widget mb-5 px-3">
		<div class="row">
			<?php echo $widget_thumbnail_url; ?>
			<div class="front-page-widget-caption <?php echo t_em_grid( '7' ) ?>">
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
