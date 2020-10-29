<?php

// for a given post, check if it has a location and if so, track latitude and longitude for it
function op_update_latlongs($post){
    $location = get_field("location", $post);
    if($location){
        global $wpdb;
        $sql = "
            INSERT INTO {$wpdb->prefix}geo 
            (post_id, latitude, longitude) 
            VALUES (%s, %f, %f) 
            ON DUPLICATE KEY UPDATE 
            latitude = %f, longitude = %f
        ";
        $sql = $wpdb->prepare($sql, $post->ID, $location["lat"], $location["lng"], $location["lat"], $location["lng"]);
        $wpdb->query($sql);
    }
}

// update values after post save
function op_track_latlongs($post_id, $post){
    if($post->post_type === "location"){
        op_update_latlongs($post);
    }
}
add_action("save_post", "op_track_latlongs", 10, 3);

// update all values on plugin activation
function op_track_all_latlongs(){
    $query = new WP_Query(array(
        "post_type" => "location",
        "posts_per_page" => -1
    ));
    foreach($query->get_posts() as $post){
        op_update_latlongs($post);
    }
}