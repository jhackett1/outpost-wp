<?php 

function objects_belonging_to_service($object_name, $id){
    $query = new WP_Query(array(
        "post_type" => $object_name,
        "meta_query" => array(
          array(
            "key" => "service",
            "value" => $id
          )
        )
    ));
    return $query->get_posts();
}