<?php
/**
 * Maintenance Mode Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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

