<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.deferousa.com/
 * @since             1.0.0
 * @package           Home_Page_Popups
 *
 * @wordpress-plugin
 * Plugin Name:       Home Page Popups
 * Plugin URI:        https://www.deferousa.com/
 * Description:       Plugin allow to configure and schedule popups.
 * Version:           1.2.0
 * Author:            Defero USA
 * Author URI:        https://www.deferousa.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       home-page-popups
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
define( 'HOME_PAGE_Popups_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-home-page-popups-activator.php
 */
function activate_home_page_popups() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-home-page-popups-activator.php';
	Home_Page_Popups_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-home-page-popups-deactivator.php
 */
function deactivate_home_page_popups() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-home-page-popups-deactivator.php';
	Home_Page_Popups_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_home_page_popups' );
register_deactivation_hook( __FILE__, 'deactivate_home_page_popups' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-home-page-popups.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_home_page_popups() {

	include_once plugin_dir_path(__FILE__) . '/includes/class-gh-updater.php';
	if ((string) get_option('updater_key_field') !== '') {
	
		$updater = new GHUpdater(__FILE__);
		$updater->set_username('defero-usa');
		$updater->set_repository('home-page-popups');
		$updater->authorize(get_option('updater_key_field'));
		$updater->initialize();
	}

	$plugin = new Home_Page_Popups();
	$plugin->run();

}
run_home_page_popups();