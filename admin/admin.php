<?php

class MP_ADMIN
{

  public $slug = 'mp-plugin-settings';
  public $options_group = 'mp-setting-options';

  public function __construct()
  {

  }

  public function adminPage()
  {
    add_options_page('MP Settings', 'MP Settings', 'manage_options', $this->slug, [, $this, 'ui']);
  }

  public function ui()
  {
    include plugin_dir_path(__FILE__) . 'partials/settings-ui.php';
  }

  public function settings()
  {
    add_settings_field('mp_name', 'Name', [$this, 'field_markup'], $this->slug, $this->options_group);
    register_setting($this->options_group, 'name', ['sanitize', 'sanitize_text_field', 'default', '']);
  }

}

$mp_admin = new MP_ADMIN();
