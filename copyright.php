<?php
/*
Plugin Name: Copyright-footer
Description: Displays a copyright notice in the footer with the current year.
Author: ABC
Version: 1.0
*/

function display_footer_notice() {
    $year = date('Y');
    $site_name = get_bloginfo('name');

    if (is_user_logged_in()){
        echo "<p style ='text-align: center; padding: 10px; font-size: 14px; color: #888;'>
        &copy; $year $site_name. All rights reserved.
        </p>";
    } else {
        echo "<p style='text-align: center;'>No copyright info</p>";
    }
    
}
add_action('wp_footer', 'display_footer_notice');