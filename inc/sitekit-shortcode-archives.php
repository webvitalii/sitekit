<?php

function sitekit_shortcode_archives( $atts ) {
	$defaults = array(
		'type' => 'monthly',
		'limit' => '',
		'format' => 'html',
		'before' => '',
		'after' => '',
		'show_post_count' => 0,
		'echo' => 0,
		'order' => 'DESC'
	);
	$atts_obj = shortcode_atts( $defaults, $atts );
	
	$archives = wp_get_archives( $atts_obj );
	
	if ( $atts_obj['format'] == 'option' ) { // Archives as a dropdown

		// Create a title for the drop-down based on the archive type
		if ( $atts_obj['type'] == 'yearly' ) {
			$option_title = __( 'Select Year', 'sitekit' );

		} elseif ( $atts_obj['type'] == 'monthly' ) {
			$option_title = __( 'Select Month', 'sitekit' );

		} elseif ( $atts_obj['type'] == 'weekly' ) {
			$option_title = __( 'Select Week', 'sitekit' );

		} elseif ( $atts_obj['type'] == 'daily' ) {
			$option_title = __( 'Select Day', 'sitekit' );

		} elseif ( $atts_obj['type'] == 'postbypost' || $atts_obj['type'] == 'alpha' ) {
			$option_title = __( 'Select Post', 'sitekit' );
		}
		// Output the <select> element and each <option>
		$archives_output = '<p class="sitekit-archives"><select name="archive-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>';
			$archives_output .= '<option value="">' . $option_title . '</option>';
			$archives_output .= $archives;
		$archives_output .= '</select></p><!-- .sitekit-archives -->';
		
	} elseif ( $atts_obj['format'] == 'html' ) { // Archives as an unordered list

		$archives_output = '<ul class="sitekit-archives">' . $archives . '</ul><!-- .sitekit-archives -->';

	} else { // Other formats

		$archives_output = $archives;

	}
	
	return $archives_output . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_archives', 'sitekit_shortcode_archives' );
