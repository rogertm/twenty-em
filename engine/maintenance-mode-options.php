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
 * @since 			Twenty'em 1.0.1
 */

/**
 * Twenty'em Maintenance Mode options.
 */

/**
 * Render the Maintenance Mode Options setting field in admin panel.
 * Referenced via t_em_register_setting_options_init(), add_settings_field() callback in
 * /engine/theme-options.php.
 *
 * @global $t_em.
 *
 * @since Twenty'em 1.0.1
 */
function t_em_settings_field_maintenance_mode_set(){
	global $t_em;
?>
	<div id="maintenance-mode-options">
		<?php do_action( 't_em_admin_action_maintenance_mode_options_before' ); ?>
		<div class="sub-extend option-group text-option">
			<p class="alert alert-info"><?php _e( 'Activating the "<strong>Maintenance Mode</strong>" only users width role "Administrator" will can interact with your site. Otherwise you can active others group of users in the <strong>Users and Roles</strong> section.', 't_em' ); ?></p>
			<header><?php _e( 'Options', 't_em' ) ?></header>
			<p>
				<label class="description single-option">
					<?php $checked_option = checked( $t_em['maintenance_mode'], '1', false ); ?>
					<input type="checkbox" name="t_em_theme_options[maintenance_mode]" value="1" <?php echo $checked_option ?>>
					<?php _e( 'Active the Maintenance Mode', 't_em' ) ?>
				</label>
			</p>
		</div>
		<div class="sub-extend option-group text-option">
			<header><?php _e( 'Timer', 't_em' ) ?></header>
			<?php
				$year = date( 'Y' );
				$month = date( 'm' );
				$day = date( 'd' );
				$date = $year + 1 .'-'. $month .'-'. $day;
			?>
			<p><label><span><?php printf( __( 'Enter the date your site will be available again. Format: <code>YYYY-MM-DD</code>. Example: <code>%s</code>', 't_em' ), $date ) ?></span>
				<input id="datepicker" type="date" class="regular-text" name="t_em_theme_options[maintenance_mode_timer]" value="<?php echo $t_em['maintenance_mode_timer'] ?>" autocomplete="off" />
			</label></p>
			<p>
				<label class="description single-option">
					<?php $checked_option = checked( $t_em['maintenance_mode_reactive'], '1', false ); ?>
					<input type="checkbox" name="t_em_theme_options[maintenance_mode_reactive]" value="1" <?php echo $checked_option ?>>
					<?php _e( 'Reactive automatically after the timer end date', 't_em' ) ?>
				</label>
			</p>
		</div>
		<div class="sub-extend option-group text-option">
			<header><?php _e( 'Users and Roles', 't_em' ) ?></header>
			<p><?php _e( 'Select which role of users will interact with your site', 't_em' ); ?></p>
			<p>
			<?php
			$roles = t_em_maintenance_mode_roles();
			foreach ( $roles as $role => $name ) :
			?>
				<label class="description single-option">
					<?php $checked_role = checked( $t_em[$role], '1', false ); ?>
					<?php $disabled = ( $role == 'maintenance_mode_role_administrator' ) ? 'disabled' : null; ?>
					<input type="checkbox" name="t_em_theme_options[<?php echo $role ?>]" value="1" <?php echo $checked_role ?> <?php echo $disabled ?>>
					<?php echo $name ?>
				</label>
			<?php
			endforeach;
			?>
			</p>
		</div>
		<div class="sub-extend option-group text-option">
			<header><?php _e( 'Headline, Content and More...', 't_em' ) ?></header>
			<p><label>
				<span><?php _e( 'Headline', 't_em' ) ?></span>
				<input class="regular-text headline" type="text" name="t_em_theme_options[maintenance_mode_headline]" value="<?php echo esc_textarea( $t_em['maintenance_mode_headline'] ) ?>">
			</label></p>

			<p><label>
				<span><?php printf( __( 'Headline <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_headline_icon_class]" value="<?php echo $t_em['maintenance_mode_headline_icon_class'] ?>" >
			</label></p>

			<p><label>
				<span><?php _e( 'Content', 't_em' ) ?></span>
				<textarea class="large-text" name="t_em_theme_options[maintenance_mode_content]" cols="50" rows="5"><?php echo $t_em['maintenance_mode_content'] ?></textarea>
			</label></p>

			<p><label>
				<span><?php printf( __( '<a href="%1$s" target="_blank">Thumbnail URL</a>', 't_em' ), admin_url( 'upload.php' ) ) ?></span>
				<input id="t-em-maintenance-mode-image-url" type="url" class="regular-text media-url" name="t_em_theme_options[maintenance_mode_thumbnail_src]" value="<?php echo $t_em['maintenance_mode_thumbnail_src'] ?>">
				<a href="#" id="t-em-button-maintenance-mode-image" class="button media-selector"><?php _e( 'Upload Image', 't_em' ) ?></a>
			</label></p>

			<p><label><span><?php _e( 'Primary button text', 't_em' ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_primary_button_text]" value="<?php echo $t_em['maintenance_mode_primary_button_text'] ?>" />
			</label></p>

			<p><label><span><?php printf( __( 'Primary button <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_primary_button_icon_class]" value="<?php echo $t_em['maintenance_mode_primary_button_icon_class'] ?>" />
			</label></p>

			<p><label><span><?php _e( 'Primary button link', 't_em' ) ?></span>
				<input type="url" class="regular-text" name="t_em_theme_options[maintenance_mode_primary_button_link]" value="<?php echo $t_em['maintenance_mode_primary_button_link'] ?>" />
			</label></p>

			<p><label><span><?php _e( 'Secondary button text', 't_em' ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_secondary_button_text]" value="<?php echo $t_em['maintenance_mode_secondary_button_text'] ?>" />
			</label></p>

			<p><label><span><?php printf( __( 'Secondary button <a href="%1$s" target="_blank">Icon Class</a>', 't_em' ), T_EM_ICON_PACK ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_secondary_button_icon_class]" value="<?php echo $t_em['maintenance_mode_secondary_button_icon_class'] ?>" />
			</label></p>

			<p><label><span><?php _e( 'Secondary button link', 't_em' ) ?></span>
				<input type="url" class="regular-text" name="t_em_theme_options[maintenance_mode_secondary_button_link]" value="<?php echo $t_em['maintenance_mode_secondary_button_link'] ?>" />
			</label></p>
		</div>
		<div class="sub-extend option-group text-option">
			<header><?php _e( 'Title tag', 't_em' ) ?></header>
			<?php
				$default_options = t_em_default_theme_options();
				$title_tag = $default_options['maintenance_mode_title_tag'];
				$the_title_tag = ( ! empty( $t_em['maintenance_mode_title_tag'] ) ? $t_em['maintenance_mode_title_tag'] : $title_tag );
			?>
			<p><label><span><?php printf( __( 'Enter the text for the <code>&lt;title&gt;... &lt;/title&gt;</code> tag. Default: <strong>%s</strong>', 't_em' ), $title_tag ) ?></span>
				<input type="text" class="regular-text" name="t_em_theme_options[maintenance_mode_title_tag]" value="<?php echo $the_title_tag ?>" />
			</label></p>
		</div>
		<?php do_action( 't_em_admin_action_maintenance_mode_options_after' ); ?>
	</div><!-- #maintenance-mode-options -->
<?php
}

/**
 * User roles for the Maintenance Mode
 *
 * @return array Array containing a key (maintenance_mode_role_{$role}) for each user role
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_roles(){
	if ( ! function_exists( 'get_editable_roles' ) ) require_once( ABSPATH . 'wp-admin/includes/user.php' );
	$editable_roles = get_editable_roles();
	$roles = array();
	foreach ( $editable_roles as $key => $value ) :
		$role = array( "maintenance_mode_role_{$key}" => translate_user_role( $value['name'] ) );
		$roles = array_merge( $roles, $role );
	endforeach;
	return $roles;
}

/**
 * Active roles for Maintenance Mode
 *
 * @return array Array of actives roles for Maintenance Mode
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_role_active(){
	global $t_em;
	$roles = t_em_maintenance_mode_roles();
	$role_active = array();
	foreach ( $roles as $key => $value ) :
		if ( $t_em[$key] == 1 ) :
			$role = str_replace( 'maintenance_mode_role_', '', $key );
			$role_active = array_merge( $role_active, array( $role ) );
		endif;
	endforeach;
	return $role_active;
}

/**
 * Load the Maintenance Mode template file before any other template file
 *
 * @global $t_em
 *
 * @since Twenty'em 1.0.1
 */
function t_em_load_maintenance_mode_template( $template = '' ){
	global $t_em;
	// Check if the current user can see the site
	$current_user = wp_get_current_user();
	$user_can = array_intersect( t_em_maintenance_mode_role_active(), $current_user->roles );

	$nonce = ( isset( $_GET['maintenance-mode'] ) ) ? $_GET['maintenance-mode'] : null;
	if ( $t_em['maintenance_mode'] == 1 && (
				! is_user_logged_in() ||
				empty( $user_can ) ||
				( isset( $_GET['maintenance-mode'] ) && wp_verify_nonce( $nonce, 'maintenance_mode' ) )
			) ) :
		$template = locate_template( 'maintenance-mode.php' );
	endif;
	return $template;
}
add_action( 'index_template', 't_em_load_maintenance_mode_template' );
add_action( '404_template', 't_em_load_maintenance_mode_template' );
add_action( 'archive_template', 't_em_load_maintenance_mode_template' );
add_action( 'author_template', 't_em_load_maintenance_mode_template' );
add_action( 'category_template', 't_em_load_maintenance_mode_template' );
add_action( 'tag_template', 't_em_load_maintenance_mode_template' );
add_action( 'taxonomy_template', 't_em_load_maintenance_mode_template' );
add_action( 'date_template', 't_em_load_maintenance_mode_template' );
add_action( 'home_template', 't_em_load_maintenance_mode_template' );
add_action( 'front_page_template', 't_em_load_maintenance_mode_template' ); /** $#@*8! */
add_action( 'frontpage_template', 't_em_load_maintenance_mode_template' );
add_action( 'page_template', 't_em_load_maintenance_mode_template' );
add_action( 'paged_template', 't_em_load_maintenance_mode_template' );
add_action( 'search_template', 't_em_load_maintenance_mode_template' );
add_action( 'single_template', 't_em_load_maintenance_mode_template' );
add_action( 'text_template', 't_em_load_maintenance_mode_template' );
add_action( 'plain_template', 't_em_load_maintenance_mode_template' );
add_action( 'text_plain_template', 't_em_load_maintenance_mode_template' );
add_action( 'attachment_template', 't_em_load_maintenance_mode_template' );
add_action( 'comments_popup', 't_em_load_maintenance_mode_template' );

/**
 * Filter the title tag in Maintenance Mode
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_title_tag( $title ){
	global $t_em;
	// Check if the current user can see the site
	$current_user = wp_get_current_user();
	$user_can = array_intersect( t_em_maintenance_mode_role_active(), $current_user->roles );

	$sep = apply_filters( 'document_title_separator', '-' );
	$nonce = ( isset( $_GET['maintenance-mode'] ) ) ? $_GET['maintenance-mode'] : null;
	if ( $t_em['maintenance_mode'] == 1 && (
				! is_user_logged_in() ||
				empty( $user_can ) ||
				( isset( $_GET['maintenance-mode'] ) && wp_verify_nonce( $nonce, 'maintenance_mode' ) )
			) ) :
		$title = $t_em['maintenance_mode_title_tag'] . " $sep " . get_bloginfo( 'name' );
	endif;
	return $title;
}
add_filter( 'pre_get_document_title', 't_em_maintenance_mode_title_tag' );

/**
 * Add dynamically maintenance mode user roles to t_em_default_theme_options()
 *
 * @return array
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_default_roles( $default_theme_options ){
	$user_roles = t_em_maintenance_mode_roles();
	$roles = array();
	foreach ( $user_roles as $key => $value ) :
		$role = ( $key == 'maintenance_mode_role_administrator' ) ? array( $key => '1' ) :  array( $key => '' );
		$roles = array_merge( $roles, $role );
	endforeach;
	$default_options = array_merge( $default_theme_options, $roles );
	return $default_options;
}
add_filter( 't_em_admin_filter_default_theme_options', 't_em_maintenance_mode_default_roles' );

/**
 * Sanitize and validate dynamically the maintenance mode roles input.
 * This function is attached to the "t_em_admin_filter_theme_options_validate" filter hook
 *
 * @since Twenty'em 1.0.1
 */
function t_em_maintenance_mode_options_validate( $input ){
	if ( $input != null ) :
		global $t_em;
		// All the checkbox are either 0 or 1
		$user_roles = t_em_maintenance_mode_roles();
		foreach ( $user_roles as $key => $value ) :
			$input[$key] = ( $input[$key] == 1 ? 1 : 0 );
		endforeach;
		// Role administrator always will be 1
		if ( ! isset( $input['maintenance_mode_role_administrator'] ) )
			$input['maintenance_mode_role_administrator'] = null;
		$input['maintenance_mode_role_administrator'] = ( $input['maintenance_mode_role_administrator'] == 1 ? 1 : 1 );
		return $input;
	endif;
}
add_filter( 't_em_admin_filter_theme_options_validate', 't_em_maintenance_mode_options_validate' );
?>
