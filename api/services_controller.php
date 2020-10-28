<?php

require "serializers.php";

function op_services_index_controller(){
    $query = new WP_Query(array(
        "post_type" => "service"
    ));
    return array_map(function($service){
        return service_serializer($service);
    }, $query->get_posts());
}

function op_services_show_controller($data){
    return service_serializer(get_post($data['id']));
}