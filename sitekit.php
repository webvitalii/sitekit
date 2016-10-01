<?php
/*
Plugin Name: Sitekit
Plugin URI: http://wordpress.org/plugins/sitekit/
Description: Widgets: search, archives, categories, pages, posts. Shortcodes: archives, bloginfo, categories, posts.
Version: 1.2
Author: webvitaly
Text Domain: sitekit
Author URI: http://web-profile.net/wordpress/plugins/
License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}

define('SITEKIT_PLUGIN_VERSION', '1.2');
define('SITEKIT_PLUGIN_POWERED', "\n".'<!-- Powered by Sitekit v.'.SITEKIT_PLUGIN_VERSION.' wordpress.org/plugins/sitekit/ -->'."\n");


include( 'inc/sitekit-functions.php' );
include( 'inc/sitekit-settings.php' );


include( 'inc/sitekit-shortcode-archives.php' );
include( 'inc/sitekit-shortcode-bloginfo.php' );
include( 'inc/sitekit-shortcode-categories.php' );
include( 'inc/sitekit-shortcode-posts.php' );
include( 'inc/sitekit-shortcode-iframe.php' );


include( 'inc/sitekit-widget-search.php' );
include( 'inc/sitekit-widget-archives.php' );
include( 'inc/sitekit-widget-categories.php' );
include( 'inc/sitekit-widget-posts.php' );


function sitekit_enqueue_scripts() {
	//wp_enqueue_style( 'sitekit-flexify-style', plugin_dir_url( __FILE__ ) . 'flexify/css/flexify.css', array(), SITEKIT_PLUGIN_VERSION, 'all' );
	wp_enqueue_style( 'sitekit-style', plugin_dir_url( __FILE__ ) . 'css/sitekit.css', array(), SITEKIT_PLUGIN_VERSION, 'all' );
}
//add_action( 'wp_enqueue_scripts', 'sitekit_enqueue_scripts' );


function sitekit_wp_head() { // output content to the head section
	$settings = sitekit_get_settings();
	$code_head = $settings['code_head'];
	
	if ( ! empty( $code_head ) ) {
		echo "\n".'<!-- Sitekit head code -->'."\n";
		echo $code_head;
		echo "\n".'<!-- End of Sitekit head code -->'."\n";
	}
}
add_action( 'wp_head', 'sitekit_wp_head' );


function sitekit_wp_footer() { // output content to the footer section

	$settings = sitekit_get_settings();
	$code_footer = $settings['code_footer'];
	
	$ga_code = $settings['ga_code'];
	$ga_code_hide_if_loggedin = $settings['ga_code_hide_if_loggedin'];
	
	if ( ! empty( $code_footer ) ) {
		echo "\n".'<!-- Sitekit footer code -->'."\n";
		echo $code_footer;
		echo "\n".'<!-- End of Sitekit footer code -->'."\n";
	}
	
	
	if ( ! empty( $ga_code ) ) {
		if( !is_user_logged_in() || ( is_user_logged_in() && !$ga_code_hide_if_loggedin ) ) {
			echo "\n".'<!-- Sitekit Google Analytics code -->'."\n";
			?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo $ga_code; ?>', 'auto');
ga('send', 'pageview');
</script>
			<?php
			echo "\n".'<!-- End of Sitekit Google Analytics code -->'."\n";
		}
	}

}
add_action( 'wp_footer', 'sitekit_wp_footer' );


// TinyMCE Buttons code - https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
function sitekit_add_tinymce_button() {
	global $typenow;
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
	}
	if( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
		return;
	}
	if ( get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'sitekit_add_tinymce_plugin');
		add_filter('mce_buttons', 'sitekit_register_my_tc_button');
	}
}
add_action('admin_head', 'sitekit_add_tinymce_button');


function sitekit_add_tinymce_plugin($plugin_array) {
   	$plugin_array['sitekit_tinymce_button'] = plugins_url( '/js/tinymce.js', __FILE__ );
   	return $plugin_array;
}

function sitekit_register_my_tc_button($buttons) {
   array_push($buttons, 'sitekit_tinymce_button');
   return $buttons;
}


function sitekit_plugin_row_meta( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$row_meta = array(
			'support' => '<a href="http://web-profile.net/wordpress/plugins/sitekit/" target="_blank"><span class="dashicons dashicons-editor-help"></span> ' . __( 'Sitekit', 'sitekit' ) . '</a>',
			'donate' => '<a href="http://web-profile.net/donate/" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __( 'Donate', 'sitekit' ) . '</a>',
			'pro' => '<a href="http://codecanyon.net/item/silver-bullet-pro/15171769?ref=webvitalii" target="_blank" title="Silver Bullet Pro - Speedup and Protect WordPress in a Smart Way"><span class="dashicons dashicons-star-filled"></span> ' . __( 'Speedup and Protect WordPress', 'sitekit' ) . '</a>'
		);
		$links = array_merge( $links, $row_meta );
	}
	return (array) $links;
}
add_filter( 'plugin_row_meta', 'sitekit_plugin_row_meta', 10, 2 );
