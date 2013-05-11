<?php
/**
 * Twenty'em contextual help screens.
 *
 * @file			help.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			0.1
 * @filesource		wp-content/themes/twenty-em/inc/help.php
 * @link			N/A
 * @since			Twenty'em 0.1
 */
?>
<?php
/**
 * Add contextual help to Theme Options screen
 *
 * @since Twenty'em 0.1
 */
function t_em_theme_options_help(){
	global $t_em_theme_data;

	$screen = get_current_screen();

	$help =	'<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/" title="Twenty&#8217;em Framework" target="_blank">Twenty&#8217;em Framework</a></strong> provide customization options that are grouped together on this Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, <strong>%s</strong>, provides the following options:', 't_em' ), $t_em_theme_data['Name'] ) . '</p>'.
			'<ul>' .
				'<li>' . __( '<strong>General Options</strong>: Default Values: All.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Header Options</strong>: Default Values: No header image.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Archive Options</strong>: Default Values: The content.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Layout Options</strong>: Default Values: Sidebar on right. Site width: 960px.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Social Network Options</strong>: Default Values: Empty.', 't_em' ) . '</li>' .
			'</ul>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Overview', 't_em' ),
		'id'		=> 'theme-options-help',
		'content'	=> $help,
		)
	);

	$general_help =	'<p>' . __( '<strong>General Options</strong>: By checking the check boxes below, you may enable or not this options.<br />Note: All of then are check by default.', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . __( '<strong>Twenty&#8217;em.com and WordPress.org links</strong>: If this option is set to true, a link to WordPress.org and Twenty&#8217;em will be displayed in your site footer area.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>Featured image in single post</strong>: Useful to show featured post image on top of a post (above the title) when it is displayed.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>Related posts in single post</strong>: Display a list of related posts, sorts by post tags, at the end of each post.', 't_em' ) . '</li>' .
					'</ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'General Options', 't_em' ),
		'id'		=> 'general-options-help',
		'content'	=> $general_help,
		)
	);

	$header_help =	'<p>' . __( '<strong>Header Options</strong>: With this options you are able to configure your header site section.', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . __( '<strong>No header image</strong>: This options will be check by default at the first time the theme is loaded, and display <em>just another WordPress header</em>: Site Title and Tagline.', 't_em' ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Header image</strong>: This option let you select an image to be shown at the top of your site by uploading from your computer or choosing from your media library. Go to your <a href="%1$s">Header Settings</a> to customize this section.<br /> In addition you may active the checkbox "<strong>Display featured image in single posts and pages?</strong>", it will show in single post or page the Featured Image attached to it.', 't_em' ),
								 admin_url( 'themes.php?page=custom-header' ) ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Slider</strong>: With this options active, a carousel with posts under your favourite category will be displayed in header area. The first time your theme is loaded, your default post category (%1$s) will be actives for this option. Go to your <a href="%2$s">Writing Settings</a> to manage your default category.', 't_em' ),
								 get_cat_name( get_option( 'default_category' ) ),
								 admin_url( 'options-writing.php' ) ). '</li>' .
					'</ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Header Options', 't_em' ),
		'id'		=> 'header-options-help',
		'content'	=> $header_help,
		)
	);

	$archive_help =	'<p>' . __( '<strong>Archive Options</strong>: Two simple ways to show your posts archive: The Content or The Excerpt.', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . __( '<strong>The Content</strong>: If you are running <em>Just another WordPress Blog</em>, this could be a great option, showing the whole content of your posts when an archive is displayed.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>The Excerpt</strong>: The excerpt, of course, shows a resume of your posts, but let you manage some other options, like thumbnail alignment and thumbnail Width and Height.', 't_em' ) . '</li>' .
					'<ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Archive Options', 't_em' ),
		'id'		=> 'archive-options-help',
		'content'	=> $archive_help,
		)
	);

	$layout_help =	'<p>' . __( '<strong>Layout Options</strong>: This options do not need to be explained, really. With this you may decide where you want your side bar, in case you need one. And also you can enter the value you wish to be your site width. Default value <strong>960px</strong>.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Layout Options', 't_em' ),
		'id'		=> 'layout-options-help',
		'content'	=> $layout_help,
		)
	);

	$socialnetwork_help = '<p>' . __( '<strong>Social Network Options</strong>: We provide a long list of the must used social network sites on the Internet. This option let you introduce your users URL, and they will be show in your site footer area as a menu.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Social Network Options', 't_em' ),
		'id'		=> 'socialnetwork-options-help',
		'content'	=> $socialnetwork_help,
		)
	);

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>' .
		'<p>' . __( 'Documentation not yet available', 't_em' ) . '</p>';

	$screen->set_help_sidebar( $sidebar );
}

/**
 * Add contextual help to Tools Box options screen
 *
 * @since Twenty'em 0.1
 */
function t_em_tools_box_options_help(){
	global $t_em_theme_data;

	$screen = get_current_screen();

	$help = '<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/" title="Twenty&#8217;em Framework" target="_blank">Twenty&#8217;em Framework</a></strong> provides some external tools to make your work easier. Some of them are <strong>required and loaded by default</strong>, but some others you can active them, normally to work as a developer. Your current theme, <strong>%s</strong>, provides the following tools:', 't_em' ),
					$t_em_theme_data['Name'] ) . '</p>'.
			'<p><strong>' . __( 'Required:', 't_em' ) . '</strong></p>' .
			'<ul>' .
				'<li>' . __( '<strong>LESS</strong>', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Modernizr</strong>', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>HTML5 Shiv</strong>', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Timthumb</strong>', 't_em' ) . '</li>' .
			'</ul>' .
			'<p><strong>' . __( 'Not required:', 't_em' ) . '</strong></p>' .
			'<ul>' .
				'<li>' . __( '<strong>Golden Grid System</strong>', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>IcoMoon</strong>', 't_em' ) . '</li>' .
			'</ul>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-toolbox-help',
		'content' => $help,
		)
	);

	$required_help = '<p>' . __( 'All this tools are <strong>required and loaded by default</strong>, and they are necessary for the good working of your theme. In addition, We provide a small explanation of how they work, and a link to each tool web site. Enjoy it!', 't_em' ) . '</p>'.
			'<ul>' .
				'<li>' . sprintf( __( '<strong>LESS</strong>: A dynamic stylesheet language. Extends CSS with dynamic behavior such as variables, mixins, operations and functions. You may manage your Color Scheme using this useful tool.<br />Visit <a href="%1$s" title="less.js" target="_blank">LESS Web Site</a> for more info.', 't_em' ),
								'http://lesscss.org' ) . '</li>' .
				'<li>' . sprintf( __( '<strong>Modernizr</strong>: Modernizr is a small JavaScript library that detects the availability of native implementations for HTML5 and CSS3 specifications and tell you whether the current browser has this feature natively implemented or not. Modernizr also enables you to use more semantic elements from the HTML5 spec, even in Internet Explorer.<br />Visit <a href="%1$s" title="Modernizr.com" target="_blank">Modernizr Web Site</a> for more info.', 't_em' ),
						'http://modernizr.com/' ) . '</li>' .
				'<li>' . sprintf( __( '<strong>HTML5 Shiv</strong>: Visit <a href="%1$s" title="HTML5Shiv" target="_blank">HTML5Shiv Web Site</a> for more info', 't_em' ),
						'https://github.com/aFarkas/html5shiv' ) . '</li>' .
				'<li>' . sprintf( __( '<strong>Timthumb</strong>: Visit <a href="%1$s" title="Timthumb" target="_blank">Timthumb Web Site</a> for more info.' ),
						'http://www.binarymoon.co.uk/projects/timthumb/' ) . '</li>' .
			'</ul>';

	$screen->add_help_tab( array(
		'title' => __( 'Required tools', 't_em' ),
		'id' => 'required-toolbox-help',
		'content' => $required_help,
		)
	);

	$not_required_help = '<p>' . __( 'This tools are useful to develop using Twenty&#8217;em Framework', 't_em' ) . '</p>' .
				'<ul>' .
					'<li>' . sprintf( __( '<strong>Golden Grid System</strong>: A folding grid for responsive design. Golden Grid System (GGS) splits the screen into 18 even columns. The leftmost and rightmost columns are used as the outer margins of the grid, which leaves 16 columns for use in design.<br />Visit <a href="%1$s" title="Golden Grid System" target="_blank">Golden Grid System Web Site</a> for more info.', 't_em' ),
							'http://goldengridsystem.com' ) . '</li>' .
					'<li>' . sprintf( __( '<strong>IcoMoon</strong>: This great tool provide a big set of font symbols icons to use in your theme, appropriate to display your site correctly when someone access using a Retina Display.<br />Visit <a href="%1$s" title="IcoMoon.io" target="_blank">IcoMoon Web Site</a> for more info, or see <a href="%2$s" title="IcoMoon examples" target="_blank">all available options</a> and how to use them.', 't_em' ),
							'http://icomoon.io/',
							T_EM_THEME_DIR_DOCS . '/icomoon.html' ) . '</li>' .
				'</ul>';

	$screen->add_help_tab( array(
		'title' => __( 'Not required tools', 't_em' ),
		'id' => 'not-required-toolbox-help',
		'content' => $not_required_help,
		)
	);

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>';

	$screen->set_help_sidebar( $sidebar );
}

/**
 * Add contextual help to Webmaster Tools options screen
 */
function t_em_webmaster_tools_help(){
	global $t_em_theme_data;
	$help = '<p>' . __( 'In this section you should enter your Search Engines ID&#8217;s and Statistics Tracker codes provided by Google, Yahoo! and/or Bing.', 't_em' ) . '</p>'.
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-webmaster-tools-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}
?>
