<?php
/**
 * Plugin Name: Offline WP
 * Description: Put your WP install into a "standalone" local install and get rid of all the checking for update e.g. on WordPress.org
 * Version:     0.74
 * Author:      Julien Maury
 * Author URI:  https://tweetpress.fr
 * Text Domain: owp
 * Domain Path:  /languages
 */
if ( ! defined( 'DB_USER' ) ) {
	die( '~No~' );
}

define( 'OWP_PATH', plugin_dir_path( __FILE__ ) );
define( 'OWP_URL', plugins_url( '', __FILE__ ) );

/**
 * Let's add a simple option
 */
register_activation_hook( __FILE__, '_owp_on_activation' );
function _owp_on_activation() {
	if ( ! add_option( 'owp_toggle_offline_mod', 1, '', 'no' ) ) {
		update_option( 'owp_toggle_offline_mod', 1, 'no' );
	}
}

add_action( 'init', '_owp_load_textdomain' );
function _owp_load_textdomain() {
	load_plugin_textdomain( 'owp', false, basename( dirname( __FILE__ ) ) . '/languages' );
}

/**
 * Let's remove option on deactivation
 */
register_deactivation_hook( __FILE__, '_owp_on_deactivation' );
function _owp_on_deactivation() {
	delete_option( 'owp_toggle_offline_mod' );
}

require_once OWP_PATH . 'inc/options.php';
require_once OWP_PATH . 'inc/core.php';
require_once OWP_PATH . 'inc/admin-bar.php';