<?php
/**
 * Add User Tags Section in Admin Menu
 */
function cut_add_user_tags_menu() {
    add_users_page('User Tags', 'User Tags', 'manage_options', 'edit-tags.php?taxonomy=user_tags');
}
add_action('admin_menu', 'cut_add_user_tags_menu');

/**
 * Fix "User Tags" menu highlighting the "Posts" menu
 */
function cut_fix_user_tags_admin_menu() {
    global $parent_file, $submenu_file, $current_screen;

    if ($current_screen->taxonomy === 'user_tags') {
        $parent_file  = 'users.php';
        $submenu_file = 'edit-tags.php?taxonomy=user_tags';
    }
}
add_action('admin_head', 'cut_fix_user_tags_admin_menu');
