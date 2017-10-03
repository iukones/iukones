<?php
// Theme Specific Settings

// Content Width
	if ( ! isset( $content_width ) )
	$content_width = 990; /* pixels */


// Custom Backgrounds
function themefurnace_register_custom_background() {
	$args = array(
		'default-color' => '#ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'themefurnace_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_theme_support( 'custom-background');
	}
}
add_action( 'after_setup_theme', 'themefurnace_register_custom_background' );


function load_theme_fonts() {
    $heading = get_theme_mod('google_fonts_heading_font');
    $body = get_theme_mod('google_fonts_body_font');
    if((!empty($heading) && $heading != 'none') || (!empty($body) && $body != 'none')) {
        echo '<style type="text/css">';
        $imports = array();
        $styles = array();
        if(!empty($heading) && $heading != 'none') {
            $imports[] = '@import url(//fonts.googleapis.com/css?family='.urlencode($heading).');';
            $styles[] = 'h1, h2, h3, h4, h5, h6 { font-family: "'.$heading.'" !important }';
        }
        if(!empty($body) && $body != 'none') {
            $imports[] = '@import url(//fonts.googleapis.com/css?family='.urlencode($body).');';
            $styles[] = 'body { font-family: "'.$body.'" !important }';
        }

        echo implode("\r\n", $imports);
        echo implode("\r\n", $styles);
        echo '</style>';

    }
}

// load colors
function load_theme_colors() {
    $backgroundColor = get_theme_mod('background_color', '#ffffff;');
	$headerColor = get_theme_mod('header_color', '#ffffff;');
	$accentColor = get_theme_mod('accent_color', '#FFD200;');
	$textColor = get_theme_mod('text_color', '#999999;');
	$headingsColor = get_theme_mod('headings_color', '#31373b;');
	$linkColor = get_theme_mod('link_color', '#8fb9d4;');
	$footerColor = get_theme_mod('footer_color', '#0A0A08;');
    $sidebarLinkColor = get_theme_mod('sidebar_link_color', '#8fb9d4;');
	$sidebarHeadingColor = get_theme_mod('sidebar_heading_color', '#ffffff;');

    echo '<style type="text/css">';

    if(!empty($backgroundColor)) {
        $hash = '';
        if(strpos($backgroundColor, '#') === false) {
            $hash = '#';
        }
        echo 'body { background-color: '.$hash.$backgroundColor.'}';
    }

    if(!empty($headerColor)) {
        $hash = '';
        if(strpos($headerColor, '#') === false) {
            $hash = '#';
        }
        echo '#header { background-color: '.$hash.$headerColor.'}';
    }

    if(!empty($linkColor)) {
        $hash = '';
        if(strpos($linkColor, '#') === false) {
            $hash = '#';
        }
        echo ' a { color: '.$hash.$linkColor.'}';
    }

    if(!empty($sidebarLinkColor)) {
        $hash = '';
        if(strpos($sidebarLinkColor, '#') === false) {
            $hash = '#';
        }
        echo ' #sidebar a:not(:hover) { color: '.$hash.$sidebarLinkColor.'}';
    }

    if(!empty($sidebarHeadingColor)) {
        $hash = '';
        if(strpos($sidebarHeadingColor, '#') === false) {
            $hash = '#';
        }
        echo '#sidebar h1, #sidebar h2, #sidebar h3, #sidebar h4, #sidebar h5, #sidebar h6 { color: '.$hash.$sidebarHeadingColor.'}';
    }
	

    if(!empty($accentColor)) {
        $hash = '';
        if(strpos($accentColor, '#') === false) {
            $hash = '#';
        }
		echo '#main-nav ul ul li a:hover, #slider { border-color: '.$hash.$accentColor.'}';
		echo '.portfoliooverlay span, .socialicon, .itemoverlay:before,  a.button, .button, button, html input[type="button"], input[type="reset"]{ background-color: '.$hash.$accentColor.'}';
        echo '.featureicon a { color: '.$hash.$accentColor.'!important}';
    }
	
	if(!empty($textColor)) {
        $hash = '';
        if(strpos($textColor, '#') === false) {
            $hash = '#';
        }
		echo 'body, .feature p { color: '.$hash.$textColor.'}';
    }
	
	if(!empty($headingsColor)) {
        $hash = '';
        if(strpos($headingsColor, '#') === false) {
            $hash = '#';
        }
		echo 'h1,h2,h3,h4,h5,h6, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6, blockquote, .posttitle, .posttitle a { color: '.$hash.$headingsColor.' }';
    }

    if(!empty($footerColor)) {
        $hash = '';
        if(strpos($footerColor, '#') === false) {
            $hash = '#';
        }
		echo '#footer { background-color: '.$hash.$footerColor.'}';
    }

    echo '</style>';
}

function load_slide_backgrounds() {
    echo '<style type="text/css">';
    $quote_background = get_theme_mod('quote_background', '');
    $testimonial_background = get_theme_mod('testimonial_background', '');

    if(!empty($quote_background)) {
        echo '#quote { background-image: url('.$quote_background.'); }';
    }

    if(!empty($testimonial_background)) {
        echo '#testimonial { background-image: url('.$testimonial_background.'); }';
    }

    echo '</style>';
}