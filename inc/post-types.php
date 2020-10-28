<?php

function op_custom_post_types_init() {

    register_post_type("organisation", array(
        "label" => __("Organisations"),
        "public" => true,
        "menu_icon" => "dashicons-networking",
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("service", array(
        "label" => __("Services"),
        "public" => true,
        "menu_icon" => "dashicons-awards",
        "supports" => array("title", "editor", "revisions", "author")
    ));

    register_post_type("location", array(
        "label" => __("Locations"),
        "public" => true,
        "menu_icon" => "dashicons-location",
        "supports" => array("title", "revisions", "author")
    ));

}
add_action("init", "op_custom_post_types_init");