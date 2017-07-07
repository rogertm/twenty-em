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
 * @since 			Twenty'em 1.1
 */

/**
 * Maintenance Mode Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php t_em_action_maintenance_mode_top(); ?>
<div id="wrap" class="hfeed">
	<?php t_em_action_maintenance_mode_header_before(); ?>

	<?php t_em_action_maintenance_mode_header_after(); ?>

	<div id="main">
		<?php t_em_action_maintenance_mode_main_before(); ?>
		<div id="inner-main" class="wrapper container">

