<?php
/*
Plugin Name: Pusher - Pushing mobile notifications with FCM
Description: If your wordpress site has a mobile application, you can push a notification to the users of your mobile application via this plugin.
Version: 1.0.0
Author: Kemal YAZICI - PluginPress
Author URI: https://pluginpress.net
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: pusher
*/

// If this file calls directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define('PUSHERFCM_VS','1.0');
define('PUSHERFCM_URL',plugin_dir_url(__FILE__));
define('PUSHERFCM_FILE', __FILE__);
define('PUSHERFCM_ROOT',plugin_dir_path(__FILE__));



/***************** CONTROLLERS ********************/
//FCM Messaging
include PUSHERFCM_ROOT.'includes/Controllers/FCMController.php';
include PUSHERFCM_ROOT.'includes/Controllers/ApiController.php';

/***************** HELPERS ********************/

//Actions
include PUSHERFCM_ROOT.'includes/Helpers/actions.php';

//Admin Menu
include PUSHERFCM_ROOT.'includes/Helpers/styles.php';
include PUSHERFCM_ROOT.'includes/Helpers/menu.php';
include PUSHERFCM_ROOT.'includes/Helpers/content.php';