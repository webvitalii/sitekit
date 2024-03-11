<?php
/*
Plugin Name: Sitekit
Plugin URI: https://wordpress.org/plugins/sitekit/
Description: Widgets: search, archives, categories, pages, posts. Shortcodes: archives, bloginfo, categories, posts.
Version: 1.7
Author: webvitaly
Text Domain: sitekit
Author URI: http://web-profile.net/wordpress/plugins/
License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}

define('SITEKIT_PLUGIN_VERSION', '1.7');
define('SITEKIT_PLUGIN_POWERED', "\n".'<!-- Powered by Sitekit v.'.SITEKIT_PLUGIN_VERSION.' https://wordpress.org/plugins/sitekit/ -->'."\n");


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

	$ga_code = $settings['ga_code'];
	$ga_code_hide_if_loggedin = $settings['ga_code_hide_if_loggedin'];

		
	if ( ! empty( $ga_code ) ) {
		if( !is_user_logged_in() || ( is_user_logged_in() && !$ga_code_hide_if_loggedin ) ) {
			?>
<!-- Sitekit Google Analytics code -->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_code; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $ga_code; ?>');
</script>
<!-- End of Sitekit Google Analytics code -->
			<?php
		}
	}

}
add_action( 'wp_head', 'sitekit_wp_head' );


function sitekit_wp_footer() { // output content to the footer section

	$settings = sitekit_get_settings();
	$code_footer = $settings['code_footer'];
	
	
	
	if ( ! empty( $code_footer ) ) {
		echo "\n".'<!-- Sitekit footer code -->'."\n";
		echo $code_footer;
		echo "\n".'<!-- End of Sitekit footer code -->'."\n";
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
			'support' => '<a href="http://web-profile.net/wordpress/plugins/sitekit/" target="_blank">' . __( 'Sitekit', 'sitekit' ) . '</a>',
			'donate' => '<a href="http://web-profile.net/donate/" target="_blank">' . __( 'Donate', 'sitekit' ) . '</a>',
			'pro' => '<a href="https://1.envato.market/KdRNz" target="_blank" title="Advanced iFrame Pro">' . __( 'Advanced iFrame Pro', 'sitekit' ) . '</a>'
		);
		$links = array_merge( $links, $row_meta );
	}
	return (array) $links;
}
add_filter( 'plugin_row_meta', 'sitekit_plugin_row_meta', 10, 2 );
