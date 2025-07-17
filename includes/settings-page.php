<?php

function fdn_register_settings() {
    register_setting('fdn_settings_group', 'fdn_roles');
    register_setting('fdn_settings_group', 'fdn_post_types');
    register_setting('fdn_settings_group', 'fdn_position');
}
add_action('admin_init', 'fdn_register_settings');

function fdn_settings_menu() {
    add_options_page('Draft Notifier Settings', 'Draft Notifier', 'manage_options', 'fdn-settings', 'fdn_settings_page');
}
add_action('admin_menu', 'fdn_settings_menu');

function fdn_settings_page() {
    $roles = wp_roles()->roles;
    $post_types = get_post_types(['public' => true], 'objects');
    $saved_roles = (array)get_option('fdn_roles', ['administrator', 'editor']);
    $saved_types = (array)get_option('fdn_post_types', ['post']);
    $position = get_option('fdn_position', 'bottom-right');
    ?>
    <div class="wrap">
        <h1>Frontend Draft Notifier Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('fdn_settings_group'); ?>

            <h3>Visible To Roles</h3>
            <?php foreach ($roles as $key => $role): ?>
                <label>
                    <input type="checkbox" name="fdn_roles[]" value="<?= esc_attr($key); ?>" <?= in_array($key, $saved_roles) ? 'checked' : ''; ?>>
                    <?= esc_html($role['name']); ?>
                </label><br>
            <?php endforeach; ?>

            <h3>Post Types to Monitor</h3>
            <?php foreach ($post_types as $key => $pt): ?>
                <label>
                    <input type="checkbox" name="fdn_post_types[]" value="<?= esc_attr($key); ?>" <?= in_array($key, $saved_types) ? 'checked' : ''; ?>>
                    <?= esc_html($pt->labels->name); ?>
                </label><br>
            <?php endforeach; ?>

            <h3>Button Position</h3>
            <select name="fdn_position">
                <option value="bottom-right" <?= $position === 'bottom-right' ? 'selected' : ''; ?>>Bottom Right</option>
                <option value="bottom-left" <?= $position === 'bottom-left' ? 'selected' : ''; ?>>Bottom Left</option>
                <option value="top-right" <?= $position === 'top-right' ? 'selected' : ''; ?>>Top Right</option>
                <option value="top-left" <?= $position === 'top-left' ? 'selected' : ''; ?>>Top Left</option>
            </select>

            <br><br>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
