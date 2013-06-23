/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-aries' : '&#xf3aa;',
			'icon-taurus' : '&#xf3ab;',
			'icon-gemini' : '&#xf3ac;',
			'icon-cancer' : '&#xf3ad;',
			'icon-leo' : '&#xf3ae;',
			'icon-virgo' : '&#xf3af;',
			'icon-libra' : '&#xf3b0;',
			'icon-scorpio' : '&#xf3b1;',
			'icon-sagitarius' : '&#xf3b2;',
			'icon-capricorn' : '&#xf3b3;',
			'icon-aquarius' : '&#xf3b4;',
			'icon-pisces' : '&#xf3b5;',
			'icon-circleleft' : '&#xf3c6;',
			'icon-circledown' : '&#xf3c7;',
			'icon-circleup' : '&#xf3c8;',
			'icon-circleright' : '&#xf3c9;',
			'icon-tooth' : '&#xf3de;',
			'icon-lungs' : '&#xf3df;',
			'icon-kidney' : '&#xf3e0;',
			'icon-stomach' : '&#xf3e1;',
			'icon-liver' : '&#xf3e2;',
			'icon-brain' : '&#xf3e3;',
			'icon-dieone' : '&#xf3f7;',
			'icon-dietwo' : '&#xf3f8;',
			'icon-diethree' : '&#xf3f9;',
			'icon-diefour' : '&#xf3fa;',
			'icon-diefive' : '&#xf3fb;',
			'icon-diesix' : '&#xf3fc;',
			'icon-uniF014' : '&#xf014;',
			'icon-support3' : '&#xf015;',
			'icon-html' : '&#xf068;',
			'icon-html5' : '&#xf069;',
			'icon-css3' : '&#xf06a;',
			'icon-jquery' : '&#xf06b;',
			'icon-jqueryui' : '&#xf06c;',
			'icon-magento' : '&#xf06e;',
			'icon-ajax' : '&#xf06f;',
			'icon-flashplayer' : '&#xf070;',
			'icon-python' : '&#xf071;',
			'icon-joomla' : '&#xf073;',
			'icon-mysql' : '&#xf076;',
			'icon-drupal' : '&#xf075;',
			'icon-java' : '&#xf083;',
			'icon-cplusplus' : '&#xf0b1;',
			'icon-csharp' : '&#xf0b2;',
			'icon-squarebrackets' : '&#xf0b3;',
			'icon-braces' : '&#xf0b4;',
			'icon-chevrons' : '&#xf0b5;',
			'icon-ubuntu' : '&#xf120;',
			'icon-bluetooth' : '&#xf12b;',
			'icon-sortbysizedescending' : '&#xf1c4;',
			'icon-sortbysizeascending' : '&#xf1c3;',
			'icon-sortbynamedescending' : '&#xf1c2;',
			'icon-sortbynameascending' : '&#xf1c1;',
			'icon-_0' : '&#x30;',
			'icon-_1' : '&#x31;',
			'icon-_2' : '&#x32;',
			'icon-_3' : '&#x33;',
			'icon-_4' : '&#x34;',
			'icon-_5' : '&#x35;',
			'icon-_6' : '&#x36;',
			'icon-_7' : '&#x37;',
			'icon-_8' : '&#x38;',
			'icon-_9' : '&#x39;',
			'icon-at' : '&#x40;',
			'icon-A' : '&#x41;',
			'icon-B' : '&#x42;',
			'icon-C' : '&#x43;',
			'icon-D' : '&#x44;',
			'icon-E' : '&#x45;',
			'icon-F' : '&#x46;',
			'icon-G' : '&#x47;',
			'icon-H' : '&#x48;',
			'icon-I' : '&#x49;',
			'icon-J' : '&#x4a;',
			'icon-K' : '&#x4b;',
			'icon-L' : '&#x4c;',
			'icon-M' : '&#x4d;',
			'icon-N' : '&#x4e;',
			'icon-O' : '&#x4f;',
			'icon-P' : '&#x50;',
			'icon-Q' : '&#x51;',
			'icon-R' : '&#x52;',
			'icon-S' : '&#x53;',
			'icon-T' : '&#x54;',
			'icon-U' : '&#x55;',
			'icon-V' : '&#x56;',
			'icon-W' : '&#x57;',
			'icon-X' : '&#x58;',
			'icon-Y' : '&#x59;',
			'icon-Z' : '&#x5a;',
			'icon-a' : '&#x61;',
			'icon-b' : '&#x62;',
			'icon-c' : '&#x63;',
			'icon-d' : '&#x64;',
			'icon-e' : '&#x65;',
			'icon-f' : '&#x66;',
			'icon-g' : '&#x67;',
			'icon-h' : '&#x68;',
			'icon-i' : '&#x69;',
			'icon-j' : '&#x6a;',
			'icon-k' : '&#x6b;',
			'icon-l' : '&#x6c;',
			'icon-m' : '&#x6d;',
			'icon-n' : '&#x6e;',
			'icon-o' : '&#x6f;',
			'icon-p' : '&#x70;',
			'icon-q' : '&#x71;',
			'icon-r' : '&#x72;',
			'icon-s' : '&#x73;',
			'icon-t' : '&#x74;',
			'icon-u' : '&#x75;',
			'icon-v' : '&#x76;',
			'icon-w' : '&#x77;',
			'icon-x' : '&#x78;',
			'icon-y' : '&#x79;',
			'icon-z' : '&#x7a;',
			'icon-yen' : '&#xa5;',
			'icon-copyright' : '&#xa9;',
			'icon-layout' : '&#xe038;',
			'icon-layout-2' : '&#xe037;',
			'icon-layout-3' : '&#xe03f;',
			'icon-layout-4' : '&#xe040;',
			'icon-layout-5' : '&#xe041;',
			'icon-layout-6' : '&#xe042;',
			'icon-layout-7' : '&#xe043;',
			'icon-layout-8' : '&#xe036;',
			'icon-layout-9' : '&#xe039;',
			'icon-layout-10' : '&#xe03a;',
			'icon-layout-11' : '&#xe03d;',
			'icon-layout-12' : '&#xe03c;',
			'icon-layout-13' : '&#xe03e;',
			'icon-layout-14' : '&#xe03b;',
			'icon-search' : '&#xf002;',
			'icon-envelope' : '&#xf003;',
			'icon-heart' : '&#xf004;',
			'icon-star' : '&#xf005;',
			'icon-star-empty' : '&#xf006;',
			'icon-zoom-in' : '&#xf00e;',
			'icon-zoom-out' : '&#xf010;',
			'icon-glass' : '&#xf000;',
			'icon-music' : '&#xf001;',
			'icon-off' : '&#xf011;',
			'icon-signal' : '&#xf012;',
			'icon-cog' : '&#xf013;',
			'icon-home' : '&#xe000;',
			'icon-time' : '&#xf017;',
			'icon-download-alt' : '&#xf019;',
			'icon-tag' : '&#xf02b;',
			'icon-tags' : '&#xf02c;',
			'icon-pencil' : '&#xf040;',
			'icon-font' : '&#xf031;',
			'icon-bold' : '&#xf032;',
			'icon-italic' : '&#xf033;',
			'icon-text-height' : '&#xf034;',
			'icon-text-width' : '&#xf035;',
			'icon-align-left' : '&#xf036;',
			'icon-align-center' : '&#xf037;',
			'icon-align-right' : '&#xf038;',
			'icon-align-justify' : '&#xf039;',
			'icon-list' : '&#xf03a;',
			'icon-indent-left' : '&#xf03b;',
			'icon-indent-right' : '&#xf03c;',
			'icon-picture' : '&#xf03e;',
			'icon-facetime-video' : '&#xf03d;',
			'icon-volume-up' : '&#xf028;',
			'icon-volume-down' : '&#xf027;',
			'icon-volume-off' : '&#xf026;',
			'icon-folder-close' : '&#xf07b;',
			'icon-folder-open' : '&#xf07c;',
			'icon-shopping-cart' : '&#xf07a;',
			'icon-cogs' : '&#xf085;',
			'icon-comment' : '&#xe001;',
			'icon-comments' : '&#xf086;',
			'icon-double-angle-left' : '&#xf100;',
			'icon-double-angle-right' : '&#xf101;',
			'icon-double-angle-up' : '&#xf102;',
			'icon-double-angle-down' : '&#xf103;',
			'icon-angle-left' : '&#xf104;',
			'icon-angle-right' : '&#xf105;',
			'icon-angle-up' : '&#xf106;',
			'icon-angle-down' : '&#xf107;',
			'icon-quote-left' : '&#xf10d;',
			'icon-quote-right' : '&#xf10e;',
			'icon-circle-blank' : '&#xf10c;',
			'icon-spinner' : '&#xf110;',
			'icon-circle' : '&#xf111;',
			'icon-folder-close-alt' : '&#xf114;',
			'icon-folder-open-alt' : '&#xf115;',
			'icon-desktop' : '&#xf108;',
			'icon-laptop' : '&#xf109;',
			'icon-tablet' : '&#xf10a;',
			'icon-mobile' : '&#xf10b;',
			'icon-link' : '&#xf0c1;',
			'icon-group' : '&#xf0c0;',
			'icon-user' : '&#xf007;',
			'icon-film' : '&#xf008;',
			'icon-remove' : '&#xf00d;',
			'icon-ok' : '&#xf00c;',
			'icon-th-list' : '&#xf00b;',
			'icon-th' : '&#xf00a;',
			'icon-th-large' : '&#xf009;',
			'icon-road' : '&#xf018;',
			'icon-wrench' : '&#xf0ad;',
			'icon-paper-clip' : '&#xf0c6;',
			'icon-happy' : '&#xe002;',
			'icon-happy-2' : '&#xe003;',
			'icon-smiley' : '&#xe004;',
			'icon-smiley-2' : '&#xe005;',
			'icon-tongue' : '&#xe006;',
			'icon-tongue-2' : '&#xe007;',
			'icon-sad' : '&#xe008;',
			'icon-sad-2' : '&#xe009;',
			'icon-wink' : '&#xe00a;',
			'icon-wink-2' : '&#xe00b;',
			'icon-grin' : '&#xe00c;',
			'icon-grin-2' : '&#xe00d;',
			'icon-cool' : '&#xe00e;',
			'icon-cool-2' : '&#xe00f;',
			'icon-angry' : '&#xe010;',
			'icon-angry-2' : '&#xe011;',
			'icon-evil' : '&#xe012;',
			'icon-evil-2' : '&#xe013;',
			'icon-shocked' : '&#xe014;',
			'icon-shocked-2' : '&#xe015;',
			'icon-confused' : '&#xe016;',
			'icon-confused-2' : '&#xe017;',
			'icon-neutral' : '&#xe018;',
			'icon-neutral-2' : '&#xe019;',
			'icon-wondering' : '&#xe01a;',
			'icon-wondering-2' : '&#xe01b;',
			'icon-cloud-download' : '&#xf0ed;',
			'icon-cloud' : '&#xf0c2;',
			'icon-cloud-upload' : '&#xf0ee;',
			'icon-key' : '&#xf084;',
			'icon-thumbs-up' : '&#xf087;',
			'icon-thumbs-down' : '&#xf088;',
			'icon-upload-alt' : '&#xe04c;',
			'icon-chrome' : '&#xf14e;',
			'icon-camera' : '&#xf030;',
			'icon-camera-retro' : '&#xe01c;',
			'icon-enter' : '&#xe110;',
			'icon-exit' : '&#xe111;',
			'icon-embed' : '&#xe128;',
			'icon-code' : '&#xe129;',
			'icon-console' : '&#xe12a;',
			'icon-share' : '&#xe12b;',
			'icon-mail' : '&#xe12c;',
			'icon-mail-2' : '&#xe12d;',
			'icon-mail-3' : '&#xe12e;',
			'icon-mail-4' : '&#xe12f;',
			'icon-google' : '&#xe130;',
			'icon-google-plus' : '&#xe131;',
			'icon-google-plus-2' : '&#xe132;',
			'icon-google-plus-3' : '&#xe133;',
			'icon-google-plus-4' : '&#xe134;',
			'icon-google-drive' : '&#xe135;',
			'icon-facebook' : '&#xe136;',
			'icon-facebook-2' : '&#xe137;',
			'icon-facebook-3' : '&#xe138;',
			'icon-instagram' : '&#xe139;',
			'icon-twitter' : '&#xe13a;',
			'icon-twitter-2' : '&#xe13b;',
			'icon-twitter-3' : '&#xe13c;',
			'icon-feed' : '&#xe13d;',
			'icon-feed-2' : '&#xe13e;',
			'icon-feed-3' : '&#xe13f;',
			'icon-youtube' : '&#xe140;',
			'icon-youtube-2' : '&#xe141;',
			'icon-vimeo' : '&#xe142;',
			'icon-vimeo2' : '&#xe143;',
			'icon-vimeo-2' : '&#xe144;',
			'icon-lanyrd' : '&#xe145;',
			'icon-flickr' : '&#xe146;',
			'icon-flickr-2' : '&#xe147;',
			'icon-flickr-3' : '&#xe148;',
			'icon-flickr-4' : '&#xe149;',
			'icon-picassa' : '&#xe14a;',
			'icon-picassa-2' : '&#xe14b;',
			'icon-dribbble' : '&#xe14c;',
			'icon-dribbble-2' : '&#xe14d;',
			'icon-dribbble-3' : '&#xe14e;',
			'icon-forrst' : '&#xe14f;',
			'icon-forrst-2' : '&#xe150;',
			'icon-deviantart' : '&#xe151;',
			'icon-deviantart-2' : '&#xe152;',
			'icon-steam' : '&#xe153;',
			'icon-steam-2' : '&#xe154;',
			'icon-github' : '&#xe155;',
			'icon-github-2' : '&#xe156;',
			'icon-github-3' : '&#xe157;',
			'icon-github-4' : '&#xe158;',
			'icon-github-5' : '&#xe159;',
			'icon-wordpress' : '&#xe15a;',
			'icon-wordpress-2' : '&#xe15b;',
			'icon-joomla-2' : '&#xe15c;',
			'icon-blogger' : '&#xe15d;',
			'icon-blogger-2' : '&#xe15e;',
			'icon-tumblr' : '&#xe15f;',
			'icon-tumblr-2' : '&#xe160;',
			'icon-yahoo' : '&#xe161;',
			'icon-tux' : '&#xe162;',
			'icon-apple' : '&#xe163;',
			'icon-finder' : '&#xe164;',
			'icon-android' : '&#xe165;',
			'icon-windows' : '&#xe166;',
			'icon-windows8' : '&#xe167;',
			'icon-soundcloud' : '&#xe168;',
			'icon-soundcloud-2' : '&#xe169;',
			'icon-skype' : '&#xe16a;',
			'icon-reddit' : '&#xe16b;',
			'icon-linkedin' : '&#xe16c;',
			'icon-lastfm' : '&#xe16d;',
			'icon-lastfm-2' : '&#xe16e;',
			'icon-delicious' : '&#xe16f;',
			'icon-stumbleupon' : '&#xe170;',
			'icon-stumbleupon-2' : '&#xe171;',
			'icon-stackoverflow' : '&#xe172;',
			'icon-pinterest' : '&#xe173;',
			'icon-pinterest-2' : '&#xe174;',
			'icon-xing' : '&#xe175;',
			'icon-xing-2' : '&#xe176;',
			'icon-flattr' : '&#xe177;',
			'icon-foursquare' : '&#xe178;',
			'icon-foursquare-2' : '&#xe179;',
			'icon-paypal' : '&#xe17a;',
			'icon-paypal-2' : '&#xe17b;',
			'icon-paypal-3' : '&#xe17c;',
			'icon-yelp' : '&#xe17d;',
			'icon-libreoffice' : '&#xe17e;',
			'icon-file-pdf' : '&#xe17f;',
			'icon-file-openoffice' : '&#xe180;',
			'icon-file-word' : '&#xe181;',
			'icon-file-excel' : '&#xe182;',
			'icon-file-zip' : '&#xe183;',
			'icon-file-powerpoint' : '&#xe184;',
			'icon-file-xml' : '&#xe185;',
			'icon-file-css' : '&#xe186;',
			'icon-html5-2' : '&#xe187;',
			'icon-html5-3' : '&#xe188;',
			'icon-css3-2' : '&#xe189;',
			'icon-chrome-2' : '&#xe18a;',
			'icon-firefox' : '&#xe18b;',
			'icon-IE' : '&#xe18c;',
			'icon-opera' : '&#xe18d;',
			'icon-safari' : '&#xe18e;',
			'icon-IcoMoon' : '&#xe18f;',
			'icon-spinner-2' : '&#xe0f3;',
			'icon-spinner-3' : '&#xe0f4;',
			'icon-spinner-4' : '&#xe0f5;',
			'icon-spinner-5' : '&#xe0f6;',
			'icon-spinner-6' : '&#xe0f7;',
			'icon-spinner-7' : '&#xe0f8;',
			'icon-apple-2' : '&#xe097;',
			'icon-pause' : '&#xe098;',
			'icon-play' : '&#xe099;',
			'icon-next' : '&#xe09a;',
			'icon-previous' : '&#xe09b;',
			'icon-next-2' : '&#xe09c;',
			'icon-previous-2' : '&#xe09d;',
			'icon-record' : '&#xe09e;',
			'icon-eject' : '&#xe09f;',
			'icon-disk' : '&#xe0a0;',
			'icon-spider' : '&#xf346;',
			'icon-spiderman' : '&#xf347;',
			'icon-batman' : '&#xf348;',
			'icon-ironman' : '&#xf349;',
			'icon-darthvader' : '&#xf34a;',
			'icon-tetrisone' : '&#xf34b;',
			'icon-tetristwo' : '&#xf34c;',
			'icon-tetristhree' : '&#xf34d;',
			'icon-spaceinvaders' : '&#xf352;',
			'icon-chat' : '&#xf162;',
			'icon-pictures' : '&#xe024;',
			'icon-euro' : '&#x20ac;',
			'icon-euro2' : '&#xf25a;',
			'icon-dollar2' : '&#xf259;',
			'icon-dollar' : '&#x24;',
			'icon-yen2' : '&#xf25d;',
			'icon-pound2' : '&#xf25c;',
			'icon-pound' : '&#xf25b;',
			'icon-moneybag' : '&#xf271;',
			'icon-earth' : '&#xe022;',
			'icon-maps' : '&#xf209;',
			'icon-pin' : '&#xf20a;',
			'icon-pushpin' : '&#xf08d;',
			'icon-podcast' : '&#xe023;',
			'icon-connection' : '&#xe025;',
			'icon-feed-4' : '&#xe026;',
			'icon-box' : '&#xe027;',
			'icon-location' : '&#xe028;',
			'icon-location-2' : '&#xe029;',
			'icon-pushpin-2' : '&#xe02a;',
			'icon-hydrant' : '&#xf3ff;',
			'icon-fort' : '&#xf400;',
			'icon-cannon' : '&#xf401;',
			'icon-dna' : '&#xf409;',
			'icon-greenlightbulb' : '&#xf406;',
			'icon-pasta' : '&#xf408;',
			'icon-cricket' : '&#xf418;',
			'icon-razor' : '&#xf416;',
			'icon-danger' : '&#xf415;',
			'icon-windleft' : '&#xf424;',
			'icon-windright' : '&#xf425;',
			'icon-infinity' : '&#x221e;',
			'icon-intersection' : '&#x2229;',
			'icon-fork' : '&#x22d4;',
			'icon-yinyang' : '&#x262f;',
			'icon-screw' : '&#xf426;',
			'icon-nut' : '&#xf427;',
			'icon-nail' : '&#xf428;',
			'icon-stiletto' : '&#xf429;',
			'icon-fishbone' : '&#xf42b;',
			'icon-bread' : '&#xf42f;',
			'icon-chicken' : '&#xf359;',
			'icon-fish' : '&#xf35a;',
			'icon-cupcake' : '&#xf35b;',
			'icon-pizza' : '&#xf35c;',
			'icon-cherry' : '&#xf35d;',
			'icon-mushroom' : '&#xf35e;',
			'icon-bone' : '&#xf35f;',
			'icon-steak' : '&#xf360;',
			'icon-restaurantmenu' : '&#xf362;',
			'icon-bottle' : '&#xf361;',
			'icon-muffin' : '&#xf363;',
			'icon-pepperoni' : '&#xf364;',
			'icon-sunnysideup' : '&#xf365;',
			'icon-chocolate' : '&#xf367;',
			'icon-tea' : '&#xf3cb;',
			'icon-hotdog' : '&#xf3cc;',
			'icon-taco' : '&#xf3cd;',
			'icon-chef' : '&#xf3ce;',
			'icon-pretzel' : '&#xf3cf;',
			'icon-foodtray' : '&#xf3d0;',
			'icon-soup' : '&#xf3d1;',
			'icon-bowlingpins' : '&#xf3d2;',
			'icon-bat' : '&#xf3d3;',
			'icon-stadium' : '&#xf3d6;',
			'icon-whistle' : '&#xf3d8;',
			'icon-hockey' : '&#xf3d9;',
			'icon-carrot' : '&#xf3f2;',
			'icon-strawberry' : '&#xf3f3;',
			'icon-banana' : '&#xf3f4;',
			'icon-edit' : '&#xf1b7;',
			'icon-brush' : '&#xf1b8;',
			'icon-palette' : '&#xf1b9;',
			'icon-insertpictureleft' : '&#xf1e1;',
			'icon-insertpictureright' : '&#xf1e2;',
			'icon-insertpicturecenter' : '&#xf1e3;',
			'icon-trafficlight' : '&#xf22a;',
			'icon-cactus' : '&#xf22c;',
			'icon-watertap' : '&#xf22d;',
			'icon-snow' : '&#xf22e;',
			'icon-rain' : '&#xf22f;',
			'icon-storm' : '&#xf230;',
			'icon-automobile' : '&#xf239;',
			'icon-navigation' : '&#xf23a;',
			'icon-wave2' : '&#xf23b;',
			'icon-wave' : '&#xf23c;',
			'icon-airplane' : '&#xf23e;',
			'icon-shipping' : '&#xf23f;',
			'icon-roadsignleft' : '&#xf240;',
			'icon-bus' : '&#xf241;',
			'icon-rubberstamp' : '&#xf274;',
			'icon-briefcase3' : '&#xf25f;',
			'icon-briefcase2' : '&#xf25e;',
			'icon-shovel' : '&#xf290;',
			'icon-hammer' : '&#xf291;',
			'icon-screwdriver' : '&#xf292;',
			'icon-screwdriver2' : '&#xf293;',
			'icon-sunglasses' : '&#xf294;',
			'icon-glasses' : '&#xf295;',
			'icon-medal' : '&#xf2e5;',
			'icon-medalgold' : '&#xf2e6;',
			'icon-medalsilver' : '&#xf2e7;',
			'icon-medalbronze' : '&#xf2e8;',
			'icon-basketball' : '&#xf2e9;',
			'icon-tennis' : '&#xf2ea;',
			'icon-football' : '&#xf2eb;',
			'icon-americanfootball' : '&#xf2ec;',
			'icon-sword' : '&#xf2ed;',
			'icon-bow' : '&#xf2ee;',
			'icon-axe' : '&#xf2ef;',
			'icon-pingpong' : '&#xf2f0;',
			'icon-golf' : '&#xf2f1;',
			'icon-racquet' : '&#xf2f2;',
			'icon-bowling' : '&#xf2f3;',
			'icon-spades' : '&#xf2f5;',
			'icon-clubs' : '&#xf2f6;',
			'icon-diamonds' : '&#xf2f7;',
			'icon-pawn' : '&#xf2f8;',
			'icon-bishop' : '&#xf2f9;',
			'icon-rook' : '&#xf2fa;',
			'icon-knight' : '&#xf2fb;',
			'icon-king' : '&#xf2fc;',
			'icon-queen' : '&#xf2fd;',
			'icon-percent' : '&#x25;',
			'icon-asterisk' : '&#x2a;',
			'icon-plus' : '&#x2b;',
			'icon-sum' : '&#xf33b;',
			'icon-root' : '&#xf33c;',
			'icon-minus' : '&#x2212;',
			'icon-book' : '&#xf02d;',
			'icon-print' : '&#xf02f;',
			'icon-bookmark' : '&#xf02e;',
			'icon-flag' : '&#xf024;',
			'icon-qrcode' : '&#xf029;',
			'icon-barcode' : '&#xf02a;',
			'icon-globe' : '&#xe02b;',
			'icon-headphones' : '&#xf025;',
			'icon-phone' : '&#xf095;',
			'icon-phone-sign' : '&#xf098;',
			'icon-trash' : '&#xe02c;',
			'icon-desklamp' : '&#xf412;',
			'icon-visa' : '&#xf3c2;',
			'icon-vendetta' : '&#xf3c5;',
			'icon-value' : '&#xe02d;',
			'icon-foldertree' : '&#xf0f0;',
			'icon-gamecursor' : '&#xf2d0;',
			'icon-controllerps' : '&#xf2d1;',
			'icon-controllernes' : '&#xf2d2;',
			'icon-controllersnes' : '&#xf2d3;',
			'icon-joystickarcade' : '&#xf2d4;',
			'icon-joystickatari' : '&#xf2d5;',
			'icon-podium' : '&#xf2d6;',
			'icon-trophy' : '&#xf2d7;',
			'icon-diamond' : '&#xe02e;',
			'icon-circles' : '&#xe02f;',
			'icon-progress-3' : '&#xe030;',
			'icon-progress-2' : '&#xe031;',
			'icon-brogress-1' : '&#xe032;',
			'icon-progress-0' : '&#xe033;',
			'icon-cc' : '&#xe034;',
			'icon-volume-decrease' : '&#xe035;',
			'icon-volume-increase' : '&#xe044;',
			'icon-volume-mute' : '&#xe045;',
			'icon-volume-mute-2' : '&#xe046;',
			'icon-volume-low' : '&#xe047;',
			'icon-volume-medium' : '&#xe048;',
			'icon-volume-high' : '&#xe049;',
			'icon-hand-right' : '&#xf0a4;',
			'icon-hand-left' : '&#xf0a5;',
			'icon-hand-up' : '&#xf0a6;',
			'icon-hand-down' : '&#xf0a7;',
			'icon-heart-empty' : '&#xf08a;',
			'icon-locked' : '&#xe04a;',
			'icon-unlocked' : '&#xe04b;',
			'icon-myspace' : '&#xf153;',
			'icon-reorder' : '&#xf0c9;',
			'icon-sort' : '&#xf0dc;',
			'icon-dagger' : '&#x2020;',
			'icon-ring' : '&#x2da;',
			'icon-pipe' : '&#x1c0;',
			'icon-triangle' : '&#x25b3;',
			'icon-cube' : '&#xe04e;',
			'icon-box-2' : '&#xe04f;',
			'icon-curling' : '&#xf3d7;',
			'icon-lighthouse' : '&#xf3e6;',
			'icon-helicopter' : '&#xf3e4;',
			'icon-telescope' : '&#xf3ef;',
			'icon-graduation' : '&#xe050;',
			'icon-fedora' : '&#xf3f1;',
			'icon-tophat' : '&#xf3f0;',
			'icon-filmstrip' : '&#xf3ed;',
			'icon-lollypop' : '&#xf3ee;',
			'icon-hearts' : '&#xf2f4;',
			'icon-caret-up' : '&#xf0d8;',
			'icon-caret-down' : '&#xf0d7;',
			'icon-sort-up' : '&#xf0de;',
			'icon-sort-down' : '&#xf0dd;',
			'icon-caret-right' : '&#xf0da;',
			'icon-caret-left' : '&#xf0d9;',
			'icon-arrow-left' : '&#xe051;',
			'icon-arrow-down' : '&#xe052;',
			'icon-arrow-up' : '&#xe053;',
			'icon-untitled' : '&#xe054;',
			'icon-ellipsis' : '&#xe055;',
			'icon-dots' : '&#xe056;',
			'icon-dot' : '&#xe057;',
			'icon-file' : '&#xf016;',
			'icon-list-ul' : '&#xf0ca;',
			'icon-list-ol' : '&#xf0cb;',
			'icon-save' : '&#xf0c7;',
			'icon-strikethrough' : '&#xf0cc;',
			'icon-underline' : '&#xf0cd;',
			'icon-sitemap' : '&#xf0e8;',
			'icon-umbrella' : '&#xf0e9;',
			'icon-baloon' : '&#xf405;',
			'icon-alienship' : '&#xf41f;',
			'icon-tie' : '&#x2040;',
			'icon-pigpena' : '&#xf456;',
			'icon-pigpenb' : '&#xf457;',
			'icon-pigpenc' : '&#xf458;',
			'icon-pigpend' : '&#xf459;',
			'icon-pigpene' : '&#xf45a;',
			'icon-pigpenf' : '&#xf45b;',
			'icon-pigpeng' : '&#xf45c;',
			'icon-pigpenh' : '&#xf45d;',
			'icon-pigpeni' : '&#xf45e;',
			'icon-pigpenj' : '&#xf45f;',
			'icon-pigpenk' : '&#xf460;',
			'icon-pigpenl' : '&#xf461;',
			'icon-pigpenm' : '&#xf462;',
			'icon-pigpenn' : '&#xf463;',
			'icon-pigpeno' : '&#xf464;',
			'icon-pigpenp' : '&#xf465;',
			'icon-pigpenq' : '&#xf466;',
			'icon-pigpenr' : '&#xf467;',
			'icon-pigpens' : '&#xf468;',
			'icon-pigpent' : '&#xf469;',
			'icon-pigpenu' : '&#xf46a;',
			'icon-pigpenv' : '&#xf46b;',
			'icon-pigpenw' : '&#xf46c;',
			'icon-pigpenx' : '&#xf46d;',
			'icon-pigpeny' : '&#xf46e;',
			'icon-pigpenz' : '&#xf46f;',
			'icon-braillea' : '&#xf431;',
			'icon-brailleb' : '&#xf432;',
			'icon-braillec' : '&#xf433;',
			'icon-brailled' : '&#xf434;',
			'icon-braillee' : '&#xf435;',
			'icon-braillef' : '&#xf436;',
			'icon-brailleg' : '&#xf437;',
			'icon-brailleh' : '&#xf438;',
			'icon-braillei' : '&#xf439;',
			'icon-braillej' : '&#xf43a;',
			'icon-braillek' : '&#xf43b;',
			'icon-braillel' : '&#xf43c;',
			'icon-braillem' : '&#xf43d;',
			'icon-braillen' : '&#xf43e;',
			'icon-brailleo' : '&#xf43f;',
			'icon-braillep' : '&#xf440;',
			'icon-brailleq' : '&#xf441;',
			'icon-brailler' : '&#xf442;',
			'icon-brailles' : '&#xf443;',
			'icon-braillet' : '&#xf444;',
			'icon-brailleu' : '&#xf445;',
			'icon-braillev' : '&#xf446;',
			'icon-braillew' : '&#xf447;',
			'icon-braillex' : '&#xf448;',
			'icon-brailley' : '&#xf449;',
			'icon-braillez' : '&#xf44a;',
			'icon-braille0' : '&#xf44b;',
			'icon-braille1' : '&#xf44c;',
			'icon-braille2' : '&#xf44d;',
			'icon-braille3' : '&#xf44e;',
			'icon-braille4' : '&#xf44f;',
			'icon-braille5' : '&#xf450;',
			'icon-braille6' : '&#xf451;',
			'icon-braille7' : '&#xf452;',
			'icon-braille8' : '&#xf453;',
			'icon-braille9' : '&#xf454;',
			'icon-braillespace' : '&#xf455;',
			'icon-raceflag' : '&#xf38e;',
			'icon-tictactoe' : '&#xf39a;',
			'icon-settings2' : '&#xf306;',
			'icon-settings3' : '&#xf307;',
			'icon-settings4' : '&#xf308;',
			'icon-tools' : '&#xe058;',
			'icon-equalizer' : '&#xe059;',
			'icon-desktop-2' : '&#xe05a;',
			'icon-pilcrow' : '&#xe05b;',
			'icon-left-to-right' : '&#xe05c;',
			'icon-right-to-left' : '&#xe05d;',
			'icon-sigma' : '&#xe05e;',
			'icon-omega' : '&#xe05f;',
			'icon-table' : '&#xf0ce;',
			'icon-copy' : '&#xf0c5;',
			'icon-columns' : '&#xf0db;',
			'icon-bookmark-empty' : '&#xf097;',
			'icon-envelope-alt' : '&#xf0e0;',
			'icon-fridge' : '&#xf40d;',
			'icon-speed' : '&#xf40b;',
			'icon-microwave' : '&#xf42e;',
			'icon-candy' : '&#xf42d;',
			'icon-teapot' : '&#xf42c;',
			'icon-raspberry' : '&#xf368;',
			'icon-raspberrypi' : '&#xf369;',
			'icon-fries' : '&#xf36a;',
			'icon-birthday' : '&#xf36b;',
			'icon-christmastree' : '&#xf37b;',
			'icon-snowman' : '&#xf37c;',
			'icon-candycane' : '&#xf37d;',
			'icon-dart' : '&#xf3d4;',
			'icon-ink' : '&#xf3f6;',
			'icon-resistor' : '&#xf3eb;',
			'icon-bag' : '&#xe04d;',
			'icon-money-bag' : '&#xe060;',
			'icon-spotify' : '&#xe061;',
			'icon-calendar' : '&#xe062;',
			'icon-planet' : '&#xe063;',
			'icon-toiletpaper' : '&#xf384;',
			'icon-toothbrush' : '&#xf385;',
			'icon-info' : '&#xe064;',
			'icon-info-2' : '&#xe065;',
			'icon-question' : '&#xe066;',
			'icon-help' : '&#xe067;',
			'icon-warning' : '&#xe068;',
			'icon-trumpet' : '&#xf375;',
			'icon-metronome' : '&#xf374;',
			'icon-eightball' : '&#xf36e;',
			'icon-uniF002' : '&#xe01d;',
			'icon-ampersand' : '&#xe01e;',
			'icon-bug' : '&#xe01f;',
			'icon-coffeebean' : '&#xf366;',
			'icon-ram' : '&#xe020;',
			'icon-finder-2' : '&#xf398;',
			'icon-keyboard' : '&#xe021;',
			'icon-fourohfour' : '&#xf09d;',
			'icon-php' : '&#xf09c;',
			'icon-route' : '&#xf402;',
			'icon-nintendods' : '&#xf404;',
			'icon-gameboy' : '&#xf403;',
			'icon-peace' : '&#xf2a7;',
			'icon-lightning2' : '&#xf2a8;',
			'icon-target' : '&#xf2a6;',
			'icon-flower' : '&#xf2a5;',
			'icon-icecream' : '&#xf2a4;',
			'icon-man' : '&#xf2a2;',
			'icon-woman' : '&#xf2a1;',
			'icon-candle' : '&#xf29a;',
			'icon-forklift' : '&#xf29b;',
			'icon-flashlight' : '&#xf299;',
			'icon-hanger' : '&#xf2ab;',
			'icon-director' : '&#xf2ae;',
			'icon-fence' : '&#xf2af;',
			'icon-lightbulb' : '&#xf0eb;',
			'icon-usb' : '&#xe069;',
			'icon-cord' : '&#xe06a;',
			'icon-socket' : '&#xe06b;',
			'icon-socket-2' : '&#xe06c;',
			'icon-socket-3' : '&#xe06d;',
			'icon-stats' : '&#xe06e;',
			'icon-font-2' : '&#xe06f;',
			'icon-text-height-2' : '&#xe070;',
			'icon-text-width-2' : '&#xe071;',
			'icon-cgi' : '&#xe072;',
			'icon-soundwave' : '&#xf194;',
			'icon-vector' : '&#xf1b6;',
			'icon-polygonlasso' : '&#xf397;',
			'icon-lasso' : '&#xf396;',
			'icon-subscript' : '&#xf1ea;',
			'icon-superscript' : '&#xf1eb;',
			'icon-network' : '&#xe073;',
			'icon-lan' : '&#xe074;',
			'icon-usb2' : '&#xe075;',
			'icon-usb-2' : '&#xe076;',
			'icon-usb-3' : '&#xe077;',
			'icon-treediagram' : '&#xf0ec;',
			'icon-antenna' : '&#xf3ec;',
			'icon-adobe' : '&#xf1c9;',
			'icon-bolt' : '&#xf0e7;',
			'icon-uniF005' : '&#xe078;',
			'icon-write' : '&#xf1c5;',
			'icon-radio' : '&#xe079;',
			'icon-satellite' : '&#xe07a;',
			'icon-bomb' : '&#xe07b;',
			'icon-mouse' : '&#xe07c;',
			'icon-cursor' : '&#xe07d;',
			'icon-anchor' : '&#xe07e;',
			'icon-pie' : '&#xe07f;',
			'icon-bars' : '&#xe080;',
			'icon-bars-2' : '&#xe081;',
			'icon-stamp' : '&#xf242;',
			'icon-stamp2' : '&#xf243;',
			'icon-stamp-2' : '&#xe082;',
			'icon-camera-2' : '&#xe083;',
			'icon-radio-checked' : '&#xe084;',
			'icon-radio-unchecked' : '&#xe085;',
			'icon-radioactive' : '&#xf282;',
			'icon-radio-2' : '&#xf1a1;',
			'icon-webcam' : '&#xf0fe;',
			'icon-settings5' : '&#xf309;',
			'icon-eye-open' : '&#xe086;',
			'icon-eye-close' : '&#xe087;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};