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
 * Add contextual help to theme options screen
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
			'<p>' . __( 'Remember to click <strong>"Save Changes"</strong> to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Overview', 't_em' ),
		'id'		=> 'theme-options-help',
		'content'	=> $help,
		)
	);

	$general_help =	'<p>' . __( '<strong>General Options</strong>: By checking the check boxes below, you may enable or not this options.<br />Note: All of then are check by default.', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . __( '<strong>Twenty’em.com and WordPress.org links</strong>: If this option is set to true, a link to WordPress.org and Twenty&#8217;em will be displayed in your site footer area.', 't_em' ) . '</li>' .
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
						'<li>' . sprintf( __( '<strong>Header image</strong>: This option let you select an image to be shown at the top of your site by uploading from your computer or choosing from your media library. Go to <a href="%1$s">Appearance</a> &gt; <a href="%2$s">Header</a> to customize this section.<br /> In addition you may active the checkbox "<strong>Display featured image in single posts and pages?</strong>", it will show in single post or page the Featured Image attached to it.', 't_em' ),
								 admin_url( 'themes.php' ),
								 admin_url( 'themes.php?page=custom-header' ) ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Slider</strong>: With this options active, a carousel with posts under your favourite category will be displayed in header area. The first time your theme is loaded, your default post category (%1$s) will be actives for this option. Go to <a href="%2$s">Settings</a> &gt; <a href="%3$s">Writing</a> to manage your default category.', 't_em' ),
								 get_cat_name( get_option( 'default_category' ) ),
								 admin_url( 'options-general.php' ),
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

	$layout_help =	'<p>' . __( '<strong>Layout Options</strong>: This options do not need to be explained, really. With this you may decide where you want your side bar, in case you need one. And also you can enter the value you wish to be your site width. Default value <strong>960px</strong>.' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Layout Options', 't_em' ),
		'id'		=> 'layout-options-help',
		'content'	=> $layout_help,
		)
	);

	$socialnetwork_help = '<p>' . __( '<strong>Social Network Options</strong>: We provide a long list of the must used social network sites on the Internet. This option let you introduce your users URL, and they will be show in your site footer area as a menu.' ) . '</p>';

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
 * Add contextual help to tools box options screen
 */
function t_em_tools_box_options_help(){
	global $t_em_theme_data;
	$help = '<p>' . sprintf( __( '<strong><a href="http://twenty-em.com/framework" title="Twenty&#8217;em Framework" target="_blank">Twenty&#8217;em Framework</a></strong> provides somes Javascript and CSS Frameworks or Tools to make your work easier. Some of them are <strong>loaded by default</strong>, so, it is recommended to leave them as they are. Your current theme, <strong>%s</strong>, provides the following tools:', 't_em' ), $t_em_theme_data['Name'] ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>LESS (loaded by default)</strong>: One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Modernizr (loaded by default)</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>HTML5 Shiv (loaded by default)</strong>: Nulla lectus lorem, varius aliquet, auctor vitae, bibendum et, nisl. Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Golden Grid System</strong>: Fusce pulvinar, risus non euismod varius, ante tortor facilisis lorem, non condimentum diam nisl vel lectus.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>jQuery Cycle Lite Plugin</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>jQuery Easing Plugin</strong>: Mauris a diam in eros pretium elementum. Vivamus lacinia nisl non orci. Duis ut dolor. Sed sollicitudin cursus libero.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}

/**
 * Add contextual help to webmaster tools options screen
 */
function t_em_webmaster_tools_help(){
	global $t_em_theme_data;
	$help = '<p>' . __( '<strong><a href="http://twenty-em.com/framework" title="Twenty&#8217;em Framework" target="_blank">Twenty&#8217;em Framework</a></strong> One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly', 't_em' ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>Search Engines ID</strong>: One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Site Statistics Tracker</strong>: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}

/**
 * Add contextual help to backup options screen
 */
function t_em_backup_options_help(){
	global $t_em_theme_data;
	$help = '<p>' . __( '<strong><a href="http://twenty-em.com/framework" title="Twenty&#8217;em Framework" target="_blank">Twenty&#8217;em Framework</a></strong> One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly', 't_em' ) . '</p>'.
			'<ol>' .
				'<li>' . __( '<strong>Theme Options</strong>: <code>t_em_theme_options</code> One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Webmaster Tools Options</strong>: <code>t_em_webmaster_tools_options</code> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Tools Box Options</strong>: <code>t_em_tools_box_options</code> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. HTML In dapibus. CSS In pretium pede. Donec molestie facilisis ante. Ut a turpis ut ipsum pellentesque tincidunt. Morbi blandit sapien in mauris.', 't_em' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://twenty-em.com/framework" target="_blank">Visit Twenty&#8217;em home page</a>', 't_em' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 't_em' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);

	$screen->set_help_sidebar( $sidebar );
}
?>
