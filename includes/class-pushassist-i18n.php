<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://pushassist.com/
 * @since      3.0.8
 *
 * @package    Pushassist
 * @subpackage Pushassist/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      3.0.8
 * @package    Pushassist
 * @subpackage Pushassist/includes
 * @author     Team PushAssist <support@pushassist.com>
 */
class Pushassist_i18n {

	public $domain;
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    3.0.8
	 */

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ). '/languages/'
		);

	}

	public function set_domain( $domain ) {
		$this->domain = $domain;
	}

}

