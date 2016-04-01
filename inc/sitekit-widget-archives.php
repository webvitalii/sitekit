<?php

class Sitekit_Archives_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_archives_widget', // Base ID
			__( 'Sitekit Archives', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Archives Widget', 'sitekit' ) ) // Args
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
		
		$archives = wp_get_archives( $instance );

		if ( $instance['format'] == 'option' ) { // Archives as a dropdown

			/* Create a title for the drop-down based on the archive type. */
			if ( $instance['type'] == 'yearly' ) {
				$option_title = __( 'Select Year', 'sitekit' );

			} elseif ( $instance['type'] == 'monthly' ) {
				$option_title = __( 'Select Month', 'sitekit' );

			} elseif ( $instance['type'] == 'weekly' ) {
				$option_title = __( 'Select Week', 'sitekit' );

			} elseif ( $instance['type'] == 'daily' ) {
				$option_title = __( 'Select Day', 'sitekit' );

			} elseif ( $instance['type'] == 'postbypost' || $instance['type'] == 'alpha' ) {
				$option_title = __( 'Select Post', 'sitekit' );
			}
			/* Output the <select> element and each <option>. */
			echo '<p class="sitekit-archives"><select name="archive-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>';
				echo '<option value="">' . $option_title . '</option>';
				echo $archives;
			echo '</select></p><!-- .sitekit-archives -->';
			
		} elseif ( $instance['format'] == 'html' ) { // Archives as an unordered list
		
			echo "\n".'<ul class="sitekit-archives">' ."\n". $archives ."\n". '</ul><!-- .sitekit-archives -->'."\n";
			
		} else { // Other formats
		
			echo $archives;
			
		}
		
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
		
		$type_list = array( 
			'yearly' => __( 'Yearly', 'sitekit' ),
			'monthly' => __( 'Monthly', 'sitekit' ),
			'daily' => __( 'Daily', 'sitekit' ),
			'weekly' => __( 'Weekly', 'sitekit' ),
			'postbypost' => __( 'Post By Post', 'sitekit' ),
			'alpha' => __( 'Alphabetical', 'sitekit' )
		);
		
		$format_list = array(
			'html' => __( 'HTML', 'sitekit' ),
			'option' => __( 'Dropdown', 'sitekit' ),
			'custom' => __( 'Custom', 'sitekit' )
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
	<label><?php _e( 'Type:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'type' ); ?>">
			<?php foreach ( $type_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['type'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label><?php _e( 'Limit:', 'sitekit' ); ?><br>
		<input type="number" class="widefat" min="0" name="<?php echo $this->get_field_name( 'limit' ); ?>" 
			value="<?php echo esc_attr( $instance['limit'] ); ?>" />
	</label>
</p>

<p>
	<label><?php _e( 'Format:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'format' ); ?>">
			<?php foreach ( $format_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['format'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label>
		<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_count'] ); ?> 
			name="<?php echo $this->get_field_name( 'show_post_count' ); ?>" />
		<?php _e( 'Show post count', 'sitekit' ); ?>
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
		$instance['type'] = $new_instance['type'];
		$instance['limit'] = intval( $new_instance['limit'] );
		$instance['limit'] = $instance['limit'] === 0 ? '' : $instance['limit'];
		$instance['format'] = $new_instance['format'];
		$instance['show_post_count'] = isset($new_instance['show_post_count']) ? 1 : 0;
		$instance['order'] = $new_instance['order'];
		
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
			'title' => __( 'Archives', 'sitekit' ),
			'description' => '',
			'type' => 'monthly',
			'limit' => 10,
			'format' => 'html',
			'show_post_count' => 0,
			'order' => 'DESC'
		);
		return $defaults;
	}
	
}


function sitekit_archives_register_widget() {
    register_widget( 'Sitekit_Archives_Widget' );
}
add_action( 'widgets_init', 'sitekit_archives_register_widget' );
