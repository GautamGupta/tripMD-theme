<?php

/**
 * TripMD Updater
 *
 * @package TripMD
 * @subpackage Updater
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * If there is no raw DB version, this is the first installation
 *
 * @uses tmd_get_db_version() To get TripMD's database version
 * @return bool
 */
function tmd_is_install() {
	return ! tmd_get_db_version_raw();
}

/**
 * Compare the TripMD version to the DB version to determine if updating
 *
 * @uses tmd_get_db_version_raw() To get TripMD's database version from db
 * @uses tmd_get_db_version() To get TripMD's database version
 * @return bool
 */
function tmd_is_update() {
	$raw    = (int) tmd_get_db_version_raw();
	$cur    = (int) tmd_get_db_version();
	$retval = (bool) ( $raw < $cur );
	return $retval;
}

/**
 * Determine if TripMD is being activated
 *
 * Note that this function currently is not used in TripMD core and is here
 * for third party extensions to use to check for TripMD activation.
 *
 * @return bool
 */
function tmd_is_activation( $basename = '' ) {
	global $pagenow;

	$bbp    = tripmd();
	$action = false;

	// Bail if not in admin/themes
	if ( ! ( is_admin() && ( 'themes.php' === $pagenow ) ) ) {
		return false;
	}

	if ( ! empty( $_REQUEST['action'] ) && ( '-1' !== $_REQUEST['action'] ) ) {
		$action = $_REQUEST['action'];
	} elseif ( ! empty( $_REQUEST['action2'] ) && ( '-1' !== $_REQUEST['action2'] ) ) {
		$action = $_REQUEST['action2'];
	}

	// Bail if not activating
	if ( empty( $action ) || !in_array( $action, array( 'activate', 'activate-selected' ) ) ) {
		return false;
	}

	// The theme(s) being activated
	if ( $action === 'activate' ) {
		$themes = isset( $_GET['theme'] ) ? array( $_GET['theme'] ) : array();
	} else {
		$themes = isset( $_POST['checked'] ) ? (array) $_POST['checked'] : array();
	}

	// Set basename if empty
	if ( empty( $basename ) && !empty( $bbp->basename ) ) {
		$basename = $bbp->basename;
	}

	// Bail if no basename
	if ( empty( $basename ) ) {
		return false;
	}

	// Is TripMD being activated?
	return in_array( $basename, $themes );
}

/**
 * Determine if TripMD is being deactivated
 *
 * @return bool
 */
function tmd_is_deactivation( $basename = '' ) {
	global $pagenow;

	$bbp    = tripmd();
	$action = false;

	// Bail if not in admin/themes
	if ( ! ( is_admin() && ( 'themes.php' === $pagenow ) ) ) {
		return false;
	}

	if ( ! empty( $_REQUEST['action'] ) && ( '-1' !== $_REQUEST['action'] ) ) {
		$action = $_REQUEST['action'];
	} elseif ( ! empty( $_REQUEST['action2'] ) && ( '-1' !== $_REQUEST['action2'] ) ) {
		$action = $_REQUEST['action2'];
	}

	// Bail if not deactivating
	if ( empty( $action ) || !in_array( $action, array( 'deactivate', 'deactivate-selected' ) ) ) {
		return false;
	}

	// The theme(s) being deactivated
	if ( $action === 'deactivate' ) {
		$themes = isset( $_GET['theme'] ) ? array( $_GET['theme'] ) : array();
	} else {
		$themes = isset( $_POST['checked'] ) ? (array) $_POST['checked'] : array();
	}

	// Set basename if empty
	if ( empty( $basename ) && !empty( $bbp->basename ) ) {
		$basename = $bbp->basename;
	}

	// Bail if no basename
	if ( empty( $basename ) ) {
		return false;
	}

	// Is TripMD being deactivated?
	return in_array( $basename, $themes );
}

/**
 * Update the DB to the latest version
 *
 * @uses update_option()
 * @uses tmd_get_db_version() To get TripMD's database version
 */
function tmd_version_bump() {
	update_option( '_tmd_db_version', tmd_get_db_version() );
}

/**
 * Setup the TripMD updater
 *
 * @uses tmd_is_update() To check if it's an update
 * @uses tmd_version_updater() Make necessary db updates
 */
function tmd_setup_updater() {

	// Bail if no update needed
	if ( ! tmd_is_update() )
		return;

	// Call the automated updater
	tmd_version_updater();
}

/**
 * Create some defaults
 *
 * @param array $args Array of arguments to override default values
 */
function tmd_create_initial_content( $args = array() ) {
	/*
	// Parse arguments against default values
	$r = tmd_parse_args( $args, array(
		'forum_parent'  => 0,
		'forum_status'  => 'publish',
		'forum_title'   => __( 'General',                                  'tripmd' ),
		'forum_content' => __( 'General chit-chat',                        'tripmd' ),
		'topic_title'   => __( 'Hello World!',                             'tripmd' ),
		'topic_content' => __( 'I am the first topic in your new forums.', 'tripmd' ),
		'reply_title'   => __( 'Re: Hello World!',                         'tripmd' ),
		'reply_content' => __( 'Oh, and this is what a reply looks like.', 'tripmd' ),
	), 'create_initial_content' );

	// Create the initial forum
	$forum_id = tmd_insert_forum( array(
		'post_parent'  => $r['forum_parent'],
		'post_status'  => $r['forum_status'],
		'post_title'   => $r['forum_title'],
		'post_content' => $r['forum_content']
	) );
	*/
}

/**
 * TripMD's version updater looks at what the current database version is, and
 * runs whatever other code is needed.
 *
 * This is most-often used when the data schema changes, but should also be used
 * to correct issues with TripMD meta-data silently on software update.
 */
function tmd_version_updater() {

	// Get the raw database version
	$raw_db_version = (int) tmd_get_db_version_raw();

	/** 0.1 Branch ************************************************************/

	// 0.1
	if ( $raw_db_version < 10 ) {
		// No changes
	}

	/** All done! *************************************************************/

	// Bump the version
	tmd_version_bump();

	// Delete rewrite rules to force a flush
	tmd_delete_rewrite_rules();
}
