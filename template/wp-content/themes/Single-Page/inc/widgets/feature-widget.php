<?php

class Themefurnace_Feature_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'themefurnace_feature_widget', // Base ID
			'Themefurnace_Feature_Widget', // Name
			array( 'description' => 'Front Page Feature Widget',
			       'name' => 'themefurnace Feature Widget' ) // Args
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
		$url = $instance['url'];
		
		if(strpos($url, 'http://') === false && strpos($url, 'https://') === false) {
		    $url = 'http://'.$url;
		}

		echo $args['before_widget'];
		echo '<div class="featureicon">
                <a href="'.$url.'"><i class="fa '.$instance['icon'].'"></i></a>
              </div>';
        echo '<div class="featuretext">';
		if(!empty( $title )) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if(!empty( $instance['textbox'])) {
		    echo '<p>'.$instance['textbox'].'</p>';
		}
        echo '</div>';
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
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );

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
		$url = ( isset( $instance['url'] ) ) ? $instance['url'] : 'http://www.yourpage.com';
		$icon = ( isset( $instance['icon'] ) ) ? $instance['icon'] : 'fa-book';
		
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'textbox' ); ?>"><?php _e( 'Text Box:' ); ?></label> 
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'textbox' ); ?>" name="<?php echo $this->get_field_name( 'textbox' ); ?>"><?php echo esc_attr( $textbox ); ?></textarea>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon (see <a href="http://fortawesome.github.com/Font-Awesome/#all-icons" target="_blank">this link</a> for reference):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
		</p>
		
		<?php 
	}

}
function themefurnace_register_featured_widget() {
    return register_widget('themefurnace_feature_widget');
}
// register Foo_Widget widget
add_action( 'widgets_init', 'themefurnace_register_featured_widget' );
