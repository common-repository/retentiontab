<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://retentiontab.com
 * @since             1.0.0
 * @package           Retentiontab
 *
 * @wordpress-plugin
 * Plugin Name:       RetentionTab
 * Plugin URI:        https://retentiontab.com
 * Description:       RetentionTab Wordpress Plugin.
 * Version:           1.0.0
 * Author:            RetentionTab
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       retentiontab
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-retentiontab-activator.php
 */
function activate_retentiontab() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-retentiontab-activator.php';
	Retentiontab_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-retentiontab-deactivator.php
 */
function deactivate_retentiontab() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-retentiontab-deactivator.php';
	Retentiontab_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_retentiontab' );
register_deactivation_hook( __FILE__, 'deactivate_retentiontab' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-retentiontab.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_retentiontab() {

	$plugin = new Retentiontab();
	$plugin->run();

}
run_retentiontab();
