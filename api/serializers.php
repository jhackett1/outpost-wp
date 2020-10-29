<?php

function base_serializer($post){
    return array(
        "id" => $post->ID,
        "name" => $post->post_title
    );
}

function location_serializer($post){
    return array(
        "id" => $post->ID,
        "name" => $post->post_title,
        "latitude" => "",
        "longitude" => "",
        "physical_address" => array(
            "address_1" => "",
            "city" => "",
            "country" => "",
            "postal_code" => "",
            "state_province" => ""
        )
    );
}

function contact_serializer($post){
    return array(
        "id" => $post->ID,
        "name" => $post->post_title,
        "title" => get_field("role", $post),
        "phone" => get_field("phone", $post),
        "email" => get_field("email", $post)
    );
}

function schedule_serializer($post){
    return array(
        "id" => $post->ID,
        "opens_at" => get_field("opens_at", $post),
        "closes_at" => get_field("closes_at", $post),
    );
}

function cost_option_serializer($post){
    return array(
        "id" => $post->ID,
        "option" => $post->post_title,
        "amount" => get_field("amount", $post),
        "amount_description" => get_field("amount_description", $post)
    );
}

function service_serializer($post){
    return array(
        
        "id" => $post->ID,
        "name" => $post->post_title,
        "description" => $post->post_content,
        "url" => get_field("url", $post),

        "organization" => base_serializer(get_field("organisation", $post)),

        "locations" => array_map(function($location){ 
            return location_serializer($location); 
        }, posts_belonging_to_service("location", $post->ID)),

        "contacts" => array_map(function($contact){ 
            return contact_serializer($contact); 
        }, posts_belonging_to_service("contact", $post->ID)),

        "cost_options" => array_map(function($cost_option){ 
            return cost_option_serializer($cost_option); 
        }, posts_belonging_to_service("cost_option", $post->ID)),

        "regular_schedules" => array_map(function($schedules){ 
            return schedule_serializer($schedules); 
        }, posts_belonging_to_service("schedule", $post->ID))
    );
}