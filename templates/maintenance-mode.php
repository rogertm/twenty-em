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


if ( ! function_exists( 't_em_maintenance_mode_area' ) ) :
/**
 * Pluggable Function: Display the Maintenance Mode Front Page Area if Maintenance Mode is active
 * in the admin panel
 *
 * This function is directly call from maintenance-mode.php template
 *
 * @global $t_em
 *
 * @return string HTML
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_area(){
	global $t_em;
?>
	<section id="maintenance-mode">
	<?php t_em_action_maintenance_mode_inside_before(); ?>
	<?php if ( $t_em['maintenance_mode_thumbnail_src'] ) : ?>
		<img src="<?php echo $t_em['maintenance_mode_thumbnail_src'] ?>" alt="<?php echo sanitize_text_field( $t_em['maintenance_mode_headline'] ) ?>">
	<?php endif; ?>
	<?php if ( $t_em['maintenance_mode_headline'] ) :
				$icon_class	= ( $t_em['maintenance_mode_headline_icon_class'] ) ?
					'<span class="'. $t_em['maintenance_mode_headline_icon_class'] .' icomoon"></span>' : '';
	?>
		<header><h1><?php echo $icon_class . $t_em['maintenance_mode_headline'] ?></h1></header>
	<?php endif; ?>
	<?php if ( $t_em['maintenance_mode_content'] ) : ?>
		<div><?php echo t_em_wrap_paragraph( do_shortcode( $t_em['maintenance_mode_content'] ) ) ?></div>
	<?php endif; ?>
	<?php t_em_maintenance_mode_countdown_timer() ?>
	<?php
		$primary_link_text			= ( $t_em['maintenance_mode_primary_button_text'] ) ? $t_em['maintenance_mode_primary_button_text'] : null;
		$primary_link_icon_class	= ( $t_em['maintenance_mode_primary_button_icon_class'] ) ? $t_em['maintenance_mode_primary_button_icon_class'] : null;
		$primary_button_link 		= ( $t_em['maintenance_mode_primary_button_link'] ) ? $t_em['maintenance_mode_primary_button_link'] : null;
		$secondary_link_text		= ( $t_em['maintenance_mode_secondary_button_text'] ) ? $t_em['maintenance_mode_secondary_button_text'] : null;
		$secondary_link_icon_class	= ( $t_em['maintenance_mode_secondary_button_icon_class'] ) ? $t_em['maintenance_mode_secondary_button_icon_class'] : null;
		$secondary_button_link 		= ( $t_em['maintenance_mode_secondary_button_link'] ) ? $t_em['maintenance_mode_secondary_button_link'] : null;

		if ( ( $primary_button_link && $primary_link_text ) || ( $secondary_button_link && $secondary_link_text ) ) :
				$primary_button_link_url = ( $primary_button_link && $primary_link_text ) ?
					'<a href="'. $primary_button_link .'" class="btn primary-button">
					<span class="'.$primary_link_icon_class.' icomoon"></span> <span class="button-text">'. $primary_link_text .'</span></a>' : null;

				$secondary_button_link_url = ( $secondary_button_link && $secondary_link_text ) ?
					'<a href="'. $secondary_button_link .'" class="btn secondary-button">
					<span class="'.$secondary_link_icon_class.' icomoon"></span> <span class="button-text">'. $secondary_link_text .'</span></a>' : null;

			$footer = '<footer>'. $primary_button_link_url . ' ' . $secondary_button_link_url .'</footer>';
		else :
			$footer = null;
		endif;
		echo $footer;
	?>
	<?php t_em_action_maintenance_mode_inside_after(); ?>
	</section>
<?php
}
endif; // function t_em_maintenance_mode_area()

if ( ! function_exists( 't_em_maintenance_mode_countdown_timer' ) ) :
/**
 * Pluggable Function: Display countdown timer if it's set in the Maintenance Mode options in the admin panel
 *
 * @global $t_em
 *
 * @return string HTML
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_countdown_timer(){
	global $t_em;
	if ( $t_em['maintenance_mode_timer'] ) :
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function($){
			$('#countdown-clock').countdown('<?php echo $t_em['maintenance_mode_timer'] ?>', function(event) {
				var $this = $(this).html(event.strftime(''
				+ '<span class="countdown-item">%w <small><?php _e( 'weeks', 't_em' ) ?></small> </span>'
				+ '<span class="countdown-item">%d <small><?php _e( 'days', 't_em' ) ?></small> </span>'
				+ '<span class="countdown-item">%H <small><?php _e( 'hr', 't_em' ) ?></small> </span>'
				+ '<span class="countdown-item">%M <small><?php _e( 'min', 't_em' ) ?></small> </span>'
				+ '<span class="countdown-item">%S <small><?php _e( 'sec', 't_em' ) ?></small></span>'));
			});
		});
		/* ]]> */
		</script>
		<div id="countdown-clock"></div>
<?php
	endif;
}
endif;
?>