<?php

require "serializers.php";

function handle_location_search($query) {
    if ( array_key_exists("location_query", $query->query_vars) ) {
        // what now?
    }
}
add_action( 'pre_get_posts', 'handle_location_search' );


function op_services_index_controller($data){
    $query = new WP_Query(array(
        "location" => array(
            "longitude" => "foo",
            "latitude" => "foo"
        ),
        "post_type" => "service",
        "posts_per_page" => $data->get_param("per_page"),
        "paged" => $data->get_param("page"),
        "s" => $data->get_param("text")
    ));

    return $query->query_vars;

    return array(
        "page" => $data->get_param("page"),
        "size" => $query->post_count,
        "totalPages" => $query->max_num_pages,
        "totalElements" => $query->found_posts,
        "content" => array_map(function($service){
            return service_serializer($service);
        }, $query->get_posts())
    );
}



function op_services_show_controller($data){
    return service_serializer(get_post($data['id']));
}