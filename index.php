<?php
/* 
Plugin name: WP Outpost
Description: Manage a service directory in your WordPress site. Required Advanced Custom Fields to be activated.
Version: 0.1
Author: Jaye Hackett
Plugin URI: wearefuturegov.com
*/

require "inc/check-dependencies.php";

require "inc/post-types.php";
require "inc/taxonomies.php";
require "inc/custom-fields.php";

require "api/index.php";