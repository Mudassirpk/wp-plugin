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
include plugin_dir_path(__FILE__) . "/admin/admin.php";
require_once plugin_dir_path(__FILE__) . "includes/gb-blocks/vehicle-block.php";

class MPlugin
{
  public function __construct()
  {
    add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
    add_action('init',[$this,'enqueue_block_styles']);
  }


  public function enqueue_styles()
  {
    wp_register_style('mp-css', plugin_dir_url(__FILE__) . 'admin/css/add-vehicle.css');
    wp_enqueue_style('mp-css');
    wp_register_style('mp-notice-css', plugin_dir_url(__FILE__) . 'includes/css/notice.css');
    wp_enqueue_style('mp-notice-css');

  }

  public function enqueue_block_styles(){
    wp_register_style('mp-block-vehicle-css', plugin_dir_url(__FILE__) . 'includes/gb-blocks/styles.css');
    wp_enqueue_style('mp-block-vehicle-css');
  }

}

$mp_plugin = new MPlugin();

