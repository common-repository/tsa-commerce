<?php

add_action( 'wp_enqueue_scripts', 'tsac_register_plugin_styles' );

function tsac_register_plugin_styles() {
	wp_register_style( 'tsacommerce-stylesheet', tsac_get_uri() . '/assets/css/main.css', array(), '', 'all' );
    wp_enqueue_style( 'tsacommerce-stylesheet' );
}
