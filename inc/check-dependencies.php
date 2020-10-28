<?php

add_action("admin_notices", function(){
    if ( !is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
        ?>
            <div class="error notice">
                <p><strong>Missing required plugin:</strong> You need to activate <a href="https://www.advancedcustomfields.com/">Advanced Custom Fields</a> before using WP Outpost.</p>
            </div>
        <?php
    }
});