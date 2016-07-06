<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function sitekit_default_settings() {
	$settings = array(
		'code_head' => '',
		'code_footer' => '',
		'ga_code' => '',
		'ga_code_hide_if_loggedin' => 1
	);
	return $settings;
}


function sitekit_get_settings() {
	$sitekit_settings = (array) get_option('sitekit_settings');
	$default_settings = sitekit_default_settings();
	$sitekit_settings = array_merge($default_settings, $sitekit_settings); // use default settings if custom settings are empty
	return $sitekit_settings;
}
