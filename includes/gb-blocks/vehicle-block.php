<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function register_vehicle_block()
{
    $block_js_path = plugin_dir_path(__FILE__) . 'block.js';
    $block_css_path = plugin_dir_path(__FILE__) . 'style.css';

    // Register block editor script
    if (file_exists($block_js_path)) {
        wp_register_script(
            'vehicle-block-editor',
            plugin_dir_url(__FILE__) . 'block.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
            filemtime($block_js_path)
        );
    }

    // Register block styles
    if (file_exists($block_css_path)) {
        wp_register_style(
            'vehicle-block-style',
            plugin_dir_url(__FILE__) . 'style.css',
            array('wp-blocks'),
            filemtime($block_css_path)
        );
    }

    // Register the block
    register_block_type('custom/vehicle-block', array(
        'editor_script' => 'vehicle-block-editor',
        'editor_style' => 'vehicle-block-style',
        'render_callback' => 'render_vehicle_block',
    ));
}

add_action('init', 'register_vehicle_block');

// Callback to render block content
function render_vehicle_block($attributes)
{
    // Fetch vehicle data using REST API or WP_Query
    $vehicles = get_vehicles(); // Custom function that returns vehicles

    ob_start();
    include plugin_dir_path(__FILE__) . 'partials/vehicle-list.php';
    return ob_get_clean();
}

// Custom function to get vehicles
function get_vehicles()
{
    $args = array(
        'post_type' => 'vehicle',  // Custom post type
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    $vehicles = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $vehicles[] = [
                'title' => get_the_title(),
                'company' => get_post_meta(get_the_ID(), 'company', true),
                'production' => get_post_meta(get_the_ID(), 'production', true),
            ];
        }
        wp_reset_postdata();
    }

    return $vehicles;
}
