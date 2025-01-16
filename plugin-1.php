<?php

/*
    Plugin Name: plugin-1
    Description: plugin-1
    Version: 1.0
    Author: MSK
 */

if (!defined("ABSPATH"))
  exit;

require_once plugin_dir_path(__FILE__) . "includes/notices.php";
require_once plugin_dir_path(__FILE__) . 'includes/api.php';

class MPlugin
{
  public function __construct()
  {
    add_action('admin_notices', [$this, 'display_custom_notices']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
    add_action('admin_post_' . MP_API::$CREATE_MP_VEHICLE_ACTION, [$this, 'handle_create_vehicle_action']);
  }

  public function display_custom_notices()
  {
    WP_Notice_Manager::display_notices();
  }

  public function enqueue_styles()
  {
    wp_register_style('mp-css', plugin_dir_url(__FILE__) . 'admin/css/add-vehicle.css');
    wp_enqueue_style('mp-css');
  }

  public function handle_create_vehicle_action()
  {
    $api = new MP_API();
    $api->post();
    wp_redirect(admin_url('admin.php?page=mp-plugin-settings'));
    exit;
  }
}

$mp_plugin = new MPlugin();

include_once plugin_dir_path(__FILE__) . "/admin/admin.php";
