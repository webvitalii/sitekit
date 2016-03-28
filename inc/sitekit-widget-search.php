<?php

class Sitekit_Search_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_search_widget', // Base ID
			__( 'Sitekit Search', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Search Widget', 'sitekit' ), ) // Args
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
		extract( $args );
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		?>
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-inline">
			<div class="form-group">
				<fieldset>
					<div class="input-group">
						<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" class="input-medium form-control" name="s">
					</div>
					<button type="submit" class="btn btn-primary"><i class="dashicons dashicons-search"></i> <?php echo $instance['button_text']; ?></button>
				</fieldset>
			</div>
		</form>
		<?php
		echo $args['after_widget'];
		echo SITEKIT_PLUGIN_POWERED;
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		?>
		<p>
		<label><?php _e( 'Title:', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>">
		</label>
		</p>
		
		<p>
		<label><?php _e( 'Button text:', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'button_text' ); ?>" 
			value="<?php echo esc_attr( $instance['button_text'] ); ?>">
		</label>
		</p>
		<?php 
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
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, self::get_defaults() );
		$instance['title'] = trim(strip_tags($new_instance['title']));
		$instance['button_text'] = trim(strip_tags($new_instance['button_text']));
		return $instance;
	}

	
	/**
	 * Render an array of default values.
	 *
	 * @return array default values
	 */
	private static function get_defaults() {
		$defaults = array(
			'title' => __( 'Search', 'sitekit' ),
			'description' => '',
			'button_text' => __( 'Search', 'sitekit' ),
		);
		return $defaults;
	}
	
}


function sitekit_search_register_widget() {
    register_widget( 'Sitekit_Search_Widget' );
}
add_action( 'widgets_init', 'sitekit_search_register_widget' );
