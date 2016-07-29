<?php

class Sitekit_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_posts_widget', // Base ID
			__( 'Sitekit Posts', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Posts Widget', 'sitekit' ) ) // Args
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
		
		$atts_obj = $instance;
	
		$custom_query = new WP_Query( $atts_obj );
		echo '+++';
		//print_r( $custom_query );
		//echo '===';
		print_r( $atts_obj );
		
		$posts_output = '';

		if ( $custom_query->have_posts() ) :
			$posts_output .= '<ul class="sitekit-posts">'."\n";
			while( $custom_query->have_posts() ) : $custom_query->the_post();
				$posts_output .= '<li>';
				$posts_output .= '<a href="'. get_permalink() .'">'. get_the_title(). '</a>';
				$posts_output .= '</li>'."\n";
			endwhile;
			$posts_output .= '</ul><!-- .sitekit-posts -->'."\n";
			if ($custom_query->max_num_pages > 1) : // custom pagination
				//$orig_query = $wp_query; // fix for pagination to work
				//$wp_query = $custom_query;
				/* ?>
				<nav class="prev-next-posts">
					<div class="prev-posts-link">
						<?php echo get_next_posts_link( 'Older Entries', $custom_query->max_num_pages ); ?>
					</div>
					<div class="next-posts-link">
						<?php echo get_previous_posts_link( 'Newer Entries' ); ?>
					</div>
				</nav>
				<?php */
				//$wp_query = $orig_query; // fix for pagination to work
			endif;
		 
			wp_reset_postdata(); // reset the query 
		else:
			$posts_output .= '<p>'.__('Sorry, no posts matched your criteria.', 'sitekit').'</p>';
		endif;
		
		echo "\n".$posts_output."\n";
		
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
		
		/*$instance['show_count'] = isset($new_instance['show_count']) ? 1 : 0;
		$instance['hide_empty'] = isset($new_instance['hide_empty']) ? 1 : 0;
		$instance['hierarchical'] = isset($new_instance['hierarchical']) ? 1 : 0;
		
		$instance['child_of'] = intval($new_instance['child_of']);
		$instance['exclude'] = trim(strip_tags($new_instance['exclude']));
		$instance['exclude_tree'] = trim(strip_tags($new_instance['exclude_tree']));
		$instance['depth'] = intval( $new_instance['depth'] );*/
		
		$updated_instance = wp_parse_args( (array) $instance, self::get_defaults() );
		
		return $updated_instance;
	}

	
	/**
	 * Render an array of default values.
	 *
	 * @return array default values
	 */
	private static function get_defaults() {
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$defaults = array(
			'title' => __( 'Posts', 'sitekit' ),
			'description' => '',
			'post_type' => 'post',
			'posts_per_page' => 100, //get_option('posts_per_page'),
			//'paged' => 1, //$paged,
			//'post_status' => 'publish',
			//'ignore_sticky_posts' => true,
			//'category_name' => 'custom-cat',
			'order' => 'DESC', // 'ASC'
			'orderby' => 'date' // modified | title | name | ID | rand
		);
		return $defaults;
	}
	
}


function sitekit_posts_register_widget() {
    register_widget( 'Sitekit_Posts_Widget' );
}
add_action( 'widgets_init', 'sitekit_posts_register_widget' );
