<?php

function op_services_index_controller($data){

    if($data->get_param("location")){
        $geocoded = geocode($data->get_param("location"));
    }

    $geo_query = null;
    if(isset($geocoded)){
        $geo_query = array(
            "latitude" => $geocoded->lat,
            "longitude" => $geocoded->lng
        );
    }

    $query = new WP_Query(array(
        "geo_query" => $geo_query,
        "post_type" => "service",
        "posts_per_page" => $data->get_param("per_page"),
        "paged" => $data->get_param("page"),
        "s" => $data->get_param("text")
    ));
    
    return array(
        "page" => $query->get("paged", 1),
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