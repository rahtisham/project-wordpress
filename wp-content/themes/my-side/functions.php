<?php
/**
 * Theme setup and custom functions for My Side theme.
 */

function myside_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'myside'),
    ));
}
add_action('after_setup_theme', 'myside_theme_setup');

function myside_scripts() {
    wp_enqueue_style('myside-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'myside_scripts');

function myside_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'myside'),
        'id'            => 'sidebar-1',
        'description'   => __('Main sidebar that appears on posts and pages.', 'myside'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'myside_widgets_init');

function myside_create_product_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'myside_products';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        price decimal(10,2) NOT NULL DEFAULT '0.00',
        created_at datetime NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_setup_theme', 'myside_create_product_table');

/**
 * Ensure a 'Product' page exists and assign the Product Form template.
 */
function myside_ensure_product_page() {
    if ( get_option( 'myside_product_page_created' ) ) {
        return;
    }

    $existing = get_page_by_path( 'product' );
    if ( $existing ) {
        update_option( 'myside_product_page_created', 1 );
        return;
    }

    $page = array(
        'post_title'   => 'Product',
        'post_name'    => 'product',
        'post_content' => '',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_author'  => 1,
    );

    $page_id = wp_insert_post( $page );
    if ( $page_id && ! is_wp_error( $page_id ) ) {
        update_post_meta( $page_id, '_wp_page_template', 'page-product.php' );
        update_option( 'myside_product_page_created', 1 );
    }
}
add_action( 'init', 'myside_ensure_product_page' );
