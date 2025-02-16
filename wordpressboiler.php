<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jackone
 * @since             1.0.0
 * @package           Wordpressboiler
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Boiler
 * Plugin URI:        https://Wordpressboiler
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            jackones
 * Author URI:        https://jackone/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpressboiler
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
define( 'WORDPRESSBOILER_VERSION', '1.0.0' );
define( 'WORDPRESSBOILER_PLUGIN_URL', plugin_dir_url(__FILE__) );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpressboiler-activator.php
 */
function activate_wordpressboiler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpressboiler-activator.php';
	$activator = new WordPressBoiler_Activator();
	$activator -> activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpressboiler-deactivator.php
 */
function deactivate_wordpressboiler() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpressboiler-activator.php';
	$activator = new WordPressBoiler_Activator();

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpressboiler-deactivator.php';
	$deactivator = new Wordpressboiler_Deactivator($activator);
	$deactivator-> deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpressboiler' );
register_deactivation_hook( __FILE__, 'deactivate_wordpressboiler' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpressboiler.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordpressboiler() {

	$plugin = new Wordpressboiler();
	$plugin->run();

}
run_wordpressboiler();
