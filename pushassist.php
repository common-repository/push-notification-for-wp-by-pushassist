<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pushassist.com/
 * @since             3.0.8
 * @package           Pushassist
 *
 * @wordpress-plugin
 * Plugin Name:       Push Notification for WordPress by PushAssist
 * Plugin URI:        https://wordpress.org/plugins/push-notification-for-wp-by-pushassist/
 * Description:       Increase engagement & drive more repeat traffic to your WordPress site with desktop, mobile push notifications. Supporting Chrome, Firefox, Safari.
 * Version:           3.0.8
 * Author:            Team PushAssist
 * Author URI:        https://pushassist.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       push-notification-for-wp-by-pushassist
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pushassist-activator.php
 */
function activate_pushassist() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pushassist-activator.php';
	Pushassist_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pushassist-deactivator.php
 */
function deactivate_pushassist() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pushassist-deactivator.php';
	Pushassist_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pushassist' );
register_deactivation_hook( __FILE__, 'deactivate_pushassist' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pushassist.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.8
 */
function run_pushassist() {

	$plugin = new Pushassist();
	$plugin->run();

	$pushassist_settings = get_option('pushassist_settings');
	
	if(version_compare(PHP_VERSION, '5.3.0') >= 0 && empty($pushassist_settings)){
	
		is_admin() && add_filter('gettext',
			function ($translated_text, $untranslated_text, $domain) {
				$old = array(
					"Plugin <strong>activated</strong>.",
					"Selected plugins <strong>activated</strong>."
				);
				
				$new = "<p style='font-size: 15px;'><strong><a href=".admin_url('admin.php?page=pushassist-admin').">Create your FREE Account</a> </strong> and start sending Push Notifications.</p>";

				if (in_array($untranslated_text, $old, true))
					$translated_text = $new;

				return $translated_text;
			}
			, 99, 3);
	}
}
run_pushassist();
