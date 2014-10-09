<?php

/**
 * TripMD Flow
 *
 * @package TripMD
 * @subpackage Flow
 * @version 0.2
 *
 * This file ensures proper redirects and flow to be followed.
 * 
 *  1. Front page
 *  2. Select speciality
 *  3. If logged out, go to register page -> option to login
 *      3.1 Register -> Auto login, confirmation email -> Go to speciality
 *      3.2 Login -> Go to speciality
 *  4. Select doctor (registration flow if logged out)
 *  5. Click Book Appointment
 *  6. Send inquiry, shows confirmation page.
 *     Followed up within 24 hours manually.
 */

/**
 * Redirect speciality page to registration page if logged out
 */
function tmd_speciality_redirect() {

    if ( tmd_is_speciality() && !is_user_logged_in() ) {
        wp_redirect( add_query_arg( array( 'redirect_to' => get_permalink() ), site_url( '/register' ) ) );
        exit;
    }

}

/**
 * Redirect doctor page to registration page if logged out
 */
function tmd_doctor_redirect() {

    if ( tmd_is_doctor() && !is_user_logged_in() ) {
        wp_redirect( add_query_arg( array( 'redirect_to' => get_permalink() ), site_url( '/register' ) ) );
        exit;
    }

}
