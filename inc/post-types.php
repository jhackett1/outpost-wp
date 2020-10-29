<?php

function op_custom_post_types_init() {

    register_post_type("organisation", array(
        "label" => __("Organisations"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-networking",
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("service", array(
        "label" => __("Services"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-awards",
        "supports" => array("title", "editor", "revisions", "author")
    ));

    register_post_type("location", array(
        "label" => __("Locations"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-location",
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("contact", array(
        "label" => __("Contacts"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-groups",
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("cost_option", array(
        "label" => __("Fees"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-money-alt",
        "supports" => array("title", "revisions", "author")
    ));

    register_post_type("schedule", array(
        "label" => __("Schedules"),
        "public" => false,
        "show_ui" => true,
        "menu_icon" => "dashicons-calendar",
        "supports" => array("title", "revisions", "author")
    ));

    // register_post_type("review", array(
    //     "label" => __("Reviews"),
    //     "public" => false,
    //     "show_ui" => true,
    //     "menu_icon" => "dashicons-format-chat",
    //     "supports" => array("title")
    // ));

}
add_action("init", "op_custom_post_types_init");