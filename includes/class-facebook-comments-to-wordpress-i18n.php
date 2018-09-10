<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       maavuz.com
 * @since      1.0.0
 *
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Facebook_Comments_To_Wordpress
 * @subpackage Facebook_Comments_To_Wordpress/includes
 * @author     Maavuz Saif <maavuzsaif@gmail.com>
 */
class Facebook_Comments_To_Wordpress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'facebook-comments-to-wordpress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
