<?php

function sitekit_shortcode_bloginfo( $atts ) {
	extract(shortcode_atts(array(
		'show' => 'name'
	), $atts));
	return get_bloginfo($show);
}
add_shortcode( 'sitekit_bloginfo', 'sitekit_shortcode_bloginfo' );
