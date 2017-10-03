<?php
/**
 * Adds Front_Page_Section_Widget widget.
 */
class Front_Page_Section_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'front_page_section_widget', // Base ID
            'Front_Page_Section_Widget', // Name
            array( 'description' => 'ThemeFurnace Front Page Section Widget',
                'name' => 'themefurnace Front Page' ) // Args
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
        echo $args['before_widget'];

        if($instance['item_type'] === 'slider') {
            echo '<div ui-view="slider" id="slider" ng-show="show'.ucfirst($instance['item_type']).'">';
            if(function_exists('show_flexslider_rotator')) echo show_flexslider_rotator( 'homepage');
            echo '</div>';
        } else if ($instance['item_type'] === 'quote') {
            echo '
            <div id="quote">
                <div class="container">
                    <h3 class="quotetext">'.$instance['title'].'</h3>
                    <p>'.$instance['description'].'</p>
                </div><!-- End Container -->
            </div><!-- End Quote -->
            ';
        } else if ($instance['item_type'] === 'testimonial') {
            echo '
            <div id="testimonial">
                <div class="container">
                    <h3 class="testimonialtext">'.$instance['title'].'</h3>
                    <p>'.$instance['description'].'</p>
                </div><!-- End Container -->
            </div><!-- End Testimonial -->
            ';
        } else if ($instance['item_type'] === 'small-features') {
            echo '
            <div id="features">
                <div class="container">
                    <div class="textwidget">
                        <h2>'.$instance['title'].'</h2>
                        <p>'.$instance['description'].'</p>
                    </div>';
            if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('ThemeFurnace Small Features') ) {
            }
            echo '
                </div><!-- End Container -->
            </div><!-- End Small Features -->
            ';
        } else if ($instance['item_type'] === 'footer') {
            echo '
            <div id="footerheader">
                <div class="textwidget">
                    <h2>'.$instance['title'].'</h2>
                    <p>'.$instance['description'].'</p>
                </div>
            </div><!-- End Footer Header -->
            <div id="footerwidgets">
            ';
            if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('ThemeFurnace Map') ) {
            }
            echo '
                <div class="container">
            ';
            if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('ThemeFurnace Footer') ) {
            }
            echo '
                </div><!-- End Container -->
            </div><!-- End Footer Widgets -->
            ';
        } else if ($instance['item_type'] === 'page') {
            echo '
            <div id="pages">
                <div class="container">
                    <div class="textwidget">
                        <h2>'.$instance['title'].'</h2>
                        <p>'.$instance['description'].'</p>
                    </div>';
                if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('ThemeFurnace Pages') ) {
                }
                echo '
                </div><!-- End Container -->
                <div ui-view="content-page" id="content-'.$instance['item_type'].'"></div>
            </div><!-- End Page -->
            ';
        } else {
            echo '
            <div id="'.$instance['item_type'].'">
                <div class="container">
                    <div class="textwidget">
                        <h2>'.$instance['title'].'</h2>
                        <p>'.$instance['description'].'</p>
                    </div>
                    <div ui-view="'.$instance['item_type'].'" ng-show="show'.ucfirst($instance['item_type']).'"></div>
                </div>
                <div ui-view="content-'.$instance['item_type'].'" id="content-'.$instance['item_type'].'"></div>
            </div>';
        }

        echo $args['after_widget'];
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
        $instance['item_type'] = $new_instance['item_type'];
        $instance['title'] = $new_instance['title'];
        $instance['description'] = $new_instance['description'];

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
        $title = isset($instance['title']) ? $instance['title'] : '';
        $description = isset($instance['description']) ? $instance['description'] : '';
        $item_type = isset($instance['item_type']) ? $instance['item_type'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','themefurnace' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"><?php echo esc_attr( $title ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:','themefurnace' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'item_type' ); ?>"><?php _e( 'Item Type:','themefurnace' ); ?></label>
            <select class="" name="<?php echo $this->get_field_name( 'item_type' ); ?>">
                <option value="portfolio" <?php echo $item_type === 'portfolio' ? 'selected="selected"' : ''?>>Portfolio</option>
                <option value="blog" <?php echo $item_type === 'blog' ? 'selected="selected"' : ''?>>Blog</option>
                <option value="slider" <?php echo $item_type === 'slider' ? 'selected="selected"' : ''?>>Slider</option>
                <option value="quote" <?php echo $item_type === 'quote' ? 'selected="selected"' : ''?>>Quote</option>
                <option value="staff" <?php echo $item_type === 'staff' ? 'selected="selected"' : ''?>>Staff</option>
                <option value="testimonial" <?php echo $item_type === 'testimonial' ? 'selected="selected"' : ''?>>Testimonial</option>
                <option value="small-features" <?php echo $item_type === 'small-features' ? 'selected="selected"' : ''?>>Small Features</option>
                <option value="page" <?php echo $item_type === 'page' ? 'selected="selected"' : ''?>>Page</option>
                <option value="footer" <?php echo $item_type === 'footer' ? 'selected="selected"' : ''?>>Footer</option>
            </select>
        </p>

    <?php
    }

}

// register Front_Page_Section_Widget widget
function register_front_page_section_widget() {
    register_widget('Front_Page_Section_Widget');
}
add_action( 'widgets_init', 'register_front_page_section_widget' );
