<?php

/**
 * TripMD Hospital/Doctor Rating/Reviews
 *
 * @package TripMD
 * @subpackage Review
 */

/**
 * Doctor review submission handler
 */
function tmd_review_doctor_handler() {
    global $wpdb;

    if ( !wp_verify_nonce( $_POST['_wpnonce'], 'tmd_review_doctor_nonce' ) )
        tmd_add_error( 'nonce', __( 'Are you sure you\'re doing that?', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_name'] ) )
        tmd_add_error( 'required-name', __( 'Please provide your full name.', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_email'] ) || !is_email( $_POST['tmd_review_email'] ) )
        tmd_add_error( 'required-email', __( 'Please provide a valid email id.', 'tripmd' ) );
    // elseif ( $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$wpdb->prefix}tmd_beta_users WHERE email = %s LIMIT 1", $_POST['tmd_review_email'] ) ) )
    //    tmd_add_error( 'exists-email', __( 'You\'ve already registered with this email id.', 'tripmd' ) );

    if ( empty( $_POST['tmd_review_parent_id'] ) )
        tmd_add_error( 'required-parent', __( 'Sorry but what are you reviewing?', 'tripmd' ) );
    else {
        $parent = get_post( isset( $_POST['tmd_review_parent_id'] ) ? (int) $_POST['tmd_review_parent_id'] : 0 );
        if ( empty( $parent->comment_status ) || ! comments_open( $parent->ID ) || ! in_array( $parent->post_type, array( 'hospital', 'doctor' ) ) )
            tmd_add_error( 'required-parent', __( 'Sorry but what are you reviewing?', 'tripmd' ) );
    }

    if ( tmd_has_errors() )
        return;

    $comment_data = array(
        'comment_post_ID' => $parent->ID,
        'comment_author' => trim( strip_tags( $_POST['tmd_review_name'] ) ),
        'comment_author_email' => trim( $_POST['tmd_review_email'] ),
        'comment_author_url' => null,
        'comment_content' => trim( $_POST['tmd_review_comment'] ),
        'comment_type' => 'review',
        'comment_parent' => 0
    );

    $comment_id = wp_new_comment( $comment_data );
    if ( empty ( $comment_id ) ) {
        tmd_add_error( 'error-registration', __( 'There was a problem adding the review. Please try again or contact us at support@tripmd.com.', 'tripmd' ) );
    } else {

        // Sanitize ratings
        $rating = array(
            'quality'       => intval( $_POST['tmd_review_rating']['quality']       ),
            'communication' => intval( $_POST['tmd_review_rating']['communication'] ),
            'friendliness'  => intval( $_POST['tmd_review_rating']['friendliness']  )
        );

        // Add review meta
        add_comment_meta( $comment_id, 'tmd_review_nationality', trim( $_POST['tmd_review_nationality'] ), true );
        add_comment_meta( $comment_id, 'tmd_review_subscribe', intval( $_POST['tmd_review_subscribe'] ), true );
        add_comment_meta( $comment_id, 'tmd_review_rating', serialize( $rating ), true );
    }
}