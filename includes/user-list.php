<?php
/**
 * Add User Tags Column to Users List
 */
function cut_add_user_tags_column($columns) {
    $columns['user_tags'] = 'User Tags';
    return $columns;
}
add_filter('manage_users_columns', 'cut_add_user_tags_column');

/**
 * Populate User Tags Column
 */
function cut_show_user_tags_column_data($value, $column_name, $user_id) {
    if ($column_name == 'user_tags') {
        $terms = wp_get_object_terms($user_id, 'user_tags', array('fields' => 'names'));
        return !empty($terms) ? esc_html(implode(', ', $terms)) : '—';
    }
    return $value;
}
add_filter('manage_users_custom_column', 'cut_show_user_tags_column_data', 10, 3);

/**
 * Filter Users by User Tags
 */
function cut_filter_users_by_tag($which) {
    if ($which !== 'top') return;

    $taxonomy = 'user_tags';
    $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => false));
    $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';

    echo '<select name="' . esc_attr($taxonomy) . '" style="float: none; margin-left: 10px;">';
    echo '<option value="">Filter by user tags...</option>';
    foreach ($terms as $term) {
        echo '<option value="' . esc_attr($term->term_id) . '" ' . selected($selected, $term->term_id, false) . '>' . esc_html($term->name) . '</option>';
    }
    echo '</select>';
    submit_button('Filter', '', '', false);
}
add_action('restrict_manage_users', 'cut_filter_users_by_tag');

/**
 * Modify Users Query Based on Selected Tag
 */
function cut_filter_users_query($query) {
    global $pagenow;
    if (is_admin() && $pagenow == 'users.php' && isset($_GET['user_tags']) && $_GET['user_tags'] != '') {
        $tag_id = intval($_GET['user_tags']);
        $user_ids = get_objects_in_term($tag_id, 'user_tags');
        if (!empty($user_ids)) {
            $query->query_vars['include'] = $user_ids;
        } else {
            $query->query_vars['include'] = array(0);
        }
    }
}
add_action('pre_get_users', 'cut_filter_users_query');
