<?php

function base_serializer($post){
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
        "url" => get_field("url", $post),
        "organisation" => base_serializer(get_field("organisation", $post)),
        "locations" => array_map(function($location){ 
            return base_serializer($location); 
        }, posts_belonging_to_service("location", $post->ID)),
        "contacts" => array_map(function($contact){ 
            return base_serializer($contact); 
        }, posts_belonging_to_service("contact", $post->ID)),
        "cost_options" => array_map(function($cost_option){ 
            return base_serializer($cost_option); 
        }, posts_belonging_to_service("cost_option", $post->ID)),
        "schedules" => array_map(function($schedules){ 
            return base_serializer($schedules); 
        }, posts_belonging_to_service("schedule", $post->ID))
    );
}