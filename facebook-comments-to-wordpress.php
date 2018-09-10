<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              maavuz.com
 * @since             1.0.0
 * @package           Facebook_Comments_To_Wordpress
 *
 * @wordpress-plugin
 * Plugin Name:       Facebook Comments to WordPress
 * Plugin URI:        maavuz.com
 * Description:       This plugin imports all of your facebook app's comments into WordPress. if you want to migrate from Facebook Comments to WordPress or Disqus, this plugin is for you.
 * Version:           1.0.0
 * Author:            Maavuz Saif
 * Author URI:        maavuz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       facebook-comments-to-wordpress
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
define( 'PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-facebook-comments-to-wordpress-activator.php
 */
function activate_facebook_comments_to_wordpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-facebook-comments-to-wordpress-activator.php';
	Facebook_Comments_To_Wordpress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-facebook-comments-to-wordpress-deactivator.php
 */
function deactivate_facebook_comments_to_wordpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-facebook-comments-to-wordpress-deactivator.php';
	Facebook_Comments_To_Wordpress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_facebook_comments_to_wordpress' );
register_deactivation_hook( __FILE__, 'deactivate_facebook_comments_to_wordpress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-facebook-comments-to-wordpress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_facebook_comments_to_wordpress() {

	$plugin = new Facebook_Comments_To_Wordpress();
	$plugin->run();

}
run_facebook_comments_to_wordpress();
