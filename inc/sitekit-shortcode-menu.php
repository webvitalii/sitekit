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
    
    return wp_nav_menu( $atts ) . SITEKIT_PLUGIN_POWERED;
}
add_shortcode( 'sitekit_menu', 'sitekit_shortcode_menu' );