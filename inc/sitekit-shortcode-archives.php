<?php

function sitekit_archives_shortcode( $atts ) {
	$defaults = array(
		'type' => 'monthly',
		'limit' => '',
		'format' => 'html',
		'before' => '',
		'after' => '',
		'show_post_count' => 0,
		//'echo' => 0,
		'order' => 'DESC'
	);
	extract( shortcode_atts( $defaults, $atts ) );
	$archives_args = array(
		'type' => $type,
		'limit' => $limit,
		'format' => $format,
		'before' => '',
		'after' => '',
		'show_post_count' => $show_post_count,
		'echo' => 0,
		'order' => $order
	);
	
	$archives = wp_get_archives( $archives_args );
	
	if ( $archives_args['format'] == 'option' ) { // Archives as a dropdown

		/* Create a title for the drop-down based on the archive type. */
		if ( $archives_args['type'] == 'yearly' ) {
			$option_title = __( 'Select Year', 'sitekit' );

		} elseif ( $archives_args['type'] == 'monthly' ) {
			$option_title = __( 'Select Month', 'sitekit' );

		} elseif ( $archives_args['type'] == 'weekly' ) {
			$option_title = __( 'Select Week', 'sitekit' );

		} elseif ( $archives_args['type'] == 'daily' ) {
			$option_title = __( 'Select Day', 'sitekit' );

		} elseif ( $archives_args['type'] == 'postbypost' || $archives_args['type'] == 'alpha' ) {
			$option_title = __( 'Select Post', 'sitekit' );
		}
		/* Output the <select> element and each <option>. */
		$archives_output = '<p class="sitekit-archives"><select name="archive-dropdown" onchange=\'document.location.href=this.options[this.selectedIndex].value;\'>';
			$archives_output .= '<option value="">' . $option_title . '</option>';
			$archives_output .= $archives;
		$archives_output .= '</select></p><!-- .sitekit-archives -->';
		
	} elseif ( $archives_args['format'] == 'html' ) { // Archives as an unordered list
	
		$archives_output = '<ul class="sitekit-archives">' . $archives . '</ul><!-- .sitekit-archives -->';
		
	} else { // Other formats
	
		$archives_output = $archives;
		
	}
	
	return $archives_output . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_archives', 'sitekit_archives_shortcode' );
