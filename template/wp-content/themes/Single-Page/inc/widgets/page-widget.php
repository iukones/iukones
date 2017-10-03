<?php

class Themefurnace_Page_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'themefurnace_page_widget', // Base ID
            'Themefurnace_Page_Widget', // Name
            array( 'description' => 'Page widget',
                'name' => 'themefurnace Page' )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        //echo $args['before_widget'];
        $post = get_post($instance['page_id']);
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'home-thumb');

        echo '
        <div class="post post-content">
            <div class="container">
            <h2 class="blogposttitle">' . $post->post_title . '</h2>';
        if(isset($featured_image[0])) {
            echo '<img ng-src="' . $featured_image[0] . '" alt="Image" class="featured-image">';
        }

        echo '
                <div class="align-left inner-content textwidget">
                    <div class="postdetails">
                        <span class="meta-title">Page Details</span><br>
                    Posted By ' . get_the_author( $post->post_author ) . '<br>
                    Posted on: ' . date( 'F j, Y', strtotime( $post->post_date ) ) . '<br>';

        $categories = $tags = array();
        $terms = wp_get_object_terms( $post->ID, array('category', 'post_tag') );
        foreach($terms as $t) {
            if( $t->taxonomy == 'category' ) {
                $categories[] = $t->name;
            } elseif( $t->taxonomy == 'post_tag' ) {
                $tags[] = $t->name;
            }
        }
        if( !empty( $categories ) ) {
            echo '<span>Posted in <span>' . implode( ', ', $categories ) . '</span></span><br>';
        }
        if( !empty( $categories ) ) {
            echo '<span>Tags: <span>' . implode( ', ', $tags ) . '</span></span><br>';
        }

        echo '</div>
                <div class="content-text">' . apply_filters( 'the_content', $post->post_content ) . '</div>
            </div>
            </div>
        </div>';
        //echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['page_id'] = $new_instance['page_id'];

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
    ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Page:', 'themefurnace' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>">
                <?php
                $pages = get_posts('post_type=page&post_status=publish');
                foreach($pages as $page) {
                    $selected = '';
                    if ( $instance['page_id'] == $page->ID ) {
                        $selected = ' selected="selected" ';
                    }
                    echo '<option value="'.$page->ID.'"'.$selected.'>'.$page->post_title.'</option>';
                }
                ?>
            </select>
        </p>

    <?php
    }

}
function themefurnace_register_page_widget() {
    return register_widget('themefurnace_page_widget');
}
// register Foo_Widget widget
add_action( 'widgets_init', 'themefurnace_register_page_widget' );
