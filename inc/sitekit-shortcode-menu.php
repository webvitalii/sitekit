<?php

if ( ! defined( 'ABSPATH' ) ) { // prevent full path disclosure
    exit;
}

function sitekit_shortcode_menu( $atts ) {
    $defaults = array(
        'menu'            => '',
        'container'       => 'div',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => false,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    );
    
    $atts = shortcode_atts( $defaults, $atts, 'sitekit_menu' );
    
    // Sanitize attributes to prevent XSS attacks
    $safe_atts = array();
    
    // Sanitize text fields
    $text_fields = array('menu', 'fallback_cb', 'walker');
    foreach ($text_fields as $field) {
        $safe_atts[$field] = isset($atts[$field]) ? sanitize_text_field($atts[$field]) : '';
    }
    
    // Sanitize HTML attributes that will appear as tag attributes
    $html_attr_fields = array('container', 'container_class', 'container_id', 'menu_class', 'menu_id', 'before', 'after', 'link_before', 'link_after', 'items_wrap');
    foreach ($html_attr_fields as $field) {
        if (isset($atts[$field])) {
            if ($field === 'container') {
                // Container should only accept specific valid values
                $safe_atts[$field] = in_array($atts[$field], array('div', 'nav', '', false)) ? $atts[$field] : 'div';
            } elseif ($field === 'items_wrap') {
                // Items wrap is a special case with a specific format
                $safe_atts[$field] = sanitize_text_field($atts[$field]);
            } else {
                $safe_atts[$field] = sanitize_html_class($atts[$field]);
            }
        } else {
            $safe_atts[$field] = '';
        }
    }
    
    // Handle numeric values
    $safe_atts['depth'] = isset($atts['depth']) ? intval($atts['depth']) : 0;
    $safe_atts['echo'] = isset($atts['echo']) ? (bool)$atts['echo'] : false;
    
    return wp_nav_menu( $safe_atts ) . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_menu', 'sitekit_shortcode_menu' );