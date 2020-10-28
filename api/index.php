<?php

require "services_controller.php";

add_action("rest_api_init", function(){

    register_rest_route( 'outpost/v1', '/services', array(
        'methods' => 'GET',
        'callback' => 'op_services_index_controller',
    ));

    register_rest_route( 'outpost/v1', '/services/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'op_services_show_controller'
    ));
    
});