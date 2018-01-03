<?php
if ( ! defined( 'DB_USER' ) ) {
	die( '~No~' );
}

add_action( 'init', '_owp_process_save' );// init because admin bar can be shown on front
function _owp_process_save() { // cause I really like function named "%process%", so accurate...

	$opt = (int) get_option( 'owp_toggle_offline_mod' );

	/**
	 * You could say, what the hell !
	 * offline mod && nonce ?
	 * Yes Sir. Don't ask don't tell !
	 */
	if ( isset( $_GET['toggle-offline-nonce'] ) && wp_verify_nonce( $_GET['toggle-offline-nonce'], 'toggle-offline' ) ) {
		switch ( $opt ) {
			case 0:
				update_option( 'owp_toggle_offline_mod', 1, 'no' );
				break;
			case 1:
				update_option( 'owp_toggle_offline_mod', 0, 'no' );
				break;
			default:
				return false;
		}

		$params = [ 'toggle-offline', 'toggle-offline-nonce' ]; // avoid the annoying part, like if you have to reload page for other purpose
		wp_safe_redirect( remove_query_arg( $params ) );
		exit;
	}

	return false;
}

/**
 * @return bool
 */
function _owp_is_offline_mod_enabled() {
	return (bool) get_option( 'owp_toggle_offline_mod' );
}