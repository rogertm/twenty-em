<?php
/**
 * Twenty'em shortcodes.
 *
 * @file			shortcodes.php
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @copyright		2012
 * @license			license.txt
 * @version			1.0
 * @filesource		wp-content/themes/twenty-em/inc/shortcodes.php
 * @link			http://codex.wordpress.org/Shortcode_API
 * @since			Twenty'em 1.0
 */
?>
<?php
/**
 * Include additional buttons in the Text (HTML) mode of the WordPress editor
 *
 * @link http://codex.wordpress.org/Quicktags_API
 *
 * @since Twenty'em 1.0
 */
function t_em_quickttags_buttons(){
?>
	<script type="text/javascript">
		QTags.addButton( 'sc_success', 'success', '[success]', '[/success]', '', '', 121 );
		QTags.addButton( 'sc_info', 'info', '[info]', '[/info]', '', '', 122 );
		QTags.addButton( 'sc_warning', 'warning', '[warning]', '[/warning]', '', '', 123 );
		QTags.addButton( 'sc_error', 'error', '[error]', '[/error]', '', '', 124 );
		QTags.addButton( 'sc_quote', 'quote', '[quote text_align="" float=""]', '[/quote]', '', '', 125 );
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 't_em_quickttags_buttons' );

function t_em_shortcode_alert_close_button( $atts ){
	return '<a href="#" class="close" data-dismiss="alert">&times;</a>';
}
add_shortcode( 'close', 't_em_shortcode_alert_close_button' );

function t_em_shortcode_alert_success( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-success alert-block',
			'span_icon' => '<span class="icon-thumbs-up font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'success', 't_em_shortcode_alert_success' );

function t_em_shortcode_alert_warning( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-warning alert-block',
			'span_icon' => '<span class="icon-warning font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'warning', 't_em_shortcode_alert_warning' );

function t_em_shortcode_alert_help( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-help font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'help', 't_em_shortcode_alert_help' );

function t_em_shortcode_alert_info( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-info alert-block',
			'span_icon' => '<span class="icon-info-2 font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'info', 't_em_shortcode_alert_info' );

function t_em_shortcode_alert_error( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-danger font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'error', 't_em_shortcode_alert_error' );

function t_em_shortcode_alert_bug( $atts, $content = null ){
	extract( shortcode_atts( array (
			'class' => 'alert alert-error alert-block',
			'span_icon' => '<span class="icon-bug font-icon"></span>',
		), $atts ) );
	return '<div class="'. esc_attr( $class ) .'">' . $span_icon . do_shortcode( $content ) .'</div>';
}
add_shortcode( 'bug', 't_em_shortcode_alert_bug' );

function t_em_shortcode_quote( $atts, $content = null ){
	extract( shortcode_atts( array (
			'text_align' => '',
			'float' => '',
		), $atts ) );
	if ( esc_attr( $text_align ) == 'left' ) :
		$class_align = 'text-left';
	elseif ( esc_attr( $text_align )  == 'right') :
		$class_align = 'text-right';
	else :
		$class_align = '';
	endif;

	if ( esc_attr( $float ) == 'left' ) :
		$class_float = 'pull-left span6';
	elseif ( esc_attr( $float ) == 'right' ) :
		$class_float = 'pull-right span6';
	else :
		$class_float = '';
	endif;


	return '<blockquote class="'. esc_attr( $class_align ) .' '. esc_attr( $class_float ) .'"><p>'. $content .'</p></blockquote>';
}
add_shortcode( 'quote', 't_em_shortcode_quote' );

function t_em_shortcut_icomoon_icon( $atts ){
	$icomoon = array ( 'icon-aries', 'icon-taurus', 'icon-gemini', 'icon-cancer', 'icon-leo', 'icon-virgo', 'icon-libra', 'icon-scorpio', 'icon-sagitarius', 'icon-capricorn', 'icon-aquarius', 'icon-pisces', 'icon-circleleft', 'icon-circledown', 'icon-circleup', 'icon-circleright', 'icon-tooth', 'icon-lungs', 'icon-kidney', 'icon-stomach', 'icon-liver', 'icon-brain', 'icon-dieone', 'icon-dietwo', 'icon-diethree', 'icon-diefour', 'icon-diefive', 'icon-diesix', 'icon-uniF014', 'icon-support3', 'icon-html', 'icon-html5', 'icon-css3', 'icon-jquery', 'icon-jqueryui', 'icon-magento', 'icon-ajax', 'icon-flashplayer', 'icon-python', 'icon-joomla', 'icon-mysql', 'icon-drupal', 'icon-java', 'icon-cplusplus', 'icon-csharp', 'icon-squarebrackets', 'icon-braces', 'icon-chevrons', 'icon-ubuntu', 'icon-bluetooth', 'icon-sortbysizedescending', 'icon-sortbysizeascending', 'icon-sortbynamedescending', 'icon-sortbynameascending', 'icon-_0', 'icon-_1', 'icon-_2', 'icon-_3', 'icon-_4', 'icon-_5', 'icon-_6', 'icon-_7', 'icon-_8', 'icon-_9', 'icon-at', 'icon-A', 'icon-B', 'icon-C', 'icon-D', 'icon-E', 'icon-F', 'icon-G', 'icon-H', 'icon-I', 'icon-J', 'icon-K', 'icon-L', 'icon-M', 'icon-N', 'icon-O', 'icon-P', 'icon-Q', 'icon-R', 'icon-S', 'icon-T', 'icon-U', 'icon-V', 'icon-W', 'icon-X', 'icon-Y', 'icon-Z', 'icon-a', 'icon-b', 'icon-c', 'icon-d', 'icon-e', 'icon-f', 'icon-g', 'icon-h', 'icon-i', 'icon-j', 'icon-k', 'icon-l', 'icon-m', 'icon-n', 'icon-o', 'icon-p', 'icon-q', 'icon-r', 'icon-s', 'icon-t', 'icon-u', 'icon-v', 'icon-w', 'icon-x', 'icon-y', 'icon-z', 'icon-yen', 'icon-copyright', 'icon-layout', 'icon-layout-2', 'icon-layout-3', 'icon-layout-4', 'icon-layout-5', 'icon-layout-6', 'icon-layout-7', 'icon-layout-8', 'icon-layout-9', 'icon-layout-10', 'icon-layout-11', 'icon-layout-12', 'icon-layout-13', 'icon-layout-14', 'icon-search', 'icon-envelope', 'icon-heart', 'icon-star', 'icon-star-empty', 'icon-zoom-in', 'icon-zoom-out', 'icon-glass', 'icon-music', 'icon-off', 'icon-signal', 'icon-cog', 'icon-home', 'icon-time', 'icon-download-alt', 'icon-tag', 'icon-tags', 'icon-pencil', 'icon-font', 'icon-bold', 'icon-italic', 'icon-text-height', 'icon-text-width', 'icon-align-left', 'icon-align-center', 'icon-align-right', 'icon-align-justify', 'icon-list', 'icon-indent-left', 'icon-indent-right', 'icon-picture', 'icon-facetime-video', 'icon-volume-up', 'icon-volume-down', 'icon-volume-off', 'icon-folder-close', 'icon-folder-open', 'icon-shopping-cart', 'icon-cogs', 'icon-comment', 'icon-comments', 'icon-double-angle-left', 'icon-double-angle-right', 'icon-double-angle-up', 'icon-double-angle-down', 'icon-angle-left', 'icon-angle-right', 'icon-angle-up', 'icon-angle-down', 'icon-quote-left', 'icon-quote-right', 'icon-circle-blank', 'icon-spinner', 'icon-circle', 'icon-folder-close-alt', 'icon-folder-open-alt', 'icon-desktop', 'icon-laptop', 'icon-tablet', 'icon-mobile', 'icon-link', 'icon-group', 'icon-user', 'icon-film', 'icon-remove', 'icon-ok', 'icon-th-list', 'icon-th', 'icon-th-large', 'icon-road', 'icon-wrench', 'icon-paper-clip', 'icon-happy', 'icon-happy-2', 'icon-smiley', 'icon-smiley-2', 'icon-tongue', 'icon-tongue-2', 'icon-sad', 'icon-sad-2', 'icon-wink', 'icon-wink-2', 'icon-grin', 'icon-grin-2', 'icon-cool', 'icon-cool-2', 'icon-angry', 'icon-angry-2', 'icon-evil', 'icon-evil-2', 'icon-shocked', 'icon-shocked-2', 'icon-confused', 'icon-confused-2', 'icon-neutral', 'icon-neutral-2', 'icon-wondering', 'icon-wondering-2', 'icon-cloud-download', 'icon-cloud', 'icon-cloud-upload', 'icon-key', 'icon-thumbs-up', 'icon-thumbs-down', 'icon-upload-alt', 'icon-chrome', 'icon-camera', 'icon-camera-retro', 'icon-enter', 'icon-exit', 'icon-embed', 'icon-code', 'icon-console', 'icon-share', 'icon-mail', 'icon-mail-2', 'icon-mail-3', 'icon-mail-4', 'icon-google', 'icon-google-plus', 'icon-google-plus-2', 'icon-google-plus-3', 'icon-google-plus-4', 'icon-google-drive', 'icon-facebook', 'icon-facebook-2', 'icon-facebook-3', 'icon-instagram', 'icon-twitter', 'icon-twitter-2', 'icon-twitter-3', 'icon-feed', 'icon-feed-2', 'icon-feed-3', 'icon-youtube', 'icon-youtube-2', 'icon-vimeo', 'icon-vimeo2', 'icon-vimeo-2', 'icon-lanyrd', 'icon-flickr', 'icon-flickr-2', 'icon-flickr-3', 'icon-flickr-4', 'icon-picassa', 'icon-picassa-2', 'icon-dribbble', 'icon-dribbble-2', 'icon-dribbble-3', 'icon-forrst', 'icon-forrst-2', 'icon-deviantart', 'icon-deviantart-2', 'icon-steam', 'icon-steam-2', 'icon-github', 'icon-github-2', 'icon-github-3', 'icon-github-4', 'icon-github-5', 'icon-wordpress', 'icon-wordpress-2', 'icon-joomla-2', 'icon-blogger', 'icon-blogger-2', 'icon-tumblr', 'icon-tumblr-2', 'icon-yahoo', 'icon-tux', 'icon-apple', 'icon-finder', 'icon-android', 'icon-windows', 'icon-windows8', 'icon-soundcloud', 'icon-soundcloud-2', 'icon-skype', 'icon-reddit', 'icon-linkedin', 'icon-lastfm', 'icon-lastfm-2', 'icon-delicious', 'icon-stumbleupon', 'icon-stumbleupon-2', 'icon-stackoverflow', 'icon-pinterest', 'icon-pinterest-2', 'icon-xing', 'icon-xing-2', 'icon-flattr', 'icon-foursquare', 'icon-foursquare-2', 'icon-paypal', 'icon-paypal-2', 'icon-paypal-3', 'icon-yelp', 'icon-libreoffice', 'icon-file-pdf', 'icon-file-openoffice', 'icon-file-word', 'icon-file-excel', 'icon-file-zip', 'icon-file-powerpoint', 'icon-file-xml', 'icon-file-css', 'icon-html5-2', 'icon-html5-3', 'icon-css3-2', 'icon-chrome-2', 'icon-firefox', 'icon-IE', 'icon-opera', 'icon-safari', 'icon-IcoMoon', 'icon-spinner-2', 'icon-spinner-3', 'icon-spinner-4', 'icon-spinner-5', 'icon-spinner-6', 'icon-spinner-7', 'icon-apple-2', 'icon-pause', 'icon-play', 'icon-next', 'icon-previous', 'icon-next-2', 'icon-previous-2', 'icon-record', 'icon-eject', 'icon-disk', 'icon-spider', 'icon-spiderman', 'icon-batman', 'icon-ironman', 'icon-darthvader', 'icon-tetrisone', 'icon-tetristwo', 'icon-tetristhree', 'icon-spaceinvaders', 'icon-chat', 'icon-pictures', 'icon-euro', 'icon-euro2', 'icon-dollar2', 'icon-dollar', 'icon-yen2', 'icon-pound2', 'icon-pound', 'icon-moneybag', 'icon-earth', 'icon-maps', 'icon-pin', 'icon-pushpin', 'icon-podcast', 'icon-connection', 'icon-feed-4', 'icon-box', 'icon-location', 'icon-location-2', 'icon-pushpin-2', 'icon-hydrant', 'icon-fort', 'icon-cannon', 'icon-dna', 'icon-greenlightbulb', 'icon-pasta', 'icon-cricket', 'icon-razor', 'icon-danger', 'icon-windleft', 'icon-windright', 'icon-infinity', 'icon-intersection', 'icon-fork', 'icon-yinyang', 'icon-screw', 'icon-nut', 'icon-nail', 'icon-stiletto', 'icon-fishbone', 'icon-bread', 'icon-chicken', 'icon-fish', 'icon-cupcake', 'icon-pizza', 'icon-cherry', 'icon-mushroom', 'icon-bone', 'icon-steak', 'icon-restaurantmenu', 'icon-bottle', 'icon-muffin', 'icon-pepperoni', 'icon-sunnysideup', 'icon-chocolate', 'icon-tea', 'icon-hotdog', 'icon-taco', 'icon-chef', 'icon-pretzel', 'icon-foodtray', 'icon-soup', 'icon-bowlingpins', 'icon-bat', 'icon-stadium', 'icon-whistle', 'icon-hockey', 'icon-carrot', 'icon-strawberry', 'icon-banana', 'icon-edit', 'icon-brush', 'icon-palette', 'icon-insertpictureleft', 'icon-insertpictureright', 'icon-insertpicturecenter', 'icon-trafficlight', 'icon-cactus', 'icon-watertap', 'icon-snow', 'icon-rain', 'icon-storm', 'icon-automobile', 'icon-navigation', 'icon-wave2', 'icon-wave', 'icon-airplane', 'icon-shipping', 'icon-roadsignleft', 'icon-bus', 'icon-rubberstamp', 'icon-briefcase3', 'icon-briefcase2', 'icon-shovel', 'icon-hammer', 'icon-screwdriver', 'icon-screwdriver2', 'icon-sunglasses', 'icon-glasses', 'icon-medal', 'icon-medalgold', 'icon-medalsilver', 'icon-medalbronze', 'icon-basketball', 'icon-tennis', 'icon-football', 'icon-americanfootball', 'icon-sword', 'icon-bow', 'icon-axe', 'icon-pingpong', 'icon-golf', 'icon-racquet', 'icon-bowling', 'icon-spades', 'icon-clubs', 'icon-diamonds', 'icon-pawn', 'icon-bishop', 'icon-rook', 'icon-knight', 'icon-king', 'icon-queen', 'icon-percent', 'icon-asterisk', 'icon-plus', 'icon-sum', 'icon-root', 'icon-minus', 'icon-book', 'icon-print', 'icon-bookmark', 'icon-flag', 'icon-qrcode', 'icon-barcode', 'icon-globe', 'icon-headphones', 'icon-phone', 'icon-phone-sign', 'icon-trash', 'icon-desklamp', 'icon-visa', 'icon-vendetta', 'icon-value', 'icon-foldertree', 'icon-gamecursor', 'icon-controllerps', 'icon-controllernes', 'icon-controllersnes', 'icon-joystickarcade', 'icon-joystickatari', 'icon-podium', 'icon-trophy', 'icon-diamond', 'icon-circles', 'icon-progress-3', 'icon-progress-2', 'icon-brogress-1', 'icon-progress-0', 'icon-cc', 'icon-volume-decrease', 'icon-volume-increase', 'icon-volume-mute', 'icon-volume-mute-2', 'icon-volume-low', 'icon-volume-medium', 'icon-volume-high', 'icon-hand-right', 'icon-hand-left', 'icon-hand-up', 'icon-hand-down', 'icon-heart-empty', 'icon-locked', 'icon-unlocked', 'icon-myspace', 'icon-reorder', 'icon-sort', 'icon-dagger', 'icon-ring', 'icon-pipe', 'icon-triangle', 'icon-cube', 'icon-box-2', 'icon-curling', 'icon-lighthouse', 'icon-helicopter', 'icon-telescope', 'icon-graduation', 'icon-fedora', 'icon-tophat', 'icon-filmstrip', 'icon-lollypop', 'icon-hearts', 'icon-caret-up', 'icon-caret-down', 'icon-sort-up', 'icon-sort-down', 'icon-caret-right', 'icon-caret-left', 'icon-arrow-left', 'icon-arrow-down', 'icon-arrow-up', 'icon-untitled', 'icon-ellipsis', 'icon-dots', 'icon-dot', 'icon-file', 'icon-list-ul', 'icon-list-ol', 'icon-save', 'icon-strikethrough', 'icon-underline', 'icon-sitemap', 'icon-umbrella', 'icon-baloon', 'icon-alienship', 'icon-tie', 'icon-pigpena', 'icon-pigpenb', 'icon-pigpenc', 'icon-pigpend', 'icon-pigpene', 'icon-pigpenf', 'icon-pigpeng', 'icon-pigpenh', 'icon-pigpeni', 'icon-pigpenj', 'icon-pigpenk', 'icon-pigpenl', 'icon-pigpenm', 'icon-pigpenn', 'icon-pigpeno', 'icon-pigpenp', 'icon-pigpenq', 'icon-pigpenr', 'icon-pigpens', 'icon-pigpent', 'icon-pigpenu', 'icon-pigpenv', 'icon-pigpenw', 'icon-pigpenx', 'icon-pigpeny', 'icon-pigpenz', 'icon-braillea', 'icon-brailleb', 'icon-braillec', 'icon-brailled', 'icon-braillee', 'icon-braillef', 'icon-brailleg', 'icon-brailleh', 'icon-braillei', 'icon-braillej', 'icon-braillek', 'icon-braillel', 'icon-braillem', 'icon-braillen', 'icon-brailleo', 'icon-braillep', 'icon-brailleq', 'icon-brailler', 'icon-brailles', 'icon-braillet', 'icon-brailleu', 'icon-braillev', 'icon-braillew', 'icon-braillex', 'icon-brailley', 'icon-braillez', 'icon-braille0', 'icon-braille1', 'icon-braille2', 'icon-braille3', 'icon-braille4', 'icon-braille5', 'icon-braille6', 'icon-braille7', 'icon-braille8', 'icon-braille9', 'icon-braillespace', 'icon-raceflag', 'icon-tictactoe', 'icon-settings2', 'icon-settings3', 'icon-settings4', 'icon-tools', 'icon-equalizer', 'icon-desktop-2', 'icon-pilcrow', 'icon-left-to-right', 'icon-right-to-left', 'icon-sigma', 'icon-omega', 'icon-table', 'icon-copy', 'icon-columns', 'icon-bookmark-empty', 'icon-envelope-alt', 'icon-fridge', 'icon-speed', 'icon-microwave', 'icon-candy', 'icon-teapot', 'icon-raspberry', 'icon-raspberrypi', 'icon-fries', 'icon-birthday', 'icon-christmastree', 'icon-snowman', 'icon-candycane', 'icon-dart', 'icon-ink', 'icon-resistor', 'icon-bag', 'icon-money-bag', 'icon-spotify', 'icon-calendar', 'icon-planet', 'icon-toiletpaper', 'icon-toothbrush', 'icon-info', 'icon-info-2', 'icon-question', 'icon-help', 'icon-warning', 'icon-trumpet', 'icon-metronome', 'icon-eightball', 'icon-uniF002', 'icon-ampersand', 'icon-bug', 'icon-coffeebean', 'icon-ram', 'icon-finder-2', 'icon-keyboard', 'icon-fourohfour', 'icon-php', 'icon-route', 'icon-nintendods', 'icon-gameboy', 'icon-peace', 'icon-lightning2', 'icon-target', 'icon-flower', 'icon-icecream', 'icon-man', 'icon-woman', 'icon-candle', 'icon-forklift', 'icon-flashlight', 'icon-hanger', 'icon-director', 'icon-fence', 'icon-lightbulb', 'icon-usb', 'icon-cord', 'icon-socket', 'icon-socket-2', 'icon-socket-3', 'icon-stats', 'icon-font-2', 'icon-text-height-2', 'icon-text-width-2', 'icon-cgi', 'icon-soundwave', 'icon-vector', 'icon-polygonlasso', 'icon-lasso', 'icon-subscript', 'icon-superscript', 'icon-network', 'icon-lan', 'icon-usb2', 'icon-usb-2', 'icon-usb-3', 'icon-treediagram', 'icon-antenna', 'icon-adobe', 'icon-bolt', 'icon-uniF005', 'icon-write', 'icon-radio', 'icon-satellite', 'icon-bomb', 'icon-mouse', 'icon-cursor', 'icon-anchor', 'icon-pie', 'icon-bars', 'icon-bars-2', 'icon-stamp', 'icon-stamp2', 'icon-stamp-2', 'icon-camera-2', 'icon-radio-checked', 'icon-radio-unchecked', 'icon-radioactive', 'icon-radio-2', 'icon-webcam', 'icon-settings5' );
	foreach ( $icomoon as $icon ) :
		return '<span class="'. $icon .' font-icon"></span>';
	endforeach;
}
$icomoon = array ( 'icon-aries', 'icon-taurus', 'icon-gemini', 'icon-cancer', 'icon-leo', 'icon-virgo', 'icon-libra', 'icon-scorpio', 'icon-sagitarius', 'icon-capricorn', 'icon-aquarius', 'icon-pisces', 'icon-circleleft', 'icon-circledown', 'icon-circleup', 'icon-circleright', 'icon-tooth', 'icon-lungs', 'icon-kidney', 'icon-stomach', 'icon-liver', 'icon-brain', 'icon-dieone', 'icon-dietwo', 'icon-diethree', 'icon-diefour', 'icon-diefive', 'icon-diesix', 'icon-uniF014', 'icon-support3', 'icon-html', 'icon-html5', 'icon-css3', 'icon-jquery', 'icon-jqueryui', 'icon-magento', 'icon-ajax', 'icon-flashplayer', 'icon-python', 'icon-joomla', 'icon-mysql', 'icon-drupal', 'icon-java', 'icon-cplusplus', 'icon-csharp', 'icon-squarebrackets', 'icon-braces', 'icon-chevrons', 'icon-ubuntu', 'icon-bluetooth', 'icon-sortbysizedescending', 'icon-sortbysizeascending', 'icon-sortbynamedescending', 'icon-sortbynameascending', 'icon-_0', 'icon-_1', 'icon-_2', 'icon-_3', 'icon-_4', 'icon-_5', 'icon-_6', 'icon-_7', 'icon-_8', 'icon-_9', 'icon-at', 'icon-A', 'icon-B', 'icon-C', 'icon-D', 'icon-E', 'icon-F', 'icon-G', 'icon-H', 'icon-I', 'icon-J', 'icon-K', 'icon-L', 'icon-M', 'icon-N', 'icon-O', 'icon-P', 'icon-Q', 'icon-R', 'icon-S', 'icon-T', 'icon-U', 'icon-V', 'icon-W', 'icon-X', 'icon-Y', 'icon-Z', 'icon-a', 'icon-b', 'icon-c', 'icon-d', 'icon-e', 'icon-f', 'icon-g', 'icon-h', 'icon-i', 'icon-j', 'icon-k', 'icon-l', 'icon-m', 'icon-n', 'icon-o', 'icon-p', 'icon-q', 'icon-r', 'icon-s', 'icon-t', 'icon-u', 'icon-v', 'icon-w', 'icon-x', 'icon-y', 'icon-z', 'icon-yen', 'icon-copyright', 'icon-layout', 'icon-layout-2', 'icon-layout-3', 'icon-layout-4', 'icon-layout-5', 'icon-layout-6', 'icon-layout-7', 'icon-layout-8', 'icon-layout-9', 'icon-layout-10', 'icon-layout-11', 'icon-layout-12', 'icon-layout-13', 'icon-layout-14', 'icon-search', 'icon-envelope', 'icon-heart', 'icon-star', 'icon-star-empty', 'icon-zoom-in', 'icon-zoom-out', 'icon-glass', 'icon-music', 'icon-off', 'icon-signal', 'icon-cog', 'icon-home', 'icon-time', 'icon-download-alt', 'icon-tag', 'icon-tags', 'icon-pencil', 'icon-font', 'icon-bold', 'icon-italic', 'icon-text-height', 'icon-text-width', 'icon-align-left', 'icon-align-center', 'icon-align-right', 'icon-align-justify', 'icon-list', 'icon-indent-left', 'icon-indent-right', 'icon-picture', 'icon-facetime-video', 'icon-volume-up', 'icon-volume-down', 'icon-volume-off', 'icon-folder-close', 'icon-folder-open', 'icon-shopping-cart', 'icon-cogs', 'icon-comment', 'icon-comments', 'icon-double-angle-left', 'icon-double-angle-right', 'icon-double-angle-up', 'icon-double-angle-down', 'icon-angle-left', 'icon-angle-right', 'icon-angle-up', 'icon-angle-down', 'icon-quote-left', 'icon-quote-right', 'icon-circle-blank', 'icon-spinner', 'icon-circle', 'icon-folder-close-alt', 'icon-folder-open-alt', 'icon-desktop', 'icon-laptop', 'icon-tablet', 'icon-mobile', 'icon-link', 'icon-group', 'icon-user', 'icon-film', 'icon-remove', 'icon-ok', 'icon-th-list', 'icon-th', 'icon-th-large', 'icon-road', 'icon-wrench', 'icon-paper-clip', 'icon-happy', 'icon-happy-2', 'icon-smiley', 'icon-smiley-2', 'icon-tongue', 'icon-tongue-2', 'icon-sad', 'icon-sad-2', 'icon-wink', 'icon-wink-2', 'icon-grin', 'icon-grin-2', 'icon-cool', 'icon-cool-2', 'icon-angry', 'icon-angry-2', 'icon-evil', 'icon-evil-2', 'icon-shocked', 'icon-shocked-2', 'icon-confused', 'icon-confused-2', 'icon-neutral', 'icon-neutral-2', 'icon-wondering', 'icon-wondering-2', 'icon-cloud-download', 'icon-cloud', 'icon-cloud-upload', 'icon-key', 'icon-thumbs-up', 'icon-thumbs-down', 'icon-upload-alt', 'icon-chrome', 'icon-camera', 'icon-camera-retro', 'icon-enter', 'icon-exit', 'icon-embed', 'icon-code', 'icon-console', 'icon-share', 'icon-mail', 'icon-mail-2', 'icon-mail-3', 'icon-mail-4', 'icon-google', 'icon-google-plus', 'icon-google-plus-2', 'icon-google-plus-3', 'icon-google-plus-4', 'icon-google-drive', 'icon-facebook', 'icon-facebook-2', 'icon-facebook-3', 'icon-instagram', 'icon-twitter', 'icon-twitter-2', 'icon-twitter-3', 'icon-feed', 'icon-feed-2', 'icon-feed-3', 'icon-youtube', 'icon-youtube-2', 'icon-vimeo', 'icon-vimeo2', 'icon-vimeo-2', 'icon-lanyrd', 'icon-flickr', 'icon-flickr-2', 'icon-flickr-3', 'icon-flickr-4', 'icon-picassa', 'icon-picassa-2', 'icon-dribbble', 'icon-dribbble-2', 'icon-dribbble-3', 'icon-forrst', 'icon-forrst-2', 'icon-deviantart', 'icon-deviantart-2', 'icon-steam', 'icon-steam-2', 'icon-github', 'icon-github-2', 'icon-github-3', 'icon-github-4', 'icon-github-5', 'icon-wordpress', 'icon-wordpress-2', 'icon-joomla-2', 'icon-blogger', 'icon-blogger-2', 'icon-tumblr', 'icon-tumblr-2', 'icon-yahoo', 'icon-tux', 'icon-apple', 'icon-finder', 'icon-android', 'icon-windows', 'icon-windows8', 'icon-soundcloud', 'icon-soundcloud-2', 'icon-skype', 'icon-reddit', 'icon-linkedin', 'icon-lastfm', 'icon-lastfm-2', 'icon-delicious', 'icon-stumbleupon', 'icon-stumbleupon-2', 'icon-stackoverflow', 'icon-pinterest', 'icon-pinterest-2', 'icon-xing', 'icon-xing-2', 'icon-flattr', 'icon-foursquare', 'icon-foursquare-2', 'icon-paypal', 'icon-paypal-2', 'icon-paypal-3', 'icon-yelp', 'icon-libreoffice', 'icon-file-pdf', 'icon-file-openoffice', 'icon-file-word', 'icon-file-excel', 'icon-file-zip', 'icon-file-powerpoint', 'icon-file-xml', 'icon-file-css', 'icon-html5-2', 'icon-html5-3', 'icon-css3-2', 'icon-chrome-2', 'icon-firefox', 'icon-IE', 'icon-opera', 'icon-safari', 'icon-IcoMoon', 'icon-spinner-2', 'icon-spinner-3', 'icon-spinner-4', 'icon-spinner-5', 'icon-spinner-6', 'icon-spinner-7', 'icon-apple-2', 'icon-pause', 'icon-play', 'icon-next', 'icon-previous', 'icon-next-2', 'icon-previous-2', 'icon-record', 'icon-eject', 'icon-disk', 'icon-spider', 'icon-spiderman', 'icon-batman', 'icon-ironman', 'icon-darthvader', 'icon-tetrisone', 'icon-tetristwo', 'icon-tetristhree', 'icon-spaceinvaders', 'icon-chat', 'icon-pictures', 'icon-euro', 'icon-euro2', 'icon-dollar2', 'icon-dollar', 'icon-yen2', 'icon-pound2', 'icon-pound', 'icon-moneybag', 'icon-earth', 'icon-maps', 'icon-pin', 'icon-pushpin', 'icon-podcast', 'icon-connection', 'icon-feed-4', 'icon-box', 'icon-location', 'icon-location-2', 'icon-pushpin-2', 'icon-hydrant', 'icon-fort', 'icon-cannon', 'icon-dna', 'icon-greenlightbulb', 'icon-pasta', 'icon-cricket', 'icon-razor', 'icon-danger', 'icon-windleft', 'icon-windright', 'icon-infinity', 'icon-intersection', 'icon-fork', 'icon-yinyang', 'icon-screw', 'icon-nut', 'icon-nail', 'icon-stiletto', 'icon-fishbone', 'icon-bread', 'icon-chicken', 'icon-fish', 'icon-cupcake', 'icon-pizza', 'icon-cherry', 'icon-mushroom', 'icon-bone', 'icon-steak', 'icon-restaurantmenu', 'icon-bottle', 'icon-muffin', 'icon-pepperoni', 'icon-sunnysideup', 'icon-chocolate', 'icon-tea', 'icon-hotdog', 'icon-taco', 'icon-chef', 'icon-pretzel', 'icon-foodtray', 'icon-soup', 'icon-bowlingpins', 'icon-bat', 'icon-stadium', 'icon-whistle', 'icon-hockey', 'icon-carrot', 'icon-strawberry', 'icon-banana', 'icon-edit', 'icon-brush', 'icon-palette', 'icon-insertpictureleft', 'icon-insertpictureright', 'icon-insertpicturecenter', 'icon-trafficlight', 'icon-cactus', 'icon-watertap', 'icon-snow', 'icon-rain', 'icon-storm', 'icon-automobile', 'icon-navigation', 'icon-wave2', 'icon-wave', 'icon-airplane', 'icon-shipping', 'icon-roadsignleft', 'icon-bus', 'icon-rubberstamp', 'icon-briefcase3', 'icon-briefcase2', 'icon-shovel', 'icon-hammer', 'icon-screwdriver', 'icon-screwdriver2', 'icon-sunglasses', 'icon-glasses', 'icon-medal', 'icon-medalgold', 'icon-medalsilver', 'icon-medalbronze', 'icon-basketball', 'icon-tennis', 'icon-football', 'icon-americanfootball', 'icon-sword', 'icon-bow', 'icon-axe', 'icon-pingpong', 'icon-golf', 'icon-racquet', 'icon-bowling', 'icon-spades', 'icon-clubs', 'icon-diamonds', 'icon-pawn', 'icon-bishop', 'icon-rook', 'icon-knight', 'icon-king', 'icon-queen', 'icon-percent', 'icon-asterisk', 'icon-plus', 'icon-sum', 'icon-root', 'icon-minus', 'icon-book', 'icon-print', 'icon-bookmark', 'icon-flag', 'icon-qrcode', 'icon-barcode', 'icon-globe', 'icon-headphones', 'icon-phone', 'icon-phone-sign', 'icon-trash', 'icon-desklamp', 'icon-visa', 'icon-vendetta', 'icon-value', 'icon-foldertree', 'icon-gamecursor', 'icon-controllerps', 'icon-controllernes', 'icon-controllersnes', 'icon-joystickarcade', 'icon-joystickatari', 'icon-podium', 'icon-trophy', 'icon-diamond', 'icon-circles', 'icon-progress-3', 'icon-progress-2', 'icon-brogress-1', 'icon-progress-0', 'icon-cc', 'icon-volume-decrease', 'icon-volume-increase', 'icon-volume-mute', 'icon-volume-mute-2', 'icon-volume-low', 'icon-volume-medium', 'icon-volume-high', 'icon-hand-right', 'icon-hand-left', 'icon-hand-up', 'icon-hand-down', 'icon-heart-empty', 'icon-locked', 'icon-unlocked', 'icon-myspace', 'icon-reorder', 'icon-sort', 'icon-dagger', 'icon-ring', 'icon-pipe', 'icon-triangle', 'icon-cube', 'icon-box-2', 'icon-curling', 'icon-lighthouse', 'icon-helicopter', 'icon-telescope', 'icon-graduation', 'icon-fedora', 'icon-tophat', 'icon-filmstrip', 'icon-lollypop', 'icon-hearts', 'icon-caret-up', 'icon-caret-down', 'icon-sort-up', 'icon-sort-down', 'icon-caret-right', 'icon-caret-left', 'icon-arrow-left', 'icon-arrow-down', 'icon-arrow-up', 'icon-untitled', 'icon-ellipsis', 'icon-dots', 'icon-dot', 'icon-file', 'icon-list-ul', 'icon-list-ol', 'icon-save', 'icon-strikethrough', 'icon-underline', 'icon-sitemap', 'icon-umbrella', 'icon-baloon', 'icon-alienship', 'icon-tie', 'icon-pigpena', 'icon-pigpenb', 'icon-pigpenc', 'icon-pigpend', 'icon-pigpene', 'icon-pigpenf', 'icon-pigpeng', 'icon-pigpenh', 'icon-pigpeni', 'icon-pigpenj', 'icon-pigpenk', 'icon-pigpenl', 'icon-pigpenm', 'icon-pigpenn', 'icon-pigpeno', 'icon-pigpenp', 'icon-pigpenq', 'icon-pigpenr', 'icon-pigpens', 'icon-pigpent', 'icon-pigpenu', 'icon-pigpenv', 'icon-pigpenw', 'icon-pigpenx', 'icon-pigpeny', 'icon-pigpenz', 'icon-braillea', 'icon-brailleb', 'icon-braillec', 'icon-brailled', 'icon-braillee', 'icon-braillef', 'icon-brailleg', 'icon-brailleh', 'icon-braillei', 'icon-braillej', 'icon-braillek', 'icon-braillel', 'icon-braillem', 'icon-braillen', 'icon-brailleo', 'icon-braillep', 'icon-brailleq', 'icon-brailler', 'icon-brailles', 'icon-braillet', 'icon-brailleu', 'icon-braillev', 'icon-braillew', 'icon-braillex', 'icon-brailley', 'icon-braillez', 'icon-braille0', 'icon-braille1', 'icon-braille2', 'icon-braille3', 'icon-braille4', 'icon-braille5', 'icon-braille6', 'icon-braille7', 'icon-braille8', 'icon-braille9', 'icon-braillespace', 'icon-raceflag', 'icon-tictactoe', 'icon-settings2', 'icon-settings3', 'icon-settings4', 'icon-tools', 'icon-equalizer', 'icon-desktop-2', 'icon-pilcrow', 'icon-left-to-right', 'icon-right-to-left', 'icon-sigma', 'icon-omega', 'icon-table', 'icon-copy', 'icon-columns', 'icon-bookmark-empty', 'icon-envelope-alt', 'icon-fridge', 'icon-speed', 'icon-microwave', 'icon-candy', 'icon-teapot', 'icon-raspberry', 'icon-raspberrypi', 'icon-fries', 'icon-birthday', 'icon-christmastree', 'icon-snowman', 'icon-candycane', 'icon-dart', 'icon-ink', 'icon-resistor', 'icon-bag', 'icon-money-bag', 'icon-spotify', 'icon-calendar', 'icon-planet', 'icon-toiletpaper', 'icon-toothbrush', 'icon-info', 'icon-info-2', 'icon-question', 'icon-help', 'icon-warning', 'icon-trumpet', 'icon-metronome', 'icon-eightball', 'icon-uniF002', 'icon-ampersand', 'icon-bug', 'icon-coffeebean', 'icon-ram', 'icon-finder-2', 'icon-keyboard', 'icon-fourohfour', 'icon-php', 'icon-route', 'icon-nintendods', 'icon-gameboy', 'icon-peace', 'icon-lightning2', 'icon-target', 'icon-flower', 'icon-icecream', 'icon-man', 'icon-woman', 'icon-candle', 'icon-forklift', 'icon-flashlight', 'icon-hanger', 'icon-director', 'icon-fence', 'icon-lightbulb', 'icon-usb', 'icon-cord', 'icon-socket', 'icon-socket-2', 'icon-socket-3', 'icon-stats', 'icon-font-2', 'icon-text-height-2', 'icon-text-width-2', 'icon-cgi', 'icon-soundwave', 'icon-vector', 'icon-polygonlasso', 'icon-lasso', 'icon-subscript', 'icon-superscript', 'icon-network', 'icon-lan', 'icon-usb2', 'icon-usb-2', 'icon-usb-3', 'icon-treediagram', 'icon-antenna', 'icon-adobe', 'icon-bolt', 'icon-uniF005', 'icon-write', 'icon-radio', 'icon-satellite', 'icon-bomb', 'icon-mouse', 'icon-cursor', 'icon-anchor', 'icon-pie', 'icon-bars', 'icon-bars-2', 'icon-stamp', 'icon-stamp2', 'icon-stamp-2', 'icon-camera-2', 'icon-radio-checked', 'icon-radio-unchecked', 'icon-radioactive', 'icon-radio-2', 'icon-webcam', 'icon-settings5' );
	foreach ( $icomoon as $icon ) :
		add_shortcode( $icon, 't_em_shortcut_icomoon_icon' );
	endforeach;
?>
