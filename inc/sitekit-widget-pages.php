<?php

class Sitekit_Pages_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sitekit_pages_widget', // Base ID
			__( 'Sitekit Pages', 'sitekit' ), // Name
			array( 'description' => __( 'Sitekit Pages Widget', 'sitekit' ) ) // Args
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
		
		//$instance['include'] = explode(',', $instance['include']);
		//$instance['exclude'] = explode(',', $instance['exclude']);
		
		$pages_array = get_pages( $instance ); // $instance
		$pages_list = '';
		
		/*echo '<pre>';
		var_dump($pages_array);
		echo '</pre>';*/
		
		foreach( $pages_array as $page ) {
			//$content = $page->post_content;
			//$content = apply_filters( 'the_content', $content );
			$pages_list .= '<li><a href="'.get_page_link( $page->ID ).'">'.$page->post_title.'</a></li>'."\n";
		}
		
		echo "\n".'<ul class="sitekit-pages">'."\n".$pages_list."\n".'</ul><!-- .sitekit-pages -->'."\n";
		
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
		<select class="widefat" name="<?php echo $this->get_field_name( 'sort_column' ); ?>">
			<?php foreach ( $sort_column_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['sort_column'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
	</label>
</p>

<p>
	<label><?php _e( 'Sort order:', 'sitekit' ); ?><br>
		<select class="widefat" name="<?php echo $this->get_field_name( 'sort_order' ); ?>">
			<?php foreach ( $sort_order_list as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['sort_order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
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
	<label><?php _e( 'Number of pages to show:', 'sitekit' ); ?><br>
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
		$instance['sort_column'] = $new_instance['sort_column'];
		$instance['sort_order'] = $new_instance['sort_order'];
		
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
			'title' => __( 'Pages', 'sitekit' ),
			'sort_column' => 'post_title',
			'sort_order' => 'ASC',
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


function sitekit_pages_register_widget() {
    register_widget( 'Sitekit_Pages_Widget' );
}
add_action( 'widgets_init', 'sitekit_pages_register_widget' );
