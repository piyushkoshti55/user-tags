<?php
/**
 * Enqueue Select2 for User Tags
 */
function cut_enqueue_admin_scripts($hook) {
    if (in_array($hook, ['profile.php', 'user-edit.php', 'user-new.php'])) {
        wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array('jquery'), null, true);
        wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
        wp_add_inline_script('select2', 'jQuery(document).ready(function($){ $("select[name=\'user_tags[]\']").select2(); });');
    }
}
add_action('admin_enqueue_scripts', 'cut_enqueue_admin_scripts');
