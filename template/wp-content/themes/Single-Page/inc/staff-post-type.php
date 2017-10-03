<?php
/*
Plugin Name: Staff Custom Post Type
Description: Adds custom post types for staff members
Version: 0.1
License: GPL
Author: Oli Dale
Author URI: http://wplift.com
*/

add_action( 'init', 'register_cpt_staff' );

function register_cpt_staff() {

    $labels = array( 
        'name' => _x( 'Staff', 'staff' ,'themefurnace'),
        'singular_name' => _x( 'Staff', 'staff' ,'themefurnace'),
        'add_new' => _x( 'Add New', 'staff','themefurnace' ),
        'add_new_item' => _x( 'Add New Staff Member', 'staff','themefurnace' ),
        'edit_item' => _x( 'Edit Staff Member', 'staff','themefurnace' ),
        'new_item' => _x( 'New Staff Member', 'staff' ,'themefurnace'),
        'view_item' => _x( 'View Staff Member', 'staff','themefurnace' ),
        'search_items' => _x( 'Search Staff', 'staff','themefurnace' ),
        'not_found' => _x( 'No staff found', 'staff','themefurnace' ),
        'not_found_in_trash' => _x( 'No staff found in Trash', 'staff' ,'themefurnace'),
        'parent_item_colon' => _x( 'Parent Staff:', 'staff','themefurnace' ),
        'menu_name' => _x( 'Staff', 'staff','themefurnace' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Staff names and descriptions',
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'staff', $args );
}

function department_init() {
  register_taxonomy('department',array('staff'), array(

    'hierarchical' => true,
    'labels' => array(
    'name' => _x( 'Department', 'taxonomy general name','themefurnace' ),
    'singular_name' => _x( 'Department', 'taxonomy singular name' ,'themefurnace'),
    'search_items' =>  __( 'Search Departments','themefurnace' ),
    'all_items' => __( 'All Departments','themefurnace' ),
    'parent_item' => __( 'Parent Department','themefurnace' ),
    'parent_item_colon' => __( 'Parent Department:','themefurnace' ),
    'edit_item' => __( 'Edit Department','themefurnace' ),
    'update_item' => __( 'Update Department','themefurnace' ),
    'add_new_item' => __( 'Add New Department' ,'themefurnace'),
    'new_item_name' => __( 'New Department Name','themefurnace' ),
    'menu_name' => __( 'Department','themefurnace' ),
  ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'department' ),
  ));
}
add_action( 'init', 'department_init' );


add_action( 'admin_head', 'custom_post_type_icon' );

function custom_post_type_icon() {
    ?>
    <style>
        /* Admin Menu - 16px */
        #menu-posts-staff .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/img/icon-adminmenu16-sprite.png) no-repeat 6px 6px !important;
        }
		#menu-posts-staff:hover .wp-menu-image, #menu-posts-staff.wp-has-current-submenu .wp-menu-image {
            background-position: 6px -26px !important;
        }
        /* Post Screen - 32px */
        .icon32-posts-staff {
        	background: url(<?php echo get_template_directory_uri(); ?>/img/icon-adminpage32.png) no-repeat left top !important;
        }
        @media
        only screen and (-webkit-min-device-pixel-ratio: 1.5),
        only screen and (   min--moz-device-pixel-ratio: 1.5),
        only screen and (     -o-min-device-pixel-ratio: 3/2),
        only screen and (        min-device-pixel-ratio: 1.5) {
        	
        	/* Admin Menu - 16px @2x */
        	#menu-posts-staff .wp-menu-image {
        		background-image: url('<?php echo get_template_directory_uri(); ?>/img/icon-adminmenu16-sprite@2x.png') !important;
        		-webkit-background-size: 16px 48px;
        		-moz-background-size: 16px 48px;
        		background-size: 16px 48px;
        	}
        	/* Post Screen - 32px @2x */
        	.icon32-posts-staff {
        		background-image: url('<?php echo get_template_directory_uri(); ?>/img/icon-adminpage32@2x.png') !important;
        		-webkit-background-size: 32px 32px;
        		-moz-background-size: 32px 32px;
        		background-size: 32px 32px;
        	}         
        }
    </style>
<?php } 

?>