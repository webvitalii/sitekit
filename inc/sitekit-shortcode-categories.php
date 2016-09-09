<?php

function sitekit_shortcode_categories( $atts ) {
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
		'exclude_tree' => '',
		'title_li' => '',
		'show_option_all' => '',
		'show_option_none' => '',
		'feed' => '',
		'echo' => 0
	);
	$atts_obj = shortcode_atts( $defaults, $atts );
	
	$categories = wp_list_categories( $atts_obj );
	
	$categories = "\n".'<ul class="sitekit-categories">' . "\n" . $categories . "\n" . '</ul><!-- .sitekit-categories -->' . "\n";
	
	return $categories . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_categories', 'sitekit_shortcode_categories' );
