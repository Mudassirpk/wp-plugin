<?php

class MP_API
{
    public static $CREATE_MP_VEHICLE_ACTION = "CREATE_MP_VEHICLE_ACTION";

    public function __construct()
    {
        add_action('admin_post_' . self::$CREATE_MP_VEHICLE_ACTION, [$this, 'post']);
    }

    public function post()
    {
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

            WP_Notice_Manager::add_notice("Success","info");
        }else{

            WP_Notice_Manager::add_notice("Post type not found","error");
        }



    }

}

$mp_api = new MP_API();