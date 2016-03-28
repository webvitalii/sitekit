<?php

function sitekit_bloginfo_shortcode( $atts ) {
	extract(shortcode_atts(array(
		'show' => 'name'
	), $atts));
	return get_bloginfo($show);
}
add_shortcode( 'sitekit_bloginfo', 'sitekit_bloginfo_shortcode' );