<?php
/**
 * Display Twenty'em.com link at bottom of the page
 */
global $t_em_theme_options;

if ( '1' == $t_em_theme_options['t-em-link'] ) :
	global $t_em_theme_data;
?>
	<div id="twenty-em-credit">
		<?php _e( 'Proudly powered by: ', 't_em' ); ?>
		<a href="<?php esc_url( _e('http://wordpress.org/', 't_em') ); ?>"
			title="<?php esc_attr_e('Semantic Personal Publishing Platform', 't_em'); ?>" rel="generator">
			<?php _e('WordPress', 't_em'); ?></a>
		<?php _e( 'and', 't_em' ); ?>
		<a href="<?php esc_url( _e( 'http://twenty-em.com/', 't_em' ) ) ?>"
			title="<?php esc_attr_e( 'Theming is Prose', 't_em' ); ?>">
			<?php esc_attr_e( __( 'Twenty&#8217;em', 't_em' ) ) ?></a>.
		<?php _e( 'Theme name: ', 't_em' ); ?><a href="<?php echo $t_em_theme_data['ThemeURI']; ?>" title="<?php printf( __( 'Version: %s', 't_em' ), $t_em_theme_data['Version'] ); ?>"><?php echo $t_em_theme_data['Name']; ?></a>
		<?php _e( 'by: ', 't_em' ); ?><?php echo $t_em_theme_data['Author']; ?>
	</div>
<?php
endif;
?>
