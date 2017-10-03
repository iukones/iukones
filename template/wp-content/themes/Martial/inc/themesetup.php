<?php

function martial_load_theme_fonts()
{
	$heading = get_theme_mod( 'martial_google_fonts_heading_font' );
	$body = get_theme_mod( 'martial_google_fonts_body_font' );
	if ( ( !empty( $heading ) && $heading != 'none' ) || ( !empty( $body ) && $body != 'none' ) ) {
		echo '<style type="text/css">';
		$styles = array();
		if ( !empty( $heading ) && $heading != 'none' ) {
			$styles[] = 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { font-family: "' . esc_attr( $heading ) . '" !important }';
		}
		if ( !empty( $body ) && $body != 'none' ) {
			$styles[] = 'div:not(#wpadminbar) > *:not(.fa), .profile_cont *:not(.fa), .postmeta *:not(.fa) { font-family: "' . esc_attr( $body ) . '" !important }';
		}

		echo implode( "\r\n", $styles );
		echo '</style>';

	}
}

add_action( 'wp_head', 'martial_load_theme_fonts' );

function martial_load_theme_styles()
{

	$hero_image_bg = get_theme_mod( 'martial_hero_bg_image' );
	$main_link_color = get_theme_mod( 'martial_link_color', '#000' );
	$main_titles_color = get_theme_mod( 'martial_title_color', '#262626' );
	$main_text_color = get_theme_mod( 'martial_text_color', '#868686' );
	$footer_titles_color = get_theme_mod( 'martial_footer_title_color', '#fff' );
	$footer_link_color = get_theme_mod( 'martial_footer_link_color', '#a0a0a0' );
	$footer_text_color = get_theme_mod( 'martial_footer_text_color', '#ababab' );
	$footer_bg_color = get_theme_mod( 'martial_footer_bg_color', '#222528' );
	$accent_color = get_theme_mod( 'martial_accent_color', '#5dc093' );
	$content_border_color = get_theme_mod( 'martial_content_border_color', '#e0e0e2' );
	$content_bar_text_color = get_theme_mod( 'martial_content_bar_text_color', '#b1b0b1' );
	$content_bar_bg_color = get_theme_mod( 'martial_content_bar_bg_color', '#f6f6f6' );
	$content_bg_color = get_theme_mod( 'martial_content_bg_color', '#fff' );
	$hero_link_color = get_theme_mod( 'martial_hero_link_color', '#fff' );
	$hero_text_color = get_theme_mod( 'martial_hero_text_color', '#d3d3d3' );
	$hero_title_color = get_theme_mod( 'martial_hero_title_color', '#fdfdfe' );
	$hero_bg_color = get_theme_mod( 'martial_hero_bg_color', '#2d333b' );
	$top_bar_link_color = get_theme_mod( 'martial_top_bar_link_color', '#bfbfbf' );
	$top_bar_text_color = get_theme_mod( 'martial_top_bar_text_color', '#f6f6f6' );
	$top_bar_bg_color = get_theme_mod( 'martial_top_bar_color', '#222428' );
	$hero_button1_bg_color = get_theme_mod( 'martial_hero_button1_bg_color', '#9c9a96' );
	$hero_button1_text_color = get_theme_mod( 'martial_hero_button1_text_color', '#ffffff' );
	$hero_button2_bg_color = get_theme_mod( 'martial_hero_button2_bg_color', '#5dc093' );
	$hero_button2_text_color = get_theme_mod( 'martial_hero_button2_text_color', '#ffffff' );
	$hero_blur = get_theme_mod( 'martial_hero_blur_enabled', '0px' );
	$hero_overlay_color = get_theme_mod( 'martial_hero_overlay_color', '#ffffff' );
	$hero_overlay_opacity = get_theme_mod( 'martial_hero_overlay_opacity', 30 );


	echo '<style>';
	// hero banner image
	echo '.banner-bg { background-image: ' . ( $hero_image_bg ? 'url(' . $hero_image_bg . ')' : 'none' ) . '}';

	// hero blur
	echo '.banner-bg { filter: blur(' . $hero_blur . 'px); -webkit-filter: blur(' . $hero_blur . 'px); }';

	// hero overlay color and opacity
	echo '.banner-bg-overlay { background-color: ' . $hero_overlay_color . '; opacity: ' . ( $hero_overlay_opacity / 100 ) . '}';

	// COLORS:
	// main link
	echo '.content a:not(.read_more), #comments a, #respond a { color: ' . $main_link_color . '; }';

	// main titles
	echo '.main_content h1, .main_content h2, .main_content h3, .main_content h4, .main_content h5, .block_cont_in h5, .main_content h1 a, .main_content h2 a, .main_content h3 a, .main_content h4 a, .main_content h5 a, .block_cont_in h5 a, .author h5, .sidebarwidget h5, .search_sec h5, .profile_cont h6 a { color: ' . $main_titles_color . ';}';

	// main text
	echo 'body .main_content, #responder, #comments, .author p { color: ' . $main_text_color . '; }';

	// footer titles
	echo '.footer_blocks ul li h4 { color: ' . $footer_titles_color . ';}';

	// footer links
	echo '#footer a, .footer_logo a { color: ' . $footer_link_color . ';}';

	// footer text
	echo '#footer, .footer_logo p { color: ' . $footer_text_color . ';}';

	// footer bg
	echo '#footer { background-color: ' . $footer_bg_color . ';}';

	// accent
	echo '.search input.submit, #respond .submit, .tab_head li.active, .banner_left a.contact:not(:hover), .read_more, .pagination a:not(:hover), .pagination span { background-color: ' . $accent_color . '; color: #fff;}';
	echo '.tab_head li:hover, .nav-links a:hover { background-color: ' . $accent_color . ';}';
	echo '.postmeta li a:hover, .banner_left a:hover { color: ' . $accent_color . ';}';
	echo '.block_cont_in ul li .fa, .profile_cont .fa { color: ' . $accent_color . ';}';
	echo '.banner_left p a { border-color: ' . $accent_color . ';}';
	echo '.pagination a:hover, #respond .submit:hover,  {background: #fff; color: ' . $accent_color . '; border-color: ' . $accent_color . ';}';

	// content border
	echo '#comments, #responder, .comments-title, .sidebarwidget, .tab_sec, .search_sec, .block_cont, .reply, #reply-title, #comment { border-color: ' . $content_border_color . ';}';
	echo '#sidebar .author ul { background-color: ' . $content_border_color . ';}';

	// content bar text
	echo '.postmeta ul li p, .postmeta ul li p a:not(:hover), .profile_cont p small, .profile_cont p a:not(:hover) { color: ' . $content_bar_text_color . ';}';

	// content bar meta bg
	echo '.postmeta ul { background-color: ' . $content_bar_bg_color . ';}';

	// content bg
	echo '.block_cont, #sidebar > div, #comments, #responder { background-color: ' . $content_bg_color . ';}';

	// hero link
	echo '.banner .banner_left ul li a:not(:hover) .fa, .banner .banner_left .text a:not(:hover) {color: ' . $hero_link_color . ';}';

	// hero text
	echo '.banner .banner_left p { color: ' . $hero_text_color . ';}';

	// hero title
	echo '.banner .banner_left h1 {color: ' . $hero_title_color . '}';

	// hero bg color
	echo '.banner{background-color: ' . $hero_bg_color . ';}';

	// hero button 1 bg
	echo '.banner .text .about:not(.contact) {background-color: ' . $hero_button1_bg_color . '}';

	// hero button 1 text
	echo '.banner .text .about:not(.contact) {color: ' . $hero_button1_text_color . ' !important}';

	// hero button 2 bg
	echo '.banner .text .contact {background-color: ' . $hero_button2_bg_color . '}';

	// hero button 2 text
	echo '.banner .text .contact {color: ' . $hero_button2_text_color . ' !important}';

	// top bar links
	echo '.wrapper header #cssmenu > ul > li > a:not(:hover), #cssmenu .menu > ul > li > a:not(:hover) {color: ' . $top_bar_link_color . ' !important;}';

	// top bar text
	echo '.wrapper header .header-logo, #tagline {color: ' . $top_bar_text_color . '}';

	// top bar bg
	echo '.wrapper header {background-color: ' . $top_bar_bg_color . ';}';

	echo '</style>';
}

add_action( 'wp_head', 'martial_load_theme_styles' );