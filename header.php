<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty'em
 * @since Twenty'em 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php t_em_action_top(); ?>
<div id="wrap" class="hfeed">
	<?php t_em_action_header_before(); ?>
	<header id="header">
		<section id="masthead">
			<div id="branding" role="banner" class="wrapper container">
				<?php t_em_action_header_inside_before() ?>
				<div class="branding-inner row">
					<div class="col-md-6">
						<?php t_em_action_header_inside_left(); ?>
					</div>
					<div class="col-md-6">
						<?php t_em_action_header_inside_right(); ?>
					</div>
				</div><!-- .branding-inner -->
				<?php t_em_action_header_inside_after(); ?>
			</div><!-- #branding .wrapper .container -->
		</section><!-- #masthead -->
	</header><!-- #header -->

	<?php t_em_action_header_after(); ?>

	<div id="main">
		<?php t_em_action_main_before(); ?>
		<div id="inner-main" class="wrapper container">

