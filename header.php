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
</head>

<body <?php body_class(); ?>>
<!--[if lte IE 8 ]>
<noscript class="alert alert-error lead"><strong><span class="icon-warning font-icon"></span><?php _e( 'JavaScript is required for this website to be displayed correctly. Please enable JavaScript before continuing...', 't_em' ); ?></strong></noscript>
<![endif]-->

<div id="wrap" class="hfeed">
	<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
	<?php /* The Top Menu, if it's active by the user we display it, else, we get nothing */ ?>
	<div id="top" class="wrapper container-fluid">
		<div class="row-fluid">
			<nav id="top-menu" role="navigation" class="span12">
				<?php wp_nav_menu( array ( 'container_class' => 'menu-top pull-right', 'theme_location' => 'top-menu', 'depth' => '0' ) ); ?>
			</nav>
		</div><!-- .row-fluid -->
	</div>
	<?php endif; ?>
	<header id="header">
		<section id="masthead">
			<div id="branding" role="banner" class="wrapper container-fluid">
				<div class="row-fluid">
					<hgroup class="span12">
						<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
						<<?php echo $heading_tag; ?> id="site-title">
						<span>
							<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</span>
						</<?php echo $heading_tag; ?>>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</hgroup>
				</div><!-- .row-fluid -->
			</div><!-- #branding .container-fluid -->

			<?php t_em_header_options_set(); ?>

		<?php if ( has_nav_menu( 'navigation-menu' ) ) : ?>
			<nav id="site-navigation" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Skip menu', 't_em' ); ?></h3>
				<?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link"><a class="assistive-text" href="#main" title="<?php esc_attr_e( 'Skip to primary content', 't_em' ); ?>"><?php _e( 'Skip to primary content', 't_em' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 't_em' ); ?>"><?php _e( 'Skip to secondary content', 't_em' ); ?></a></div>
				<h3 class="screen-menu icon-menu"><span class="hidden"><?php _e( 'Main menu', 't_em' ); ?></span></h3>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'navigation-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
		</section><!-- #masthead -->
	</header><!-- #header -->
