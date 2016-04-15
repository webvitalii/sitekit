<?php

class Sitekit_Categories_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_categories_widget', // Base ID
			__( 'Sitekit Categories', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Categories Widget', 'sitekit' ) ) // Args
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
		//extract( $args );
		$instance = wp_parse_args( (array) $instance, self::get_defaults() );
		
		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		
		$instance['echo'] = 0;
		$instance['title_li'] = '';
		$instance['show_option_all'] = '';
		$instance['show_option_none'] = '';
		$instance['feed'] = '';
		
		$categories = wp_list_categories( $instance );
		
		echo "\n".'<ul class="sitekit-categories">' ."\n". $categories ."\n". '</ul><!-- .sitekit-categories -->'."\n";
		
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
		
		$orderby_list = array( 
			'name' => __( 'Name', 'sitekit' ),
			'id' => __( 'ID', 'sitekit' )
		);
		
		$order_list = array(
			'ASC' => __( 'Ascending (A-Z)', 'sitekit' ),
			'DESC' => __( 'Descending (Z-A)', 'sitekit' )
		);
		
		?>
<p>
	<label><?php _e( 'Title:', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Order by:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
			<?php foreach ( $orderby_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label><?php _e( 'Order:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'order' ); ?>">
			<?php foreach ( $order_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label>
		<input class="checkbox" type="checkbox" <?php checked( $instance['show_count'] ); ?> 
			name="<?php echo $this->get_field_name( 'show_count' ); ?>" />
		<?php _e( 'Show post count', 'sitekit' ); ?>
	</label>
</p>

<p>
	<label>
		<input class="checkbox" type="checkbox" <?php checked( $instance['hide_empty'] ); ?> 
			name="<?php echo $this->get_field_name( 'hide_empty' ); ?>" />
		<?php _e( 'Hide empty', 'sitekit' ); ?>
	</label>
</p>

<p>
	<label>
		<input class="checkbox" type="checkbox" <?php checked( $instance['hierarchical'] ); ?> 
			name="<?php echo $this->get_field_name( 'hierarchical' ); ?>" />
		<?php _e( 'Hierarchical', 'sitekit' ); ?>
	</label>
</p>

<p>
	<label><?php _e( 'Child of:', 'sitekit' ); ?><br>
		<input type="number" class="widefat" min="0" name="<?php echo $this->get_field_name( 'child_of' ); ?>" 
			value="<?php echo esc_attr( $instance['child_of'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Exclude:', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'exclude' ); ?>" 
			value="<?php echo esc_attr( $instance['exclude'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Exclude tree:', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'exclude_tree' ); ?>" 
			value="<?php echo esc_attr( $instance['exclude_tree'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Depth:', 'sitekit' ); ?><br>
		<input type="number" class="widefat" min="0" name="<?php echo $this->get_field_name( 'depth' ); ?>" 
			value="<?php echo esc_attr( $instance['depth'] ); ?>" />
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
	 * @param array $instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $instance ) {
		$instance['title'] = trim(strip_tags($new_instance['title']));
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		
		$instance['show_count'] = isset($new_instance['show_count']) ? 1 : 0;
		$instance['hide_empty'] = isset($new_instance['hide_empty']) ? 1 : 0;
		$instance['hierarchical'] = isset($new_instance['hierarchical']) ? 1 : 0;
		
		$instance['child_of'] = intval($new_instance['child_of']);
		$instance['exclude'] = trim(strip_tags($new_instance['exclude']));
		$instance['exclude_tree'] = trim(strip_tags($new_instance['exclude_tree']));
		$instance['depth'] = intval( $new_instance['depth'] );
		
		$updated_instance = wp_parse_args( (array) $instance, self::get_defaults() );
		
		return $updated_instance;
	}

	
	/**
	 * Render an array of default values.
	 *
	 * @return array default values
	 */
	private static function get_defaults() {
		$defaults = array(
			'title' => __( 'Categories', 'sitekit' ),
			'description' => '',
			'orderby' => 'name',
			'order' => 'ASC',
			'show_count' => 0,
			'hide_empty' => 1,
			'hierarchical' => 1,
			'child_of' => 0,
			'exclude' => '',
			'exclude_tree' => '',
			'depth' => 0
		);
		return $defaults;
	}
	
}


function sitekit_categories_register_widget() {
    register_widget( 'Sitekit_Categories_Widget' );
}
add_action( 'widgets_init', 'sitekit_categories_register_widget' );
