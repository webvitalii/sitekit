<?php

class Sitekit_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_posts_widget', // Base ID
			__( 'Sitekit Posts', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Posts/Pages Widget', 'sitekit' ) ) // Args
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
		
		$query_default_args = array(
			'post_type' => 'post',
			'posts_per_page' => 100, //get_option('posts_per_page'),
			'paged' => 1,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			//'category_name' => 'custom-cat',
			'order' => 'DESC', // 'ASC'
			'orderby' => 'date' // modified | title | name | ID | rand
		);
		$query_widget_args = array(
			'orderby' => $instance['orderby'],
			'order' => $instance['order'],
			'hierarchical' => $instance['hierarchical'],
			'child_of' => $instance['child_of'],
			'include' => $instance['include'],
			'exclude' => $instance['exclude'],
			'exclude_tree' => $instance['exclude_tree'],
			'authors' => $instance['authors'],
			'number' =>  $instance['number']
		);
		$query_args = array_merge( $query_default_args, $query_widget_args );
		
		$custom_query = new WP_Query( $query_args );
		//echo '+++';
		//print_r( $custom_query );
		//echo '===';
		print_r( $query_args );
		
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
		
		$sort_column_list = array( 
			'post_title' => __( 'Post title', 'sitekit' ),
			'post_name' => __( 'Post slug', 'sitekit' ),
			'ID' => __( 'ID', 'sitekit' ),
			'post_date' => __( 'Post date', 'sitekit' ),
			'post_modified' => __( 'Post date modified', 'sitekit' ),
			'comment_count' => __( 'Comment count', 'sitekit' ),
			'post_author' => __( 'Post author', 'sitekit' ),
			'menu_order' => __( 'Menu order', 'sitekit' ),
			'post_parent' => __( 'Post parent', 'sitekit' ),
			'rand' => __( 'Random order', 'sitekit' )
		);
		
		$sort_order_list = array(
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
			<?php foreach ( $sort_column_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label><?php _e( 'Sort order:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'order' ); ?>">
			<?php foreach ( $sort_order_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
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
	<label><?php _e( 'Include (comma-separated list of page IDs):', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'include' ); ?>" 
			value="<?php echo esc_attr( $instance['include'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Exclude (comma-separated list of page IDs):', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'exclude' ); ?>" 
			value="<?php echo esc_attr( $instance['exclude'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Exclude tree (comma-separated list of page IDs):', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'exclude_tree' ); ?>" 
			value="<?php echo esc_attr( $instance['exclude_tree'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Authors (comma-separated list of author IDs):', 'sitekit' ); ?><br>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'authors' ); ?>" 
			value="<?php echo esc_attr( $instance['authors'] ); ?>">
	</label>
</p>

<p>
	<label><?php _e( 'Number of posts to show:', 'sitekit' ); ?><br>
		<input type="number" class="widefat" min="0" name="<?php echo $this->get_field_name( 'number' ); ?>" 
			value="<?php echo esc_attr( $instance['number'] ); ?>">
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
		
		$instance['hierarchical'] = isset($new_instance['hierarchical']) ? 1 : 0;
		
		$instance['child_of'] = intval($new_instance['child_of']);
		$instance['include'] = trim(strip_tags($new_instance['include']));
		$instance['exclude'] = trim(strip_tags($new_instance['exclude']));
		$instance['exclude_tree'] = trim(strip_tags($new_instance['exclude_tree']));
		$instance['authors'] = trim(strip_tags($new_instance['authors']));
		$instance['number'] = trim(strip_tags($new_instance['number']));
		
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
			'title' => __( 'Posts', 'sitekit' ),
			'orderby' => 'post_title',
			'order' => 'ASC',
			'hierarchical' => 1,
			'child_of' => 0,
			'include' => '',
			'exclude' => '',
			'exclude_tree' => '',
			'authors' => '',
			'number' => 0
		);
		return $defaults;
	}

}


function sitekit_posts_register_widget() {
    register_widget( 'Sitekit_Posts_Widget' );
}
add_action( 'widgets_init', 'sitekit_posts_register_widget' );
