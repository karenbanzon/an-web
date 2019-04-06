<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       karenbanzon.com
 * @since      1.0.0
 *
 * @package    Sdp_Post_Types
 * @subpackage Sdp_Post_Types/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sdp_Post_Types
 * @subpackage Sdp_Post_Types/includes
 * @author     Karen Monica Banzon <kabanzon@gmail.com>
 */
class Sdp_Post_Types_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sdp-post-types',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
