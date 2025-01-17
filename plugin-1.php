<?php

/*
    Plugin Name: plugin-1
    Description: plugin-1
    Version: 1.0
    Author: MSK
 */

if (!defined("ABSPATH"))
  exit;

function my_cpt()
{
  error_log('registering cpt');
  $label = array(
    'name' => 'properties',
    'singular_name' => 'property'
  );

  $options = array(
    'labels' => $label,
    'public' => true,
    'has_archive' => true,
    'rewrite' => true,
    'show_in_rest' => true
  );

  register_post_type('property', $options);
  error_log('cpt registered');
}

add_action('init', 'my_cpt');

// require_once plugin_dir_path(__FILE__) . "includes/notices.php";
// require_once plugin_dir_path(__FILE__) . 'includes/api.php';
// include plugin_dir_path(__FILE__) . "/admin/admin.php";

// class MPlugin
// {
//   public function __construct()
//   {
//     add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
//     $mp_admin = new MP_ADMIN();
//     add_action('init', array($mp_admin, 'create_vehicle_cpt'));
//   }


//   public function enqueue_styles()
//   {
//     wp_register_style('mp-css', plugin_dir_url(__FILE__) . 'admin/css/add-vehicle.css');
//     wp_enqueue_style('mp-css');
//     wp_register_style('mp-notice-css', plugin_dir_url(__FILE__) . 'includes/css/notice.css');
//     wp_enqueue_style('mp-notice-css');
//   }

// }

// $mp_plugin = new MPlugin();

