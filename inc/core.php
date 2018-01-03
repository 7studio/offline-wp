<?php
if ( ! defined( 'DB_USER' ) ) {
	die( '~No~' );
}

/**
 * Let's define some constant
 * we will use it to trigger / disable the rest of the code
 */
if ( _owp_is_offline_mod_enabled() ) {
	/**
	 * Disable all external requests
	 * which is already a very good point
	 * for our plugin
	 */
	if ( ! defined( 'WP_HTTP_BLOCK_EXTERNAL' ) ) {
		define( 'WP_HTTP_BLOCK_EXTERNAL', true );
	}

	if ( ! defined( 'WP_ACCESSIBLE_HOSTS' ) ) {
		define( 'WP_ACCESSIBLE_HOSTS', null );
	}

	/**
	 * Be careful
	 * if your purpose is to test CRON !!!
	 * in this case just insert in your wp-config.php
	 * define( 'DISABLE_WP_CRON', false );
	 */
	if ( ! defined( 'DISABLE_WP_CRON' ) ) {
		define( 'DISABLE_WP_CRON', true );
	}

	/**
	 * Remove all the checking part
	 * in wp core for theme & plugins
	 * and the core itself
	 */
	add_action( 'init', function () {
		remove_action( 'admin_init', '_maybe_update_core' );
		remove_action( 'wp_version_check', 'wp_version_check' );
		remove_action( 'load-plugins.php', 'wp_update_plugins' );
		remove_action( 'load-update.php', 'wp_update_plugins' );
		remove_action( 'load-update-core.php', 'wp_update_plugins' );
		remove_action( 'admin_init', '_maybe_update_plugins' );
		remove_action( 'wp_update_plugins', 'wp_update_plugins' );
		remove_action( 'load-themes.php', 'wp_update_themes' );
		remove_action( 'load-update.php', 'wp_update_themes' );
		remove_action( 'load-update-core.php', 'wp_update_themes' );
		remove_action( 'admin_init', '_maybe_update_themes' );
		remove_action( 'wp_update_themes', 'wp_update_themes' );
		remove_action( 'init', 'wp_schedule_update_checks' );
	} );

	/**
	 * This one is really really annoying
	 * so it deserves its own function
	 */
	add_action( 'init', function () {
		add_filter( 'get_avatar', '__return_empty_string' );
	} );

	/**
	 * This one too !
	 * So let's make another callback here
	 */
	add_action( 'init', function () {
		add_filter( 'pre_http_request', '__return_true', 100 ); // Why this ? it's meant to prevent annoying 404 errors, especially when using Google Fonts in theme
	} );

}
