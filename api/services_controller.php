<?php

add_filter('posts_orderby', 'handle_geo_ordering', 10, 2);

function handle_geo_ordering($orderby_statement, $query) {
    if($query->get("orderby") == "geo"){
        $orderby_statement = "FUCK";
    }
    return $orderby_statement;
}


function op_services_index_controller($data){

    $args = array(
        // "orderby" => "geo",
        "post_type" => "service",
        "posts_per_page" => $data->get_param("per_page"),
        "paged" => $data->get_param("page"),
        "s" => $data->get_param("text")
    );

    $query = new WP_Query($args);

    return array(
        "page" => $data->get_param("page") ? $data->get_param("page") : 1,
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