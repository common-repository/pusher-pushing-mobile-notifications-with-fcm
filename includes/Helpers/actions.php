<?php
// Add action of admin css
add_action('admin_enqueue_scripts','pusherfcm_admin_styles');
// Add admin menu
add_action('admin_menu','pusherfcm_admin_menu');

add_action('wp_insert_post', 'pusherfcm_update_post', 10, 2);


//Post action
include PUSHERFCM_ROOT.'includes/Helpers/actions/post.php';