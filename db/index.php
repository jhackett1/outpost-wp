<?php

// set up a table to store lat/long pairs for easy querying
function op_db_install () {
    global $wpdb;
    $table_name = $wpdb->prefix . "geo";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
        post_id MEDIUMINT(9) NOT NULL UNIQUE,
        latitude FLOAT NOT NULL,
        longitude FLOAT NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}