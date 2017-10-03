<?php
/**
 * Single Page functions and definitions
 *
 * @package Single Page
 */

// themefurnace functions and definitions
if ( ! function_exists( 'themefurnace_setup' ) ) :
    function themefurnace_setup() {
        load_theme_textdomain( 'themefurnace', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
    }
endif;
add_action( 'after_setup_theme', 'themefurnace_setup' );

// Allow shortcodes in Widgets
add_filter('widget_text', 'do_shortcode');

// unregister all some widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
	 unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);

// Emable The custom Menu
register_nav_menu( 'primary', __( 'Primary Menu', 'themefurnace' ) );

// Style the Tag Cloud
function custom_tag_cloud_widget($args) {
    $args['largest'] = 12; //largest tag
    $args['smallest'] = 12; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    $args['number'] = '8'; //number of tags
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
    $links = str_replace('</a> (', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis) and sets character length to 35
 */
function wp_new_excerpt($text)
{
    if ($text == '')
    {
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text);
        $text = nl2br($text);
        $excerpt_length = apply_filters('excerpt_length', 25);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function single_page_widgets_init() {
    register_sidebar( array(
        'name' => 'ThemeFurnace Dynamic Front Page',
        'id' => 'single-page-dynamic-front-page',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar(array(
        'name' => 'ThemeFurnace Small Features',
        'id' => 'single-page-small-features',
        'before_widget' => '<div class="feature">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="featuretitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'ThemeFurnace Footer',
        'id' => 'single-page-sidebar-footer-1',
        'before_widget' => '<div class="footerwidget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footertitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => 'ThemeFurnace Map',
        'id' => 'single-page-map',
        'before_widget' => '<div id="singlemap">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ));
}
add_action( 'widgets_init', 'single_page_widgets_init' );

add_theme_support('menus');
// create primary menu
$menu_exists = wp_get_nav_menu_object( 'primary' );

// If it doesn't exist, let's create it.
if( !$menu_exists ) {
    $menu_id = wp_create_nav_menu( 'primary' );
    if(!is_wp_error($menu_id)) {

        // Set up default menu items
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' =>  __( 'Home' ),
            //'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/#/home' ),
            'menu-item-status' => 'publish' )
        );

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' =>  __( 'Portfolio' ),
            'menu-item-url' => home_url( '/#/portfolio' ),
            'menu-item-status' => 'publish' )
        );

        wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title' =>  __( 'Staff' ),
                'menu-item-url' => home_url( '/#/staff' ),
                'menu-item-status' => 'publish' )
        );
    }
}

require get_template_directory() . '/inc/portfolio-post-type.php';
require get_template_directory() . '/inc/staff-post-type.php';
require get_template_directory() . '/inc/flexslider/flexslider.php';
flexslider_hg_setup();

//Enqueue scripts and styles
function themefurnace_scripts() {
    wp_enqueue_style( 'themefurnace-style', get_stylesheet_uri() );
    wp_enqueue_style( 'slicknav-css', get_template_directory_uri(). '/inc/css/slicknav.css' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'themefurnace-selectbox', get_template_directory_uri() . '/js/selectbox.js', array(), '20130115', true );
    wp_enqueue_script( 'themefurnace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_register_script('jquery.ui.totop', get_template_directory_uri() . '/js/jquery.ui.totop.js');
    wp_enqueue_script('jquery.ui.totop');
    wp_enqueue_script('jquery.slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'themefurnace-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }

}
add_action( 'wp_enqueue_scripts', 'themefurnace_scripts' );


function load_fonts() {
    wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Roboto:300,700', array(), false, 'all');
    wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'load_fonts');

// post thumbnail support
if ( function_exists( 'add_image_size' ) ) {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-full');
    add_image_size( 'post-thumb', 225, 158, true );
    add_image_size( 'home-thumb', 300, 300, true );
    add_image_size( 'item-full', 1200, 620, true );
}

// Load Extra Functions
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/themesetup.php';
require get_template_directory() . '/inc/metaboxes.php';