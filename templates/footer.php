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


if ( ! function_exists( 't_em_copy_right' ) ) :
/**
 * Pluggable Function: Copy Right.
 * This function is attached to the t_em_action_site_info action hook.
 */
function t_em_copy_right(){
?>
	<div id="copyright" class="mb-3">
		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'description', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?>
		</a>
	</div><!-- #copyright -->
<?php
}
endif; // function t_em_copy_right()
add_action( 't_em_action_site_info_left', 't_em_copy_right' );

/**
 * Display WordPress.org and Twenty'em.com link at bottom of the page. This function is attached to
 * the t_em_action_site_info action hook.
 */
function t_em_credit(){
	$t_em_theme = t_em_theme();
	if ( '1' == t_em( 't_em_credit' ) ) :
?>
	<div id="twenty-em-credit" class="text-center">
<?php
	printf( __( 'Proudly powered by: <a href="%1$s" title="%2$s">%3$s</a> and <a href="%4$s" title="%5$s">%6$s</a>. Theme Name: <a href="%7$s" title="Version %8$s">%9$s</a> by: %10$s', 't_em' ),
		__( 'https://wordpress.org/' ),
		'State-of-the-art semantic personal publishing platform.',
		'WordPress',
		T_EM_SITE,
		'Theming is Prose',
		T_EM_FRAMEWORK_NAME,
		$t_em_theme['ThemeURI'],
		$t_em_theme['Version'],
		$t_em_theme['Name'],
		$t_em_theme['Author']
	);
?>
	</div>
<?php
	endif;
}
add_action( 't_em_action_site_info_bottom', 't_em_credit' );
?>
