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
 * Silents is gold... But we call the others
 */
require_once( get_template_directory() . '/engine/constants.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/theme-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/generals-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/header-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/front-page-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/archive-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/layout-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/social-network-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/webmaster-tools-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/maintenance-mode-options.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/theme-backup.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/actions.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/cron.php' );
require_once( T_EM_ENGINE_DIR_PATH . '/help.php' );
?>
