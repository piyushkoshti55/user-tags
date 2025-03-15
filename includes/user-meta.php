<?php
/**
 * Add User Tags Field to User Profile
 */
function cut_add_user_tags_field($user) {
    $terms = get_terms(array('taxonomy' => 'user_tags', 'hide_empty' => false));
    $user_terms = wp_get_object_terms($user->ID, 'user_tags', array('fields' => 'ids'));
    ?>
    <h2>User Tags</h2>
    <table class="form-table">
        <tr>
            <th><label for="user_tags">User Tags</label></th>
            <td>
                <select name="user_tags[]" multiple="multiple" style="width: 100%;">
                    <?php foreach ($terms as $term) : ?>
                        <option value="<?php echo esc_attr($term->term_id); ?>" 
                            <?php echo in_array($term->term_id, $user_terms) ? 'selected' : ''; ?>>
                            <?php echo esc_html($term->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'cut_add_user_tags_field');
add_action('edit_user_profile', 'cut_add_user_tags_field');

/**
 * Save User Tags
 */
function cut_save_user_tags($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    if (isset($_POST['user_tags'])) {
        wp_set_object_terms($user_id, array_map('intval', $_POST['user_tags']), 'user_tags', false);
    } else {
        wp_set_object_terms($user_id, array(), 'user_tags', false);
    }
}
add_action('personal_options_update', 'cut_save_user_tags');
add_action('edit_user_profile_update', 'cut_save_user_tags');
