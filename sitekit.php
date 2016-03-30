<?php
/*
Plugin Name: Sitekit
Plugin URI: http://wordpress.org/plugins/sitekit/
Description: Plugin adds search and archives widgets, archives and bloginfo shortcodes.
Version: 1.0
Author: webvitaly
Text Domain: sitekit
Author URI: http://web-profile.com.ua/wordpress/plugins/
License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}

define('SITEKIT_PLUGIN_VERSION', '1.0');
define('SITEKIT_PLUGIN_POWERED', "\n".'<!-- Powered by Sitekit plugin v.'.SITEKIT_PLUGIN_VERSION.' wordpress.org/plugins/sitekit/ -->'."\n");


include( 'inc/sitekit-shortcode-archives.php' );
include( 'inc/sitekit-shortcode-bloginfo.php' );

include( 'inc/sitekit-widget-search.php' );
include( 'inc/sitekit-widget-archives.php' );
include( 'inc/sitekit-widget-categories.php' );


function sitekit_plugin_row_meta( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$row_meta = array(
			'support' => '<a href="http://web-profile.com.ua/wordpress/plugins/sitekit/" target="_blank"><span class="dashicons dashicons-editor-help"></span> ' . __( 'Sitekit', 'sitekit' ) . '</a>',
			'donate' => '<a href="http://web-profile.com.ua/donate/" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', 'sitekit' ) . '</a>',
			'pro' => '<a href="http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii" target="_blank" title="Speedup and protect WordPress in a smart way"><span class="dashicons dashicons-star-filled"></span> ' . __( 'Silver Bullet Pro', 'sitekit' ) . '</a>'
		);
		$links = array_merge( $links, $row_meta );
	}
	return (array) $links;
}
add_filter( 'plugin_row_meta', 'sitekit_plugin_row_meta', 10, 2 );
