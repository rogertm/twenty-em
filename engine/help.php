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

	$overview_help =	'<p>' . sprintf( __( '<strong><a href="%1$s" title="%2$s Framework">%2$s Framework</a></strong> provide customization options that are grouped together on this Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, <strong>%3$s</strong>, provides the following options:', 't_em' ),
					T_EM_SITE .'/?page-request=home&amp;ver='.T_EM_FRAMEWORK_VERSION,
					T_EM_FRAMEWORK_NAME,
					$t_em_theme_data['Name'] ) . '</p>'.
			'<ul>' .
				'<li>' . __( '<strong>General Options</strong>: Default Values: All.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Header Options</strong>: Default Values: No header image.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Front Page Options</strong>: Default Values: Just another WordPress front page', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Archive Options</strong>: Default Values: The content.', 't_em' ) . '</li>' .
				'<li>' . sprintf( __( '<strong>Layout Options</strong>: Default Values: Two Columns, content on left. Four footer widgets areas. Site width: <code>%1$spx</code>.', 't_em' ),
						 T_EM_LAYOUT_WIDTH_DEFAULT_VALUE ) . '</li>' .
				'<li>' . __( '<strong>Social Network Options</strong>: Default Values: Empty.', 't_em' ) . '</li>' .
				'<li>' . __( '<strong>Webmaster Tools Options</strong>: Default Values: Empty.', 't_em' ) . '</li>' .
			'</ul>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Overview', 't_em' ),
		'id'		=> 'theme-options-help',
		'content'	=> $overview_help,
		)
	);

	$general_help =	'<p>' . __( '<strong>General Options</strong>: By checking the check boxes below, you may enable or not this options.<br />Note: All of then are check by default.', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . sprintf( __( '<strong>%1$s.com and WordPress.org links</strong>: If this option is set to true, a link to WordPress.org and %1$s.com will be displayed in your site footer area.', 't_em' ), T_EM_FRAMEWORK_NAME ) . '</li>' .
						'<li>' . __( '<strong>Featured image in single post</strong>: Useful to show featured post image on top of a post (above the title) when it is displayed.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>Related posts in single post</strong>: Display a list of related posts, sorts by post tags, at the end of each post.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>Breadcrumb path</strong>: Just another <em>You are here</em> script :)', 't_em' ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Separate comments from pingbacks and trackbacks</strong>: Display pingbacks and trackbacks in a different list at the end of all comments. For this option works properly, please deactivate your <a href="%1$s">comments pagination</a>.', 't_em' ),
								 admin_url( 'options-discussion.php#page_comments' ) ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Enable comments in single pages</strong>: This option lets you allow comments in single pages. If true, the option <a href="%1$s">Allow people to post comments on new articles</a> in <strong>Default article settings</strong> must be true too.', 't_em' ),
								 admin_url( 'options-discussion.php#default_comment_status' ) ) . '</li>' .
						'<li>' . __( '<strong>Enable shortcodes buttons</strong>: Lets you show or hide the shortocde buttons in the post or page editor. Note that shortcodes allways will be enable', 't_em' ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Favicon URL</strong>: <a href="%1$s">Upload</a> and/or select from your <a href="%2$s">Media Library</a> a favicon to your site.', 't_em' ),
								 admin_url( 'media-new.php' ),
								 admin_url( 'upload.php' ) ) . '</li>' .
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
						'<li>' . sprintf( __( '<strong>Header image</strong>: This option let you select an image to be shown at the top of your site by uploading from your computer or choosing from your media library. Go to your <a href="%1$s">Header Settings</a> to customize this section. In addition you may active the checkbox "<strong>Display featured image in single posts and pages</strong>", it will show in single post or page the Featured Image attached to it.', 't_em' ),
								 admin_url( 'customize.php?autofocus[control]=header_image' ) ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Slider</strong>: With this options active, a carousel with posts under your favourite category will be displayed in header area. The first time your theme is loaded, your default post category (%1$s) will be actives for this option. Go to your <a href="%2$s">Writing Settings</a> to manage your default category.', 't_em' ),
								 get_cat_name( get_option( 'default_category' ) ),
								 admin_url( 'options-writing.php' ) ). '</li>' .
						'<li>' . sprintf( __( '<strong>Static Header</strong>: Useful option to let people know what about your site is. You can insert an image previously uploaded to your <a href="%1$s">Media Library</a> and a headline with a small text or slogan describing your site. In addition you can add a primary and/or secondary button linked to featured URL&#8217;s, also add <a href="%2$s">icons</a> to these buttons.', 't_em' ),
								 admin_url( 'upload.php' ),
								 T_EM_THEME_DIR_FONTS_URL . '/icomoon.html' ) . '</li>' .
					'</ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Header Options', 't_em' ),
		'id'		=> 'header-options-help',
		'content'	=> $header_help,
		)
	);

	$front_page_help =	'<p>' . __( '<strong>Front Page Options</strong>: With this options you are able to configure your front page.', 't_em' ) . '</p>' .
						'<ul>' .
							'<li>' . sprintf( __( '<strong>Just another WordPress front page</strong>: This is a child of your <a href="%1$s">Reading Settings</a> options.', 't_em' ),
									 admin_url( 'options-reading.php' ) ) . '</li>' .
							'<li>' . sprintf( __( '<strong>Text Widgets</strong>: Four featured text widgets areas (one primary, three secondaries). Same options for all of them: headline, content (HTML enable, will be escaped before to be insert into the data base), <a href="%1$s">icon class</a>, image (previously uploaded to your <a href="%2$s">Media Library</a>) and a two buttons linked to the URL you like.', 't_em' ),
									 T_EM_THEME_DIR_FONTS_URL . '/icomoon.html',
									 admin_url( 'upload.php' ) ) . '</li>' .
						'</ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Front Page Options', 't_em' ),
		'id'		=> 'front-page-options-help',
		'content'	=> $front_page_help,
		)
	);

	$archive_help =	'<p>' . __( '<strong>Archive Options</strong>: Two simple ways to show your posts archive: The Content or The Excerpt. Besides two pagination options', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . __( '<strong>The Content</strong>: If you are running <em>Just another WordPress Blog</em>, this could be a great option, showing the whole content of your posts when an archive is displayed.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>The Excerpt</strong>: The excerpt, of course, shows a resume of your posts, also let you manage some other options, like excerpt length, thumbnail alignment and thumbnail Width and Height.', 't_em' ) . '</li>' .
						'<li>' . __( '<strong>Archive Pagination</strong>: Two ways to display your pagination. Simple: <code>Older</code> and <code>Newer</code> posts links. Or Paginated: list of links <code>&laquo; Newer 1 &hellip; 3 4 5 6 7 &hellip; 9 Older &raquo;</code>', 't_em' ) . '</li>' .
					'</ul>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Archive Options', 't_em' ),
		'id'		=> 'archive-options-help',
		'content'	=> $archive_help,
		)
	);

	$layout_help =	'<p>' . __( '<strong>Layout Options</strong>: This options do not need to be explained, really. You may decide where you want your(s) side(s) bar(s), in case you need one.', 't_em' ) . '</p>' .
					'<p>' . sprintf( __( 'And also enter the value (in pixels) you wish to be your site width. Default: <code>%1$s</code>, Max: <code>%2$s</code>, Min: <code>%3$s</code>.', 't_em' ),
							T_EM_LAYOUT_WIDTH_DEFAULT_VALUE,
							T_EM_LAYOUT_WIDTH_MAX_VALUE,
							T_EM_LAYOUT_WIDTH_MIN_VALUE ) . '</p>';

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

	$webmastertools_help = '<p>' . sprintf( __( '<strong>Webmaster Tools Options</strong>: In this section you should enter your meta key "content" value provided by <a href="%1$s">Google Webmaster Tools</a>, <a href="%2$s">Bing Webmaster Center</a> and <a href="%3$s">Pinterest Site Verification</a>, and Statistics Tracker codes from the system you like.', 't_em' ),
								'https://www.google.com/webmasters/tools/',
								'http://www.bing.com/webmaster/',
								'https://pinterest.com/website/verify/' ) . '</p>';

	$screen->add_help_tab( array(
		'title' => __( 'Webmaster Tools Options', 't_em' ),
		'id' => 'webmaster-tools-help',
		'content' => $webmastertools_help,
		)
	);

	$debug_help = '<p>' . __( '<strong>Little Debug Information</strong>:', 't_em' ) . '</p>' .
					'<ul>' .
						'<li>' . sprintf( __( '<strong>Framework Name</strong>: <code>%s</code>', 't_em' ), T_EM_FRAMEWORK_NAME ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Version</strong>: <code>%s</code>', 't_em' ), T_EM_FRAMEWORK_VERSION ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Status</strong>: <code>%s</code>', 't_em' ), T_EM_FRAMEWORK_VERSION_STATUS ) . '</li>' .
						'<li>' . sprintf( __( '<strong>Data Base Version</strong>: <code>%s</code>', 't_em' ), T_EM_DB_VERSION ) . '</li>' .
					'</ul>';

	$screen->add_help_tab( array(
		'title' => __( 'Little Debug Info', 't_em' ),
		'id' => 'debug-help',
		'content' => $debug_help,
		)
	);

	$screen->set_help_sidebar( t_em_theme_sidebar_help() );
}

/**
 * Add contextual help to Backup Manager screen
 */
function t_em_theme_backup_help(){
	$screen = get_current_screen();

	$overview_help =	'<p>' . sprintf( __( '<strong>%1$s Backup Manager</strong>', 't_em' ), T_EM_FRAMEWORK_NAME ) . '</p>' .
						'<p>' . sprintf( __( 'The backup manager allows you to backup or restore your <a href="%1$s">Theme Options</a> settings to or from a text file. Only valid backup files generated through the <strong>%2$s Backup Manager</strong> should be imported. ', 't_em' ),
										admin_url( 'admin.php?page=twenty-em-options' ), T_EM_FRAMEWORK_NAME ) . '</p>' .
						'<p>' . sprintf( __( 'Please note that this manager only backs up your settings, not your content, to backup your content use the <a href="%1$s">WordPress Export Tool</a>.', 't_em' ),
						admin_url( 'export.php' ) ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Overview', 't_em' ),
		'id'		=> 'theme-backup-help',
		'content'	=> $overview_help,
		)
	);

	$export_help =		'<p>' . __( '<strong>Export Settings</strong>', 't_em' ) . '</p>' .
						'<p>' . sprintf( __( 'You can export your <strong>%1$s</strong> settings to back them up, or copy them to another site. If Child Themes or Plugins merge their options to <code>t_em_theme_options</code> option, that setting will be exported too.', 't_em' ), T_EM_FRAMEWORK_NAME ) .'</p>' .
						'<p>' . __( 'The settings are exported in a text file named <code>t-em-backup-</code> fallowed by the date and time it was exported.' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Export', 't_em' ),
		'id'		=> 'theme-export-help',
		'content'	=> $export_help,
		)
	);

	$import_help = 		'<p>' . __( '<strong>Import Settings</strong>', 't_em' ) . '</p>' .
						'<p>' . sprintf( __( 'You can import a file you\'ve previously exported. Remember that only files exported by the <strong>%1$s Backup Manager</strong> can be imported back.', 't_em' ), T_EM_FRAMEWORK_NAME ) . '</p>' .
						'<p>' . __( 'Once you upload your file, it will update the <code>t_em_theme_options</code> option in the data base. <strong>This action cannot be undone</strong>.', 't_em' ) . '</p>';

	$screen->add_help_tab( array(
		'title'		=> __( 'Import', 't_em' ),
		'id'		=> 'theme-import-help',
		'content'	=> $import_help,
		)
	);

	$screen->set_help_sidebar( t_em_theme_sidebar_help() );
}

/**
 * Sidebar for Contextual Help
 */
function t_em_theme_sidebar_help(){
	$help_sidebar = '<p><strong>' . __( 'For more information:', 't_em' ) . '</strong></p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Visit %2$s home page</a>', 't_em' ),
						T_EM_SITE .'/?page-request=home&amp;ver=' . T_EM_FRAMEWORK_VERSION, T_EM_FRAMEWORK_NAME ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">License</a>', 't_em' ), T_EM_SITE . '/?page-request=license&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Documentation</a>', 't_em' ), T_EM_SITE . '/?page-request=docs&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Change Log</a>', 't_em' ), T_EM_SITE . '/?page-request=log&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">News</a>', 't_em' ), T_EM_SITE . '/?page-request=blog&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Feedback</a>', 't_em' ), T_EM_SITE . '/?page-request=contact&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Share your Testimony</a>', 't_em' ), T_EM_SITE . '/?page-request=testimonies&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>' .
				'<p>' . sprintf( __( '<a href="%1$s">Donate</a>', 't_em' ), T_EM_SITE . '/?page-request=donate&amp;ver=' . T_EM_FRAMEWORK_VERSION ) . '</p>';

	return $help_sidebar;
}
?>
