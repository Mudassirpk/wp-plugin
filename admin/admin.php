<?php

class MP_ADMIN
{

  public $slug = 'mp-plugin-settings';
  public $options_group = 'mp-setting-options';

  public function __construct()
  {
    add_action('admin_menu', [$this, 'adminPage']);
    add_action('init', [$this, 'create_vehicle_cpt']);
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
    if (!post_type_exists('vehicle')) {
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
    }
  }

  public function add_vehicle_metabox()
  {
    add_meta_box(
      'vehicle_metabox', // ID for the meta box
      'Vehicle metabox', // Title of the meta box
      '', // Callback function (can be left empty)
      'vehicle', // Post type
      'normal', // Context: where to display (normal, side, advanced)
      'high' // Priority: high, low
    );
  }



}

$mp_admin = new MP_ADMIN();
