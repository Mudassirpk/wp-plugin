<?php

class WP_Notice_Manager
{
    private static $notice = null;
    private static $type = '';

    public function __construct()
    {
        add_action("admin_notices", array($this, "add_notice"));
    }

    public function add_notice()
    {
        if (self::$notice) {
            printf('<div class="notice is-dismissible %2$s">%1$s</div>', esc_html(self::$notice), self::$type);
        }
    }
    // Method to add a notice

    public static function display_notice(string $message, string $type)
    {
        self::$notice = $message;
        self::$type = $type;
    }

}

$notice_manager = new WP_Notice_Manager();