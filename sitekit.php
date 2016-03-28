<?php
/*
Plugin Name: Sitekit
Plugin URI: http://wordpress.org/plugins/sitekit/
Description: Collection of useful tools.
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


//include( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'inc/widget-search.php' );
include( 'inc/sk-widget-search.php' );


function sitekit_plugin_row_meta( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$row_meta = array(
			'support' => '<a href="http://web-profile.com.ua/wordpress/plugins/page-list/" target="_blank"><span class="dashicons dashicons-editor-help"></span> ' . __( 'Sitekit', 'sitekit' ) . '</a>',
			'donate' => '<a href="http://web-profile.com.ua/donate/" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', 'sitekit' ) . '</a>',
			'pro' => '<a href="http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii" target="_blank" title="Speedup and protect WordPress in a smart way"><span class="dashicons dashicons-star-filled"></span> ' . __( 'Silver Bullet Pro', 'sitekit' ) . '</a>'
		);
		$links = array_merge( $links, $row_meta );
	}
	return (array) $links;
}
add_filter( 'plugin_row_meta', 'sitekit_plugin_row_meta', 10, 2 );
