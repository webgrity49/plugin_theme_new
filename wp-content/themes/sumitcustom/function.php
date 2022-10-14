<?php

function insert_styles(){
    wp_enqueue_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css');
    wp_enqueue_style('core', get_template_directory_uri(). '/style.css');
}
add_action('wp_enqueue_scripts', 'insert_styles');

function insert_scripts(){
    wp_enqueue_script('bootstrap', get_template_directory_uri(). '/js/vendor/bootstrap.bundle.min.js');
}
add_action('wp_enqueue_scripts', 'insert_scripts');

function themeaw_setup(){
    register_nav_menus(array(
        'menu-1' => 'Header Menu',
        'footer-menu' => 'Footer Menu'
    ));
}
add_action('init', 'themeaw_setup');