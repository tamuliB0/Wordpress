<?php

/* 
Plugin Name: My Custom Admin Page
Description: Adds a custom admin page to the dashboard.
Version: 1.0
Author: Your Name
*/

add_action('admin_menu', 'my_custom_admin_menu');

function my_custom_admin_menu() {
    add_menu_page(
        'My Custom Page',         // Page title
        'Custom Admin',           // Menu title
        'manage_options',         // Capability
        'my-custom-admin',        // Menu slug
        'my_custom_admin_page',   // Callback function
        'dashicons-admin-generic', // Icon
        20                        // Position
    );
}

function my_custom_admin_page() {
    ?>
    <div class="wrap">
        <h1>My Custom Admin Page</h1>
        <p>Welcome to your custom admin page!</p>
    </div>
    <?php
}