<?php

class MP_ADMIN
{

  public $slug = 'mp-plugin-settings';
  public $options_group = 'mp-setting-options';
  public $vehicles = null;

  public function __construct()
  {
    add_action('admin_menu', [$this, 'adminPage']);
    add_action('admin_menu', [$this, 'renderVehicles']);
    register_activation_hook(__FILE__, [$this, 'flush_rewrite_rules_on_activation']);
  }

  public function renderVehicles()
  {
    $vehicles = $this->get_vehicles_with_metadata();
    include_once plugin_dir_path(__FILE__) . 'partials/render-vehicles.php';
  }

  public function adminPage()
  {
    add_options_page('MP Settings', 'MP Settings', 'manage_options', $this->slug, [$this, 'ui']);
  }

  public function ui()
  {
    include plugin_dir_path(__FILE__) . 'partials/add-vehicle.php';
  }

  public function create_vehicle_cpt()
  {
    // if (!post_type_exists('vehicle')) {
    try {
      $labels = [
        'name' => 'Vehicles',
        'singular_name' => 'Vehicle',
        'menu_name' => 'Vehicles',
        'name_admin_bar' => 'Vehicle',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Vehicle',
        'new_item' => 'New Vehicle',
        'edit_item' => 'Edit Vehicle',
        'view_item' => 'View Vehicle',
        'all_items' => 'All Vehicles',
        'search_items' => 'Search Vehicles',
        'parent_item_colon' => 'Parent Vehicles:',
        'not_found' => 'No vehicles found.',
        'not_found_in_trash' => 'No vehicles found in Trash.',
      ];

      $args = [
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'vehicle'],
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'],
      ];

      register_post_type('vehicle', $args);

      error_log('Vehicle post type registered'); // Debug log
      // }
    } catch (Exception $err) {
      error_log($err->getMessage());
    }
  }

  public function get_vehicles_with_metadata()
  {
    $vehicles = get_posts(array(
      'post_type' => 'vehicle',
    ));

    foreach ($vehicles as &$vehicle) {
      $vehicle->production = get_post_meta($vehicle->ID, 'production', true);
      $vehicle->company = get_post_meta($vehicle->ID, 'company', true);
    }

    return $vehicles;
  }

  public function flush_rewrite_rules_on_activation()
  {
    $this->create_vehicle_cpt(); // Ensure the custom post type is registered
    flush_rewrite_rules(); // Flush the rewrite rules to make sure 'vehicle' post type is recognized
  }
}

$mp_admin = new MP_ADMIN();

