<?php

class Themefurnace_Footer_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'themefurnace_footer_widget', // Base ID
            'Themefurnace_Footer_Widget', // Name
            array( 'description' => 'Footer text widget',
                'name' => 'themefurnace Footer Text' )
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

        $title = apply_filters( 'widget_title', $instance['title'] );
        $textbox = isset($instance['textbox']) ? $instance['textbox'] : '';

        echo $args['before_widget'];
        if(!empty( $title )) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        if(!empty( $textbox)) {
            echo '<p>'.$textbox.'</p>';
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
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['textbox'] = strip_tags( $new_instance['textbox'] );

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

        $title = ( isset( $instance['title'] ) ) ? $instance['title'] : 'Title';
        $textbox = ( isset( $instance['textbox'] ) ) ? $instance['textbox'] : 'Enter your text here';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'textbox' ); ?>"><?php _e( 'Text Box:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'textbox' ); ?>" name="<?php echo $this->get_field_name( 'textbox' ); ?>"><?php echo esc_attr( $textbox ); ?></textarea>
        </p>

    <?php
    }

}
function themefurnace_register_footer_widget() {
    return register_widget('themefurnace_footer_widget');
}
// register Foo_Widget widget
add_action( 'widgets_init', 'themefurnace_register_footer_widget' );
