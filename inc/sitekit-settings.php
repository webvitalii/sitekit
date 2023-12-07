<?php
/*
Sitekit settings code
Powered by WordPress Settings API - http://codex.wordpress.org/Settings_API
*/

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
	exit;
}


function sitekit_menu() {
	add_menu_page( __( 'Sitekit Settings', 'sitekit' ), __( 'Sitekit Settings', 'sitekit' ),
		'manage_options', 'sitekit', 'sitekit_settings', 'dashicons-admin-generic', 45 );
}
add_action('admin_menu', 'sitekit_menu');


function sitekit_admin_init() {
	register_setting('sitekit_settings_group', 'sitekit_settings', 'sitekit_settings_validate');

	add_settings_section('sitekit_settings_general_section', '', 'sitekit_section_callback', 'sitekit_general_page');
	add_settings_section('sitekit_settings_code_section', '', 'sitekit_section_callback', 'sitekit_code_page');

	add_settings_field('ga_code', __( 'Google analytics code (GA4)', 'sitekit' ), 'sitekit_field_ga_code_callback', 'sitekit_general_page', 'sitekit_settings_general_section');
	add_settings_field('ga_code_hide_if_loggedin', __( 'Hide Google analytics code if use is logged in', 'sitekit' ), 'sitekit_field_ga_code_hide_if_loggedin_callback', 'sitekit_general_page', 'sitekit_settings_general_section');
	
	add_settings_field('code_head', __( 'Head code', 'sitekit' ), 'sitekit_field_code_head_callback', 'sitekit_code_page', 'sitekit_settings_code_section');
	add_settings_field('code_footer', __( 'Footer code', 'sitekit' ), 'sitekit_field_code_footer_callback', 'sitekit_code_page', 'sitekit_settings_code_section');
}
add_action('admin_init', 'sitekit_admin_init');


function sitekit_settings_init() { // set default settings
	global $sitekit_settings;
	$sitekit_settings = sitekit_get_settings();
	update_option('sitekit_settings', $sitekit_settings);
}
add_action('admin_init', 'sitekit_settings_init');


function sitekit_settings_validate($input) {
	$default_settings = sitekit_get_settings();
	$output['ga_code_hide_if_loggedin'] = $input['ga_code_hide_if_loggedin'];

	$output['code_head'] = trim($input['code_head']);
	$output['code_footer'] = trim($input['code_footer']);
	
	$output['ga_code'] = trim($input['ga_code']);
	return $output;
}


function sitekit_section_callback() { // Sitekit settings description
	echo '';
}


function sitekit_field_code_head_callback() {
	$settings = sitekit_get_settings();
	$default_settings = sitekit_default_settings();
	echo '<textarea name="sitekit_settings[code_head]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_head'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to head section just before closing [head] tag', 'sitekit' ).'</p>';
}


function sitekit_field_code_footer_callback() {
	$settings = sitekit_get_settings();
	$default_settings = sitekit_default_settings();
	echo '<textarea name="sitekit_settings[code_footer]" class="large-text" style="width: 25em; height: 100px;">'.$settings['code_footer'].'</textarea>';
	echo '<p class="description">'.__( 'Code will be added to body section just before closing [body] tag', 'sitekit' ).'</p>';
}


function sitekit_field_ga_code_callback() {
	$settings = sitekit_get_settings();
	$default_settings = sitekit_default_settings();
	echo '<input type="text" name="sitekit_settings[ga_code]" class="regular-text" value="'.$settings['ga_code'].'" />';
	echo '<p class="description">Example: G-LENB42R6HN</p>';
}


function sitekit_field_ga_code_hide_if_loggedin_callback() {
	$settings = sitekit_get_settings();
	echo '<label><input type="checkbox" name="sitekit_settings[ga_code_hide_if_loggedin]" '.checked(1, $settings['ga_code_hide_if_loggedin'], false).' value="1" />';
	echo ' Hide Google analytics code if use is logged in</label>';
	echo '<p class="description"></p>';
}


function sitekit_settings() {
	
	?>
	<div class="wrap">
		
		<h2><span class="dashicons dashicons-admin-generic" style="position: relative; top: 4px;"></span> 
			<?php echo __( 'Sitekit Settings', 'sitekit' ); ?></h2>
		
		
		<h2 class="nav-tab-wrapper">
			<a href="#" class="nav-tab sitekit-tab-general">General</a>
			<a href="#" class="nav-tab sitekit-tab-code">Code</a>
		</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields('sitekit_settings_group'); ?>
			<div class="sitekit-group-general">
				<?php do_settings_sections('sitekit_general_page'); ?>
			</div>
			<div class="sitekit-group-code">
				<?php do_settings_sections('sitekit_code_page'); ?>
			</div>
			<?php submit_button(); ?>
		</form>


		<script>
			jQuery(function($){
				$('.sitekit-tab-general').click(function(event) {
					event.preventDefault();
					$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
					$('.sitekit-group-general').slideDown();
					$('.sitekit-group-code').slideUp();
				});

				$('.sitekit-tab-code').click(function(event) {
					event.preventDefault();
					$(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
					$('.sitekit-group-code').slideDown();
					$('.sitekit-group-general').slideUp();
				});

				$('.sitekit-tab-general').click();
			});
		</script>
	
	
	</div><!-- .wrap -->
	<?php
}