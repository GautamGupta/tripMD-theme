<?php

/**
 * TripMD Core Functions
 *
 * @package TripMD
 * @subpackage Functions
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/** Versions ******************************************************************/

/**
 * Output the TripMD version
 *
 * @uses tmd_get_version() To get the TripMD version
 */
function tmd_version() {
	echo tmd_get_version();
}
	/**
	 * Return the TripMD version
	 *
	 * @return string The TripMD version
	 */
	function tmd_get_version() {
		return tripmd()->version;
	}

/**
 * Output the TripMD database version
 *
 * @uses tmd_get_version() To get the TripMD version
 */
function tmd_db_version() {
	echo tmd_get_db_version();
}
	/**
	 * Return the TripMD database version
	 *
	 * @return string The TripMD version
	 */
	function tmd_get_db_version() {
		return tripmd()->db_version;
	}

/**
 * Output the TripMD database version directly from the database
 *
 * @uses tmd_get_version() To get the current TripMD version
 */
function tmd_db_version_raw() {
	echo tmd_get_db_version_raw();
}
	/**
	 * Return the TripMD database version directly from the database
	 *
	 * @return string The current TripMD version
	 */
	function tmd_get_db_version_raw() {
		return get_option( '_tmd_db_version', '' );
	}

/** Errors ********************************************************************/

/**
 * Adds an error message to later be output in the theme
 *
 * @see WP_Error()
 * @uses WP_Error::add();
 *
 * @param string $code Unique code for the error message
 * @param string $message Translated error message
 * @param string $data Any additional data passed with the error message
 */
function tmd_add_error( $code = '', $message = '', $data = '' ) {
	tripmd()->errors->add( $code, $message, $data );
}

/**
 * Check if error messages exist in queue
 *
 * @see WP_Error()
 *
 * @uses is_wp_error()
 * @usese WP_Error::get_error_codes()
 */
function tmd_has_errors() {
	return tripmd()->errors->get_error_codes() ? true : false;
}

/**
 * Return error messages in queue
 *
 * @see WP_Error()
 * @uses WP_Error::get_error_codes()
 * 
 * @return array Messages
 */
function tmd_get_errors() {
    return tripmd()->errors->get_error_messages();
}

/** Post Statuses *************************************************************/

/**
 * Return the public post status ID
 *
 * @return string
 */
function tmd_get_public_status_id() {
	return tripmd()->public_status_id;
}

/**
 * Return the pending post status ID
 *
 * @return string
 */
function tmd_get_pending_status_id() {
	return tripmd()->pending_status_id;
}

/**
 * Return the private post status ID
 *
 * @return string
 */
function tmd_get_private_status_id() {
	return tripmd()->private_status_id;
}

/**
 * Return the closed post status ID
 *
 * @return string
 */
function tmd_get_closed_status_id() {
	return tripmd()->closed_status_id;
}
/**
 * Return the trash post status ID
 *
 * @return string
 */
function tmd_get_trash_status_id() {
	return tripmd()->trash_status_id;
}

/** Rewrite IDs ***************************************************************/

/**
 * Return the unique ID for user profile rewrite rules
 *
 * @return string
 */
/*
function tmd_get_user_rewrite_id() {
	return tripmd()->user_id;
}

/**
 * Return the unique ID for all edit rewrite rules (forum|topic|reply|tag|user)
 *
 * @return string
 */
/*
function tmd_get_edit_rewrite_id() {
	return tripmd()->edit_id;
}

/**
 * Return the unique ID for topic view rewrite rules
 *
 * @return string
 */
/*
function tmd_get_view_rewrite_id() {
	return tripmd()->view_id;
}

/** Rewrite Extras ************************************************************/

/**
 * Get the id used for paginated requests
 *
 * @return string
 */
/*
function tmd_get_paged_rewrite_id() {
	return tripmd()->paged_id;
}

/**
 * Get the slug used for paginated requests
 *
 * @global object $wp_rewrite The WP_Rewrite object
 * @return string
 */
/*
function tmd_get_paged_slug() {
	global $wp_rewrite;
	return $wp_rewrite->pagination_base;
}

/**
 * Delete a blogs rewrite rules, so that they are automatically rebuilt on
 * the subsequent page load.
 */
function tmd_delete_rewrite_rules() {
	delete_option( 'rewrite_rules' );
}

/** Requests ******************************************************************/

/**
 * Return true|false if this is a POST request
 *
 * @return bool
 */
function tmd_is_post_request() {
	return (bool) ( 'POST' === strtoupper( $_SERVER['REQUEST_METHOD'] ) );
}

/**
 * Return true|false if this is a GET request
 *
 * @return bool
 */
function tmd_is_get_request() {
	return (bool) ( 'GET' === strtoupper( $_SERVER['REQUEST_METHOD'] ) );
}

