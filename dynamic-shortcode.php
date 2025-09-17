<?php

/*
Plugin Name: Dynamic shortcode
Description: Displays dynamic greeting based on if user is logged in
Author: Name
Version: 1.0
 */

function dynamic_shortcode() {
    if (is_user_logged_in()){
        $current_user = wp_get_current_user();
        return "Hello, "."($current_user->display_name)";
    } else {
        return "Hello, Guest.";
    }
}

add_shortcode('greeting','dynamic_shortcode');