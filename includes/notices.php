<?php

class WP_Notice_Manager
{

    // Method to add a notice
    public static function add_notice($message, $type = 'updated')
    {
        // Valid notice types are 'updated', 'error', 'warning', 'info'
        $valid_types = ['updated', 'error', 'warning', 'info'];

        // Ensure the type is valid, default to 'updated' if not
        if (!in_array($type, $valid_types)) {
            $type = 'updated';
        }

        // Add the notice using WordPress's add_settings_error
        add_settings_error(
            'wp_notice_manager',  // Unique ID for the notice
            'wp_notice_' . time(), // Unique ID for the message
            $message,              // The message content
            $type                   // The notice type ('updated', 'error', 'warning', 'info')
        );
    }

    // Method to display the notices
    public static function display_notices()
    {
        settings_errors('wp_notice_manager'); // Display all notices with the ID 'wp_notice_manager'
    }
}