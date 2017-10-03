<?php
/**
 * Martial Theme Customizer
 *
 * @package martial
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function martial_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	function martial_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function martial_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'martial_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function martial_customize_preview_js()
{
	wp_enqueue_script( 'martial_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130514', true );
}

add_action( 'customize_preview_init', 'martial_customize_preview_js' );

function martial_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function martial_sanitize_int( $value )
{
	return (int)$value;
}

function martial_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'martial_homepage', array(
		'title'    => __( 'Homepage Setup', 'martial' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'martial_site_identity', array(
		'title'    => __( 'Site Identity', 'martial' ),
		'priority' => 10,
	) );

	// move "site identity" to a panel first
	$wp_customize->add_section( 'title_tagline', array(
		'title'    => __( 'Title and Tagline', 'martial' ),
		'priority' => 50,
		'panel'    => 'martial_site_identity',
	) );

	// header logo
	$wp_customize->add_section( 'martial_header_logo', array(
		'title'    => __( 'Header logo', 'martial' ),
		'priority' => 50,
		'panel'    => 'martial_site_identity',
	) );

	$wp_customize->add_setting( 'martial_header_logo_show', array(
		'default'           => 'text',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'martial' ),
		'section'  => 'martial_header_logo',
		'settings' => 'martial_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'martial' ), 'text' => __( 'Text', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'martial_header_logo_image', array(
		'label'    => __( 'Header logo image', 'martial' ),
		'section'  => 'martial_header_logo',
		'settings' => 'martial_header_logo_image',
	) ) );
	// end header logo

	// hero banner
	$wp_customize->add_section( 'martial_hero', array(
		'title'       => __( 'Hero Banner', 'martial' ),
		'priority'    => 50,
		'description' => __( 'Big banner section on the front page - background image', 'martial' ),
		'panel'       => 'martial_homepage',
	) );

	$wp_customize->add_setting( 'martial_hero_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_hero_show', array(
		'label'    => __( 'Show hero banner', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_hero_hide_on_inner_pages', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_hero_hide_on_inner_pages', array(
		'label'    => __( 'Hide hero banner on inner pages', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_hide_on_inner_pages',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/hero-bg.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'martial_hero_bg_image', array(
		'label'    => __( 'Background image', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'martial_hero_title', array(
		'default'           => __( 'Hi, I\'m the Martial Theme for WordPress', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_hero_title', array(
		'label'   => __( 'Title', 'martial' ),
		'section' => 'martial_hero',
	) );

	$wp_customize->add_setting( 'martial_hero_text', array(
		'default'           => '<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing</a> elit. Praesent vel interdum diam, in ultricies diam. Proin vehicula sagittis lorem, nec.</p>
<a href="#" class="about">About us</a>
<a href="#" class="about contact">Contact us</a>',
		'sanitize_callback' => 'martial_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_text', array(
		'label'    => __( 'Main text', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'martial_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_hero_button1_show', array(
		'label'    => __( 'Show button 1', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_hero_button1_text', array(
		'default'           => __( 'About us', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_button1_text', array(
		'label'    => __( 'Button 1 text', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'martial_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_button1_link', array(
		'label'    => __( 'Button 1 link', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'martial_hero_button1_bg_color', array(
		'default'           => '#9c9a96',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button1_bg', array(
		'label'    => __( 'Button 1 background color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button1_bg_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_button1_text_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button1_text', array(
		'label'    => __( 'Button 1 text color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button1_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_hero_button2_show', array(
		'label'    => __( 'Show button 2', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_hero_button2_text', array(
		'default'           => __( 'Contact', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_button2_text', array(
		'label'    => __( 'Button 2 text', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'martial_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_button2_link', array(
		'label'    => __( 'Button 2 link', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'martial_hero_button2_bg_color', array(
		'default'           => '#5dc093',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button2_bg', array(
		'label'    => __( 'Button 2 background color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button2_bg_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_button2_text_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_button2_text', array(
		'label'    => __( 'Button 2 text color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_button2_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'martial_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_blur_enabled', array(
		'label'    => __( 'Blur amount (pixels)', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'martial_hero_overlay_enabled', array(
		'default'           => 'no',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_hero_overlay_enabled', array(
		'label'    => __( 'Overlay the image with color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_hero_overlay_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => __( 'Hero image overlay color', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'martial_hero_overlay_opacity', array(
		'default'           => '30',
		'sanitize_callback' => 'martial_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'martial_hero_overlay_opacity', array(
		'label'    => __( 'Overlay opacity (between 0 and 100)', 'martial' ),
		'section'  => 'martial_hero',
		'settings' => 'martial_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner

	// social
	$wp_customize->add_section( 'martial_header_social', array(
		'title'    => __( 'Social', 'martial' ),
		'priority' => 50,
		'panel'    => 'martial_homepage',
	) );
	$wp_customize->add_setting( 'martial_header_social_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_header_social_show', array(
		'label'    => __( 'Show social icons below the hero banner text', 'martial' ),
		'section'  => 'martial_header_social',
		'settings' => 'martial_header_social_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_header_social_twitter', array(
		'default'           => __( 'http://twitter.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_twitter', array(
		'label'   => __( 'Twitter URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_facebook', array(
		'default'           => __( 'http://facebook.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_facebook', array(
		'label'   => __( 'Facebook URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_pinterest', array(
		'default'           => __( 'http://pinterest.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_pinterest', array(
		'label'   => __( 'Pinterest URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_linkedin', array(
		'default'           => __( 'http://linkedin.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_gplus', array(
		'default'           => __( 'http://plus.google.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_gplus', array(
		'label'   => __( 'Google+ URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_behance', array(
		'default'           => __( 'http://behance.net', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_behance', array(
		'label'   => __( 'Behance URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_flickr', array(
		'default'           => __( 'http://flickr.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_flickr', array(
		'label'   => __( 'Flickr URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_500px', array(
		'default'           => __( 'http://500px.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_500px', array(
		'label'   => __( '500px URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_reddit', array(
		'default'           => __( 'http://reddit.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_reddit', array(
		'label'   => __( 'Reddit URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_wordpress', array(
		'default'           => __( 'http://wordpress.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_wordpress', array(
		'label'   => __( 'Wordpress URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_youtube', array(
		'default'           => __( 'http://youtube.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_youtube', array(
		'label'   => __( 'Youtube URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_soundcloud', array(
		'default'           => __( 'http://soundcloud.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_soundcloud', array(
		'label'   => __( 'Soundcloud URL', 'martial' ),
		'section' => 'martial_header_social',
	) );

	$wp_customize->add_setting( 'martial_header_social_medium', array(
		'default'           => __( 'http://medium.com', 'martial' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'martial_header_social_medium', array(
		'label'   => __( 'Medium URL', 'martial' ),
		'section' => 'martial_header_social',
	) );
	// end social

	// footer logo
	$wp_customize->add_section( 'martial_footer_logo', array(
		'title'    => __( 'Footer logo', 'martial' ),
		'priority' => 50,
		'panel'    => 'martial_site_identity',
	) );

	$wp_customize->add_setting( 'martial_footer_logo_show', array(
		'default'           => 'no',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'martial' ),
		'section'  => 'martial_footer_logo',
		'settings' => 'martial_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'martial' ), 'no' => __( 'No', 'martial' ) ),
	) );

	$wp_customize->add_setting( 'martial_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/footer_logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'martial_footer_logo_image', array(
		'label'    => __( 'Footer logo image', 'martial' ),
		'section'  => 'martial_footer_logo',
		'settings' => 'martial_footer_logo_image',
	) ) );
	// end footer logo

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'martial_google_fonts', array(
		'title'    => __( 'Fonts', 'martial' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'martial_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'martial' ),
		'section'  => 'martial_google_fonts',
		'settings' => 'martial_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'martial_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'martial_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'martial' ),
		'section'  => 'martial_google_fonts',
		'settings' => 'martial_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'martial_top_bar_color', array(
		'default'           => '#222428',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar', array(
		'label'    => __( 'Top bar color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_top_bar_color',
	) ) );

	$wp_customize->add_setting( 'martial_top_bar_text_color', array(
		'default'           => '#f6f6f6',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_text', array(
		'label'    => __( 'Top bar text color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_top_bar_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_top_bar_link_color', array(
		'default'           => '#bfbfbf',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_bar_link', array(
		'label'    => __( 'Top bar link color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_top_bar_link_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_bg_color', array(
		'default'           => '#2d333b',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_bg', array(
		'label'    => __( 'Hero background color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_hero_bg_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_title_color', array(
		'default'           => '#fdfdfe',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_title', array(
		'label'    => __( 'Hero title color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_hero_title_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_text_color', array(
		'default'           => '#d3d3d3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text', array(
		'label'    => __( 'Hero text color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_hero_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_hero_link_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_link', array(
		'label'    => __( 'Hero link color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_hero_link_color',
	) ) );

	$wp_customize->add_setting( 'martial_content_bg_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_bg', array(
		'label'    => __( 'Content background color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_content_bg_color',
	) ) );

//	$wp_customize->add_setting( 'martial_content_text_color', array(
//		'default'           => '#868686',
//		'type'              => 'theme_mod',
//		'capability'        => 'edit_theme_options',
//		'transport'         => 'postMessage',
//		'sanitize_callback' => 'martial_sanitize_color_hex',
//	) );
//
//	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_text', array(
//		'label'    => __( 'Content text color', 'martial' ),
//		'section'  => 'colors',
//		'settings' => 'martial_content_text_color',
//	) ) );

//	$wp_customize->add_setting( 'martial_content_link_color', array(
//		'default'           => '#000000',
//		'type'              => 'theme_mod',
//		'capability'        => 'edit_theme_options',
//		'transport'         => 'postMessage',
//		'sanitize_callback' => 'martial_sanitize_color_hex',
//	) );
//
//	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_link', array(
//		'label'    => __( 'Content link color', 'martial' ),
//		'section'  => 'colors',
//		'settings' => 'martial_content_link_color',
//	) ) );

//	$wp_customize->add_setting( 'martial_content_heading_color', array(
//		'default'           => '#000000',
//		'type'              => 'theme_mod',
//		'capability'        => 'edit_theme_options',
//		'transport'         => 'postMessage',
//		'sanitize_callback' => 'martial_sanitize_color_hex',
//	) );
//
//	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_heading', array(
//		'label'    => __( 'Content headings color', 'martial' ),
//		'section'  => 'colors',
//		'settings' => 'martial_content_heading_color',
//	) ) );

	$wp_customize->add_setting( 'martial_content_bar_bg_color', array(
		'default'           => '#f6f6f6',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_bar_bg', array(
		'label'    => __( 'Content bar background color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_content_bar_bg_color',
	) ) );

	$wp_customize->add_setting( 'martial_content_bar_text_color', array(
		'default'           => '#b1b0b1',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_bar_text', array(
		'label'    => __( 'Content bar text color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_content_bar_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_content_border_color', array(
		'default'           => '#e0e0e2',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_border', array(
		'label'    => __( 'Content border color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_content_border_color',
	) ) );

	$wp_customize->add_setting( 'martial_accent_color', array(
		'default'           => '#5dc093',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_accent_color',
	) ) );

	$wp_customize->add_setting( 'martial_footer_bg_color', array(
		'default'           => '#222528',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg', array(
		'label'    => __( 'Footer background color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_footer_bg_color',
	) ) );

	$wp_customize->add_setting( 'martial_footer_text_color', array(
		'default'           => '#868686',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text', array(
		'label'    => __( 'Footer text color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_footer_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_footer_link_color', array(
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link', array(
		'label'    => __( 'Footer link color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_footer_link_color',
	) ) );

	$wp_customize->add_setting( 'martial_footer_title_color', array(
		'default'           => '#ffffff',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title', array(
		'label'    => __( 'Footer title color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_footer_title_color',
	) ) );

	$wp_customize->add_setting( 'martial_text_color', array(
		'default'           => '#868686',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text', array(
		'label'    => __( 'Main text color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_text_color',
	) ) );

	$wp_customize->add_setting( 'martial_title_color', array(
		'default'           => '#262626',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_title', array(
		'label'    => __( 'Main title color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_title_color',
	) ) );

	$wp_customize->add_setting( 'martial_link_color', array(
		'default'           => '#000000',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'martial_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_links', array(
		'label'    => __( 'Main links color', 'martial' ),
		'section'  => 'colors',
		'settings' => 'martial_link_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'martial_customizer', 11 );