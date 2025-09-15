<?php
/*
Plugin Name: Hello World
Description: A simple plugin that displays "Hello world" in the WordPress admin dashboard.
Author: ABC
Version: 1.0
*/

function hello_world() {
    echo "<p id='hello-world' style='padding:20px; margin:0; font-size:14px;'>Hello world</p>";
}
add_action('admin_notices', 'hello_world');

function hello_world_css() {
    echo "
    <style type='text/css'>
        #hello-world {
            color:rgb(0, 170, 156);
            font-weight: bold;
        }
    </style>
    ";
}
add_action('admin_head', 'hello_world_css');