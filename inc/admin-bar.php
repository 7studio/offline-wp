<?php
if ( ! defined( 'DB_USER' ) ) {
	die( '~No~' );
}

add_action( 'admin_bar_menu', '_owp_admin_bar_menu' );
/**
 * Plug our bar
 * @author Julien Maury
 * @return bool
 */
function _owp_admin_bar_menu() {
	global $wp_admin_bar;
	if (
	apply_filters( 'offline-wp/hide_admin_bar',
		! is_super_admin()
		|| ! is_object( $wp_admin_bar )
		|| ! function_exists( 'is_admin_bar_showing' )
		|| ! is_admin_bar_showing() )
	) {
		return false;
	}

	$args = array(
		'id'    => 'offline-wp',
		'title' => _owp_is_offline_mod_enabled() ? __( 'Offline Mod enabled', 'owp' ) : __( 'Offline Mod disabled', 'owp' ),
		'href'  => wp_nonce_url( add_query_arg( 'toggle-offline', true ), 'toggle-offline', 'toggle-offline-nonce' ),
		'meta'  => [
			'class' => _owp_is_offline_mod_enabled() ? 'owp-enabled' : 'owp-disabled',
		]
	);
	$wp_admin_bar->add_menu( $args );

	return true;
}

add_action( 'wp_enqueue_scripts', '_owp_add_styles' );
add_action( 'admin_enqueue_scripts', '_owp_add_styles' );
/**
 * wp_add_inline_style() to add our css only when needed
 * @author Julien Maury
 */
function _owp_add_styles() {
	$styles = "
		.owp-disabled, .owp-disabled > a.ab-item:focus, .owp-disabled > a.ab-item:hover { background: green!important; color: white!important; }
		.owp-enabled, .owp-disabled > a.ab-item:focus, .owp-enabled > a.ab-item:hover { background: red!important; color: white!important; }
	";
	wp_add_inline_style( 'admin-bar', apply_filters( 'offline-wp/admin_bar_styles', $styles ) );
}
