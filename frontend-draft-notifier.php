<?php
/*
Plugin Name: Frontend Draft Notifier
Description: Shows a floating draft post counter on the frontend for logged-in admins and editors. Customizable for post types, roles, and button position.
Version: 1.1
Author: Ishan Udayanga
Author URI: https://ishanudayanga.com
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') or die('No script kiddies please!');

// Include settings page
require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';

// Enqueue frontend script and styles
function fdn_enqueue_assets() {
    if (!is_user_logged_in()) return;

    $user = wp_get_current_user();
    $roles = get_option('fdn_roles', ['administrator', 'editor']);
    $post_types = get_option('fdn_post_types', ['post']);
    $position = get_option('fdn_position', 'bottom-right');

    if (!array_intersect($roles, $user->roles)) return;

    // Count drafts across selected post types
    $total_drafts = 0;
    foreach ($post_types as $pt) {
        $count = wp_count_posts($pt)->draft ?? 0;
        $total_drafts += $count;
    }

    wp_enqueue_style('fdn-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('fdn-script', plugin_dir_url(__FILE__) . 'js/notifier.js', ['jquery'], null, true);

    wp_localize_script('fdn-script', 'fdnData', [
        'draftCount' => $total_drafts,
        'draftUrl' => admin_url('edit.php?post_status=draft'),
        'position' => $position,
    ]);
}
add_action('wp_enqueue_scripts', 'fdn_enqueue_assets');
