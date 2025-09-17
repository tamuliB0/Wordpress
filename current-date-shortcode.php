<?php

/*
Plugin Name: Current date shortcode
Description: Displays current date across pages/posts
Author: Name
Version: 1.0 
*/

function shortcode_content() {
    return date('F j, Y h:i A');

}

add_shortcode('current_date','shortcode_content');