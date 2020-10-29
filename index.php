<?php
/* 
Plugin name: WP Outpost
Description: Manage a service directory in your WordPress site. Required Advanced Custom Fields to be activated.
Version: 0.1
Author: Jaye Hackett
Plugin URI: wearefuturegov.com
*/

require "inc/check-dependencies.php";

require "inc/utils.php";

require "inc/post-types.php";
require "inc/taxonomies.php";
require "inc/custom-fields.php";
require "inc/admin-columns.php";

require "api/index.php";


function my_acf_init() {
    acf_update_setting('google_api_key', GOOGLE_CLIENT_KEY);
}
add_action('acf/init', 'my_acf_init');