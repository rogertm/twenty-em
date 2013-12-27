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
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<?php t_em_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php t_em_top(); ?>
<div id="wrap" class="hfeed">
	<?php t_em_header_before(); ?>
	<header id="header">
		<section id="masthead">
			<div id="branding" role="banner" class="container-fluid">
				<?php t_em_header_inside_before() ?>
				<div class="wrapper row-fluid">
					<?php t_em_header_inside(); ?>
				</div><!-- .row-fluid -->
				<?php t_em_header_inside_after(); ?>
			</div><!-- #branding .container-fluid -->
		</section><!-- #masthead -->
	</header><!-- #header -->

	<?php t_em_header_after(); ?>

	<div id="main" class="container-fluid">
		<?php t_em_main_before(); ?>
		<div id="inner-main" class="wrapper row-fluid">

