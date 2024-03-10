<?php

function sitekit_shortcode_iframe( $atts ) {
	$defaults = array(
		'src' => 'http://www.youtube.com/embed/4qsGTXLnmKs',
		'width' => '100%',
		'height' => '500',
		'scrolling' => 'yes',
		'frameborder' => '0'
	);

	foreach ( $defaults as $default => $value ) { // add defaults
		if ( ! @array_key_exists( $default, $atts ) ) { // mute warning with "@" when no params at all
			$atts[$default] = $value;
		}
	}

	// Remove srcdoc attribute if it exists
	if ( isset( $atts['srcdoc'] ) ) {
		unset( $atts['srcdoc'] );
	}

	$html = "\n".'<iframe';
	foreach( $atts as $attr => $value ) {
		// sanitize url
		if ( strtolower($attr) == 'src' ) {
			$value = esc_url( $value );
		}
		// remove all attributes starting with "on". Examples: onload, onmouseover, onfocus, onpageshow, onclick
		if ( strpos( strtolower( $attr ), 'on' ) !== 0 ) {
			if ( $value != '' ) {
				// adding all attributes
				$html .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $value ) . '"';
			} else {
				// adding empty attributes
				$html .= ' ' . esc_attr( $attr );
			}
		}
	}
	$html .= '></iframe>'."\n";

	return $html . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_iframe', 'sitekit_shortcode_iframe' );
