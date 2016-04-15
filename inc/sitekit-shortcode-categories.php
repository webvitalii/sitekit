<?php

function sitekit_categories_shortcode( $atts ) {
	$defaults = array(
		'orderby' => 'name',
		'order' => 'ASC',
		'show_count' => 0,
		'hide_empty' => 1,
		'hierarchical' => 1,
		'depth' => 0,
		'taxonomy' => 'category',
		'child_of' => 0,
		'exclude' => '',
		'exclude_tree' => ''
	);
	extract( shortcode_atts( $defaults, $atts ) );
	$categories_args = array(
		'order' => $order,
		'orderby' => $orderby,
		'show_count' => $show_count,
		'hide_empty' => $hide_empty,
		'hierarchical' => $hierarchical,
		'depth' => $depth,
		'taxonomy' => $taxonomy,
		'child_of' => $child_of,
		'exclude' => $exclude,
		'exclude_tree' => $exclude_tree,
		'title_li' => '',
		'show_option_all' => '',
		'show_option_none' => '',
		'feed' => '',
		'echo' => 0
	);
	
	$categories = wp_list_categories( $categories_args );
	$categories = "\n".'<ul class="sitekit-categories">' . "\n" . $categories . "\n" . '</ul><!-- .sitekit-categories -->' . "\n";
	
	return $categories . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_categories', 'sitekit_categories_shortcode' );
