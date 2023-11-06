<?php

//enqueue css//
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style',
        get_stylesheet_directory_uri() . '/style.css',
        wp_get_theme()->get('1.0.0')
    );
  }
  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


//création des emplacements de menu//
function register_custom_menu_locations() {
    register_nav_menus(
        array(
            'menu-footer' => __('Menu du Footer'),
            'menu-header' => __('Menu du Header'),
        )
    );
}
add_action('after_setup_theme', 'register_custom_menu_locations');

//enqueue script.js
function mon_theme_enqueue_scripts() {
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'mon_theme_enqueue_scripts');