<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Single Page
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <base href="<?php echo get_template_directory_uri() . '/'; ?>">
    <?php load_theme_fonts(); ?>
    <?php wp_head(); ?>
    <?php load_theme_colors(); ?>
    <?php load_slide_backgrounds(); ?>

    <script type="text/javascript">
        jQuery(document).ready(function( $ ) {
            $().UItoTop({ easingType: 'easeOutQuart', link: '<?php echo get_bloginfo('url') . '/#/home';?>' });
        });
    </script>
</head>

<body <?php body_class(); ?> ng-app="themeFurnaceTheme" id="home">

<div id="header">
    <div class="container">
        <a href="<?php echo get_bloginfo('home') . '/#/home';?>">
            <?php if ( get_theme_mod( 'themefurnace_logo' ) ) : ?>
                <img class="logo" src='<?php echo esc_url( get_theme_mod( 'themefurnace_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' />
            <?php else :
                if ( get_theme_mod( 'themefurnace_footer_logo' ) === false) : ?>
                    <img class="logo" src="<?php echo get_bloginfo('template_directory') . '/img/logo.png';?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                <?php else: ?>
                    <h1 id="logo_text"><?php bloginfo( 'name' ); ?></h1>
                <?php endif; ?>
            <?php endif; ?>
        </a>

        <div id="navbar">
            <div id="main-nav">
                <ul id="themefurnace-menu">
                    <?php
                        $items = wp_get_nav_menu_items( 'primary' );
                        foreach($items as $k => $item) {
                            $class = '';
                            if ($k === 0) {
                                $class = 'active';
                            }
                            echo '<li class="'.$class.'"><a data-scrollto="" ng-href="' . $item->url . '">'.$item->title.'</a></li>';
                        }
                    ?>
                </ul>
                <script type="text/javascript">
                    jQuery(function(){
                        jQuery('#themefurnace-menu').slicknav({prependTo: '#navbar'});
                    });
                </script>
            </div><!--End Mainnav-->
        </div><!--End Navbar-->

    </div><!--End Container -->
</div><!--End Header -->