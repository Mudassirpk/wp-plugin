<?php

class MP_API
{
    public static $CREATE_MP_VEHICLE_ACTION = "CREATE_MP_VEHICLE_ACTION";

    public function __construct()
    {
        add_action('init', [$this, 'post']);
    }

    public function post()
    {
        if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'CREATE_MP_VEHICLE_ACTION') {
            $name = $_POST['name'];
            $company = $_POST['company'];
            $production = $_POST['production'];
            $post = wp_insert_post([
                'post_title' => $name,
                'post_type' => 'vehicle',
                'post_status' => 'publish',
                'post_author' => get_current_user_id()
            ]);

            if (isset($post)) {
                if (!get_post_meta($post, 'company', true)) {
                    add_post_meta($post, 'company', $company);
                }
                if (!get_post_meta($post, 'production', true)) {
                    add_post_meta($post, 'production', $production);
                }
            }

            WP_Notice_Manager::display_notice("Vehicle addedd successfully", "success");
        }
    }



}

$mp_api = new MP_API();