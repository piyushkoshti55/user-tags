<?php
/**
 * Register Custom Taxonomy for Users
 */
function cut_register_user_tags() {
    $args = array(
        'labels'            => array(
            'name'          => 'User Tags',
            'singular_name' => 'User Tag',
            'menu_name'     => 'User Tags',
        ),
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'hierarchical'      => false,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms' => 'edit_users',
            'edit_terms'   => 'edit_users',
            'delete_terms' => 'edit_users',
            'assign_terms' => 'edit_users',
        ),
    );
    register_taxonomy('user_tags', 'user', $args);
}
add_action('init', 'cut_register_user_tags');
