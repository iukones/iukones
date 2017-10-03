<?php
require_once dirname(__FILE__) . "/../../../wp-load.php";

$result = array();
$args = array('post_status' => 'publish');
$term = array('category', 'post_tag');
$thumbnail_size = 'home-thumb';

if(isset($_GET['slug']) && !empty($_GET['slug'])) {
    $args['name'] = esc_attr($_GET['slug']);
    $thumbnail_size = 'item-full';
}

if(isset($_GET['post_type']) && !empty($_GET['post_type'])) {
    $args['post_type'] = esc_attr($_GET['post_type']);
    $term = array($args['post_type'] .'_category', $args['post_type'] . '_tag');
    $args['posts_per_page'] = get_theme_mod('fp_' . esc_attr($_GET['post_type']) . '_items', 4);
}

//if(isset($_GET['limit']) && !empty($_GET['limit'])) {
//    $args['posts_per_page'] = (int)$_GET['limit'];
//}

if(isset($_GET['offset']) && !empty($_GET['offset'])) {
    $args['offset'] = (int)$_GET['offset'];
}

if( !isset( $args['post_type'] ) ) {
    $args['post_type'] = '';
	$args['posts_per_page'] = get_theme_mod('fp_blog_items', 4);
}
// get multiple posts
$posts = get_posts($args);
foreach($posts as $k => $post) {
    setup_postdata( $post );
    $posts[$k]->post_author = get_the_author();
    $posts[$k]->post_content = apply_filters('the_content', $posts[$k]->post_content);
    $terms = wp_get_object_terms($posts[$k]->ID, $term);
    $posts[$k]->categories = array();
    $posts[$k]->tags = array();

    if(!is_wp_error(($terms))) {
        foreach($terms as $t) {
            if($t->taxonomy == $args['post_type'] . '_category' || $t->taxonomy == 'category') {
                $posts[$k]->categories[] = array('slug' => $t->slug, 'name' => $t->name);
            } elseif($t->taxonomy == $args['post_type'] . '_tag' || $t->taxonomy == 'post_tag') {
                $posts[$k]->tags[] = array('slug' => $t->slug, 'name' => $t->name);
            }

        }
    }

    $posts[$k]->readable_post_date = date('F j, Y', strtotime($post->post_date));
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $thumbnail_size);
    $posts[$k]->featured_image = $featured_image;
    $posts[$k]->post_meta = get_post_meta( $post->ID );

    ob_start();
    comment_form(array(), $post->ID);
    $form = ob_get_clean();


    $posts[$k]->comment_form = $form;
    $posts[$k]->comments = wp_list_comments(array('echo' => false), get_comments(array('post_id' => $post->ID)));
    if(isset($_GET['post_type']) && $_GET['post_type'] === 'staff') {
        $departments = wp_get_object_terms($post->ID, 'department');
        if(!empty($departments)) {
            $posts[$k]->departments = array();
            foreach($departments as $department) {
                $posts[$k]->departments[] = $department->name;
            }
        }
    }
}

$result = $posts;

// single post content - get prev/next links
if (empty($_GET['limit'])) {
    $post = $posts[0];

    $next_post = get_next_post();
    $prev_post = get_previous_post();

    if(!empty($next_post)) {
        $post->next_post = $next_post;
    }
    if(!empty($prev_post)) {
        $post->prev_post = $prev_post;
    }
    $result = $post;
}

echo json_encode($result);