<?php

/**
 * TripMD Hooks
 *
 * @package TripMD
 * @subpackage Hooks
 *
 * This file contains the actions that are used through-out TripMD. They are
 * consolidated here to make searching for them easier, and to help developers
 * understand at a glance the order in which things occur.
 *
 * There are a few common places that additional actions can currently be found
 *
 *  - TripMD: In {@link TripMD::setup_actions()} in ../tripmd.php
 *  - Admin: More in {@link TMD_Admin::setup_actions()} in admin.php
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Attach TripMD to WordPress
 *
 * TripMD uses its own internal actions to help aid in third-party plugin
 * development, and to limit the amount of potential future code changes when
 * updates to WordPress core occur.
 *
 * These actions exist to create the concept of 'plugin dependencies'. They
 * provide a safe way for plugins to execute code *only* when TripMD is
 * installed and activated, without needing to do complicated guesswork.
 *
 * For more information on how this works, see the 'Plugin Dependency' section
 * near the bottom of this file.
 *
 *           v--WordPress Actions        v--TripMD Sub-actions
 */
add_action( 'tmd_after_setup_actions',  'tmd_loaded',                 10    );
add_action( 'init',                     'tmd_init',                   0     ); // Early for tmd_register
add_action( 'parse_query',              'tmd_parse_query',            2     ); // Early for overrides
add_action( 'template_include',         'tmd_template_include',       2     ); // Early for overrides
add_action( 'widgets_init',             'tmd_widgets_init',           10    );
add_action( 'generate_rewrite_rules',   'tmd_generate_rewrite_rules', 10    );
add_action( 'wp_enqueue_scripts',       'tmd_enqueue_scripts',        10    );
add_action( 'wp',                       'tmd_setup_session',          10    );
add_action( 'wp_head',                  'tmd_head',                   10    );
add_action( 'wp_footer',                'tmd_footer',                 10    );
add_action( 'set_current_user',         'tmd_setup_current_user',     10    );
add_action( 'template_redirect',        'tmd_template_redirect',      8     ); // Before BuddyPress's 10 [BB2225]
add_action( 'login_form_login',         'tmd_login_form_login',       10    );
add_action( 'profile_update',           'tmd_profile_update',         10, 2 ); // user_id and old_user_data
add_action( 'user_register',            'tmd_user_register',          10    );

/**
 * tmd_loaded - Attached to 'plugins_loaded' above
 *
 * Attach various loader actions to the tmd_loaded action.
 * The load order helps to execute code at the correct time.
 *                                                         v---Load order
 */
add_action( 'tmd_loaded', 'tmd_load_textdomain',           0  );
add_action( 'tmd_loaded', 'tmd_constants',                 2  );
add_action( 'tmd_loaded', 'tmd_boot_strap_globals',        4  );
add_action( 'tmd_loaded', 'tmd_includes',                  6  );
add_action( 'tmd_loaded', 'tmd_setup_globals',             8  );

/**
 * tmd_init - Attached to 'init' above
 *
 * Attach various initialization actions to the init action.
 * The load order helps to execute code at the correct time.
 *                                               v---Load order
 */
add_action( 'tmd_init', 'tmd_register',          0   );
add_action( 'tmd_init', 'tmd_add_rewrite_tags',  20  );
add_action( 'tmd_init', 'tmd_add_rewrite_rules', 30  );
add_action( 'tmd_init', 'tmd_add_permastructs',  40  );
add_action( 'tmd_init', 'tmd_ready',             999 );

/**
 * tmd_register - Attached to 'init' above on 0 priority
 *
 * Attach various initialization actions early to the init action.
 * The load order helps to execute code at the correct time.
 *                                                         v---Load order
 */
add_action( 'tmd_register', 'tmd_register_post_types',     2  );
add_action( 'tmd_register', 'tmd_register_post_fields',    3  );
add_action( 'tmd_register', 'tmd_register_post_statuses',  4  );
add_action( 'tmd_register', 'tmd_register_taxonomies',     6  );

/**
 * tmd_ready - attached to end 'tmd_init' above
 *
 * Attach actions to the ready action after TripMD has fully initialized.
 * The load order helps to execute code at the correct time.
 *                                                v---Load order
 */
// add_action( 'tmd_ready',  'tmd_setup_akismet',    2  ); // Spam prevention for topics and replies

// Widgets
// add_action( 'tmd_widgets_init', array( 'BBP_Login_Widget',   'register_widget' ), 10 );

// Notices (loaded after tmd_init for translations)
add_action( 'tmd_template_notices', 'tmd_template_notices' );
/*
// Always exclude private/hidden forums if needed
add_action( 'pre_get_posts', 'tmd_pre_get_posts_normalize_forum_visibility', 4 );

// Profile Page Messages
add_action( 'tmd_template_notices', 'tmd_notice_edit_user_success'           );
add_action( 'tmd_template_notices', 'tmd_notice_edit_user_is_super_admin', 2 );

// Before Delete/Trash/Untrash Topic
add_action( 'wp_trash_post', 'tmd_trash_forum'   );
add_action( 'trash_post',    'tmd_trash_forum'   );
add_action( 'untrash_post',  'tmd_untrash_forum' );
add_action( 'delete_post',   'tmd_delete_forum'  );

// After Deleted/Trashed/Untrashed Topic
add_action( 'trashed_post',   'tmd_trashed_forum'   );
add_action( 'untrashed_post', 'tmd_untrashed_forum' );
add_action( 'deleted_post',   'tmd_deleted_forum'   );
*/

/**
 * TripMD needs to redirect the user around in a few different circumstances:
 *
 * 1. POST and GET requests
 * 2. Accessing private or hidden content (consultations)
 * 3. Editing profiles, invitation page submission, etc.
 * 4. TripMD specific AJAX requests
 */
add_action( 'tmd_template_redirect', 'tmd_speciality_redirect',   8  );
add_action( 'tmd_template_redirect', 'tmd_doctor_redirect',       8  );
add_action( 'tmd_template_redirect', 'tmd_post_request',          10 );
add_action( 'tmd_template_redirect', 'tmd_get_request',           10 );
/*
add_action( 'tmd_template_redirect', 'tmd_forum_enforce_blocked', 1  );
add_action( 'tmd_template_redirect', 'tmd_forum_enforce_hidden',  1  );
add_action( 'tmd_template_redirect', 'tmd_forum_enforce_private', 1  );
add_action( 'tmd_template_redirect', 'tmd_check_user_edit',       10 );
*/

// Theme-side POST requests
// add_action( 'tmd_post_request', 'tmd_do_ajax',                1  );
add_action( 'tmd_post_request_invitation_register', 'tmd_invitation_register_handler', 1 );
add_action( 'tmd_post_request_clinic_register',     'tmd_clinic_register_handler',     1 );
add_action( 'tmd_post_request_review_doctor',       'tmd_review_doctor_handler',       1 );

/*
// Theme-side GET requests
add_action( 'tmd_get_request', 'tmd_toggle_topic_handler',        1  );
add_action( 'tmd_get_request', 'tmd_toggle_reply_handler',        1  );
add_action( 'tmd_get_request', 'tmd_favorites_handler',           1  );
add_action( 'tmd_get_request', 'tmd_subscriptions_handler',       1  );
add_action( 'tmd_get_request', 'tmd_forum_subscriptions_handler', 1  );
add_action( 'tmd_get_request', 'tmd_search_results_redirect',     10 );
*/

/**
 * Plugin Dependency
 *
 * The purpose of the following hooks is to mimic the behavior of something
 * called 'plugin dependency' which enables a plugin to have plugins of their
 * own in a safe and reliable way.
 *
 * We do this in TripMD by mirroring existing WordPress hooks in many places
 * allowing dependant plugins to hook into the TripMD specific ones, thus
 * guaranteeing proper code execution only when TripMD is active.
 *
 * The following functions are wrappers for hookss, allowing them to be
 * manually called and/or piggy-backed on top of other hooks if needed.
 *
 * @todo use anonymous functions when PHP minimun requirement allows (5.3)
 */

/** Activation Actions ********************************************************/

/**
 * Runs on TripMD activation
 */
function tmd_activation() {
    do_action( 'tmd_activation' );
}

/**
 * Runs on TripMD deactivation
 */
function tmd_deactivation() {
    do_action( 'tmd_deactivation' );
}

/**
 * Runs when uninstalling TripMD
 */
function tmd_uninstall() {
    do_action( 'tmd_uninstall' );
}

/** Main Actions **************************************************************/

/**
 * Main action responsible for constants, globals, and includes
 */
function tmd_loaded() {
    do_action( 'tmd_loaded' );
}

/**
 * Setup constants
 */
function tmd_constants() {
    do_action( 'tmd_constants' );
}

/**
 * Setup globals BEFORE includes
 */
function tmd_boot_strap_globals() {
    do_action( 'tmd_boot_strap_globals' );
}

/**
 * Include files
 *
 * @uses do_action() Calls 'tmd_includes'
 */
function tmd_includes() {
    do_action( 'tmd_includes' );
}

/**
 * Setup globals AFTER includes
 */
function tmd_setup_globals() {
    do_action( 'tmd_setup_globals' );
}

/**
 * Register any objects before anything is initialized
 */
function tmd_register() {
    do_action( 'tmd_register' );
}

/**
 * Initialize any code after everything has been loaded
 */
function tmd_init() {
    do_action( 'tmd_init' );
}

/**
 * Initialize widgets
 */
function tmd_widgets_init() {
    do_action( 'tmd_widgets_init' );
}

/**
 * Setup the currently logged-in user
 *
 * @uses did_action() To make sure the user isn't loaded out of order
 * @uses do_action() Calls 'tmd_setup_current_user'
 */
function tmd_setup_current_user() {

    // If the current user is being setup before the "init" action has fired,
    // strange (and difficult to debug) role/capability issues will occur.
    if ( ! did_action( 'after_setup_theme' ) ) {
        _doing_it_wrong( __FUNCTION__, __( 'The current user is being initialized without using $wp->init().', 'bbpress' ), '2.3' );
    }

    do_action( 'tmd_setup_current_user' );
}

/** Supplemental Actions ******************************************************/

/**
 * Load translations for current language
 */
function tmd_load_textdomain() {
    do_action( 'tmd_load_textdomain' );
}

/**
 * Setup the post types
 */
function tmd_register_post_types() {
    do_action( 'tmd_register_post_types' );
}

/**
 * Setup the post fields
 */
function tmd_register_post_fields() {
    do_action( 'tmd_register_post_fields' );
}

/**
 * Setup the post statuses
 */
function tmd_register_post_statuses() {
    do_action( 'tmd_register_post_statuses' );
}

/**
 * Register the built in TripMD taxonomies
 */
function tmd_register_taxonomies() {
    do_action( 'tmd_register_taxonomies' );
}

/**
 * Enqueue TripMD specific CSS and JS
 */
function tmd_enqueue_scripts() {
    do_action( 'tmd_enqueue_scripts' );
}

/**
 * Setup session
 */
function tmd_setup_session() {
    do_action( 'tmd_setup_session' );
}

/**
 * Add the TripMD-specific rewrite tags
 */
function tmd_add_rewrite_tags() {
    do_action( 'tmd_add_rewrite_tags' );
}

/**
 * Add the TripMD-specific rewrite rules
 */
function tmd_add_rewrite_rules() {
    do_action( 'tmd_add_rewrite_rules' );
}

/**
 * Add the TripMD-specific permalink structures
 */
function tmd_add_permastructs() {
    do_action( 'tmd_add_permastructs' );
}

/**
 * Add the TripMD-specific login forum action
 */
function tmd_login_form_login() {
    do_action( 'tmd_login_form_login' );
}

/** User Actions **************************************************************/

/**
 * The main action for hooking into when a user account is updated
 *
 * @param int $user_id ID of user being edited
 * @param array $old_user_data The old, unmodified user data
 * @uses do_action() Calls 'tmd_profile_update'
 */
function tmd_profile_update( $user_id = 0, $old_user_data = array() ) {
    do_action( 'tmd_profile_update', $user_id, $old_user_data );
}

/**
 * The main action for hooking into a user being registered
 *
 * @param int $user_id ID of user being edited
 * @uses do_action() Calls 'tmd_user_register'
 */
function tmd_user_register( $user_id = 0 ) {
    do_action( 'tmd_user_register', $user_id );
}

/** Final Action **************************************************************/

/**
 * TripMD has loaded and initialized everything, and is okay to go
 *
 * @uses do_action() Calls 'tmd_ready'
 */
function tmd_ready() {
    do_action( 'tmd_ready' );
}

/** Theme Permissions *********************************************************/

/**
 * The main action used for redirecting TripMD theme actions that are not
 * permitted by the current_user
 *
 * @uses do_action()
 */
function tmd_template_redirect() {
    do_action( 'tmd_template_redirect' );
}

/** Theme Helpers *************************************************************/

/**
 * The main action used for handling theme-side POST requests
 *
 * @uses do_action()
 */
function tmd_post_request() {

    // Bail if not a POST action
    if ( ! tmd_is_post_request() )
        return;

    // Bail if no action
    if ( empty( $_POST['action'] ) )
        return;

    // This dynamic action is probably the one you want to use. It narrows down
    // the scope of the 'action' without needing to check it in your function.
    do_action( 'tmd_post_request_' . $_POST['action'] );

    // Use this static action if you don't mind checking the 'action' yourself.
    do_action( 'tmd_post_request',   $_POST['action'] );
}

/**
 * The main action used for handling theme-side GET requests
 *
 * @uses do_action()
 */
function tmd_get_request() {

    // Bail if not a POST action
    if ( ! tmd_is_get_request() )
        return;

    // Bail if no action
    if ( empty( $_GET['action'] ) )
        return;

    // This dynamic action is probably the one you want to use. It narrows down
    // the scope of the 'action' without needing to check it in your function.
    do_action( 'tmd_get_request_' . $_GET['action'] );

    // Use this static action if you don't mind checking the 'action' yourself.
    do_action( 'tmd_get_request',   $_GET['action'] );
}

/** Filters *******************************************************************/

/**
 * Filter the plugin locale and domain.
 *
 * @param string $locale
 * @param string $domain
 */
function tmd_plugin_locale( $locale = '', $domain = '' ) {
    return apply_filters( 'tmd_plugin_locale', $locale, $domain );
}

/**
 * Piggy back filter for WordPress's 'request' filter
 *
 * @param array $query_vars
 * @return array
 */
function tmd_request( $query_vars = array() ) {
    return apply_filters( 'tmd_request', $query_vars );
}

/**
 * Generate TripMD-specific rewrite rules
 *
 * @deprecated
 * @param WP_Rewrite $wp_rewrite
 * @uses do_action() Calls 'tmd_generate_rewrite_rules' with {@link WP_Rewrite}
 */
function tmd_generate_rewrite_rules( $wp_rewrite ) {
    do_action_ref_array( 'tmd_generate_rewrite_rules', array( &$wp_rewrite ) );
}