<?php
/*
Plugin Name: Visitor Tracker
Description: Tracks all visitors to the website from any device and logs their IP, user agent, and timestamp.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access

// Create database table on plugin activation
register_activation_hook( __FILE__, 'vt_create_table' );

function vt_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'visitor_logs';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) NOT NULL AUTO_INCREMENT,
        ip_address VARCHAR(100),
        user_agent TEXT,
        visit_time DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

// Log visitor on every page load
add_action( 'wp_loaded', 'vt_log_visitor' );

function vt_log_visitor() {
    if ( is_admin() ) return; // Don't track admin dashboard visits

    global $wpdb;
    $table_name = $wpdb->prefix . 'visitor_logs';

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

    $wpdb->insert( $table_name, [
        'ip_address' => sanitize_text_field( $ip ),
        'user_agent' => sanitize_textarea_field( $user_agent ),
        'visit_time' => current_time( 'mysql' )
    ] );
}

// Add admin menu to view visitor logs
add_action( 'admin_menu', 'vt_add_admin_menu' );

function vt_add_admin_menu() {
    add_menu_page(
        'Visitor Logs',
        'Visitor Logs',
        'manage_options',
        'visitor-logs',
        'vt_display_logs',
        'dashicons-visibility',
        25
    );
}

function vt_display_logs() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'visitor_logs';

    $results = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY visit_time DESC LIMIT 100" );

    echo '<div class="wrap"><h1>Visitor Logs (Last 100)</h1><table class="widefat"><thead><tr><th>ID</th><th>IP Address</th><th>User Agent</th><th>Visit Time</th></tr></thead><tbody>';
    foreach ( $results as $row ) {
        echo '<tr>';
        echo '<td>' . esc_html( $row->id ) . '</td>';
        echo '<td>' . esc_html( $row->ip_address ) . '</td>';
        echo '<td>' . esc_html( $row->user_agent ) . '</td>';
        echo '<td>' . esc_html( $row->visit_time ) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}
