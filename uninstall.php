<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

global $wpdb;
$wpdb->query('DELETE FROM '.$wpdb->prefix.'options WHERE option_name LIKE "pusherfcm%"');