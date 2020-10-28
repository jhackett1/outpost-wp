<?php

function location_serializer($post){
    return array(
        "id" => $post->ID,
        "name" => $post->post_title
    );
}

function service_serializer($post){
    return array(
        "id" => $post->ID,
        "name" => $post->post_title,
        "description" => $post->post_content,
        "locations" => array_map(function($location){ 
            return location_serializer($location); 
        }, get_field("locations", $post))
    );
}