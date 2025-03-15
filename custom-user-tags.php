<?php
/*
Plugin Name: Custom User Tags
Plugin URI:  https://yourwebsite.com/
Description: Adds custom taxonomy "User Tags" for categorizing users in WordPress.
Version:     1.0
Author:      Piyush Practical (User Tags)
License:     GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define Plugin Path & URL
define('CUT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CUT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once CUT_PLUGIN_DIR . 'includes/taxonomy.php';
require_once CUT_PLUGIN_DIR . 'includes/admin-menu.php';
require_once CUT_PLUGIN_DIR . 'includes/user-meta.php';
require_once CUT_PLUGIN_DIR . 'includes/user-list.php';
require_once CUT_PLUGIN_DIR . 'includes/scripts.php';