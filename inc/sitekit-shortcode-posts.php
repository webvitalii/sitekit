<?php

function sitekit_shortcode_posts( $atts ) {
	
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$defaults = array(
		'post_type' => 'post',
		'posts_per_page' => 100, //get_option('posts_per_page'),
		'paged' => $paged,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		//'cat' => 47,
		//'category_name' => 'custom-cat',
		'order' => 'DESC', // 'ASC'
		'orderby' => 'date' // modified | title | name | ID | rand
	);
	$atts_obj = shortcode_atts( $defaults, $atts );
	
	$custom_query = new WP_Query( $atts_obj );
	
	//print_r($atts);
	
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
	
	return $posts_output . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_posts', 'sitekit_shortcode_posts' );
