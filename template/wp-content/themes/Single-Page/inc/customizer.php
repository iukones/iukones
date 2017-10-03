<?php
/**
 * themefurnace Theme Customizer
 *
 * @package themefurnace
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themefurnace_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // custom handler - textarea
    class themefurnace_Textarea_Control extends WP_Customize_Control {
        public $type = 'textarea';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

}
add_action( 'customize_register', 'themefurnace_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function themefurnace_customize_preview_js() {
    wp_enqueue_script( 'themefurnace_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20140727', true );
}
add_action( 'customize_preview_init', 'themefurnace_customize_preview_js' );




function themefurnace_customizer( $wp_customize ) {


    $wp_customize->add_section( 'themefurnacefooter', array(
        'title' => 'Footer Text', // The title of section
        'priority'    => 50,
        'description' => 'Footer Text', // The description of section
    ) );

    $wp_customize->add_setting( 'themefurnacefooter_footer_text', array(
        'default' => 'Hello world',
        // Let everything else default
    ) );
    $wp_customize->add_control( 'themefurnacefooter_footer_text', array(
        // wptuts_welcome_text is a id of setting that this control handles
        'label' => 'Footer Text',
        // 'type' =>, // Default is "text", define the content type of setting rendering.
        'section' => 'themefurnacefooter', // id of section to which the setting belongs
        // Let everything else default
    ) );


    $wp_customize->add_section( 'themefurnace_logo_section' , array(
        'title'       => __( 'Logo', 'themefurnace' ),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );


    $wp_customize->add_setting( 'themefurnace_logo', array( 'default' => get_bloginfo('template_directory') . '/img/logo.png' ) );
    $wp_customize->add_setting( 'themefurnace_footer_logo', array( 'default' => get_bloginfo('template_directory') . '/img/logo-footer.png' ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themefurnace_logo', array(
        'label'    => __( 'Logo', 'themefurnace' ),
        'section'  => 'themefurnace_logo_section',
        'settings' => 'themefurnace_logo',
    ) ) );


    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themefurnace_footer_logo', array(
        'label'    => __( 'Footer Logo', 'themefurnace' ),
        'section'  => 'themefurnace_logo_section',
        'settings' => 'themefurnace_footer_logo',
    ) ) );

    /* quote background */
    $wp_customize->add_setting( 'quote_background', array( 'default' => get_bloginfo('template_directory') . '/img/quote-bg.png' ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'quote_background', array(
        'label'    => __( 'Quote Background', 'themefurnace' ),
        'section'  => 'background_image',
        'settings' => 'quote_background',
    ) ) );

    /* testimonial background */
    $wp_customize->add_setting( 'testimonial_background', array( 'default' => get_bloginfo('template_directory') . '/img/testimonial-bg.png' ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonial_background', array(
        'label'    => __( 'Testimonial Background', 'themefurnace' ),
        'section'  => 'background_image',
        'settings' => 'testimonial_background',
    ) ) );

    // $font_choices array from php file
    require_once(dirname(__FILE__).'/google-fonts/fonts.php');


    $wp_customize->add_section( 'google_fonts' , array(
        'title'		=> __( 'Fonts', 'themefurnace'),
        'priority'	=> 50,
    ) );

    $wp_customize->add_setting( 'google_fonts_heading_font', array(
        'default'		=> 'none',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'google_fonts_heading_font', array(
        'label'		=> __( 'Header Font', 'themefurnace' ),
        'section'	=> 'google_fonts',
        'settings'	=> 'google_fonts_heading_font',
        'type'		=> 'select',
        'choices'	=> $font_choices
    ) );

    $wp_customize->add_setting( 'google_fonts_body_font', array(
        'default'		=> 'none',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'google_fonts_body_font', array(
        'label'		=> __( 'Body Font', 'themefurnace'),
        'section'	=> 'google_fonts',
        'settings'	=> 'google_fonts_body_font',
        'type'		=> 'select',
        'choices'	=> $font_choices
    ) );



    $wp_customize->add_section( 'themefurnace_colors', array(
            'title'          => __( 'Colors', 'themefurnace' ),
            'priority'       => 35,
        )
    );

    $wp_customize->add_setting( 'header_color', array(
            'default'        => '#ffffff',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content', array(
        'label'   => __( 'Header color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'header_color',
    ) ) );

    $wp_customize->add_setting( 'accent_color', array(
            'default'        => '#FFD200',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
        'label'   => __( 'Accent color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'accent_color',
    ) ) );


    $wp_customize->add_setting( 'text_color', array(
            'default'        => '#868686',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text', array(
        'label'   => __( 'Text color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'text_color',
    ) ) );

    $wp_customize->add_setting( 'link_color', array(
            'default'        => '#D0B431',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link', array(
        'label'   => __( 'Link color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'link_color',
    ) ) );

    $wp_customize->add_setting( 'headings_color', array(
            'default'        => '#303030',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headings', array(
        'label'   => __( 'Headings color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'headings_color',
    ) ) );


    $wp_customize->add_setting( 'footer_color', array(
            'default'        => '#0A0A08',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer', array(
        'label'   => __( 'Footer color', 'themefurnace' ),
        'section' => 'colors',
        'settings'   => 'footer_color',
    ) ) );


    $wp_customize->add_section( 'themefurnace_footer_scripts_section', array(
        'title' => 'Footer Scripts', // The title of section
        'priority'    => 50,
        //'description' => 'Footer Scripts', // The description of section
    ) );

    $wp_customize->add_setting( 'footer_scripts', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new themefurnace_Textarea_Control( $wp_customize, 'footer_scripts', array(
        'label'   => 'Footer Scripts',
        'section' => 'themefurnace_footer_scripts_section',
        'settings'   => 'footer_scripts',
    ) ) );


    // display X blog posts and Y portfolio items
    $wp_customize->add_section( 'frontpage_items' , array(
        'title'		=> __( 'Front page items', 'themefurnace'),
        'priority'	=> 50,
    ) );


    $wp_customize->add_setting( 'fp_portfolio_items', array(
        'default'		=> '4',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_portfolio_items', array(
        'label'		=> __( 'Number of portfolio items to show on the front page', 'themefurnace'),
        'section'	=> 'frontpage_items',
        'settings'	=> 'fp_portfolio_items',
        'type'		=> 'text',
    ) );

    $wp_customize->add_setting( 'fp_blog_items', array(
        'default'		=> '4',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_blog_items', array(
        'label'		=> __( 'Number of blog posts to show on the front page', 'themefurnace'),
        'section'	=> 'frontpage_items',
        'settings'	=> 'fp_blog_items',
        'type'		=> 'text',
    ) );

    $wp_customize->add_setting( 'fp_staff_items', array(
        'default'		=> '4',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_staff_items', array(
        'label'		=> __( 'Number of staff items to show on the front page', 'themefurnace'),
        'section'	=> 'frontpage_items',
        'settings'	=> 'fp_staff_items',
        'type'		=> 'text',
    ) );


// slider options
// display X blog posts and Y portfolio items
    $wp_customize->add_section( 'frontpage_slider_options' , array(
        'title'		=> __( 'Front page slider', 'themefurnace'),
        'priority'	=> 50,
    ) );

    $wp_customize->add_setting( 'fp_slider_enable', array(
        'default'		=> 'enable',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_enable', array(
        'label'		=> __( 'Enable/Disable the slider', 'themefurnace' ),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_slider_enable',
        'type'		=> 'radio',
        'choices'   => array(
            'enable' => __('Enable', 'themefurnace'),
            'disable' => __('Disable', 'themefurnace'),
        )
    ) );

    $wp_customize->add_setting( 'fp_slider_items', array(
        'default'		=> '4',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_items', array(
        'label'		=> __( 'Number of items to show in the slider', 'themefurnace'),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_portfolio_items',
        'type'		=> 'text',
    ) );

    $wp_customize->add_setting( 'fp_slider_transition_effect', array(
        'default'		=> 'fade',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_transition_effect', array(
        'label'		=> __( 'Transition Effect', 'themefurnace'),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_slider_transition_effect',
        'type'		=> 'select',
        'choices'   => array(
            'fade'  => __('Fade', 'themefurnace'),
            'slide'  => __('Slide', 'themefurnace'),
        )
    ) );

    $wp_customize->add_setting( 'fp_slider_slide_direction', array(
        'default'		=> 'horizontal',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_slide_direction', array(
        'label'		=> __( 'Slide Direction', 'themefurnace'),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_slider_slide_direction',
        'type'		=> 'select',
        'choices'   => array(
            'horizontal'  => __('Horizontal', 'themefurnace'),
            'vertical'  => __('Vertical', 'themefurnace'),
        )
    ) );

    $wp_customize->add_setting( 'fp_slider_animation_speed', array(
        'default'		=> '500',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_animation_speed', array(
        'label'		=> __( 'Animation Speed', 'themefurnace'),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_slider_animation_speed',
        'type'		=> 'text',
    ) );

    $wp_customize->add_setting( 'fp_slider_pause_time', array(
        'default'		=> '3000',
        'type'			=> 'theme_mod',
        'capability'	=> 'edit_theme_options',
        'transport'     => 'postMessage'
    ) );

    $wp_customize->add_control( 'fp_slider_pause_time', array(
        'label'		=> __( 'Pause Time', 'themefurnace'),
        'section'	=> 'frontpage_slider_options',
        'settings'	=> 'fp_slider_pause_time',
        'type'		=> 'text',
    ) );

}
add_action( 'customize_register', 'themefurnace_customizer', 11 );
