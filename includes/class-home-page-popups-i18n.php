<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.deferousa.com/
 * @since      1.0.0
 *
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Home_Page_Popups
 * @subpackage Home_Page_Popups/includes
 * @author     Lisdanay <ldominguez@deferousa.com>
 */
class Home_Page_Popups_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'home-page-popups',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
