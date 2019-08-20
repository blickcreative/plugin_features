<?php 

/*
Plugin Name: clean markup widget 
Description: Demonstrates how to cadda widget.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/

class My_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $id = 'clean_markup_widget';
		$title = esc_html__('Clean Markup Widget', 'custom-widget');

        $options = array( 
            'classname' => 'my_widget',
            'description' => 'My Widget is awesome',
        );
        parent::__construct( $id, $title, $options );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget on the front end
        //die(var_dump($args));
        // extract( $args );
		$markup = '';

		if ( isset( $instance['markup'] ) ) {
			echo wp_kses_post( $instance['markup'] );
		}
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $id = $this->get_field_id( 'markup' );
		$for = $this->get_field_id( 'markup' );
		$name = $this->get_field_name( 'markup' );
		$label = __( 'Markup/text:', 'custom-widget' );
		$markup = '<p>'. __( 'Clean markup.', 'custom-widget' ) .'</p>';
		if ( isset( $instance['markup'] ) && ! empty( $instance['markup'] ) ) {
			$markup = $instance['markup'];
		}?>

		<p>
			<label for="<?php echo esc_attr( $id ); ?>my_widget"><?php echo esc_html( $label ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $id ); ?>my_widget" name="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $markup ); ?></textarea>
		</p><?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved to the database
        $instance = array();
		if ( isset( $new_instance['markup'] ) && ! empty( $new_instance['markup'] ) ) {
			$instance['markup'] = $new_instance['markup'];
		}
		return $instance;
    }
}

add_action( 'widgets_init', function(){
	register_widget( 'My_Widget' );
});


//https://codex.wordpress.org/Widgets_API
