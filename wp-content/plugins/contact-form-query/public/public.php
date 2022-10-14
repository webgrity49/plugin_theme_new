<?php
defined( 'ABSPATH' ) || die();

require_once STCFQ_PLUGIN_DIR_PATH . 'public/inc/class-stcfq-language.php';
require_once STCFQ_PLUGIN_DIR_PATH . 'public/inc/class-stcfq-shortcode.php';
require_once STCFQ_PLUGIN_DIR_PATH . 'public/inc/class-stcfq-admin-bar.php';

add_action( 'init', array( 'STCFQ_Language', 'load_translation' ) );

add_shortcode( 'contact_form_query', array( 'STCFQ_Shortcode', 'contact_form_query' ) );

add_action( 'wp_ajax_stcfq-save-contact', array( 'STCFQ_Shortcode', 'save_contact_form_query' ) );
add_action( 'wp_ajax_nopriv_stcfq-save-contact', array( 'STCFQ_Shortcode', 'save_contact_form_query' ) );

add_action( 'admin_bar_menu', array( 'STCFQ_Admin_Bar', 'admin_bar_menu' ), 61 );
add_action( 'admin_enqueue_scripts', array( 'STCFQ_Admin_Bar', 'admin_bar_menu_assets' ) );
add_action( 'wp_enqueue_scripts', array( 'STCFQ_Admin_Bar', 'admin_bar_menu_assets' ) );
