<?php
/**
 * Martial functions and definitions
 *
 * @package martial
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if ( !function_exists( 'martial_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function martial_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mediaphase, use a find and replace
		 * to change 'martial' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'martial', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		// enable featured images
		add_theme_support( 'post-thumbnails' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'martial_custom_background_args', array(
			'default-color' => 'f6f6f6',
			'default-image' => '',
			'panel'         => 'martial_colors',
		) ) );

		add_image_size( 'martial-frontpage-blog', 771, 376, true );
		add_image_size( 'martial-blog-profile', 371, 267, true );
		add_image_size( 'martial-blog-profile-thumb', 74, 67, true );
	}
endif;
add_action( 'after_setup_theme', 'martial_setup' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'martial' ),
) );
function martial_set_sample_content()
{


	// Add default items to primary menu
	$primary_menu_items = wp_get_nav_menu_items( 'primary' );
	if ( empty( $primary_menu_items ) ) {
		$name = 'primary';
		$menu_id = wp_create_nav_menu( $name );
		$menu = get_term_by( 'name', $name, 'nav_menu' );

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Home', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Pricing', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Blog', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Contact', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Members', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Sign up', 'martial' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['primary'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// set sample content - text, images, titles, team members
	if ( !get_theme_mod( 'martial_content_set', false ) ) {
		// set up default widgets
		$active_sidebars = get_option( 'sidebars_widgets' );
		$search_widget = get_option( 'widget_search' );
		$search_widget[1] = array( 'title' => __( 'Search', 'martial' ) );

		$userId = get_current_user_id();
		$author_box_widget = get_option( 'widget_martial-author-box-widget' );
		$author_box_widget[1] = array(
			'title-' . $userId               => 'AUTHOR PROFILE',
			'textbox-' . $userId             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.',
			'image_url-' . $userId           => get_template_directory_uri() . '/images/author_profile.png',
			'social_twitter-' . $userId      => 'http://twitter.com',
			'social_facebook-' . $userId     => 'https://facebook.com',
			'social_linkedin-' . $userId     => 'https://linkedin.com',
			'social_pinterest-' . $userId    => 'https://pinterest.com',
			'social_dribbble-' . $userId     => 'https://dribbble.com',
			'social_drupal-' . $userId       => 'https://drupal.com',
			'social_wordpress-' . $userId    => 'https://wordpress.com',
			'social_y-combinator-' . $userId => 'https://ycombinator.com',
			'social_gplus-' . $userId        => 'https://plus.google.com',
		);

		$popular_recent_posts_widget = get_option( 'widget_martial-recent-popular-posts-widget' );
		$popular_recent_posts_widget[1] = array( 'title-popular' => 'Popular', 'title-recent' => 'Recent', 'timeframe' => 'week', 'limit' => 3 );

		$text_widget = get_option( 'widget_text' );
		$text_widget[1] = array( 'title' => __( 'Text Widget', 'martial' ), 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.' );
		$text_widget[2] = array( 'title' => __( 'Text Widget', 'martial' ), 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.' );
		$text_widget[3] = array( 'title' => __( 'Text Widget', 'martial' ), 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.' );
		$text_widget[4] = array( 'title' => __( 'Text Widget', 'martial' ), 'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.' );

		$active_sidebars['martial-footer'] = array( 'text-1', 'text-2', 'text-3' );
		update_option( 'widget_martial-author-box-widget', $author_box_widget );
		update_option( 'widget_martial-recent-popular-posts-widget', $popular_recent_posts_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		$active_sidebars['sidebar-1'] = array( 'martial-author-box-widget-1', 'text-4', 'search-1', 'martial-recent-popular-posts-widget-1' );
		update_option( 'widget_search', $search_widget );
		update_option( 'widget_text', $text_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		// set customizer options
		set_theme_mod( 'martial_header_logo_image', get_template_directory_uri() . '/images/logo.png' );
		set_theme_mod( 'martial_header_logo_text', get_bloginfo( 'name' ) );
		set_theme_mod( 'martial_hero_bg_image', get_template_directory_uri() . '/images/hero-bg.jpg' );
		set_theme_mod( 'martial_hero_title', 'Hi, I\'m the Martial Theme for Wordpress' );
		set_theme_mod( 'martial_hero_text', '<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing</a> elit. Praesent vel interdum diam, in ultricies diam. Proin vehicula sagittis lorem, nec.</p>' );
		set_theme_mod( 'martial_footer_logo_image', get_template_directory_uri() . '/images/footer_logo.png' );
		set_theme_mod( 'martial_header_social_twitter', 'http://twitter.com' );
		set_theme_mod( 'martial_header_social_facebook', 'https://facebook.com' );
		set_theme_mod( 'martial_header_social_pinterest', 'https://pinterest.com' );
		set_theme_mod( 'martial_header_social_linkedin', 'https://linkedin.com' );
		set_theme_mod( 'martial_header_social_gplus', 'https://plus.google.com' );
		set_theme_mod( 'martial_header_social_behance', 'http://behance.net' );
		set_theme_mod( 'martial_header_social_dribbble', 'http://dribbble.com' );
		set_theme_mod( 'martial_header_social_flickr', 'http://flickr.com' );
		set_theme_mod( 'martial_header_social_500px', 'http://500px.com' );
		set_theme_mod( 'martial_header_social_reddit', 'http://reddit.com' );
		set_theme_mod( 'martial_header_social_wordpress', 'http://wordpress.com' );
		set_theme_mod( 'martial_header_social_youtube', 'http://youtube.com' );
		set_theme_mod( 'martial_header_social_soundcloud', 'http://soundcloud.com' );
		set_theme_mod( 'martial_header_social_medium', 'http://medium.com' );
		set_theme_mod( 'martial_hero_button1_text', __( 'About us', 'martial' ) );
		set_theme_mod( 'martial_hero_button2_text', __( 'Contact us', 'martial' ) );
		set_theme_mod( 'martial_hero_hide_on_inner_pages', 'yes' );

		set_theme_mod( 'martial_content_set', true );
	}
}

add_action( 'after_switch_theme', 'martial_set_sample_content', 100 );

// Style the Tag Cloud
function martial_tag_cloud_widget( $args )
{
	$args['largest'] = 12; //largest tag
	$args['smallest'] = 12; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['number'] = '8'; //number of tags
	return $args;
}

add_filter( 'widget_tag_cloud_args', 'martial_tag_cloud_widget' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function martial_widgets_init()
{
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'martial' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'martial' ),
		'id'            => 'martial-footer',
		'before_widget' => '<li class="footerwidget">',
		'after_widget'  => '</li>',
		'before_title'  => '<h4 class="footerwidgettitle">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'martial_widgets_init' );

// Load Roboto Font
function martial_fonts_url()
{
	$fonts_url = '';
	$font_families = array();

	// default fonts - Roboto and Arimo
	$roboto = _x( 'on', 'Roboto font: on or off', 'martial' );
	$arimo = _x( 'on', 'Arimo font: on or off', 'martial' );
	$heading_font_family = get_theme_mod( 'martial_google_fonts_heading_font', null );
	$body_font_family = get_theme_mod( 'martial_google_fonts_body_font', null );

	if ( 'off' !== $roboto ) {
		$font_families[] = 'Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic';
	}

	if ( 'off' !== $arimo ) {
		$font_families[] = 'Arimo:400,400italic,700,700italic';
	}

	if ( !empty( $heading_font_family ) && $heading_font_family !== 'none' ) {
		$heading_font = _x( 'on', $heading_font_family . ' font: on or off', 'martial' );
		if ( 'off' !== $heading_font ) {
			$font_families[] = $heading_font_family;
		}
	}

	if ( !empty( $body_font_family ) && $body_font_family !== 'none' && $body_font_family !== $heading_font_family ) {
		$body_font = _x( 'on', $body_font_family . ' font: on or off', 'martial' );
		if ( 'off' !== $body_font ) {
			$font_families[] = $body_font_family;
		}
	}


	// if both body and heading fonts are set in customizer,
	// don't include default Roboto and Arimo fonts
	if ( count( $font_families ) === 4 ) {
		array_slice( $font_families, 2 );
	}

	if ( !empty( $font_families ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function martial_scripts()
{
	wp_enqueue_style( 'martial-style', get_stylesheet_uri() );
	wp_enqueue_style( 'martial-font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css' );
	wp_enqueue_style( 'martial-defaults', get_template_directory_uri() . '/inc/css/defaults.css' );
	wp_enqueue_style( 'martial-cssmenu', get_template_directory_uri() . '/inc/css/cssmenu.css' );
	wp_enqueue_style( 'martial-widgets', get_template_directory_uri() . '/inc/css/widgets.css' );
	wp_enqueue_style( 'martial-upsell', get_template_directory_uri() . '/inc/css/upsell.css' );
	wp_enqueue_style( 'martial-fonts', martial_fonts_url(), array(), null );
	wp_enqueue_script( 'martial-sticky', get_template_directory_uri() . '/inc/js/jquery.sticky-kit.min.js', array( 'jquery' ), '20151107', true );
	wp_enqueue_script( 'martial-footer-scripts', get_template_directory_uri() . '/inc/js/scripts.js', array( 'jquery' ), '20151107', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'martial_scripts' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis) and sets character length to 35
 */
function martial_excerpt( $text )
{
	if ( $text == '' ) {
		$text = get_the_content( '' );
		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]>', $text );
		$text = strip_tags( $text );
		$text = nl2br( $text );
		$excerpt_length = apply_filters( 'excerpt_length', 45 );
		$words = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}
	}

	return $text;
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'martial_excerpt' );

function martial_esc_html( $text )
{
	return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
}

function martial_pagination( $wp_query_object = null )
{
	global $wp_query;
	$query_object = !empty( $wp_query_object ) ? $wp_query_object : $wp_query;
	if ( !is_page() && $query_object->max_num_pages < 2 ) {
		return;
	}
	$big = 999999999; // need an unlikely integer
	echo '<div class="pagination">';
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total'   => $query_object->max_num_pages
	) );
	echo '</div>';
}

function martial_search_form( $form )
{
	$form = '
			<div class="search">
			<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<i class="fa fa-search"></i>
			<input class="textfield" type="text" name="s" value="' . get_search_query() . '">
			<input type="submit" value="' . esc_attr( __( 'Search', 'martial' ) ) . '" class="submit">
			<div class="clear"></div>
			</form>
		</div>

		<script type="text/javascript">
			jQuery(\'.search\').prev(\'h5\').parent(\'.sidebarwidget\').removeClass().addClass(\'search_sec\');
			//jQuery(\'.search_sec h5\').text(el.text());
			//el.remove();
		</script>';

	return $form;
}

add_filter( 'get_search_form', 'martial_search_form', 1 );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/themesetup.php';
require get_template_directory() . '/inc/widgets/author-box.php';
require get_template_directory() . '/inc/widgets/recent-popular.php';
require get_template_directory() . '/inc/customizer.php';