<?php

function op_create_custom_taxonomies() { 

    register_taxonomy('taxonomies', 'service', array(
      "labels" => array(
          "name" => "Taxonomies",
          "singular_name" => "Taxonomy",
          "add_new_item" => "Add New Taxonomy",
          "choose_from_most_used" => "Choose from the most used taxonomies",
          "not_found" => "No taxonomies found"
      ),
      "hierarchical" => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true
    ));

    register_taxonomy('accessibility', 'location', array(
        "labels" => array(
            "name" => "Accessibility",
            "singular_name" => "Accessibility",
            "add_new_item" => "Add New Accessibility",
            "choose_from_most_used" => "Choose from the most used accessibilities",
            "not_found" => "No accessibilities found"
        ),
        "hierarchical" => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true
      ));

  }
  add_action('init', 'op_create_custom_taxonomies', 0 );