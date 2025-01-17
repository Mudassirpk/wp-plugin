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
            if (post_type_exists('vehicle')) {
                $post = get_post($name);

                if (isset($post->ID)) {
                    if (!get_post_meta($post->ID, 'name', true)) {
                        add_post_meta($post->ID, 'name', $name);
                    }
                    if (!get_post_meta($post->ID, 'company', true)) {
                        add_post_meta($post->ID, 'company', $company);
                    }
                    if (!get_post_meta($post->ID, 'company', true)) {
                        add_post_meta($post->ID, 'production', $production);
                    }
                }

            } else {
                WP_Notice_Manager::display_notice("Post type vehicle not registered", "error");
            }


        }


    }

}

$mp_api = new MP_API();