<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              karenbanzon.com
 * @since             1.0.0
 * @package           Sdp_Post_Types
 *
 * @wordpress-plugin
 * Plugin Name:       SDP - Post Types
 * Plugin URI:        karenbanzon.com
 * Description:       Custom plugin which declares SDP Custom Post Types
 * Version:           1.0.0
 * Author:            Karen Monica Banzon
 * Author URI:        karenbanzon.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sdp-post-types
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sdp-post-types-activator.php
 */
function activate_sdp_post_types() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sdp-post-types-activator.php';
	Sdp_Post_Types_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sdp-post-types-deactivator.php
 */
function deactivate_sdp_post_types() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sdp-post-types-deactivator.php';
	Sdp_Post_Types_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sdp_post_types' );
register_deactivation_hook( __FILE__, 'deactivate_sdp_post_types' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sdp-post-types.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sdp_post_types() {

	$plugin = new Sdp_Post_Types();
	$plugin->run();

}
run_sdp_post_types();
